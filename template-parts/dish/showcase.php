<?php
/**
 * بخش نمایش بصری و تصویر غذا (Showcase)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

global $product;

$thumb_id  = $product ? $product->get_image_id() : get_post_thumbnail_id();
$image_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : '';

if ( ! $image_url && function_exists( 'hashvich_get_dish_image_fallback' ) ) {
	$slug      = $product ? $product->get_slug() : get_post_field( 'post_name' );
	$image_url = hashvich_get_dish_image_fallback( $slug );
}

if ( ! $image_url ) {
	$image_url = get_template_directory_uri() . '/assets/images/photos/burger.webp';
}

$title = get_the_title();
?>

<div class="relative flex aspect-square items-center justify-center self-start overflow-hidden rounded-[var(--radius-xl)] bg-card lg:sticky lg:top-[110px]">
	<div class="absolute inset-[14%] rounded-full bg-lime/60 blur-2xl" aria-hidden="true"></div>
	<img alt="<?php echo esc_attr( $title ); ?>"
		 class="select-none object-contain relative w-[72%] drop-shadow-[0_30px_30px_rgb(0_0_0/0.22)] motion-safe:animate-float"
		 draggable="false"
		 loading="eager"
		 decoding="async"
		 src="<?php echo esc_url( $image_url ); ?>">
</div>
