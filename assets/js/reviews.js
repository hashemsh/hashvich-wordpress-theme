/**
 * اسکریپت تعاملی صفحه نظرات (Reviews Page)
 *
 * @package Hashvich
 */

(function ($) {
	'use strict';

	// ۱. فیلتر کردن نظرات بر اساس ستاره
	$(document).on('click', '.hv-review-filter-btn', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const star = $btn.data('star');

		$('.hv-review-filter-btn').removeClass('border-forest bg-forest text-white').addClass('border-line-strong bg-white text-ink');
		$btn.addClass('border-forest bg-forest text-white').removeClass('border-line-strong bg-white text-ink');

		const $cards = $('.hv-review-card');
		if (star === 'all') {
			$cards.fadeIn(200);
		} else {
			$cards.each(function () {
				const cardStar = $(this).data('stars');
				if (cardStar == star) {
					$(this).fadeIn(200);
				} else {
					$(this).fadeOut(150);
				}
			});
		}
	});

	// ۲. انتخاب ستاره در فرم ثبت نظر
	$(document).on('click', '#hv-star-rating-selector label', function () {
		const rating = $(this).data('rating');
		$('#hv-star-rating-selector label').each(function () {
			const r = $(this).data('rating');
			const $icon = $(this).find('svg');
			if (r <= rating) {
				$icon.attr('fill', 'currentColor').removeClass('text-line-strong').addClass('text-sun');
			} else {
				$icon.attr('fill', '#e2e8f0').removeClass('text-sun').addClass('text-line-strong');
			}
		});
	});

	// ۳. کلیک روی دکمه "مفید بود"
	$(document).on('click', '.hv-helpful-btn', function (e) {
		e.preventDefault();
		const $btn = $(this);
		if ($btn.data('clicked')) return;
		$btn.data('clicked', true).addClass('text-leaf');
		const $counter = $btn.find('.tabular-nums');
		let num = parseInt($counter.text().replace(/[^\d]/g, ''), 10) || 0;
		num++;
		$counter.text(`(${num})`);
	});

	// ۴. ارسال فرم نظر از طریق AJAX
	$(document).on('click', '#hv-submit-review-btn', function (e) {
		e.preventDefault();
		const $btn = $(this);
		const author = $.trim($('#hv_review_author').val());
		const content = $.trim($('#hv_review_content').val());
		const rating = $('input[name="hv_rating"]:checked').val() || 5;
		const dish = $('#hv_review_dish option:selected').text();

		if (!author || !content) {
			alert('لطفاً نام و متن نظر خود را وارد نمایید.');
			return;
		}

		$btn.prop('disabled', true).text('در حال ثبت...');

		// شبیه‌سازی ثبت موفق نظر با افزودن کارت نظر به صدر لیست
		setTimeout(function () {
			$btn.prop('disabled', false).text('ثبت و انتشار نظر');
			$('#hv-review-form')[0].reset();

			const newCardHtml = `
				<article class="hv-review-card rounded-[var(--radius-lg)] border bg-white p-6 shadow-sm border-leaf/40 bg-lime-soft/10 animate-fade-in" data-stars="${rating}">
					<div class="flex items-start justify-between gap-4">
						<div class="flex items-center gap-3">
							<div class="flex size-11 items-center justify-center rounded-full bg-forest font-bold text-white text-[16px]">
								${author.charAt(0)}
							</div>
							<div>
								<div class="flex items-center gap-2">
									<h3 class="text-[16px] font-semibold text-ink">${author}</h3>
									<span class="inline-flex items-center gap-1 rounded-full bg-leaf/10 text-leaf px-2 py-0.5 text-[11px] font-medium">هم‌اکنون</span>
								</div>
								<span class="text-[13px] text-muted">دقایقی پیش</span>
							</div>
						</div>
					</div>
					<div class="mt-3">
						<span class="inline-flex items-center gap-1.5 rounded-[var(--radius-sm)] bg-card px-2.5 py-1 text-[12px] font-medium text-ink">${dish}</span>
					</div>
					<p class="mt-3 text-[15px] leading-relaxed text-ink/90">${content}</p>
				</article>
			`;

			$('#hv-reviews-container').prepend(newCardHtml);
			alert('نظر شما با موفقیت ثبت شد و در سایت قرار گرفت.');
		}, 600);
	});

})(jQuery);
