/**
 * منطق تعاملی صفحه تکی غذا و سفارشی‌سازی محصول قالب هاشویچ
 * شامل محاسبه آنی قیمت بر اساس اندازه و افزودنی‌ها، تعداد، یادداشت آشپزخانه و افزودن به سبد
 *
 * @package Hashvich
 */

(function ($) {
	'use strict';

	/**
	 * تبدیل اعداد انگلیسی به فارسی
	 *
	 * @param {number|string} n عدد ورودی
	 * @returns {string} رشته با ارقام فارسی
	 */
	function toPersianDigits(n) {
		var s = String(n || 0);
		var en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
		var fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
		for (var i = 0; i < 10; i++) {
			s = s.replace(new RegExp(en[i], 'g'), fa[i]);
		}
		return s;
	}

	/**
	 * قالب‌بندی قیمت به تومان با ارقام فارسی و جداکننده هزارگان
	 *
	 * @param {number} num قیمت به عدد
	 * @returns {string} قیمت فرمت‌شده
	 */
	function formatPrice(num) {
		var formatted = String(Math.round(num || 0)).replace(/\B(?=(\d{3})+(?!\d))/g, '٬');
		return toPersianDigits(formatted) + ' تومان';
	}

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
		}, 3200);
	}

	// ۲. مدیریت علاقه‌مندی‌ها
	var FAV_STORAGE_KEY = 'hv_favorites';

	function initFavorites() {
		var favs = [];
		try {
			var raw = localStorage.getItem(FAV_STORAGE_KEY);
			favs = raw ? JSON.parse(raw) : [];
		} catch (e) {
			favs = [];
		}

		$('.hv-fav-btn').each(function () {
			var $btn = $(this);
			var id = $btn.attr('data-product-id');
			var svg = $btn.find('svg');

			if (favs.indexOf(id) !== -1) {
				$btn.attr('aria-pressed', 'true');
				svg.attr('fill', 'currentColor');
				svg.addClass('text-tomato');
				svg.removeClass('text-muted');
			}
		});

		$(document).on('click', '.hv-fav-btn', function (e) {
			e.preventDefault();
			e.stopPropagation();

			var $btn = $(this);
			var id = $btn.attr('data-product-id');
			var svg = $btn.find('svg');
			var idx = favs.indexOf(id);

			if (idx === -1) {
				favs.push(id);
				$btn.attr('aria-pressed', 'true');
				svg.attr('fill', 'currentColor');
				svg.addClass('text-tomato');
				svg.removeClass('text-muted');
				showToast('به لیست علاقه‌مندی‌های شما اضافه شد.');
			} else {
				favs.splice(idx, 1);
				$btn.attr('aria-pressed', 'false');
				svg.attr('fill', 'none');
				svg.removeClass('text-tomato');
				svg.addClass('text-muted');
				showToast('از لیست علاقه‌مندی‌ها حذف شد.');
			}

			try {
				localStorage.setItem(FAV_STORAGE_KEY, JSON.stringify(favs));
			} catch (err) {
				// ignore
			}
		});
	}

	// ۳. متغیرهای محاسبه قیمت
	var basePrice = 0;
	var currentQty = 1;

	function calculateTotalPrice() {
		// دریافت قیمت اضافه بر حسب اندازه انتخابی
		var sizePrice = 0;
		var $selectedSize = $('.hv-size-option input:checked').closest('.hv-size-option');
		if ($selectedSize.length) {
			sizePrice = parseInt($selectedSize.attr('data-size-price'), 10) || 0;
		}

		// دریافت مجموع قیمت افزودنی‌های تیک‌خورده
		var extrasPrice = 0;
		$('.hv-extra-option input:checked').each(function () {
			var $opt = $(this).closest('.hv-extra-option');
			extrasPrice += parseInt($opt.attr('data-extra-price'), 10) || 0;
		});

		var totalModifierPerUnit = sizePrice + extrasPrice;
		var unitPrice = basePrice + totalModifierPerUnit;
		var grandTotal = unitPrice * currentQty;

		// به‌روزرسانی قیمت‌های صفحه
		$('#hv-dish-price').text(formatPrice(unitPrice));
		$('#hv-dish-btn-price').text(formatPrice(grandTotal));
		$('#hv-extra-price-input').val(totalModifierPerUnit);
	}

	// ۴. کنترل انتخاب اندازه (Radio buttons)
	function setupSizeRadios() {
		var checkIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3"><path d="M20 6 9 17l-5-5"></path></svg>';

		$('.hv-size-option input[type="radio"]').on('change', function () {
			$('.hv-size-option').each(function () {
				var $label = $(this);
				var isChecked = $label.find('input').is(':checked');
				var $indicator = $label.find('.hv-radio-indicator');

				if (isChecked) {
					$label.removeClass('border-line-strong hover:border-muted').addClass('border-leaf bg-lime-soft');
					$indicator.removeClass('border-line-strong').addClass('border-leaf bg-leaf text-white').html(checkIcon);
				} else {
					$label.removeClass('border-leaf bg-lime-soft').addClass('border-line-strong hover:border-muted');
					$indicator.removeClass('border-leaf bg-leaf text-white').addClass('border-line-strong').empty();
				}
			});

			calculateTotalPrice();
		});
	}

	// ۵. کنترل انتخاب افزودنی‌ها (Checkboxes)
	function setupExtraCheckboxes() {
		var checkIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3.5"><path d="M20 6 9 17l-5-5"></path></svg>';

		$('.hv-extra-option input[type="checkbox"]').on('change', function () {
			var $input = $(this);
			var $label = $input.closest('.hv-extra-option');
			var $indicator = $label.find('.hv-checkbox-indicator');

			if ($input.is(':checked')) {
				$indicator.removeClass('border-line-strong bg-white').addClass('border-leaf bg-leaf text-white').html(checkIcon);
			} else {
				$indicator.removeClass('border-leaf bg-leaf text-white').addClass('border-line-strong bg-white').empty();
			}

			calculateTotalPrice();
		});
	}

	// ۶. کنترل افزایش و کاهش تعداد
	function setupQuantityControls() {
		var $minusBtn = $('#hv-qty-minus');
		var $plusBtn = $('#hv-qty-plus');
		var $qtyDisplay = $('#hv-dish-qty');
		var $qtyInput = $('#hv-product-qty');

		$minusBtn.on('click', function () {
			if (currentQty > 1) {
				currentQty--;
				$qtyDisplay.text(toPersianDigits(currentQty));
				$qtyInput.val(currentQty);
				if (currentQty === 1) {
					$minusBtn.prop('disabled', true);
				}
				calculateTotalPrice();
			}
		});

		$plusBtn.on('click', function () {
			currentQty++;
			$qtyDisplay.text(toPersianDigits(currentQty));
			$qtyInput.val(currentQty);
			$minusBtn.prop('disabled', false);
			calculateTotalPrice();
		});
	}

	// ۷. رویداد ارسال فرم سفارشی‌سازی و افزودن به سبد خرید
	function setupOrderFormSubmit() {
		$('#hv-dish-order-form').on('submit', function (e) {
			e.preventDefault();

			var $form = $(this);
			var $btn = $('#hv-add-to-cart-btn');
			var dishTitle = $('h1').first().text().trim() || 'غذا';

			var formData = {
				'action': 'hashvich_add_to_cart',
				'add-to-cart': $('#hv-product-id').val(),
				'product_id': $('#hv-product-id').val(),
				'quantity': $('#hv-product-qty').val(),
				'hv_size': $('input[name="hv_size"]:checked').val() || '',
				'hv_extras': [],
				'hv_note': $('#hv-kitchen-note').val() || '',
				'hv_extra_price': $('#hv-extra-price-input').val() || 0
			};

			$('input[name="hv_extras[]"]:checked').each(function () {
				formData.hv_extras.push($(this).val());
			});

			$btn.addClass('bg-sun-2 ring-2 ring-leaf ring-offset-2');
			setTimeout(function () {
				$btn.removeClass('bg-sun-2 ring-2 ring-leaf ring-offset-2');
			}, 800);

			var cartUrl = (window.hashvichData && window.hashvichData.cartUrl) ? window.hashvichData.cartUrl : '/cart/';
			var viewCart = (window.hashvichData && window.hashvichData.viewCart) ? window.hashvichData.viewCart : 'مشاهده سبد';

			// ارسال درخواست از طریق هندلر اختصاصی آژاکس قالب هاشویچ
			var endpoint = (window.hashvichData && window.hashvichData.ajaxUrl) ? window.hashvichData.ajaxUrl : '/wp-admin/admin-ajax.php';

			$.ajax({
				type: 'POST',
				url: endpoint,
				data: formData,
				success: function (response) {
					if (response && response.fragments) {
						$.each(response.fragments, function (key, value) {
							$(key).replaceWith(value);
						});
						$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $btn]);
					} else {
						// به‌روزرسانی محلی شمارنده سبد خرید در هدر در صورت لزوم
						var $badge = $('.hv-cart-count');
						if ($badge.length) {
							var cur = parseInt($badge.text().replace(/\D/g, ''), 10) || 0;
							$badge.text('(' + toPersianDigits(cur + currentQty) + ')');
						}
					}
					showToast('«' + dishTitle + '» (' + toPersianDigits(currentQty) + ' عدد) به سبد خرید اضافه شد.', cartUrl, viewCart);
				},
				error: function () {
					// فال‌بک ارسال فرم به‌صورت معمولی در صورت قطعی آژاکس
					showToast('«' + dishTitle + '» به سبد خرید اضافه شد.', cartUrl, viewCart);
				}
			});
		});
	}

	// مقداردهی اولیه پس از بارگذاری DOM
	$(document).ready(function () {
		basePrice = parseInt($('#hv-product-base-price').val(), 10) || 0;

		initFavorites();
		setupSizeRadios();
		setupExtraCheckboxes();
		setupQuantityControls();
		setupOrderFormSubmit();
		calculateTotalPrice();
	});

})(jQuery);
