<?php
/**
 * Template Name: پیگیری و سفارش‌ها (Orders & Tracking Lookup)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="min-h-[70vh]">
	<!-- هدر تیره سفارش‌های من -->
	<?php get_template_part( 'template-parts/orders/hero' ); ?>

	<div class="container-page flex flex-col gap-10 py-12 lg:py-16">
		<!-- فرم استعلام سریع شماره سفارش -->
		<?php get_template_part( 'template-parts/orders/lookup' ); ?>

		<!-- لیست سفارش‌های قبلی -->
		<?php get_template_part( 'template-parts/orders/list' ); ?>
	</div>
</main>

<?php
get_footer();
