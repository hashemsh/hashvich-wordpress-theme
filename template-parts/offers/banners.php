<?php
/**
 * بخش بنرهای تصویری پیشنهادات و تخفیف‌ها
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$img_dir_uri = get_template_directory_uri() . '/assets/images/';
$menu_url    = home_url( '/menu/' );
?>

<section class="container-page pt-20" aria-label="<?php esc_attr_e( 'پیشنهادهای این هفته', 'hashvich' ); ?>">
	<div class="grid gap-6 lg:grid-cols-2">
		<!-- ستون راست: ۲ بنر کوچک‌تر -->
		<div class="grid gap-6">
			<!-- بنر ۱: ساندویچ و برگر تازه -->
			<article class="relative isolate flex min-h-[280px] overflow-hidden rounded-[var(--radius-lg)] bg-sun-soft p-7 shadow-sm">
				<div class="absolute inset-y-0 left-0 -z-10 w-[56%] bg-sun [clip-path:polygon(22%_0,100%_0,100%_100%,0_100%)]"></div>
				<div class="relative z-10 flex max-w-[56%] flex-col">
					<p class="text-[18px] leading-tight text-ink/80"><?php esc_html_e( 'غذاهایی که نمی‌شود رد کرد', 'hashvich' ); ?></p>
					<h3 class="mt-4 text-[24px] leading-[1.15] font-bold text-[#3a2a0a]">
						<?php esc_html_e( 'تازه پخته، داغ سرو', 'hashvich' ); ?>
					</h3>
					<div class="mt-auto pt-6">
						<a class="round group/pill inline-flex h-11 items-center gap-2 rounded-full bg-white pr-3 pl-5 text-[14px] font-medium text-ink shadow-sm hover:shadow transition-transform hover:-translate-y-0.5"
						   href="<?php echo esc_url( $menu_url ); ?>">
							<span class="flex size-7 items-center justify-center rounded-full bg-forest text-white transition-colors group-hover/pill:bg-leaf">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
							</span>
							<span><?php esc_html_e( 'مشاهده منو', 'hashvich' ); ?></span>
						</a>
					</div>
				</div>
				<img alt="" class="pointer-events-none absolute bottom-0 left-4 max-h-[85%] w-[44%] select-none object-contain drop-shadow-xl" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/burger.webp' ); ?>">
			</article>

			<!-- بنر ۲: پیتزای تنوری -->
			<article class="relative isolate flex min-h-[280px] overflow-hidden rounded-[var(--radius-lg)] bg-tomato-soft p-7 shadow-sm">
				<div class="absolute inset-y-0 left-0 -z-10 w-[56%] bg-tomato/20 [clip-path:polygon(22%_0,100%_0,100%_100%,0_100%)]"></div>
				<div class="relative z-10 flex max-w-[56%] flex-col">
					<p class="text-[18px] leading-tight text-ink/80"><?php esc_html_e( 'پیتزاهای تنوری دست‌ساز', 'hashvich' ); ?></p>
					<h3 class="mt-4 text-[24px] leading-[1.15] font-bold text-[#5c1c0c]">
						<?php esc_html_e( 'ترد، کش‌دار و لذیذ', 'hashvich' ); ?>
					</h3>
					<div class="mt-auto pt-6">
						<a class="round group/pill inline-flex h-11 items-center gap-2 rounded-full bg-white pr-3 pl-5 text-[14px] font-medium text-ink shadow-sm hover:shadow transition-transform hover:-translate-y-0.5"
						   href="<?php echo esc_url( add_query_arg( 'category', 'pizza', $menu_url ) ); ?>">
							<span class="flex size-7 items-center justify-center rounded-full bg-forest text-white transition-colors group-hover/pill:bg-leaf">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
							</span>
							<span><?php esc_html_e( 'انواع پیتزا', 'hashvich' ); ?></span>
						</a>
					</div>
				</div>
				<img alt="" class="pointer-events-none absolute bottom-0 left-4 max-h-[85%] w-[44%] select-none object-contain drop-shadow-xl" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/pizza.webp' ); ?>">
			</article>
		</div>

		<!-- ستون چپ: بنر بزرگ کمبو و مهمانی -->
		<article class="relative isolate flex min-h-[460px] overflow-hidden rounded-[var(--radius-lg)] bg-forest p-8 md:p-10 text-white shadow-md">
			<div class="relative z-10 flex max-w-[62%] flex-col">
				<span class="inline-flex items-center gap-2 rounded-full bg-sun px-3.5 py-1 text-[13px] font-bold text-ink w-fit">
					<?php esc_html_e( 'پیشنهاد طلایی سرآشپز', 'hashvich' ); ?>
				</span>
				<h3 class="mt-6 text-[clamp(1.8rem,1.2rem+2vw,2.8rem)] leading-[1.15] font-bold">
					<?php esc_html_e( 'کمبوهای چندنفره هاشویچ', 'hashvich' ); ?>
				</h3>
				<p class="mt-4 text-[16px] leading-relaxed text-on-forest-muted">
					<?php esc_html_e( 'برگر دوبل با پنیر گودا، سیب‌زمینی دیپ چیز، شیک غلیظ توت‌فرنگی با ۲۰٪ تخفیف اقتصادی برای جمع‌های دوستانه و خانوادگی.', 'hashvich' ); ?>
				</p>
				<div class="mt-auto pt-8">
					<a class="round inline-flex items-center gap-2 rounded-full bg-sun px-7 py-3.5 text-[15px] font-bold text-ink hover:bg-sun-2 shadow-lg transition-transform hover:scale-105"
					   href="<?php echo esc_url( $menu_url ); ?>">
						<span><?php esc_html_e( 'سفارش فوری کمبو', 'hashvich' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
					</a>
				</div>
			</div>
			<img alt="" class="pointer-events-none absolute -bottom-6 left-0 max-h-[70%] w-[48%] select-none object-contain drop-shadow-2xl" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/burger-hero.webp' ); ?>">
		</article>
	</div>
</section>
