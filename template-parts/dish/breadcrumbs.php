<?php
/**
 * مسیر راهنما (Breadcrumbs) صفحه جزئیات غذا
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

global $product;

$cat_name = __( 'غذاها', 'hashvich' );
$cat_slug = 'all';

if ( $product ) {
	$categories = get_the_terms( $product->get_id(), 'product_cat' );
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $c ) {
			if ( 'uncategorized' !== $c->slug ) {
				$cat_name = $c->name;
				$cat_slug = $c->slug;
				break;
			}
		}
	}
}

$menu_url = home_url( '/menu/' );
$cat_url  = 'all' !== $cat_slug ? add_query_arg( 'category', $cat_slug, $menu_url ) : $menu_url;
?>

<div class="bg-forest">
	<nav aria-label="<?php esc_attr_e( 'مسیر صفحه', 'hashvich' ); ?>" class="container-page on-dark flex h-12 items-center gap-1.5 text-[14px] text-on-forest-muted">
		<a class="inline-flex min-h-10 min-w-10 items-center hover:text-white" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
			<?php esc_html_e( 'منو', 'hashvich' ); ?>
		</a>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left size-3.5" aria-hidden="true"><path d="m15 18-6-6 6-6"></path></svg>
		<a class="inline-flex min-h-10 items-center hover:text-white" href="<?php echo esc_url( $cat_url ); ?>" data-discover="true">
			<?php echo esc_html( $cat_name ); ?>
		</a>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left size-3.5" aria-hidden="true"><path d="m15 18-6-6 6-6"></path></svg>
		<span class="truncate text-white" aria-current="page"><?php the_title(); ?></span>
	</nav>
</div>
