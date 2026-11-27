<?php
/**
 * بخش داستان، رسالت و آمار عملکرد هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$img_dir_uri = get_template_directory_uri() . '/assets/images/photos/';
?>

<section class="container-page grid items-center gap-12 py-16 lg:grid-cols-2 lg:py-24">
	<div class="flex flex-col gap-5 text-[17px] leading-relaxed text-muted">
		<p class="text-ink font-medium text-[20px] leading-snug">
			<?php esc_html_e( 'سریع نباید هرگز به معنای غذای مانده یا فرآوری‌شده باشد.', 'hashvich' ); ?>
		</p>
		<p>
			<?php esc_html_e( 'آشپزخانه‌های هاشویچ دارای یک خط آماده‌سازی دقیق و بهداشتی هستند؛ بنابراین برگر دوبل، پیتزای تنوری و سیب‌زمینی داغ همزمان از پیشخوان خارج شده و کاملاً تازه و گرم به دست شما می‌رسند.', 'hashvich' ); ?>
		</p>
		<p>
			<?php esc_html_e( 'حقوق سفیران تحویل هاشویچ ساعتی و با بیمه کامل است، نه بر اساس عجله و خطر کردن در خیابان‌ها. همچنین تمامی بسته‌بندی‌ها با برچسب حرارتی امنیتی پلمب می‌شوند تا با خیالی آسوده غذا را نوش جان کنید.', 'hashvich' ); ?>
		</p>

		<!-- آمار و ارقام کلیدی -->
		<div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4">
			<div class="flex flex-col gap-1 rounded-[var(--radius-md)] bg-card p-5 border border-line/40">
				<span class="text-[28px] font-bold text-forest tabular-nums">۷</span>
				<span class="text-[13px] text-muted"><?php esc_html_e( 'شعبه فعال در تهران', 'hashvich' ); ?></span>
			</div>
			<div class="flex flex-col gap-1 rounded-[var(--radius-md)] bg-card p-5 border border-line/40">
				<span class="text-[28px] font-bold text-forest tabular-nums">۲۸</span>
				<span class="text-[13px] text-muted"><?php esc_html_e( 'دقیقه میانگین ارسال', 'hashvich' ); ?></span>
			</div>
			<div class="flex flex-col gap-1 rounded-[var(--radius-md)] bg-card p-5 border border-line/40 col-span-2 sm:col-span-1">
				<span class="text-[28px] font-bold text-forest tabular-nums">۱۰۰٪</span>
				<span class="text-[13px] text-muted"><?php esc_html_e( 'پلمب و قابل بازیافت', 'hashvich' ); ?></span>
			</div>
		</div>
	</div>

	<!-- تصویر گریل و برگرهای داغ -->
	<div class="relative flex items-center justify-center overflow-hidden rounded-[var(--radius-lg)] bg-card p-6 shadow-sm border border-line/50">
		<img alt="<?php esc_attr_e( 'آماده‌سازی تازه‌ترین برگرها در آشپزخانه هاشویچ', 'hashvich' ); ?>"
			 class="select-none object-contain size-full max-h-[460px] drop-shadow-xl"
			 loading="lazy"
			 decoding="async"
			 src="<?php echo esc_url( $img_dir_uri . 'burger-hero.webp' ); ?>">
	</div>
</section>
