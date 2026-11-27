<?php
/**
 * سربرگ صفحه تسویه‌حساب و پرداخت
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$home_url = home_url( '/' );
?>

<section class="on-dark doodles relative overflow-hidden bg-forest text-white hv-checkout-hero">
	<div class="container-page">
		<nav class="flex items-center gap-2 text-[13px] text-white/70 mb-3" aria-label="<?php esc_attr_e( 'مسیر راهنما', 'hashvich' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>" class="hover:text-sun transition-colors"><?php esc_html_e( 'خانه', 'hashvich' ); ?></a>
			<span class="text-white/40">/</span>
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="hover:text-sun transition-colors"><?php esc_html_e( 'سبد خرید', 'hashvich' ); ?></a>
			<span class="text-white/40">/</span>
			<span class="text-sun font-medium"><?php esc_html_e( 'تسویه‌حساب و پرداخت', 'hashvich' ); ?></span>
		</nav>
		<h1 class="text-[24px] md:text-[30px] font-bold text-white leading-tight">
			<?php esc_html_e( 'پرداخت و ثبت سفارش', 'hashvich' ); ?>
		</h1>
		<p class="mt-2 text-[15px] leading-relaxed text-on-forest-muted">
			<?php esc_html_e( 'سفارش شما بلافاصله در آشپزخانه دریافت و داغ و تازه آماده ارسال می‌شود.', 'hashvich' ); ?>
		</p>
	</div>
</section>
