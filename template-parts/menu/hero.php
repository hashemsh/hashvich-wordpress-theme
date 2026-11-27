<?php
/**
 * بخش سربرگ و جست‌وجوی زنده صفحه منو
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="on-dark doodles relative overflow-hidden bg-forest text-white">
	<div class="container-page pt-8 pb-14 md:pt-12 md:pb-20">
		<h1 class="max-w-[760px] text-[clamp(2.4rem,1.4rem+3vw,4rem)] leading-[1.04] font-bold">
			<?php esc_html_e( 'منو و طعم‌ها', 'hashvich' ); ?>
		</h1>
		<p class="mt-4 max-w-[560px] text-[17px] leading-relaxed text-on-forest-muted">
			<?php esc_html_e( 'هفت آشپزخانه، یک سفارش. همه‌چیز امروز در آشپزخانه خودمان پخته می‌شود و قیمت‌ها با تخفیف‌های فعال محاسبه شده‌اند.', 'hashvich' ); ?>
		</p>
		<form role="search" class="mt-8 max-w-[560px]" id="hv-menu-search-form" onsubmit="return false;">
			<label for="menu-search" class="sr-only"><?php esc_html_e( 'جست‌وجو در منو', 'hashvich' ); ?></label>
			<div class="relative">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search pointer-events-none absolute top-1/2 right-5 size-5 -translate-y-1/2 text-muted" aria-hidden="true"><path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>
				<input id="menu-search" placeholder="<?php esc_attr_e( 'جست‌وجو در برگر، پیتزا، سالاد...', 'hashvich' ); ?>" class="round h-14 w-full rounded-full bg-white pr-13 pl-12 text-[16px] text-ink placeholder:text-muted focus:outline-3 focus:outline-sun" type="search" autocomplete="off" spellcheck="false">
				<button type="button" id="menu-search-clear" class="hidden absolute top-1/2 left-4 -translate-y-1/2 size-7 inline-flex items-center justify-center rounded-full bg-[#f3f4f6] text-muted hover:text-ink transition-colors" aria-label="<?php esc_attr_e( 'پاک کردن جست‌وجو', 'hashvich' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
				</button>
			</div>
		</form>
	</div>
</section>
