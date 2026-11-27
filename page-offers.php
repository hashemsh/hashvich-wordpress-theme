<?php
/**
 * Template Name: تخفیف‌ها و پیشنهادها (Offers & Promos)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="min-h-[70vh]">
	<?php
	// ۱. هدر تیره با بنر اصلی
	get_template_part( 'template-parts/offers/hero' );

	// ۲. کدهای تخفیف با امکان کپی
	get_template_part( 'template-parts/offers/coupons' );

	// ۳. بنرهای تصویری پیشنهادهای ویژه
	get_template_part( 'template-parts/offers/banners' );

	// ۴. پیشنهادهای لحظه‌ای با شمارنده معکوس
	get_template_part( 'template-parts/offers/flash-deals' );
	?>
</main>

<?php
get_footer();
