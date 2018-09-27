(function(w, $, _, getLabel) {

/**
 * Модуль корзины товаров
 * @type {Object}
 */
site.Cart = {
	/** @type {Boolean} Статус готовности корзины */
	ready: true,

	/** @type {Boolean} Является ли текущая страница корзиной */
	isCartPage: _.isArray(w.document.location.pathname.match(/emarket\/cart/)),

	/** Инициализация модуля */
	init: function() {

		/** @type {string} Селектор всплывающего окна для кнопки "Купить" */
		var buyModalSelector = '#buy_modal';

		/** @type {string} Селектор всплывающего окна для кнопки "Купить в один клик" */
		var oneClickModalSelector = '#oneclick_modal';

		/**
		 * Нажатие на кнопку "Купить" ("Добавить" для связанных товаров в корзине).
		 * Если у товара есть опционные свойства - появляется всплывающее окно с выбором свойств.
		 * Если опционных свойств нет - товар добавляется в корзину.
		 */
		$('a.add_to_cart_button').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			var isNotInStock = $this.hasClass('not_buy');

			if (isNotInStock) {
				return;
			}

			var $optionedPropertiesBlock = $this.parents('.add_to_cart_block').find('.hidden_optioned_properties');

			if ($optionedPropertiesBlock.length === 0) {
				w.location.href = this.href;
				return;
			}

			var $buyModal = $(buyModalSelector);
			$buyModal.find('main').html($optionedPropertiesBlock.html());
			var $form = $buyModal.find('form');
			$form.attr('action', this.href);

			$buyModal.modal('show');
		});

		/** Нажатие на кнопку "Купить в один клик". */
		$('a.buy_one_click_button').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			var isNotInStock = $this.hasClass('not_buy');

			if (isNotInStock) {
				return;
			}

			var $addToCartBlock = $this.parents('.add_to_cart_block');
			var $oneClickModal = $(oneClickModalSelector);

			var elementId = $addToCartBlock.data('element_id');
			$oneClickModal.data('element_id', elementId);

			var $optionedPropertiesBlock = $addToCartBlock.find('.hidden_optioned_properties');

			if ($optionedPropertiesBlock.length > 0) {
				$('#one_click_order_optioned_properties')
					.html($optionedPropertiesBlock.html())
					.find('input[type="submit"]')
					.remove(); // Удаляем ненужную кнопку 'Добавить в корзину'
			}

			$oneClickModal.modal('show');
		});

		/** Нажатие на кнопку "Оформить заказ" внутри всплывающего окна для заказа в один клик. */
		$(oneClickModalSelector).find('form').on('submit', function() {
			var elementId = $(oneClickModalSelector).data('element_id');
			var $form = $(this);
			$form.attr('action', $form.attr('action') + 'element/' + elementId);
			return true;
		});

		/** Кнопка-крестик удаления товара из корзины */
		$('.order_delete').on('click', function(e) {
			e.preventDefault();
			site.Cart.remove(this.id.match(/\d+/).pop());
		});

		/** Изменение количества товара через кнопки "плюс/минус" */
		$('.change_product_quantity a').on('click', function(e) {
			e.preventDefault();

			if (!site.Cart.ready) {
				return;
			}

			site.Cart.ready = false;

			var $this = $(this);
			var orderItemId = $this.parent().data('id');
			var orderItemBlock = $('#order_item_' + orderItemId);

			var quantityNode = $('.quantity', orderItemBlock).contents()[0];
			var oldQuantity = parseInt(quantityNode.textContent, 10);
			var newQuantity = $this.hasClass('increment_product_quantity') ? oldQuantity + 1 : oldQuantity - 1;

			quantityNode.textContent = newQuantity;
			site.Cart.modify(orderItemId, newQuantity, oldQuantity);
		});
	},

	/**
	 * Возвращает функцию, которая вызывается после обновления корзины в бекенде,
	 * @see js/client/basket.js, basket.__request()
	 * Функция отвечает за обновление фронтенда корзины - пересчет количества товаров, цен, скидок и т.д.
	 *
	 * @param {Number|String} id Идентификатор измененного товарного наименования
	 * @returns {Function}
	 */
	redraw: function(id) {
		return function(data) {
			if (data.summary.amount > 0) {
				site.Cart.drawPopulatedCart(id, data);
			} else {
				site.Cart.drawEmptyCart();
			}

			var cartHeader = getLabel('js-cart_header') + data.summary.amount;
			$('#basketTooltipToggle').text(cartHeader);

			site.Cart.ready = true;
		};
	},

	/**
	 * Обновляет UI непустой корзины
	 * @param {Number|String} id Идентификатор измененного товарного наименования
	 * @param {Array} data данные корзины из бекенда
	 */
	drawPopulatedCart: function(id, data) {
		var formatPrice = site.helpers.formatPrice;
		var prefix = data.summary.price.prefix;
		var suffix = data.summary.price.suffix;

		var orderDiscount = data.summary.price.discount || 0;
		$('#order_discount').text(formatPrice(orderDiscount, prefix, suffix));

		var orderPrice = data.summary.price.original || data.summary.price.actual;
		$('#order_price').text(formatPrice(orderPrice, prefix, suffix));

		var orderItemBlock = $('#order_item_' + id);
		var orderItemWasRemoved = true;

		_.each(data.items.item, function(orderItem) {
			if (orderItem.id != id) {
				return;
			}

			orderItemWasRemoved = false;
			var orderItemTotalPrice = formatPrice(orderItem["total-price"].actual, prefix, suffix);
			var discount = orderItem.discount ? orderItem.discount.amount : 0;
			var orderItemDiscount = formatPrice(discount, prefix, suffix);

			$('.order_sum span', orderItemBlock).text(orderItemTotalPrice);
			$('.order_sale span', orderItemBlock).text(orderItemDiscount);
		});

		if (orderItemWasRemoved) {
			orderItemBlock.remove();
		}
	},

	/** Выводит на фронтенд пустую корзину */
	drawEmptyCart: function() {
		$.get('/templates/demomarket/js/cart/empty.html', function (data) {
			var emptyTemplate = _.template(data);
			var params = {
				'cart_empty': getLabel('js-cart_empty'),
				'return_to_catalog': getLabel('js-return_to_catalog')
			};

			$('.cart')
				.removeClass('cart')
				.addClass('cart-empty')
				.html(emptyTemplate(params));
		});
	},

	/**
	 * Отправляет аякс-запрос на изменение количества товарного наименования.
	 * Обновляет UI корзины.
	 *
	 * @param {number|string} id Идентификатор товарного наименования
	 * @param {number} newQuantity новое количество
	 * @param {number} oldQuantity предыдущее количество
	 */
	modify: function(id, newQuantity, oldQuantity) {
		if (newQuantity !== oldQuantity) {
			basket.modifyItem(id, {amount: newQuantity}, this.redraw(id));
		} else {
			this.ready = true;
		}
	},

	/**
	 * Отправляет аякс-запрос на удаление товарного наименования из корзины.
	 * Обновляет UI корзины.
	 *
	 * @param {number|string} id Идентификатор товарного наименования - числовое значение или ключевая строка `all`
	 */
	remove: function(id) {
		if (id === 'all') {
			basket.removeAll(this.redraw(id));
		} else {
			basket.removeItem(id, this.redraw(id));
		}
	}
};

$(function() {
	site.Cart.init();
});

})(window, jQuery, _, getLabel);
