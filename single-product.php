<?php
/**
 * The Template for displaying all single products
 *
 * قالب اختصاصی صفحه جزئیات غذا / محصول تکی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

while ( have_posts() ) :
	the_post();
	?>
	<main id="main" class="min-h-[70vh]">
		<?php get_template_part( 'template-parts/dish/breadcrumbs' ); ?>

		<section class="container-page grid gap-10 pt-10 pb-20 lg:grid-cols-[1.05fr_1fr] lg:gap-16 lg:pt-14" aria-label="<?php esc_attr_e( 'جزئیات غذا', 'hashvich' ); ?>">
			<?php get_template_part( 'template-parts/dish/showcase' ); ?>
			<?php get_template_part( 'template-parts/dish/details' ); ?>
		</section>

		<?php get_template_part( 'template-parts/dish/reviews' ); ?>
		<?php get_template_part( 'template-parts/dish/related' ); ?>
	</main>
	<?php
endwhile;

get_footer( 'shop' );
