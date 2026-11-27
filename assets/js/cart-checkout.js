/**
 * اسکریپت تعاملی سبد خرید و تسویه‌حساب هاشویچ (Hashvich Cart & Checkout)
 *
 * @package Hashvich
 */

(function ($) {
	'use strict';

	// تبدیل ارقام انگلیسی به فارسی
	function toPersianNum(num) {
		if (num === null || num === undefined) return '';
		const faDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
		return num.toString().replace(/\d/g, function (w) {
			return faDigits[+w];
		});
	}

	// فرمت سه‌رقمی قیمت به تومان
	function formatPrice(amount) {
		const formatted = Number(amount).toLocaleString('en-US');
		return toPersianNum(formatted) + ' تومان';
	}

	// نمایش پیام اعلان (Toast)
	function showToast(message, type = 'success') {
		let container = document.getElementById('hv-toast-container');
		if (!container) {
			container = document.createElement('div');
			container.id = 'hv-toast-container';
			container.className = 'fixed bottom-5 inset-x-0 z-[80] flex flex-col items-center gap-2 pointer-events-none px-4';
			document.body.appendChild(container);
		}

		const toast = document.createElement('div');
		const bgClass = type === 'success' ? 'bg-forest text-white' : 'bg-tomato text-white';
		toast.className = `rounded-full px-5 py-2.5 text-[14px] font-medium shadow-lg pointer-events-auto transition-all duration-300 transform translate-y-4 opacity-0 flex items-center gap-2 ${bgClass}`;
		toast.innerHTML = `<span>${message}</span>`;
		container.appendChild(toast);

		requestAnimationFrame(() => {
			toast.classList.remove('translate-y-4', 'opacity-0');
			toast.classList.add('translate-y-0', 'opacity-100');
		});

		setTimeout(() => {
			toast.classList.remove('translate-y-0', 'opacity-100');
			toast.classList.add('translate-y-4', 'opacity-0');
			setTimeout(() => toast.remove(), 300);
		}, 3000);
	}

	// به‌روزرسانی نوار پیشرفت ارسال رایگان
	function updateFreeShippingProgress(subtotal) {
		const threshold = (window.hashvichCartData && window.hashvichCartData.freeShippingLimit) || 320000;
		const pct = Math.min(100, Math.max(0, Math.round((subtotal / threshold) * 100)));
		const remaining = Math.max(0, threshold - subtotal);

		const $progressBars = $('[role="progressbar"]');
		if ($progressBars.length) {
			$progressBars.attr('aria-valuenow', pct);
			$progressBars.find('> div').css('width', pct + '%');
		}

		const $container = $('.rounded-\\[var\\(--radius-sm\\)\\].bg-lime-soft');
		if ($container.length && remaining <= 0) {
			$container.find('p span, p').last().text('ارسال رایگان برای شما فعال شد!');
		} else if ($container.length) {
			$container.find('p span, p').last().text(`${formatPrice(remaining)} تا ارسال رایگان`);
		}
	}

	// به‌روزرسانی نشان تعداد سبد خرید در هدر
	function updateHeaderCartCount(count) {
		const $badge = $('#hv-header-cart-count');
		if ($badge.length) {
			$badge.text(toPersianNum(count));
			if (count > 0) {
				$badge.removeClass('hidden');
			} else {
				$badge.addClass('hidden');
			}
		}
		// دکمه موبایل سبد خرید
		$('.tabular-nums:contains("(")').each(function () {
			$(this).text(`(${toPersianNum(count)})`);
		});
	}

	/* ==========================================================
	 * ۱. بخش سبد خرید (Cart Page)
	 * ========================================================== */

	// تغییر تعداد محصول (کاهش / افزایش)
	$(document).on('click', '.hv-cart-qty-btn', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const $item = $btn.closest('.hv-cart-item');
		const cartKey = $btn.data('key');
		const isPlus = $btn.hasClass('hv-cart-plus');
		const $numSpan = $btn.siblings('.tabular-nums');
		let currentQty = parseInt($btn.data('qty'), 10) || 1;

		let newQty = isPlus ? currentQty + 1 : currentQty - 1;
		if (newQty < 1) newQty = 1;
		if (newQty === currentQty) return;

		$btn.prop('disabled', true);
		$item.css('opacity', '0.6');

		$.ajax({
			url: hashvichCartData.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'hashvich_update_cart_quantity',
				cart_item_key: cartKey,
				quantity: newQty,
			},
			success: function (res) {
				$btn.prop('disabled', false);
				$item.css('opacity', '1');

				if (res.success) {
					// به‌روزرسانی ارقام در ردیف
					$numSpan.text(toPersianNum(newQty));
					$btn.data('qty', newQty);
					$btn.siblings('.hv-cart-qty-btn').data('qty', newQty);

					if (res.data.line_subtotal) {
						$item.find('.font-semibold.tabular-nums.min-w-\\[110px\\]').html(res.data.line_subtotal);
					}

					// به‌روزرسانی مبالغ سایدبار
					if (res.data.cart_subtotal) {
						$('#hv-summary-subtotal').html(res.data.cart_subtotal);
					}
					if (res.data.cart_total) {
						$('#hv-summary-total').html(res.data.cart_total);
					}
					if (res.data.cart_count !== undefined) {
						updateHeaderCartCount(res.data.cart_count);
					}
					if (res.data.subtotal_raw) {
						updateFreeShippingProgress(res.data.subtotal_raw);
					}

					showToast(hashvichCartData.i18n.cartUpdated, 'success');
				} else {
					showToast(res.data.message || 'خطا در به‌روزرسانی', 'error');
				}
			},
			error: function () {
				$btn.prop('disabled', false);
				$item.css('opacity', '1');
				showToast('خطای شبکه', 'error');
			},
		});
	});

	// حذف آیتم از سبد خرید
	$(document).on('click', '.hv-cart-remove', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const $item = $btn.closest('.hv-cart-item');
		const cartKey = $btn.data('key');

		if (!confirm('آیا از حذف این غذا از سبد خرید اطمینان دارید؟')) {
			return;
		}

		$item.css({ transition: 'opacity 0.3s, transform 0.3s', opacity: '0', transform: 'scale(0.95)' });

		$.ajax({
			url: hashvichCartData.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'hashvich_remove_cart_item',
				cart_item_key: cartKey,
			},
			success: function (res) {
				if (res.success) {
					$item.slideUp(250, function () {
						$(this).remove();
						if (res.data.cart_is_empty) {
							window.location.reload();
							return;
						}
					});

					if (res.data.cart_subtotal) {
						$('#hv-summary-subtotal').html(res.data.cart_subtotal);
					}
					if (res.data.cart_total) {
						$('#hv-summary-total').html(res.data.cart_total);
					}
					if (res.data.cart_count !== undefined) {
						updateHeaderCartCount(res.data.cart_count);
					}
					if (res.data.subtotal_raw) {
						updateFreeShippingProgress(res.data.subtotal_raw);
					}

					showToast(hashvichCartData.i18n.itemRemoved, 'success');
				} else {
					$item.css({ opacity: '1', transform: 'none' });
					showToast(res.data.message || 'خطا در حذف آیتم', 'error');
				}
			},
			error: function () {
				$item.css({ opacity: '1', transform: 'none' });
				showToast('خطای شبکه در حذف آیتم', 'error');
			},
		});
	});

	// اعمال کد تخفیف در سبد خرید
	$(document).on('click', '#hv-apply-coupon-btn', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const $input = $('#hv-cart-coupon');
		const code = $.trim($input.val());

		if (!code) {
			$input.focus();
			return;
		}

		$btn.prop('disabled', true).find('span').text('در حال بررسی...');

		$.ajax({
			url: hashvichCartData.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'hashvich_apply_coupon',
				coupon_code: code,
			},
			success: function (res) {
				$btn.prop('disabled', false).find('span').text('اعمال کد');
				if (res.success) {
					showToast(hashvichCartData.i18n.couponApplied, 'success');
					window.location.reload();
				} else {
					showToast(res.data.message || hashvichCartData.i18n.couponError, 'error');
				}
			},
			error: function () {
				$btn.prop('disabled', false).find('span').text('اعمال کد');
				showToast('خطا در بررسی کد تخفیف', 'error');
			},
		});
	});

	// حذف کد تخفیف در سبد خرید
	$(document).on('click', '.hv-remove-coupon', function (e) {
		e.preventDefault();
		const code = $(this).data('code') || $(this).data('coupon');
		if (!code) return;

		$.ajax({
			url: hashvichCartData.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'hashvich_remove_coupon',
				coupon_code: code,
			},
			success: function (res) {
				if (res.success) {
					showToast(hashvichCartData.i18n.couponRemoved, 'success');
					window.location.reload();
				}
			},
		});
	});

	/* ==========================================================
	 * ۲. بخش تسویه‌حساب (Checkout Page)
	 * ========================================================== */

	// انتخاب نوع تحویل (ارسال با پیک یا تحویل حضوری)
	$(document).on('change', 'input[name="hv_delivery_type"]', function () {
		const val = $(this).val();
		const $labels = $('.hv-delivery-type-label');

		$labels.each(function () {
			const $lbl = $(this);
			const $radio = $lbl.find('input[type="radio"]');
			const $indicator = $lbl.find('.hv-radio-indicator');
			const isChecked = $radio.is(':checked');

			if (isChecked) {
				$lbl.addClass('border-leaf bg-lime-soft').removeClass('border-line-strong hover:border-muted');
				$lbl.find('span.shrink-0').first().addClass('text-leaf').removeClass('text-muted');
				$indicator.addClass('border-leaf bg-leaf text-white').removeClass('border-line-strong').html(
					'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3"><path d="M20 6 9 17l-5-5"></path></svg>'
				);
			} else {
				$lbl.removeClass('border-leaf bg-lime-soft').addClass('border-line-strong hover:border-muted');
				$lbl.find('span.shrink-0').first().removeClass('text-leaf').addClass('text-muted');
				$indicator.removeClass('border-leaf bg-leaf text-white').addClass('border-line-strong').empty();
			}
		});

		// اگر تحویل حضوری باشد، مرحله نشانی ارسال مخفی می‌شود
		const $stepAddress = $('#hv-step-address');
		if (val === 'pickup') {
			$stepAddress.slideUp(200);
			$stepAddress.find('input[required]').removeAttr('required').attr('data-was-required', 'true');
			clearFieldError($('#billing_address_1'));
			clearFieldError($('#billing_city'));
			$('#hv-summary-shipping').text('رایگان (تحویل حضوری)');
		} else {
			$stepAddress.slideDown(200);
			$stepAddress.find('input[data-was-required="true"]').attr('required', 'required');
		}

		// ارسال نوع تحویل به سرور
		$.ajax({
			url: hashvichCartData.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'hashvich_set_delivery_type',
				delivery_type: val,
			},
			success: function (res) {
				if (res.success && res.data.cart_total) {
					$('#hv-summary-total').html(res.data.cart_total);
					updateOrderButtonTotal(res.data.cart_total);
				}
			},
		});
	});

	// انتخاب روش پرداخت
	$(document).on('change', 'input[name="payment_method"]', function () {
		const $labels = $('.hv-payment-method-label');

		$labels.each(function () {
			const $lbl = $(this);
			const $radio = $lbl.find('input[type="radio"]');
			const $indicator = $lbl.find('.hv-radio-indicator');
			const isChecked = $radio.is(':checked');

			if (isChecked) {
				$lbl.addClass('border-leaf bg-lime-soft').removeClass('border-line-strong hover:border-muted');
				$lbl.find('span.shrink-0').first().addClass('text-leaf').removeClass('text-muted');
				$indicator.addClass('border-leaf bg-leaf text-white').removeClass('border-line-strong').html(
					'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3"><path d="M20 6 9 17l-5-5"></path></svg>'
				);
			} else {
				$lbl.removeClass('border-leaf bg-lime-soft').addClass('border-line-strong hover:border-muted');
				$lbl.find('span.shrink-0').first().removeClass('text-leaf').addClass('text-muted');
				$indicator.removeClass('border-leaf bg-leaf text-white').addClass('border-line-strong').empty();
			}
		});
	});

	// انتخاب انعام پیک
	$(document).on('change', 'input[name="hv_tip"]', function () {
		const val = parseFloat($(this).val()) || 0;
		const $labels = $('.hv-tip-label');

		$labels.each(function () {
			const $lbl = $(this);
			const $radio = $lbl.find('input[type="radio"]');
			const $indicator = $lbl.find('.hv-radio-indicator');
			const isChecked = $radio.is(':checked');

			if (isChecked) {
				$lbl.addClass('border-leaf bg-lime-soft').removeClass('border-line-strong hover:border-muted');
				$indicator.addClass('border-leaf bg-leaf text-white').removeClass('border-line-strong').html(
					'<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"></path></svg>'
				);
			} else {
				$lbl.removeClass('border-leaf bg-lime-soft').addClass('border-line-strong hover:border-muted');
				$indicator.removeClass('border-leaf bg-leaf text-white').addClass('border-line-strong').empty();
			}
		});

		// ارسال انعام به سرور جهت محاسبه مجدد فاکتور
		$.ajax({
			url: hashvichCartData.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'hashvich_set_tip',
				tip: val,
			},
			success: function (res) {
				if (res.success) {
					if (val > 0) {
						$('#hv-summary-tip-row').show();
						$('#hv-summary-tip-val').text(formatPrice(val));
					} else {
						$('#hv-summary-tip-row').hide();
					}

					if (res.data.cart_total) {
						$('#hv-summary-total').html(res.data.cart_total);
						updateOrderButtonTotal(res.data.cart_total);
					}
				}
			},
		});
	});

	// اعمال کوپن در سایدبار تسویه‌حساب
	$(document).on('click', '#hv_apply_checkout_coupon_btn', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const $input = $('#hv_checkout_coupon_code');
		const code = $.trim($input.val());

		if (!code) {
			$input.focus();
			return;
		}

		$btn.prop('disabled', true).find('span').text('...');

		$.ajax({
			url: hashvichCartData.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'hashvich_apply_coupon',
				coupon_code: code,
			},
			success: function (res) {
				$btn.prop('disabled', false).find('span').text('اعمال');
				if (res.success) {
					showToast(hashvichCartData.i18n.couponApplied, 'success');
					window.location.reload();
				} else {
					$('#hv-coupon-feedback').removeClass('hidden text-leaf').addClass('text-tomato').text(res.data.message || hashvichCartData.i18n.couponError);
				}
			},
			error: function () {
				$btn.prop('disabled', false).find('span').text('اعمال');
				$('#hv-coupon-feedback').removeClass('hidden text-leaf').addClass('text-tomato').text('خطا در برقراری ارتباط');
			},
		});
	});

	// تغییر مبلغ روی دکمه ثبت سفارش
	function updateOrderButtonTotal(formattedTotal) {
		const cleanTotal = $('<div>').html(formattedTotal).text();
		$('#place_order_text').text(`ثبت سفارش به مبلغ ${cleanTotal}`);
	}

	/* ==========================================================
	 * اعتبارسنجی و نمایش خطای درجا (Inline Field Validation)
	 * ========================================================== */

	// تبدیل ارقام فارسی و عربی به انگلیسی
	function normalizeDigits(str) {
		if (!str) return '';
		return String(str)
			.replace(/[۰-۹]/g, function (d) { return '۰۱۲۳۴۵۶۷۸۹'.indexOf(d); })
			.replace(/[٠-٩]/g, function (d) { return '٠١٢٣٤٥٦٧٨٩'.indexOf(d); });
	}

	// پاک کردن کاراکترهای خطرناک HTML
	function escapeHtml(text) {
		return $('<div>').text(text).html();
	}

	// نمایش خطای درون‌برنامه‌ای زیر فیلد و قرمز کردن کادر
	function showFieldError($field, message) {
		if (!$field || !$field.length) return;

		$field.addClass('hv-input-error');

		const $wrapper = $field.closest('.flex.flex-col');
		$wrapper.find('.hv-field-error').remove();

		const errorHtml = `
			<span class="hv-field-error" role="alert">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0" aria-hidden="true">
					<circle cx="12" cy="12" r="10"></circle>
					<line x1="12" y1="8" x2="12" y2="12"></line>
					<line x1="12" y1="16" x2="12.01" y2="16"></line>
				</svg>
				<span>${escapeHtml(message)}</span>
			</span>
		`;

		$field.after(errorHtml);
	}

	// حذف خطای فیلد به محض شروع تایپ یا تغییر
	function clearFieldError($field) {
		if (!$field || !$field.length) return;
		$field.removeClass('hv-input-error');
		const $wrapper = $field.closest('.flex.flex-col');
		const $error = $wrapper.find('.hv-field-error');
		if ($error.length) {
			$error.fadeOut(150, function () {
				$(this).remove();
			});
		}
	}

	// پاک کردن همه خطاهای تسویه‌حساب
	function clearAllCheckoutErrors() {
		$('.hv-input-error').removeClass('hv-input-error');
		$('.hv-field-error').remove();
		$('.woocommerce-NoticeGroup-checkout, .woocommerce-error').remove();
	}

	// اسکرول نرم به فیلد دارای خطا با احتساب هدر چسبان
	function scrollToField($field) {
		if (!$field || !$field.length) return;
		const headerHeight = $('.site-header').outerHeight() || 80;
		const offset = $field.offset().top - headerHeight - 35;
		$('html, body').stop().animate({
			scrollTop: Math.max(0, offset)
		}, 350, function () {
			$field.focus();
		});
	}

	// شنونده زنده: پاک شدن ارور به محض تعامل کاربر با فیلد
	$(document).on('input change keyup', '#hv-checkout-form input, #hv-checkout-form textarea, #hv-checkout-form select', function () {
		clearFieldError($(this));
	});

	// اصلاح خودکار شماره تلفن هنگام خروج از فیلد
	$(document).on('blur', '#billing_phone', function () {
		const val = $(this).val();
		if (val) {
			$(this).val(normalizeDigits(val).replace(/\s+/g, ''));
		}
	});

	// اعتبارسنجی جامع سمت کاربر قبل از ارسال فرم
	function validateCheckoutFields() {
		clearAllCheckoutErrors();
		let isValid = true;
		let $firstError = null;

		// ۱. بررسی نام
		const $firstName = $('#billing_first_name');
		const firstNameVal = $.trim($firstName.val());
		if (!firstNameVal || firstNameVal.length < 2) {
			showFieldError($firstName, 'لطفاً نام خود را وارد کنید.');
			if (!$firstError) $firstError = $firstName;
			isValid = false;
		}

		// ۲. بررسی نام خانوادگی
		const $lastName = $('#billing_last_name');
		const lastNameVal = $.trim($lastName.val());
		if (!lastNameVal || lastNameVal.length < 2) {
			showFieldError($lastName, 'لطفاً نام خانوادگی خود را وارد کنید.');
			if (!$firstError) $firstError = $lastName;
			isValid = false;
		}

		// ۳. بررسی شماره موبایل
		const $phone = $('#billing_phone');
		const rawPhone = $.trim($phone.val());
		const normPhone = normalizeDigits(rawPhone);
		const phoneRegex = /^(\+98|0)?9\d{9}$/;
		if (!normPhone) {
			showFieldError($phone, 'شماره موبایل جهت هماهنگی پیک الزامی است.');
			if (!$firstError) $firstError = $phone;
			isValid = false;
		} else if (!phoneRegex.test(normPhone)) {
			showFieldError($phone, 'شماره موبایل نامعتبر است (مثال: ۰۹۱۲۳۴۵۶۷۸۹).');
			if (!$firstError) $firstError = $phone;
			isValid = false;
		}

		// ۴. بررسی ایمیل (اختیاری است اما اگر پر شد باید معتبر باشد)
		const $email = $('#billing_email');
		if ($email.length) {
			const emailVal = $.trim($email.val());
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			if (emailVal && !emailRegex.test(emailVal)) {
				showFieldError($email, 'فرمت ایمیل نامعتبر است (مثال: name@example.com).');
				if (!$firstError) $firstError = $email;
				isValid = false;
			}
		}

		// ۵. بررسی نشانی و شهر در حالت ارسال با پیک
		const deliveryType = $('input[name="hv_delivery_type"]:checked').val() || 'delivery';
		if (deliveryType === 'delivery') {
			const $address = $('#billing_address_1');
			const addressVal = $.trim($address.val());
			if (!addressVal || addressVal.length < 5) {
				showFieldError($address, 'لطفاً نشانی کامل شامل خیابان، کوچه و پلاک را وارد کنید.');
				if (!$firstError) $firstError = $address;
				isValid = false;
			}

			const $city = $('#billing_city');
			const cityVal = $.trim($city.val());
			if (!cityVal) {
				showFieldError($city, 'لطفاً نام شهر را مشخص کنید.');
				if (!$firstError) $firstError = $city;
				isValid = false;
			}
		}

		// در صورت وجود خطا اسکرول نرم و پیام اعلام می‌شود
		if (!isValid && $firstError) {
			scrollToField($firstError);
			showToast('لطفاً خطاهای مشخص‌شده در فرم را اصلاح نمایید.', 'error');
		}

		return isValid;
	}

	// رهگیری کلیک روی دکمه ثبت سفارش
	$(document).on('click', '#place_order', function (e) {
		if (!validateCheckoutFields()) {
			e.preventDefault();
			e.stopImmediatePropagation();
			return false;
		}
	});

	// ارسال فرم تسویه‌حساب با اعتبارسنجی
	$(document).on('submit', '#hv-checkout-form', function (e) {
		if (!validateCheckoutFields()) {
			e.preventDefault();
			e.stopImmediatePropagation();
			return false;
		}

		const $submitBtn = $('#place_order');
		$submitBtn.prop('disabled', true).addClass('opacity-70');
		$('#place_order_text').text(hashvichCartData.i18n.processing || 'در حال پردازش...');
	});

	// تبدیل خطاهای سمت سرور ووکامرس (AJAX) به خطاهای درون فیلدی
	function handleServerCheckoutErrors(errorHtml) {
		// حذف کامل باکس سنتی خطای ووکامرس
		$('.woocommerce-NoticeGroup-checkout, .woocommerce-error').remove();

		// فعال‌سازی مجدد دکمه ثبت
		const $submitBtn = $('#place_order');
		$submitBtn.prop('disabled', false).removeClass('opacity-70');
		const origText = $submitBtn.attr('data-value') || 'ثبت سفارش';
		$('#place_order_text').text(origText);

		if (!errorHtml) return;

		const $temp = $('<div>').html(errorHtml);
		const $items = $temp.find('li');
		let hasFieldErrors = false;
		let $firstError = null;
		const unhandledMessages = [];

		$items.each(function () {
			const text = $.trim($(this).text());

			let matched = false;
			if (text.includes('نام خانوادگی')) {
				const $f = $('#billing_last_name');
				showFieldError($f, 'لطفاً نام خانوادگی خود را وارد نمایید.');
				if (!$firstError) $firstError = $f;
				matched = true;
			} else if (text.includes('نام') && !text.includes('خانوادگی')) {
				const $f = $('#billing_first_name');
				showFieldError($f, 'لطفاً نام خود را وارد نمایید.');
				if (!$firstError) $firstError = $f;
				matched = true;
			} else if (text.includes('تلفن') || text.includes('موبایل') || text.includes('شماره')) {
				const $f = $('#billing_phone');
				showFieldError($f, 'شماره موبایل الزامی و باید معتبر باشد.');
				if (!$firstError) $firstError = $f;
				matched = true;
			} else if (text.includes('خیابان') || text.includes('نشانی') || text.includes('آدرس')) {
				const $f = $('#billing_address_1');
				showFieldError($f, 'نشانی کامل جهت ارسال سفارش الزامی است.');
				if (!$firstError) $firstError = $f;
				matched = true;
			} else if (text.includes('شهر')) {
				const $f = $('#billing_city');
				showFieldError($f, 'نام شهر تحویل الزامی است.');
				if (!$firstError) $firstError = $f;
				matched = true;
			} else if (text.includes('ایمیل') || text.includes('رایانامه')) {
				const $f = $('#billing_email');
				showFieldError($f, 'ایمیل وارد شده معتبر نیست.');
				if (!$firstError) $firstError = $f;
				matched = true;
			} else if (text.includes('کد پستی') || text.includes('کدپستی')) {
				const $f = $('#billing_postcode');
				showFieldError($f, 'کد پستی معتبر نیست.');
				if (!$firstError) $firstError = $f;
				matched = true;
			}

			if (matched) {
				hasFieldErrors = true;
			} else if (text) {
				unhandledMessages.push(text);
			}
		});

		if (hasFieldErrors && $firstError) {
			scrollToField($firstError);
			showToast('لطفاً فیلدهای مشخص شده با رنگ قرمز را بررسی و تکمیل نمایید.', 'error');
		}

		if (unhandledMessages.length > 0) {
			unhandledMessages.forEach(function (msg) {
				showToast(msg, 'error');
			});
		}
	}

	// شنود رویداد checkout_error ووکامرس
	$(document.body).on('checkout_error', function (event, errorMessages) {
		$('html, body').stop();
		handleServerCheckoutErrors(errorMessages);
	});

	// رهگیری پاسخ‌های ایجکس ووکامرس جهت اطمینان صد درصدی
	$(document).ajaxComplete(function (event, xhr, settings) {
		if (settings && settings.url && (settings.url.indexOf('checkout') !== -1 || settings.url.indexOf('wc-ajax=checkout') !== -1)) {
			try {
				const res = xhr.responseJSON;
				if (res && res.result === 'failure' && res.messages) {
					setTimeout(function () {
						handleServerCheckoutErrors(res.messages);
					}, 20);
				}
			} catch (e) {}
		}
	});

})(jQuery);
