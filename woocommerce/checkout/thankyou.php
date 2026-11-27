<?php
/**
 * برگه تایید و رسید سفارش ووکامرس (Thankyou & Order Received)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="hv-thankyou-wrap">
	<!-- هدر و بنر وضعیت سفارش -->
	<?php get_template_part( 'template-parts/tracking/hero' ); ?>

	<!-- تایم‌لاین ۵ مرحله‌ای و رسید سفارش -->
	<div class="container-page grid gap-8 py-12 lg:grid-cols-[1.6fr_1fr] lg:py-16">
		<?php get_template_part( 'template-parts/tracking/timeline' ); ?>
		<?php get_template_part( 'template-parts/tracking/receipt' ); ?>
	</div>
</div>
