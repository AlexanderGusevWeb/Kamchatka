/** Скрипт автоматической отправки формы оплаты */
$(function() {
	$('body').hide(0, function() {
		$('main .order form').get(0).submit();
	});
});
