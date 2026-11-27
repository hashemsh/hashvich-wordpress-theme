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
	<!-- هدر سبز بنر سبد خرید با تایپوگرافی متناسب و پدینگ استاندارد -->
	<section class="on-dark doodles relative overflow-hidden bg-forest text-white">
		<div class="container-page py-8 md:py-10">
			<h1 class="text-[24px] md:text-[30px] font-bold text-white leading-tight">
				<?php esc_html_e( 'سبد خرید', 'hashvich' ); ?>
			</h1>
			<p class="mt-2 text-[15px] leading-relaxed text-on-forest-muted">
				<?php esc_html_e( 'اقلام انتخابی خود را بررسی کنید و جهت تکمیل سفارش به مرحله بعد بروید.', 'hashvich' ); ?>
			</p>
		</div>
	</section>

	<?php if ( $is_empty ) : ?>
		<?php get_template_part( 'template-parts/cart/empty' ); ?>
	<?php else : ?>
		<div class="container-page grid gap-8 py-10 lg:grid-cols-[1.5fr_1fr] lg:gap-10 lg:py-14" id="hv-cart-main-grid">
			<?php get_template_part( 'template-parts/cart/items' ); ?>
			<?php get_template_part( 'template-parts/cart/totals' ); ?>
		</div>
	<?php endif; ?>
</main>
