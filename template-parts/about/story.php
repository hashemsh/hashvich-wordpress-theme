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

	<!-- کلاژ تصویری غذاهای داغ و تازه هاشویچ -->
	<div class="relative aspect-[4/3] overflow-hidden rounded-[var(--radius-lg)] bg-lime border border-line/50 shadow-sm">
		<img alt="<?php esc_attr_e( 'پیتزا تنوری روی تخته چوبی', 'hashvich' ); ?>"
			 class="select-none object-contain absolute top-[4%] left-[2%] w-[74%] drop-shadow-md"
			 draggable="false"
			 loading="lazy"
			 decoding="async"
			 src="<?php echo esc_url( $img_dir_uri . 'pizza-board.webp' ); ?>">
		<img alt="<?php esc_attr_e( 'برگر داغ و آبدار', 'hashvich' ); ?>"
			 class="select-none object-contain absolute right-[2%] bottom-[4%] w-[44%] drop-shadow-[var(--shadow-food)]"
			 draggable="false"
			 loading="lazy"
			 decoding="async"
			 src="<?php echo esc_url( $img_dir_uri . 'burger.webp' ); ?>">
		<img alt="<?php esc_attr_e( 'میلک‌شیک خنک', 'hashvich' ); ?>"
			 class="select-none object-contain absolute top-[4%] right-[6%] w-[22%] drop-shadow-sm"
			 draggable="false"
			 loading="lazy"
			 decoding="async"
			 src="<?php echo esc_url( $img_dir_uri . 'shake.webp' ); ?>">
	</div>
</section>
