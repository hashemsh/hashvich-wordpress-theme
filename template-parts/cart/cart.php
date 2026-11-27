<?php
/**
 * تمپلیت اصلی سبد خرید هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$is_empty = ! function_exists( 'WC' ) || ! is_object( WC()->cart ) || WC()->cart->is_empty();
?>

<main id="main" class="min-h-[70vh]">
	<?php if ( $is_empty ) : ?>
		<?php get_template_part( 'template-parts/cart/empty' ); ?>
	<?php else : ?>
		<section class="on-dark doodles relative overflow-hidden bg-forest text-white">
			<div class="container-page pt-8 pb-14 md:pt-12 md:pb-20">
				<h1 class="max-w-[760px] text-[clamp(2.4rem,1.4rem+3vw,4rem)] leading-[1.04] font-bold">
					<?php esc_html_e( 'سبد خرید', 'hashvich' ); ?>
				</h1>
				<p class="mt-4 max-w-[560px] text-[17px] leading-relaxed text-on-forest-muted">
					<?php esc_html_e( 'اقلام انتخابی خود را بررسی کنید و جهت تکمیل سفارش به مرحله بعد بروید.', 'hashvich' ); ?>
				</p>
			</div>
		</section>

		<div class="container-page grid gap-8 py-10 lg:grid-cols-[1.5fr_1fr] lg:gap-10 lg:py-14" id="hv-cart-main-grid">
			<?php get_template_part( 'template-parts/cart/items' ); ?>
			<?php get_template_part( 'template-parts/cart/totals' ); ?>
		</div>
	<?php endif; ?>
</main>
