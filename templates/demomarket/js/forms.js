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
