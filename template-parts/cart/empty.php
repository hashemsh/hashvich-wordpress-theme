<?php
/**
 * تمپلیت وضعیت خالی سبد خرید
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="container-page py-24 text-center" id="hv-cart-empty-view">
	<div class="mx-auto flex size-24 items-center justify-center rounded-full bg-sand text-muted mb-6">
		<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag text-muted" aria-hidden="true">
			<path d="M16 10a4 4 0 0 1-8 0"></path>
			<path d="M3.103 6.034h17.794"></path>
			<path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path>
		</svg>
	</div>
	<h2 class="text-[clamp(1.8rem,1.4rem+1.5vw,2.4rem)] font-bold text-ink">
		<?php esc_html_e( 'سبد خرید شما خالی است', 'hashvich' ); ?>
	</h2>
	<p class="mt-3 text-[16px] text-muted max-w-[460px] mx-auto leading-relaxed">
		<?php esc_html_e( 'هنوز هیچ غذایی به سبد خریدتان اضافه نکرده‌اید. منوی لذیذ و داغ هاشویچ منتظر شماست!', 'hashvich' ); ?>
	</p>
	<div class="mt-8">
		<a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-all duration-[var(--duration-fast)] bg-sun text-ink hov:bg-sun-2 hov:shadow-[0_10px_24px_-10px_rgb(247_195_46/0.9)] h-14 px-8 text-[16px]">
			<span><?php esc_html_e( 'مشاهده منو و انتخاب غذا', 'hashvich' ); ?></span>
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left rotate-180" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
		</a>
	</div>
</div>
