<?php
/**
 * لیست و فیلترهای نظرات مشتریان
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

// نمونه نظرات واقعی مشتریان هاشویچ
$reviews = array(
	array(
		'id'       => 1,
		'author'   => 'سارا احمدی',
		'stars'    => 5,
		'date'     => 'دیروز ساعت ۲۰:۴۵',
		'dish'     => 'برگر ویژه هاشویچ',
		'verified' => true,
		'helpful'  => 14,
		'content'  => 'برگر واقعاً داغ و آبدار به دستم رسید. سس مخصوصش طعم بی‌نظیری داشت و نان بریوش هم کاملاً تازه و پنبه‌ای بود. پیک هم بسیار مودب بود.',
	),
	array(
		'id'       => 2,
		'author'   => 'محمدرضا کاظمی',
		'stars'    => 5,
		'date'     => '۲ روز پیش',
		'dish'     => 'پیتزا مارگاریتا',
		'verified' => true,
		'helpful'  => 9,
		'content'  => 'خمیر پیتزا دقیقاً مثل پیتزاهای ناپلی اصیل بود؛ سبک با تاول‌های ترد روی لبه. پنیر موزارلا کش‌آمدن عالی داشت و اصلاً سنگین نبود.',
	),
	array(
		'id'       => 3,
		'author'   => 'نیلوفر راد',
		'stars'    => 4,
		'date'     => '۳ روز پیش',
		'dish'     => 'سیب‌زمینی با سس پنیر',
		'verified' => true,
		'helpful'  => 6,
		'content'  => 'سیب‌زمینی‌ها به اندازه کافی ترد بودند و سس پنیر چدار فراوان بود. فقط اگر هالوپینو تندتر بود برای من عالی‌تر می‌شد.',
	),
	array(
		'id'       => 4,
		'author'   => 'امیرحسین پارسا',
		'stars'    => 5,
		'date'     => '۴ روز پیش',
		'dish'     => 'شیک توت‌فرنگی',
		'verified' => true,
		'helpful'  => 11,
		'content'  => 'خیلی غلیظ و پر از توت‌فرنگی واقعی! اصلاً اسانس مصنوعی حس نمی‌شد. بسته‌بندی در لیوان عایق هم باعث شده بود کاملاً خنک بماند.',
	),
	array(
		'id'       => 5,
		'author'   => 'فرناز ابراهیمی',
		'stars'    => 5,
		'date'     => '۵ روز پیش',
		'dish'     => 'برگر مرغ سوخاری',
		'verified' => true,
		'helpful'  => 8,
		'content'  => 'فیله مرغ سوخاری فوق‌العاده کرانچی و بدون روغن اضافی. بعد از یک روز خسته‌کننده کاری واقعاً چسبید!',
	),
);
?>

<section aria-labelledby="all-reviews" class="min-w-0" id="hv-reviews-list-section">
	<h2 id="all-reviews" class="sr-only"><?php esc_html_e( 'همه نظرات', 'hashvich' ); ?></h2>

	<!-- دکمه‌های فیلتر بر اساس ستاره -->
	<div class="no-scrollbar -mx-4 flex gap-2 overflow-x-auto px-4 pb-2 lg:mx-0 lg:px-0" role="group" aria-label="<?php esc_attr_e( 'فیلتر بر اساس امتیاز', 'hashvich' ); ?>">
		<button type="button" class="hv-review-filter-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors border-forest bg-forest text-white" data-star="all">
			<?php esc_html_e( 'همه نظرات', 'hashvich' ); ?>
		</button>
		<button type="button" class="hv-review-filter-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors border-line-strong bg-white text-ink hover:border-forest hover:bg-lime-soft" data-star="5">
			<span>۵</span>
			<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" class="lucide lucide-star text-sun"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
			<span><?php esc_html_e( 'ستاره', 'hashvich' ); ?></span>
		</button>
		<button type="button" class="hv-review-filter-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors border-line-strong bg-white text-ink hover:border-forest hover:bg-lime-soft" data-star="4">
			<span>۴</span>
			<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" class="lucide lucide-star text-sun"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
			<span><?php esc_html_e( 'ستاره', 'hashvich' ); ?></span>
		</button>
	</div>

	<!-- لیست کارت‌های نظرات -->
	<div class="mt-6 flex flex-col gap-4" id="hv-reviews-container">
		<?php foreach ( $reviews as $r ) : ?>
			<article class="hv-review-card rounded-[var(--radius-lg)] border bg-white p-6 shadow-sm transition-all" data-stars="<?php echo esc_attr( $r['stars'] ); ?>">
				<div class="flex items-start justify-between gap-4">
					<div class="flex items-center gap-3">
						<!-- آواتار حروف اول نام -->
						<div class="flex size-11 items-center justify-center rounded-full bg-lime-soft font-bold text-forest text-[16px]">
							<?php echo esc_html( mb_substr( $r['author'], 0, 1, 'UTF-8' ) ); ?>
						</div>
						<div>
							<div class="flex items-center gap-2">
								<h3 class="text-[16px] font-semibold text-ink"><?php echo esc_html( $r['author'] ); ?></h3>
								<?php if ( $r['verified'] ) : ?>
									<span class="inline-flex items-center gap-1 rounded-full bg-leaf/10 text-leaf px-2 py-0.5 text-[11px] font-medium" title="<?php esc_attr_e( 'خریدار واقعی غذا', 'hashvich' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"></path></svg>
										<?php esc_html_e( 'خریدار تاییدشده', 'hashvich' ); ?>
									</span>
								<?php endif; ?>
							</div>
							<span class="text-[13px] text-muted"><?php echo esc_html( $r['date'] ); ?></span>
						</div>
					</div>

					<!-- ستاره‌ها -->
					<div class="flex items-center gap-0.5 text-sun">
						<?php for ( $i = 0; $i < 5; $i++ ) : ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="<?php echo $i < $r['stars'] ? 'currentColor' : '#e2e8f0'; ?>" stroke="currentColor" stroke-width="0" class="lucide lucide-star size-4"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
						<?php endfor; ?>
					</div>
				</div>

				<?php if ( ! empty( $r['dish'] ) ) : ?>
					<div class="mt-3">
						<span class="inline-flex items-center gap-1.5 rounded-[var(--radius-sm)] bg-card px-2.5 py-1 text-[12px] font-medium text-ink">
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-leaf"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" x2="6" y1="1" y2="4"></line><line x1="10" x2="10" y1="1" y2="4"></line><line x1="14" x2="14" y1="1" y2="4"></line></svg>
							<?php echo esc_html( $r['dish'] ); ?>
						</span>
					</div>
				<?php endif; ?>

				<p class="mt-3 text-[15px] leading-relaxed text-ink/90">
					<?php echo esc_html( $r['content'] ); ?>
				</p>

				<div class="mt-4 flex items-center justify-end border-t border-line/40 pt-3">
					<button type="button" class="hv-helpful-btn flex items-center gap-1.5 text-[13px] text-muted hover:text-leaf transition-colors" data-id="<?php echo esc_attr( $r['id'] ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thumbs-up"><path d="M7 10v12"></path><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h3"></path></svg>
						<span><?php esc_html_e( 'مفید بود', 'hashvich' ); ?></span>
						<span class="tabular-nums">(<?php echo esc_html( hashvich_to_persian_num( $r['helpful'] ) ); ?>)</span>
					</button>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
