<?php
/**
 * تمپلیت تجمیعی کاتالوگ منو (قابل استفاده در page-menu.php و archive-product.php)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

// دریافت تعداد کل غذاها
$total_products = 15;
if ( function_exists( 'wc_get_products' ) ) {
	$count_products = wc_get_products(
		array(
			'status' => 'publish',
			'limit'  => -1,
			'return' => 'ids',
		)
	);
	if ( ! empty( $count_products ) ) {
		$total_products = count( $count_products );
	}
}
?>

<main id="main" class="min-h-[70vh]">
	<?php get_template_part( 'template-parts/menu/hero' ); ?>
	<?php get_template_part( 'template-parts/menu/categories-bar' ); ?>

	<section class="container-page pt-8 pb-24" aria-label="<?php esc_attr_e( 'غذاها', 'hashvich' ); ?>">
		<?php
		get_template_part(
			'template-parts/menu/filters-bar',
			null,
			array(
				'total_products' => $total_products,
			)
		);
		?>

		<?php get_template_part( 'template-parts/menu/grid' ); ?>
	</section>
</main>
