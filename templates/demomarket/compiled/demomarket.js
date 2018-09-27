var site = {};

/**
 * Основной модуль шаблона
 * @type {Object}
 */
site.common = {

	/** Инициализирует стили и поведение на всех страницах сайта */
	init: function() {
		initFancybox();
		initSlick();
		initVerge();
		initMenu($('#headerMobileMenu'), $('#topMenuToggle'), $('#closeMenuToggle'), 'active');
		initCaptcha();
		initToolTips();
		initFaqQuestions();
		stylizeSelects();
		stylizeVoteResults();

		registerPrintPageCallback();
		registerFilterFieldArrowCallback();
		registerMobileFilterBlockCallback();
		registerProductPreviewCallback();
		registerProductSortingCallback();
		registerSubmitPaymentCallback();
		registerCategoryMenuCallback();
		registerSubscribeFormCallback();

		/** Стилизует результаты голосования модуля "Опросы" */
		function stylizeVoteResults() {
			var $interviewRange = $('.result_range');

			$.each($interviewRange, function(key, value) {
				var rangeWidth = $(value).next().text();
				rangeWidth = parseInt(rangeWidth, 10);
				$(this).css('width', rangeWidth + '%');
			});
		}

		/** Стилизует селекты с помощью jQuery-UI */
		function stylizeSelects() {
			$('select').selectmenu();
		}

		/** Регистрирует обработчик нажатия на кнопку "Распечатать" на странице товара. */
		function registerPrintPageCallback() {
			$('a.for_print').on('click', function(e) {
				e.preventDefault();
				window.print();
			});
		}

		/** Инициализирует slick-карусели */
		function initSlick() {
			$('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});

			$('.slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				autoplay: true,
				autoplaySpeed: 3000,
				centerMode: true,
				focusOnSelect: true,
				responsive: [{
					breakpoint: 1500,
					settings: {
						arrows: false
					}
				}]
			});

			$('.subCarousel').slick({
				slidesToShow: 5,
				slidesToScroll: 1,
				responsive: [
					{
						breakpoint: 1500,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
						}
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 570,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		}

		function initMenu(menu, openToggle, closeToggle, newClass) {
			function initCollapse() {
				if (menu.hasClass(newClass)) {
					menu.removeClass(newClass);
				} else {
					menu.addClass(newClass);
				}
			}

			openToggle.click(function(event) {
				initCollapse();
				event.preventDefault();
			});

			openToggle.on('tap', function(event) {
				initCollapse();
				event.preventDefault();
			});

			if (closeToggle != false) {
				closeToggle.click(function(event) {
					initCollapse();
					event.preventDefault(event);
				});

				closeToggle.on('tap', function(event) {
					initCollapse();
					event.preventDefault();
				});
			}
		}

		/**
		 * Регистрирует обработчик нажатия на стрелочку в заголовке поля умных фильтров.
		 * Обработчик скрывает или показывает это поле.
		 */
		function registerFilterFieldArrowCallback() {
			$('.arrow_dropdown').on('click', function() {
				if ($(this).hasClass('fa-angle-up')) {
					$(this).removeClass('fa-angle-up');
					$(this).addClass('fa-angle-down');
				} else {
					$(this).removeClass('fa-angle-down');
					$(this).addClass('fa-angle-up');
				}

				var parentArrow = $(this).closest('.arrow_product');
				var animationSpeed = 400;
				parentArrow.next('.product_form').slideToggle(animationSpeed);
			});
		}

		/**
		 * Регистрирует обработчик нажатия на иконку "фильтр" в мобильной версии.
		 * Обработчик скрывает или показывает блок умных фильтров в мобильной версии.
		 */
		function registerMobileFilterBlockCallback() {
			$('.section_capt .sort_mobile').on('click', function() {
				$(this).toggleClass('sort_close');
				var animationSpeed = 400;
				$('.filter_mobile').slideToggle(animationSpeed);
			});
		}

		/**
		 * Регистрирует обработчик отправки формы выбора способа оплаты, либо формы заказа в один шаг.
		 *
		 * Если был выбран способ оплаты "Платежная квитанция", заказ оформляется особым образом:
		 *   - Отправка формы блокируется
		 *   - Создается всплывающее окно, в котором делается редирект на action формы (оформляется заказ)
		 *   - Во всплывающем окне распечатывается платежная квитанция
		 *   - Скрипт всплывающего окна инициализирует редирект основного окна на страницу успешного оформления заказа
		 */
		function registerSubmitPaymentCallback() {
			$('form#payment_choose, form.without-steps').on('submit', function() {
				var $form = $(this);
				var $payment = $("input[name='payment-id']:checked", $form);

				if ($payment.attr('class') !== 'receipt') {
					return true;
				}

				var params = $form.serialize();
				var url = $form.attr('action');

				var win = window.open("", "_blank", "width=710,height=620,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no");
				var html = "<html><head><" + "script" + ">location.href = '" + url + "?" + params + "'</" + "script" + "></head><body></body></html>";

				win.document.write(html);
				win.focus();

				return false;
			});
		}

		/** Регистрирует обработчик нажатия на иконки вида превью товаров на странице категории. */
		function registerProductPreviewCallback() {
			$('.sort_btn a').on('click', function() {
				var $button = $(this);
				var className = $button.data('class');
				$.cookie('catalog_class', className);

				$('#catalog_category')
					.removeClass('goods catalog_list catalog_inline')
					.addClass(className);
			});
		}

		/** Регистрирует обработчик нажатия на кнопки в блоке "Сортировать по" на странице категории. */
		function registerProductSortingCallback() {
			$('.sort_list a').on('click', function() {
				var $this = $(this);
				var fieldName = $this.data('field');
				$.cookie('sort_field', fieldName);

				var isAscending = !$this.parent().hasClass('up_arrow');
				var flag = isAscending ? '1' : '0';
				$.cookie('sort_direction_is_ascending', flag);

				window.location.reload(true);
			});
		}

		/** Инициализирует fancybox */
		function initFancybox() {
			$("a[rel=fancybox_group]").fancybox();
		}

		/**
		 * Регистрирует обработчик нажатия на категорию товаров первого уровня в мобильном меню.
		 * Обработчик выводит дочерние категории для этой категории.
		 */
		function registerCategoryMenuCallback() {
			$('.product_header').on('click', function() {
				var $this = $(this);
				$this.toggleClass('open');
				var animationSpeed = 400;
				$this.next('li').find('ul').slideToggle(animationSpeed);
			});
		}

		/** Регистрирует обработчик нажатия на кнопку "Подписаться" в футере. */
		function registerSubscribeFormCallback() {
			$('a.footer_subscription_button').on('click', function(e) {
				e.preventDefault();
				$(this).closest('form').submit();
			});
		}

		/**
		 * Инициализирует классическую капчу.
		 * Регистрирует обработчик нажатия на кнопку "Перезагрузить код".
		 */
		function initCaptcha() {
			$('.captcha_reset').on('click', function() {
				var now = new Date();
				$('.captcha_img').attr('src', '/captcha.php?reset&' + now.getTime());
			});
		}

		/** Инициализирует всплывающие окна через кастомную jQuery-функцию `customTooltip`. */
		function initToolTips() {
			$.fn.customTooltip = function() {
				var $tooltipBlock = $(this.attr('data-content'));

				this.tooltip({
					'html': true,
					'trigger': 'click',
					'placement': 'bottom',
					'title': $tooltipBlock.html()
				});
			};

			$('#basketTooltipToggle').customTooltip();
		}

		/** Инициализирует сворачиваемые блоки вопросов в модуле FAQ. */
		function initFaqQuestions() {
			$.fn.hideText = function(options) {

				var settings = $.extend({
					'speed': undefined,
					'dataName': 'element'
				}, options);

				this.click(function(e) {
					var block = $(e.target).data(settings['dataName']);
					var row = $(block).parent();
					var rowHeight = row.css('height');
					if (rowHeight > '95px') {
						row.css('height', '67px');
					} else {
						row.css('height', 'auto');

					}
					if (block === undefined) {
						return;
					}
					$(block).slideToggle(settings['speed'], function() {

						if ($(e.target).hasClass('sprite-hide_up')) {
							if ($(e.target).hasClass('title_link')) {
								return;
							} else {
								$(e.target).removeClass('sprite-hide_up');
							}
						} else {
							if ($(e.target).hasClass('title_link')) {
								return;
							} else {
								$(e.target).addClass('sprite-hide_up');

							}
						}
					});
				});

				return this;
			};

			$('.sprite-hide').hideText({
				speed: 'slow'
			});

			$('.title_link').hideText({
				speed: 'slow'
			});
		}

		/** Инициализирует библиотеку verge.js */
		function initVerge() {
			$.extend(verge);
		}
	},
};

/**
 * Модуль вспомогательных функций
 * @type {Object}
 */
site.helpers = {

	/**
	 * Форматирует строку цены
	 * @link https://stackoverflow.com/a/34141813
	 *
	 * @param {Number|String} price цена
	 * @param {String|null} prefix префикс цены
	 * @param {String|null} suffix суффикс цены
	 */
	formatPrice: function(price, prefix, suffix) {
		var number_format = function(number, decimals, dec_point, thousands_sep) {
			// Strip all characters but numerical ones.
			number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
			var n = !isFinite(+number) ? 0 : +number,
				prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
				sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
				dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
				s,
				toFixedFix = function (n, prec) {
					var k = Math.pow(10, prec);
					return '' + Math.round(n * k) / k;
				};
			// Fix for IE parseFloat(0.55).toFixed(0) = 0;
			s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			if (s[0].length > 3) {
				s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			}
			if ((s[1] || '').length < prec) {
				s[1] = s[1] || '';
				s[1] += new Array(prec - s[1].length + 1).join('0');
			}
			return s.join(dec);
		};

		price = number_format(price, 0, ',', ' ');
		prefix = prefix || '';
		suffix = suffix || '';

		return prefix + ' ' + price + ' ' + suffix;
	}
};

$(function() {
	site.common.init();
});

var basket = {
	get : function(callback) {
		basket.__request("/udata/emarket/basket.json", {}, callback);
	},	
	putElement : function(id, options, callback) {
		basket.__request("/udata/emarket/basket/put/element/" + id + ".json", options, callback);
	},
	modifyItem : function(id, options, callback) {
		if(options.amount == 0) {
			this.removeItem(id, callback);
			return;
		}
		basket.__request("/udata/emarket/basket/put/item/" + id + ".json", options, callback);
	},
	removeElement : function(id, callback) {
		basket.__request("/udata/emarket/basket/remove/element/" + id + ".json", {}, callback);
	},
	removeItem    : function(id, callback) {
		basket.__request("/udata/emarket/basket/remove/item/" + id + ".json", {}, callback);
	},
	removeAll     : function(callback) {
		basket.__request("/udata/emarket/basket/remove_all.json", {}, callback);
	},
	__cleanupHash : function(input) {
		return {
			customer : input.customer.object.id,
			items    : input.items,
			summary  : input.summary,
			id	:input.id
		};
	},
	__transformOptions : function(options) {
		var o = {};
		for(var i in options) {
			var k;
			if(i.toLowerCase() != "amount") k = "options[" + i + "]";
			else k = i;
			o[k] = options[i];
		}
		return o;
	},
	__request : function(url, options, callback) {
		jQuery.ajax({
			url      : url,
			type     : 'POST',
			dataType : 'json',
			data     : basket.__transformOptions(options),
			success  : function(data) {
				callback(basket.__cleanupHash(data));
			}
		});
	}
};

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

/**
 * Модуль filters
 * Используется для управления адаптивной фильтрацией
 */
site.filters = (function($) {

	"use strict";

	/**
	 * @var {Object} data Глобальные параметры фильтрации
	 */
	var data = {
		paramName: 'filter',
		url: '/udata://catalog/getSmartFilters//',
		categoryId: null,
		form: null,
		params: null,
		changedField: null,
		resultButton: {
			element: null,
			name: null
		},
		processingDone: false
	};

	/**
	 * @var {Object} filters
	 */
	var filters = {

		/**
		 * Выполняет ajax запрос для получения данных фильтрации
		 * @param {Number} categoryId ID категории, в которой выполняется фильтрация
		 * @param {Object} params параметры запроса
		 * @param {Function} onSuccess callback функция успешного получения JSON данных
		 */
		getFilters: function(categoryId, params, onSuccess) {
			var url = data.url + categoryId + '.json';

			$.ajax({
				url: url,
				data: params,
				dataType: 'json',
				type: 'get',
				success: onSuccess
			});

		},
		/**
		 * Отображает результат фильтрации (количество найденных товаров)
		 * @param {JSON} data ответ от сервера с данными о фильтрации
		 */
		showResult: function(data) {
			var button = global.getResultButton();
			button.element.val(button.name + ' (' + data.total + ')');
		},

		canShowMobileFilters: function() {
			return $.viewportW() < 992;
		},

		/** Инициализирует основные параметры фильтрации */
		init: function() {
			var formSelector = this.canShowMobileFilters() ? '.mobile_filters' : '.desktop_filters';
			data.form = $(formSelector);
			data.categoryId = data.form.data('category');
			data.resultButton.element = $('.show_result', data.form);
			data.resultButton.name = data.resultButton.element.val();

			$('.reset', data.form).click(function(e) {
				e.preventDefault();
				location.href = location.pathname;
			});

			$('.slider_field', data.form).each(function() {
				var rangeBlock = $(this).find('.delta_price');
				var from = rangeBlock.children('input.min');
				var to = rangeBlock.children('input.max');
				var startValue = parseFloat(from.data('minimum'));
				var selectedStartValue = parseFloat(from.val());
				var endValue = parseFloat(to.data('maximum'));
				var selectedEndValue = parseFloat(to.val());

				var $slider = $(this).find('.price_progress .range');

				$slider.siblings('.min_val').text(startValue);
				$slider.siblings('.max_val').text(endValue);

				$slider.slider({
					range: true,
					min: startValue,
					max: endValue,
					values: [selectedStartValue, selectedEndValue],
					slide: function(event, ui) {
						from.val(ui.values[0]);
						to.val(ui.values[1]);
					},
					change: function(event, ui) {
						if (from.val() == ui.value) {
							onChange(from.get(0));
						}

						if (to.val() == ui.value) {
							onChange(to.get(0));
						}
					}
				});
			});

			$('.date_field input[type=text]', data.form).each(function() {
				var minDate = new Date(Date.parse($(this).data('minimum')));
				var maxDate = new Date(Date.parse($(this).data('maximum')));
				var selectedDate = new Date(Date.parse($(this).val()));
				var formattedDate = form.formatDate(selectedDate);
				$(this).val(formattedDate);
				$(this).datepicker({
					dateFormat: "d.m.yy",
					minDate: minDate,
					maxDate: maxDate
				});
			});
		}
	};

	/**
	 * @var {Object} helper Содержит функции-помощники
	 */
	var helper = {

		/**
		 * Возвращает есть ли в адресе параметры фильтрации
		 * @param {String} address адрес
		 * @returns {Boolean}
		 */
		hasFilterParam: function(address) {
			var query = address || location.search;
			var params = this.getAllParams(query);

			for (var name in params) {
				if (params.hasOwnProperty(name)) {
					if (helper.getArrayParamName(name) === data.paramName) {
						return true;
					}
				}
			}

			return false;
		},

		/**
		 * Возвращает все параметры и их значения из строки запроса в виде объекта
		 * вида {paramName1: paramValue1, paramName2: paramValue2 ...}
		 * @param {String} query адрес с GET-параметрами
		 * @returns {Object}
		 */
		getAllParams: function(query) {
			var query = query || location.search;
			var decodedQuery = decodeURIComponent(query);
			decodedQuery = decodedQuery.replace(/^\?/, '');
			var params = {};

			if (typeof query === 'string' && query.length === 0) {
				return params;
			}

			var paramGroups = decodedQuery.split('&');

			for (var i = 0; i < paramGroups.length; i++) {
				var group = paramGroups[i].split('=');
				var name = group[0];
				var value = group[1];
				params[name] = value;
			}

			return params;
		},

		getRangeParams: function() {
			var fields = form.getAllFields(form.getFilterForm());
			var params = {};
			var bound;
			var field;

			for (var num in fields) {
				field = fields[num];
				bound = form.getBound(field);

				if (bound === 'from' || bound === 'to') {
					params[$(field).attr('name')] = $(field).val();
				}
			}
			return params;
		},

		/**
		 * Возвращает имя массива по имени параметра
		 * @param {String} paramName имя параметра
		 * @returns {String} имя массива
		 */
		getArrayParamName: function(paramName) {
			var bracketPos = paramName.indexOf('[');

			if (bracketPos === -1) {
				return paramName;
			}

			return paramName.slice(0, bracketPos);
		},

		/**
		 * Возвращает объект только с данными о параметрах фильтрации
		 * вида вида {paramName1: paramValue1, paramName2: paramValue2 ...}
		 * @returns {Object}
		 */
		getFilterParams: function() {
			var allParams = this.getAllParams();
			var filterParams = {};

			for (var name in allParams) {
				if (this.getArrayParamName(name) === data.paramName) {
					filterParams[name] = allParams[name];
				}
			}

			return filterParams;
		},

		/**
		 * Возвращает имя поля по имени параметра
		 * @param {String} paramName имя параметра
		 * @returns {String} имя поля или пустую строку
		 */
		getFieldNameByParam: function(paramName) {
			var matches = /^(\w+)?\[(\w+)/.exec(paramName);

			if (typeof matches[2] !== 'undefined') {
				return matches[2];
			}

			return '';
		},

		/**
		 * Производит слияние двух объектов параметра из source в target
		 * @param {Object} target
		 * @param {Object} source
		 * @returns {Object} target
		 */
		mergeParams: function(target, source) {
			$.extend(target, source);

			return target;
		},

		/**
		 * Назначает обработчик событий выбора значения в фильтре для полей разных типов
		 * @param {Function} onChange обрабочик событий
		 */
		bindValueChangeHandler: function(onChange) {
			var field = this;
			var $field = $(field);
			var fieldType = form.getType(field);

			switch (true) {
				case fieldType.tag === 'input' && (fieldType.type === 'radio' || fieldType.type === 'checkbox'): {
					$field.click(onChange);
					break;
				}

				case $field.parents('.date_field').length > 0: {
					$field.change(onChange);
					break;
				}

				default : {
					// Поле со слайдером
					$field.bind('focus', function() {
						$(this).data('originValue', $(this).val());
					});

					$field.focusout(function(e) {
						var originValue = $(this).data('originValue');

						if ($(this).val() !== originValue) {
							onChange(e);
						}
					});
				}
			}
		},
		/**
		 * Возвращает данные, пришедшие от сервера по полю с именем name
		 * @param {JSON} data данные от сервера
		 * @param {String} name имя поля
		 * @returns {JSON}
		 */
		getFieldDataByName: function(data, name) {
			var groups = getGroups(data);
			var fields = getSubNodes(groups, 'field');

			for (var num in fields) {
				var field = fields[num];
				if (typeof field.name === 'string' && field.name === name) {
					return field;
				}
			}

			return null;

			/**
			 * Возвращает данные групп полей
			 * @param {JSON} data
			 * @returns {JSON}
			 */
			function getGroups(data) {
				var groups = {};
				for (var pos in data['group']) {
					groups[pos] = data['group'][pos];
				}
				return groups;
			}

			/**
			 * Возвращает данные о дочерних элементах с именем nodeName
			 * @param {JSON} data
			 * @param {String} nodeName имя дочернего элемента
			 * @returns {JSON}
			 */
			function getSubNodes(data, nodeName) {
				var subNodes = {};
				var i = 0;

				for (var num in data) {
					var nodes = data[num][nodeName];

					for (var num in nodes) {
						subNodes[i] = nodes[num];
						i++;
					}
				}
				return subNodes;
			}
		},

		/**
		 * Возвращает значения для поля (узлы item)
		 * @param {JSON} data
		 * @returns {JSON}
		 */
		getItems: function(data) {
			return (data && data.item ? data.item : null);
		},

		/**
		 * Удаляет параметр поля field из объекта params
		 * @param {HTMLElement} field поле фильтрации
		 * @param {Object} params параметры
		 */
		deleteParam: function(field, params) {
			var paramName = $(field).attr('name');

			if (params[paramName]) {
				delete params[paramName];
			}
		}
	};

	/**
	 * @var {Object} form Объект, содержащий функции для работы с формой фильтрации
	 */
	var form = {

		/**
		 * Выполняет функцию callback для всех полей fields, которые соответствуют критерию filter
		 * @param {Object} fields объект содержащий данные о полях формы фильтрации
		 * @param {Function} callback функция, которая будет выполнена для каждого поля
		 * @param {Function} filter функция, которая выступает в качестве критерия для отбора полей
		 */
		forEachField: function(fields, callback, filter) {
			var callback = typeof callback === 'function' ? callback : function() {
			};
			var filter = typeof filter === 'function' ? filter : function() {
				return true;
			};

			var field = null;
			var extraArgs = Array.prototype.slice.call(arguments, 3);
			for (var name in fields) {
				if (fields.hasOwnProperty(name)) {
					field = fields[name];

					if (filter(field)) {
						callback.apply(field, extraArgs);
					}
				}
			}
		},

		/**
		 * Возвращает параметр с его значением поля
		 * @param {HTMLElement} field поле
		 * @returns {Object}
		 */
		getFieldParams: function(field) {
			var $field = $(field);
			var newValue = $field.val();
			var paramName = $field.attr('name');
			var param = {};
			var fieldType = form.getType(field);

			if (fieldType.type === 'checkbox' && !$field.prop('checked')) {
				return param;
			}

			param[paramName] = newValue;
			return param;
		},

		/**
		 * Выполняет визуальную "деактивацию" поля
		 */
		resetField: function() {
			var field = this;

			if ($(field).parent().length) {
				form.makeInActive(field);
			}
		},

		/**
		 * Изменяет состояние поля в зависимости от переданных данных
		 * @param {JSON} data
		 */
		fillField: function(data) {
			var field = this;
			var fieldType = form.getType(field);

			var paramName = $(field).attr('name');
			var fieldName = helper.getFieldNameByParam(paramName);
			var fieldData = helper.getFieldDataByName(data, fieldName);

			if (fieldType.type === 'checkbox') {
				form.fillCheckBoxField(field, fieldData);
			} else if (fieldType.type === 'radio') {
				form.fillRadioField(field, fieldData);
				// Input "From To"
			} else {
				form.fillFromToField(field, fieldData);
			}

		},
		/**
		 * Возвращает все поля формы form
		 * @param {String|Jquery|HTMLElement} form форма
		 * @returns {Object}
		 */
		getAllFields: function(form) {
			var fieldsSelector = 'input[name]';
			var allFields = {};
			var i = 0;

			$(fieldsSelector, form).each(function(num, field) {
				allFields[i] = field;
				i++;
			});

			return allFields;
		},

		/**
		 * Возвращает форму фильтрации
		 */
		getFilterForm: function() {
			return data.form;
		},

		/**
		 * Возвращает объект с именем тега и типом (атрибут type) поля
		 * @param {HTMLElement} field поле
		 */
		getType: function(field) {
			var tag = $(field).prop('tagName').toLowerCase();
			var type = $(field).attr('type') || null;

			return {
				tag: tag,
				type: type
			};
		},

		/**
		 * Сделать поле активным
		 * @param {HTMLElement} field поле
		 */
		makeActive: function(field) {
			$(field).parent().removeClass('filter_disabled');
			$(field).removeAttr('disabled');
		},

		/**
		 * Сделать поле неактивным
		 * @param {HTMLElement} field поле
		 */
		makeInActive: function(field) {
			$(field).parent().addClass('filter_disabled');
			$(field).attr('disabled', '');
		},

		/**
		 * Изменяет состояние поля типа "Checkbox" в зависимости от переданных данных
		 * @param {HTMLElement} field поле
		 * @param {JSON} data
		 */
		fillCheckBoxField: function(field, data) {
			var items = null;
			var fieldValue = $(field).val();

			if (data) {
				items = helper.getItems(data);

				for (var num in items) {
					var item = items[num];

					if (item.value === fieldValue) {
						form.makeActive(field);
					}
				}
			}
		},
		/**
		 * Изменяет состояние поля типа "Radio" в зависимости от переданных данных
		 * @param {HTMLElement} field поле
		 * @param {JSON} data
		 */
		fillRadioField: function(field, data) {
			var fieldValue = $(field).val();

			if (typeof fieldValue === 'string' && fieldValue.length === 0) {
				form.makeActive(field);
			}

			form.fillCheckBoxField(field, data);
		},

		/**
		 * Изменяет состояние поля типа "От-До" в зависимости от переданных данных
		 * @param {HTMLElement} field поле
		 * @param {JSON} data
		 */
		fillFromToField: function(field, data) {
			if (!data) {
				return;
			}

			if (data.minimum && data.minimum.value && form.getBound(field) === 'from') {
				if (data['data-type'] != 'date') {
					$(field).val(data.minimum.value);
					return;
				}
				var minDate = form.timestamp2date(data.minimum.value);
				$(field).val(form.formatDate(minDate));
			}

			if (data.maximum && data.maximum.value && form.getBound(field) === 'to') {
				if (data['data-type'] != 'date') {
					$(field).val(data.maximum.value);
					return;
				}
				var maxDate = form.timestamp2date(data.maximum.value);
				$(field).val(form.formatDate(maxDate));
			}
		},

		/**
		 * Преобразует timestamp в Date
		 * @param {Integer} timestamp
		 * @returns {Date}
		 */
		timestamp2date: function(timestamp) {
			return new Date(timestamp * 1000);
		},

		/**
		 * Преобразует Date в строковую дату
		 * @param {Date} date
		 * @returns {String}
		 */
		formatDate: function(date) {
			if (!date instanceof Date) {
				return 'Date expected';
			}

			return date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear();
		},

		/**
		 * Возвращает имя границы (from или to) поля
		 * @param {HTMLElement} field
		 * @returns {String}
		 */
		getBound: function(field) {
			var name = $(field).attr('name');
			var matches = /\[(\w+)\]$/.exec(name);

			if (matches && matches[1]) {
				return matches[1];
			}

			return '';
		}
	};

	/**
	 * @var {Object} global Объект управления глобальными параметрами
	 */
	var global = {

		/**
		 * Установливает глобальные параметры
		 * @param {Object} params
		 */
		setParams: function(params) {
			data.params = params;
		},

		/**
		 * Возвращает глобальные параметры
		 */
		getParams: function() {
			return data.params || {};
		},

		/**
		 * Устанавливает поле, значение которого было изменено пользователем
		 * @param {HTMLElement} field
		 */
		setChangedField: function(field) {
			data.changedField = field;
		},

		/**
		 * Возвращает поле, значение которого было изменено пользователем
		 * @param {HTMLElement} field
		 */
		getChangedField: function() {
			return data.changedField;
		},

		/**
		 * Возвращает ID категории, по которой выполняется фильтрация
		 * @returns {Number} ID категории
		 */
		getCategoryId: function() {
			return data.categoryId;
		},

		/**
		 * Возвращает кнопку отображаения результатов
		 * @returns {HTMLElement}
		 */
		getResultButton: function() {
			return data.resultButton;
		}
	};

	$(function() {
		filters.init();

		if (helper.hasFilterParam()) {
			var params = helper.getFilterParams();
			global.setParams(params);
			filters.getFilters(global.getCategoryId(), params, processFilters);
		}

		var fields = form.getAllFields(form.getFilterForm());
		form.forEachField(fields, helper.bindValueChangeHandler, null, onChange);
	});

	function onChange(event) {
		var field = event.target || event;
		global.setChangedField(field);
		var newParams = form.getFieldParams(field);
		var currentParams = global.getParams();

		if (form.getType(field).type === 'checkbox' && !$(field).prop('checked')) {
			helper.deleteParam(field, currentParams);
		}

		helper.mergeParams(currentParams, newParams);
		var rangeParams = helper.getRangeParams();
		helper.mergeParams(currentParams, rangeParams);
		global.setParams(currentParams);
		filters.getFilters(global.getCategoryId(), global.getParams(), processFilters);
	}

	function processFilters(response) {
		var fields = form.getAllFields(form.getFilterForm());

		form.forEachField(fields, form.resetField, function(field) {
			return (form.getType(field).type !== 'text' && !($(field).attr('name') in global.getParams()));
		});

		form.forEachField(fields, form.fillField, null, response);

		if (!data.processingDone) {
			form.forEachField(fields, function() {
				$(this).prop('checked', true);
			}, function(field) {
				return (form.getType(field).type === 'checkbox' ||
					form.getType(field).type === 'radio') &&
					(typeof helper.getFilterParams()[field.name] !== 'undefined' &&
					field.value == helper.getFilterParams()[field.name].replace(/\+/ig, ' '));
			});
		}

		filters.showResult(response, global.getChangedField());
		data.processingDone = true;
	}

	return {
		helper: helper
	};

})(jQuery);

/**
 * Модуль форм на сайте
 * @type {Object}
 */
site.forms = {
	/**
	 * Инициализация форм
	 */
	init: function() {
		if (location.href.indexOf('forget') !== -1) {
			var $forgetPasswordForm = $('#forget');

			$forgetPasswordForm.find('input:radio').click(function() {
				$forgetPasswordForm.find('input:text').attr('name', $(this).attr('id'));
			});
		}

		if (location.href.indexOf('purchasing_one_step') !== -1) {
			site.forms.emarket.purchasingOneStep.init();
		}

		if (location.href.indexOf('purchase') !== -1) {
			site.forms.emarket.purchase.init();
		}
	},

	/**
	 * Контейнер для модулей оформления заказа
	 * @type {Object}
	 */
	emarket: {
		toggleNewObjectForm: function(container, newObjectBlock) {
			var block = $(newObjectBlock);

			if (block.length === 0) {
				return;
			}

			var $form = $('form#deliveryForm');

			if ($('input[type=radio][value!=new]', container).length > 0) {
				if ($('input[type=radio]:checked', container).val() !== 'new') {
					block.hide();
					$form.attr('novalidate', 'novalidate');
				}
			}

			$('input[type=radio]', container).click(function() {
				if ($(this).val() !== 'new') {
					block.hide();
					$form.attr('novalidate', 'novalidate');
				} else {
					block.show();
					$form.removeAttr('novalidate');
				}
			});
		},

		/**
		 * Модуль оформления заказа
		 * @type {Object}
		 */
		purchase: {
			init: function() {
				this.initDeliveryAddressPage();
				this.initInvoicePaymentPage();
			},

			// Показать/скрыть форму создания нового адреса доставки
			initDeliveryAddressPage: function() {
				var	addressBlock = '.delivery_address';
				site.forms.emarket.toggleNewObjectForm(addressBlock, '#new-address');

			},

			// Показать/скрыть форму создания нового юридического лица
			initInvoicePaymentPage: function() {
				var invoicePaymentBlock = '#invoice';
				var newLegalPersonBlock = '#new-legal-person';
				var $form = $('form#invoice');

				if ($('input[type=radio][value!=new]', invoicePaymentBlock).length > 0) {
					if ($('input[type=radio]:checked', invoicePaymentBlock).val() !== 'new') {
						$(newLegalPersonBlock).hide();
						$form.attr('novalidate', 'novalidate');
					}
				}

				$('input[type=radio]', invoicePaymentBlock).click(function() {
					if ($(this).val() !== 'new') {
						$(newLegalPersonBlock).hide();
						$form.attr('novalidate', 'novalidate');
					} else {
						$(newLegalPersonBlock).show();
						$form.removeAttr('novalidate');
					}
				});
			}
		},

		/**
		 * Модуль оформления заказа в один шаг
		 * @type {Object}
		 */
		purchasingOneStep: {
			init: function() {
				var customerSelector = '.customer.onestep';
				var	addressSelector = '.delivery_address.onestep';
				var	deliverySelector = '.delivery_choose.onestep';
				var paymentSelector = '.payment.onestep';
				var cartSelector = '.cart.onestep';

				var selectorList = [
					customerSelector,
					addressSelector,
					deliverySelector,
					paymentSelector,
					cartSelector
				];
				var actualBlocks = [];

				// Записываем только существующие блоки
				for (var i = 0; i < selectorList.length; i++) {
					if ($(selectorList[i]).length) {
						actualBlocks.push(selectorList[i]);
					}
				}

				var form = $('.without-steps');

				// Скрываем все блоки, кроме первого
				for (i = 1; i < actualBlocks.length; i++) {
					$(actualBlocks[i], form).hide();
				}

				// Показать/скрыть форму создания нового адреса доставки
				site.forms.emarket.toggleNewObjectForm(addressSelector, '#new-address');

				var animationSpeed = 300;
				var $paymentBlock = $(paymentSelector, form);
				var $deliveryBlock = $(deliverySelector, form);
				var $cartBlock = $(cartSelector, form);
				var $addressBlock = $(addressSelector, form);

				// Обработчик нажатия на кнопку "Продолжить" в форме личных данных покупателя
				$('a', customerSelector).click(function(event) {
					event.preventDefault();
					var formIsValid = true;

					if (typeof HTMLFormElement.prototype.reportValidity === 'function') {
						$('div.customer input', form).each(function(index, input) {
							if (!input.reportValidity()) {
								formIsValid = false;
							}
						});
					}

					if (formIsValid) {
						$(this).hide();
						$addressBlock.show(animationSpeed);
					}
				});

				// Обработчик события выбора адреса доставки или Самовывоза
				$('input[type=radio]', addressSelector).click(function() {
					if ($(this).data('type') === 'self') {
						$deliveryBlock.hide(animationSpeed);
						$paymentBlock.show(animationSpeed);
					} else {
						$deliveryBlock.show(animationSpeed);
					}
				});

				// Обработчик события выбора способа доставки
				$('input[type=radio]', deliverySelector).click(function() {
					if ($paymentBlock.length > 0) {
						$paymentBlock.show(animationSpeed);
					} else {
						$cartBlock.show(animationSpeed);
					}
				});

				// Обработчик события выбора способа оплаты
				$('input[type=radio]', paymentSelector).click(function() {
					$cartBlock.show(animationSpeed);
				});
			}
		}
	}
};

$(function() {
	site.forms.init();
});

/**
 * Поиск страниц на сайте.
 * Форма поиска находится в шапке сайта, файл `layout/header/bottom/search_form.phtml`
 */
(function($, _) {

	'use strict';

	var url = '/udata://search/search_do/.json';
	var searchStringParam = 'search_string';
	var perPageParam = 'per_page';
	var searchResults = {};
	var $element = null;
	var $form = null;
	var $templateElement = null;
	var $resultElement = null;
	var allResultButtonSelector = '.all_result';
	var maxResultsCount = 15;
	var template = null;
	var beforeCloseInterval = 200;

	var canShowMobileSearch = function() {
		return $.viewportW() < 992;
	};

	$(function() {
		var formSelector = canShowMobileSearch() ? '#searchFormMobile' : '#searchForm';
		$form = $(formSelector);
		$element = $('input[name=search_string]', $form).first();
		$templateElement = $('#search_result_template');
		$resultElement = $('.search_content', $form.parent());

		$resultElement.hide();

		if (!$form.length || !$element.length || !$templateElement.length) {
			return;
		}

		template = _.template($templateElement.html());

		$element.on('input', function() {
			var searchString = $element.val();
			search(searchString, function(response) {
				if (!isValidResult(response)) {
					return;
				}
				onSearchResult(searchString, response['items']);
			});
		});

		$element.on('blur', function() {
			setTimeout(function() {
				$resultElement.html('');
				$resultElement.hide();
			}, beforeCloseInterval);
		});
	});

	/**
	 * Обработчик события получения результатов поиска
	 * @param {String} searchString поисковый запрос
	 * @param result
	 */
	function onSearchResult(searchString, result) {
		saveResult(searchString, result);
		$resultElement.html('');

		var data = processResult(result);

		if (!data.length) {
			$resultElement.hide();
			return;
		}

		var resultHtml = template({typesList: data});
		$resultElement.html(resultHtml);
		$resultElement.show();

		$(allResultButtonSelector, $resultElement).on('click', function() {
			$form.submit();
		});
	}

	/**
	 * Обрабатывает результаты поиска для шаблонизатора
	 * @param {JSON} result данные найденных элементов
	 * @returns {*}
	 */
	function processResult(result) {
		var items = result['item'];

		if (!items) {
			return [];
		}

		return getDataByCategories(items);

		/**
		 * Группирует результаты найденные элементы по категориям
		 * @param {JSON} items данные найденных элементов
		 * @returns {Array}
		 */
		function getDataByCategories(items) {
			var data = $.extend(true, {}, items);
			var typesList = [];
			var type = null;

			_.each(data, function(element) {
				type = element['type'];

				if (!type) {
					type = {id: 0, name: ''};
				}

				if (type.module === 'Структура') {
					type.module = 'Страницы';
				}

				var addedType = _.findWhere(typesList, {id: type.id});

				if (!addedType) {
					typesList.push(type);
				}

				type = addedType || type;
				type['elements'] = type['elements'] || [];
				type['elements'].push(element);
			});

			return typesList;
		}
	}

	/**
	 * Проверяет вернулись ли от сервера корректные результаты поиска
	 * @param {JSON} data результаты поиска
	 * @returns {boolean}
	 */
	function isValidResult(data) {
		data = data || {};
		return !!data['items'];
	}

	/**
	 * Возвращает числовое значение (хэш) строки
	 * @param {String} str исходная строка
	 * @returns {number}
	 */
	function getHash(str) {
		var hash = 0;

		if (str.length === 0) {
			return hash;
		}

		var char = '';

		for (var i = 0; i < str.length; i++) {
			char = str.charCodeAt(i);
			hash = ((hash << 5) - hash) + char;
			hash = hash & hash;
		}

		return hash;
	}

	/**
	 * Сохраняет результаты поиска
	 * @param {String} searchString поисковый запрос
	 * @param {JSON} result результаты поиска
	 */
	function saveResult(searchString, result) {
		if (searchString) {
			searchResults[getHash(searchString)] = result;
		}
	}

	/**
	 * Выполняет поиск вхождения строки
	 * @param {String} string поисковый запрос
	 * @param {Function} callback вызывается при успешном получении результатов поиска
	 * @returns {*}
	 */
	function search(string, callback) {
		if (!string) {
			return;
		}

		callback = typeof callback === 'function' ? callback : function() {
		};

		var request = {};
		request[searchStringParam] = string;
		request[perPageParam] = maxResultsCount;

		var possibleResult = searchResults[getHash(string)];
		if (typeof possibleResult !== 'undefined') {
			return onSearchResult(string, possibleResult);
		}

		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			data: request,
			success: callback
		});
	}
})(jQuery, _);
