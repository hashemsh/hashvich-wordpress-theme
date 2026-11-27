<?php
/**
 * Template Name: نظرات مشتریان (Customer Reviews)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="min-h-[70vh]">
	<!-- هدر تیره نظرات -->
	<?php get_template_part( 'template-parts/reviews/hero' ); ?>

	<!-- محتوای اصلی دو ستونه -->
	<div class="container-page grid gap-8 py-12 lg:grid-cols-[1.8fr_1fr] lg:gap-12 lg:py-16">
		<!-- ستون چپ: لیست نظرات و فیلترها -->
		<div class="min-w-0 flex flex-col gap-8">
			<?php get_template_part( 'template-parts/reviews/list' ); ?>
		</div>

		<!-- ستون راست: تفکیک امتیازها و فرم ثبت نظر -->
		<aside class="flex flex-col gap-6 lg:sticky lg:top-[108px] lg:self-start">
			<?php get_template_part( 'template-parts/reviews/summary' ); ?>
			<?php get_template_part( 'template-parts/reviews/form' ); ?>
		</aside>
	</div>
</main>

<?php
get_footer();
