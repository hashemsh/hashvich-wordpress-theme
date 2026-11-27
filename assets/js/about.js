/**
 * اسکریپت تعاملی صفحه درباره ما و تماس (About & Contact)
 *
 * @package Hashvich
 */

(function ($) {
	'use strict';

	$(document).on('click', '#hv-submit-contact-btn', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const name = $.trim($('#contact_name').val());
		const phone = $.trim($('#contact_phone').val());
		const message = $.trim($('#contact_message').val());

		if (!name || !phone || !message) {
			alert('لطفاً فیلدهای الزامی (نام، شماره تماس و متن پیام) را تکمیل نمایید.');
			return;
		}

		$btn.prop('disabled', true).text('در حال ارسال پیام...');

		setTimeout(function () {
			$btn.prop('disabled', false).text('ارسال پیام به هاشویچ');
			$('#hv-contact-form')[0].reset();
			alert('پیام شما با موفقیت دریافت شد. کارشناسان ما به زودی با شما تماس خواهند گرفت.');
		}, 600);
	});

})(jQuery);
