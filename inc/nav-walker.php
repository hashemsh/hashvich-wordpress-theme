<?php
/**
 * واکر اختصاصی منوی ناوبری قالب هاشویچ
 * هماهنگ با کلاس‌های استایل Tailwind و نشانگر فعال
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

class Hashvich_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * شروع هر المان آیتم منو
	 *
	 * @param string   $output خروجی نهایی.
	 * @param WP_Post  $item   آیتم منو.
	 * @param int      $depth  عمق.
	 * @param stdClass $args   آرگومان‌ها.
	 * @param int      $id     شناسه.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$is_active = in_array( 'current-menu-item', $classes, true ) ||
					in_array( 'current_page_item', $classes, true ) ||
					in_array( 'current-menu-ancestor', $classes, true );

		$base_classes = 'relative inline-flex h-10 items-center text-[15px] transition-colors after:absolute after:inset-x-0 after:bottom-1 after:h-0.5 after:origin-left after:rounded-full after:bg-sun after:transition-transform after:duration-[var(--duration-base)]';

		if ( $is_active ) {
			$link_classes = $base_classes . ' text-white after:scale-x-100';
		} else {
			$link_classes = $base_classes . ' text-white/85 after:scale-x-0 hover:text-white hover:after:scale-x-100';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
		$attributes .= ' class="' . esc_attr( $link_classes ) . '"';

		if ( $is_active ) {
			$attributes .= ' aria-current="page"';
		}

		$item_output = sprintf(
			'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before ?? '',
			$attributes,
			$args->link_before ?? '',
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after ?? '',
			$args->after ?? ''
		);

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * پایان المان
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		// بدون نیاز به بسته شدن li چون مستقیم a رندر می‌شود
	}
}
