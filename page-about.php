<?php
/**
 * Template Name: درباره ما و تماس (About & Contact)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="min-h-[70vh]">
	<?php
	// ۱. هدر و بنر تیره
	get_template_part( 'template-parts/about/hero' );

	// ۲. داستان و آمار شعب
	get_template_part( 'template-parts/about/story' );

	// ۳. اصول و ارزش‌های برند
	get_template_part( 'template-parts/about/values' );

	// ۴. تماس با ما، اطلاعات و فرم ارتباطی
	get_template_part( 'template-parts/about/contact' );
	?>
</main>

<?php
get_footer();
