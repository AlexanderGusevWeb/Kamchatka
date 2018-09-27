/**
 * Инициализация виджета выбора способа доставки у ApiShip.
 * Сам виджет находится в файле /js/widget.Delivery.js.
 */
(function () {
	var infoBuilder,
		$form = $('form#deliverySettingsForm'),
		widget = {},
		$infoPanel = $('#order_delivery_apiship'),
		$widgetPanel = $('#apiShipWidget'),
		hiddenInputTpl = '',
		widgetRendered = false,
		$apiShipInput = $('input[name="delivery-id"][data-api="api-ship"]');

	$.get('/templates/demomarket/js/apiship/hidden_inputs.html', function (data) {
		hiddenInputTpl = _.template(data);
	});

	infoBuilder = new prettyInfoAboutDelivery({
		deliveryId: ApiShipId,
		showCost: true,
		onBuildDom: function (result) {
			$('#order_delivery_apiship').append($(result));
		}
	});

	if ($apiShipInput.attr('checked')) {
		showApiShipWidget();
	}

	$('input[name="delivery-id"]').on('change', function (e) {
		if ($(e.currentTarget).attr('checked') && $(e.currentTarget).attr('data-api') === 'api-ship') {
			showApiShipWidget();
		} else {
			hideApiShipWidget();
		}
	});

	/**
	 * Показывает контейнер виджета и иницирует его отрисовку
	 */
	function showApiShipWidget() {
		renderApiShipWidget();
		$widgetPanel.show();
		$infoPanel.show();
	}

	/**
	 * Прячет контейнер виджета
	 */
	function hideApiShipWidget() {
		$widgetPanel.hide();
		$infoPanel.hide();
	}

	/**
	 * Запускает отрисовку виджета
	 */
	function renderApiShipWidget() {
		if ($('#deliveryForm').length > 0) {
			saveDeliveryAddress(renderByOrderAddress);
		} else {
			renderByOrderAddress();
		}
	}

	/**
	 * Сохраняет адрес заказа
	 * @param callback обработчик успешного выполнения запроса
	 */
	function saveDeliveryAddress(callback) {
		$.ajax({
			url: '//' + window.location.host + '/emarket/purchase/delivery/address/do/?redirect_disallow=1',
			method: 'post',
			data: $('#deliveryForm').serializeArray()
		}).done(function() {
			callback();
		});
	}

	/**
	 * Запускает отрисовку виджета после запроса адреса доставки
	 */
	function renderByOrderAddress() {
		$.ajax({
			url: '//' + window.location.host + '/udata://emarket/getOrderDeliveryAddress/.json',
			dataType: 'json'
		}).done(function (result) {
			if (_.isUndefined(result.result) || _.isUndefined(result.result.city)) {
				hideApiShipWidget();
				$apiShipInput.removeAttr('checked');
				alert(getLabel('js-delivery-city-not-defined'));
				return;
			}

			initApiShipWidget(result.result.city);
		});
	}

	/**
	 * Инициаилизирует виджет
	 * @param {String} city город, куда доставляется товар
	 */
	function initApiShipWidget(city) {
		widgetRendered = true;
		widget = new widgetApiShipDelivery({
			el: '#apiShipWidget',
			orderId: basketOrderId,
			deliveryId: ApiShipId,
			city: city,
			onSelect: updateDeliveryInfo,
			disableCloseButton: true,
			disableToDoorSlider: true
		});
	}

	$form.submit(function () {
		var $radio = $('input[name=delivery-id]:checked');
		if ($radio.attr('data-api') === 'api-ship') {
			if (!widget.validate()) {
				alert(getLabel('js-choose-error-tariff-point-no-select'));
				return false;
			}
		}
		return true;
	});

	function updateDeliveryInfo(params) {
		if (widget.validate()) {
			$('#order_delivery_apiship').html($(hiddenInputTpl(params)));
			infoBuilder.updateInfo(params);
		} else {
			alert(getLabel('js-choose-error-tariff-no-select'));
		}
	}
})();
