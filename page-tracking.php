<?php
/**
 * Template Name: وضعیت لحظه‌ای سفارش (Live Order Tracking)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="min-h-[70vh]">
	<!-- ۱. هدر و بنر تیره پیگیری -->
	<?php get_template_part( 'template-parts/tracking/hero' ); ?>

	<!-- ۲. بدنه دو ستونه تایم‌لاین و رسید -->
	<div class="container-page grid gap-8 py-12 lg:grid-cols-[1.6fr_1fr] lg:py-16">
		<!-- ستون چپ: تایم‌لاین ۵ مرحله‌ای و کارت امتیاز -->
		<?php get_template_part( 'template-parts/tracking/timeline' ); ?>

		<!-- ستون راست: آدرس و رسید پرداخت -->
		<?php get_template_part( 'template-parts/tracking/receipt' ); ?>
	</div>
</main>

<?php
get_footer();
