/**
 * تعاملات تعاملی صفحه اصلی قالب هاشویچ
 *
 * @package Hashvich
 */

(function ($) {
	'use strict';

	// ۱. کانتینر توئست‌ها
	var toastContainer = document.querySelector('[role="status"][aria-live="polite"]');
	if (!toastContainer) {
		toastContainer = document.createElement('div');
		toastContainer.setAttribute('role', 'status');
		toastContainer.setAttribute('aria-live', 'polite');
		toastContainer.className = 'pointer-events-none fixed inset-x-0 bottom-6 z-[70] flex flex-col items-center gap-2 px-4';
		document.body.appendChild(toastContainer);
	}

	/**
	 * نمایش توئست اعلان
	 *
	 * @param {string} message متن پیام
	 * @param {string} [actionUrl] آدرس دکمه اقدام
	 * @param {string} [actionText] متن دکمه اقدام
	 */
	function showToast(message, actionUrl, actionText) {
		var toast = document.createElement('div');
		toast.className = 'pointer-events-auto flex items-center gap-3 rounded-full bg-forest px-5 py-3 text-white shadow-[0_10px_30px_rgba(0,0,0,0.35)] text-[14px] transition-all duration-300 translate-y-4 opacity-0 border border-white/10';

		var checkSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-sun shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>';
		var html = checkSvg + '<span>' + message + '</span>';

		if (actionUrl && actionText) {
			html += '<a href="' + actionUrl + '" class="round ml-1 rounded-full bg-sun px-3 py-1 text-[12px] font-semibold text-ink hover:bg-sun-2 transition-colors">' + actionText + '</a>';
		}

		toast.innerHTML = html;
		toastContainer.appendChild(toast);

		requestAnimationFrame(function () {
			toast.classList.remove('translate-y-4', 'opacity-0');
		});

		setTimeout(function () {
			toast.classList.add('opacity-0', 'translate-y-2');
			setTimeout(function () {
				if (toast.parentNode) {
					toast.parentNode.removeChild(toast);
				}
			}, 300);
		}, 3800);
	}

	// ۲. مدیریت تایمرهای شمارش معکوس بخش پیشنهادهای لحظه‌ای (deals)
	function initDealsTimers() {
		var timers = document.querySelectorAll('[role="timer"]');
		if (!timers.length) return;

		timers.forEach(function (timer) {
			var spans = timer.querySelectorAll('span[aria-hidden="true"]');
			if (spans.length < 3) return;

			var h = parseInt(spans[0].textContent, 10) || 0;
			var m = parseInt(spans[1].textContent, 10) || 0;
			var s = parseInt(spans[2].textContent, 10) || 0;
			var totalSeconds = h * 3600 + m * 60 + s;
			if (totalSeconds <= 0) totalSeconds = 45 * 60 + 30;

			timer.dataset.seconds = totalSeconds;
		});

		setInterval(function () {
			timers.forEach(function (timer) {
				var sec = parseInt(timer.dataset.seconds, 10);
				if (sec > 0) {
					sec -= 1;
					timer.dataset.seconds = sec;

					var hours = Math.floor(sec / 3600);
					var minutes = Math.floor((sec % 3600) / 60);
					var seconds = sec % 60;

					var spans = timer.querySelectorAll('span[aria-hidden="true"]');
					if (spans.length >= 3) {
						spans[0].textContent = (hours < 10 ? '0' : '') + hours;
						spans[1].textContent = (minutes < 10 ? '0' : '') + minutes;
						spans[2].textContent = (seconds < 10 ? '0' : '') + seconds;
					}
				}
			});
		}, 1000);
	}

	// ۳. مدیریت انتخابگر تعداد در کارت‌های پیشنهاد ویژه
	function initQuantitySelectors() {
		document.querySelectorAll('[role="group"][aria-label*="تعداد"]').forEach(function (group) {
			var buttons = group.querySelectorAll('button');
			var countSpan = group.querySelector('span[aria-live="polite"]');
			var minusBtn = buttons[0];
			var plusBtn = buttons[1];
			var article = group.closest('article');
			var addToCartBtn = article ? article.querySelector('.add-to-cart-deal, button.bg-leaf, a.add_to_cart_button') : null;

			if (!countSpan || !minusBtn || !plusBtn) return;

			var count = parseInt(countSpan.textContent, 10) || 1;
			minusBtn.disabled = count <= 1;

			plusBtn.addEventListener('click', function (e) {
				e.preventDefault();
				count += 1;
				countSpan.textContent = count;
				minusBtn.disabled = false;
				if (addToCartBtn) {
					addToCartBtn.setAttribute('data-quantity', count);
				}
			});

			minusBtn.addEventListener('click', function (e) {
				e.preventDefault();
				if (count > 1) {
					count -= 1;
					countSpan.textContent = count;
					minusBtn.disabled = (count <= 1);
					if (addToCartBtn) {
						addToCartBtn.setAttribute('data-quantity', count);
					}
				}
			});
		});
	}

	// ۴. دکمه نشان‌کردن و علاقه‌مندی‌ها (Heart Toggle)
	function initFavorites() {
		document.querySelectorAll('button[aria-label*="ذخیره"]').forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var isPressed = btn.getAttribute('aria-pressed') === 'true';
				var newPressed = !isPressed;
				btn.setAttribute('aria-pressed', newPressed ? 'true' : 'false');

				var svg = btn.querySelector('svg');
				if (svg) {
					if (newPressed) {
						svg.setAttribute('fill', '#c03d17');
						svg.classList.add('text-tomato');
						svg.classList.remove('text-muted');
						showToast('به لیست علاقه‌مندی‌های شما اضافه شد.');
					} else {
						svg.setAttribute('fill', 'none');
						svg.classList.remove('text-tomato');
						svg.classList.add('text-muted');
						showToast('از لیست علاقه‌مندی‌ها حذف شد.');
					}
				}
			});
		});
	}

	// ۵. رویداد دکمه افزودن به سبد در بخش پیشنهادهای ویژه
	$(document).on('click', '.add-to-cart-deal', function (e) {
		e.preventDefault();
		var $btn = $(this);
		var card = $btn.closest('article');
		var itemName = card.find('h3').text().trim() || 'غذا';
		var qty = parseInt($btn.attr('data-quantity'), 10) || 1;
		var productId = $btn.attr('data-product_id');

		$btn.addClass('bg-leaf-2 ring-2 ring-leaf ring-offset-2');
		setTimeout(function () {
			$btn.removeClass('bg-leaf-2 ring-2 ring-leaf ring-offset-2');
		}, 800);

		if (productId && window.wc_add_to_cart_params) {
			var endpoint = window.wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart');
			$.post(endpoint, {
				product_id: productId,
				quantity: qty
			}, function (response) {
				if (response && response.fragments) {
					$.each(response.fragments, function (key, value) {
						$(key).replaceWith(value);
					});
					$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $btn]);
				}
			});
		} else {
			var cartUrl = (window.hashvichData && window.hashvichData.cartUrl) ? window.hashvichData.cartUrl : '/cart/';
			var viewCart = (window.hashvichData && window.hashvichData.viewCart) ? window.hashvichData.viewCart : 'مشاهده سبد';
			showToast('«' + itemName + '» (' + qty + ' عدد) به سبد خرید اضافه شد.', cartUrl, viewCart);

			var $badge = $('.hv-cart-count');
			if ($badge.length) {
				var cur = parseInt($badge.text().replace(/\D/g, ''), 10) || 0;
				$badge.text('(' + (cur + qty) + ')');
			}
		}
	});

	// ۶. رویداد افزوده شدن به سبد خرید ووکامرس (AJAX Added to Cart)
	$(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {
		var itemName = 'غذا';
		if ($button && $button.length) {
			var card = $button.closest('article');
			if (card.length) {
				var heading = card.find('h3');
				if (heading.length) {
					itemName = heading.text().trim();
				}
			}
			$button.addClass('bg-leaf-2 ring-2 ring-leaf ring-offset-2');
			setTimeout(function () {
				$button.removeClass('bg-leaf-2 ring-2 ring-leaf ring-offset-2');
			}, 800);
		}

		var cartUrl = (window.hashvichData && window.hashvichData.cartUrl) ? window.hashvichData.cartUrl : '/cart/';
		var viewCart = (window.hashvichData && window.hashvichData.viewCart) ? window.hashvichData.viewCart : 'مشاهده سبد';

		showToast('«' + itemName + '» به سبد خرید اضافه شد.', cartUrl, viewCart);
	});

	// اجرای تمامی ماژول‌ها پس از آماده‌سازی سند
	$(document).ready(function () {
		initDealsTimers();
		initQuantitySelectors();
		initFavorites();
	});

})(jQuery);
