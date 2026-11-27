/**
 * اسکریپت تعاملی صفحه پیشنهادها و تخفیف‌ها (Offers & Promos)
 *
 * @package Hashvich
 */

(function ($) {
	'use strict';

	function toPersianNum(num) {
		if (num === null || num === undefined) return '';
		const faDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
		return num.toString().replace(/\d/g, function (w) {
			return faDigits[+w];
		});
	}

	function pad(n) {
		return n < 10 ? '0' + n : n;
	}

	// ۱. کپی کد تخفیف در کلیپ‌بورد با فیدبک بصری
	$(document).on('click', '.hv-copy-coupon', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const code = $btn.data('code');

		if (navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(code).then(() => {
				const originalText = $btn.find('span').text();
				$btn.addClass('bg-leaf text-white border-leaf').find('span').text('کپی شد!');
				setTimeout(() => {
					$btn.removeClass('bg-leaf text-white border-leaf').find('span').text(originalText);
				}, 2000);
			});
		} else {
			// فال‌بک
			const $temp = $('<input>');
			$('body').append($temp);
			$temp.val(code).select();
			document.execCommand('copy');
			$temp.remove();
			$btn.find('span').text('کپی شد!');
			setTimeout(() => $btn.find('span').text('کپی کد'), 2000);
		}
	});

	// ۲. تایمر معکوس پیشنهادهای لحظه‌ای با اعداد فارسی
	function startCountdown() {
		const $timer = $('#hv-deals-countdown');
		if (!$timer.length) return;

		let secondsLeft = 2 * 3600 + 45 * 60 + 18;

		setInterval(() => {
			if (secondsLeft <= 0) {
				secondsLeft = 3 * 3600; // ریست دوره
			}
			secondsLeft--;

			const hours = Math.floor(secondsLeft / 3600);
			const minutes = Math.floor((secondsLeft % 3600) / 60);
			const seconds = secondsLeft % 60;

			const timeStr = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
			$timer.text(toPersianNum(timeStr));
		}, 1000);
	}

	$(document).ready(function () {
		startCountdown();
	});

})(jQuery);
