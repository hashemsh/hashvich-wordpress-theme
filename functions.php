<?php
/**
 * قالب اختصاصی رستوران و فست‌فود زنجیره‌ای هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

define( 'HASHVICH_VERSION', '1.0.0' );

// بارگذاری واکر منوی ناوبری اختصاصی
require_once get_template_directory() . '/inc/nav-walker.php';

/**
 * پیکربندی قابلیت‌های قالب
 */
add_action(
	'after_setup_theme',
	function () {
		// پشتیبانی از عنوان داینامیک صفحه
		add_theme_support( 'title-tag' );

		// پشتیبانی از تصویر شاخص
		add_theme_support( 'post-thumbnails' );

		// پشتیبانی از چیدمان تمام‌عرض
		add_theme_support( 'align-wide' );

		// فرمت‌های استاندارد HTML5
		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
		);

		// پشتیبانی کامل از ووکامرس
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// سازگاری کامل با صفحه‌ساز المنتور
		add_theme_support( 'elementor' );

		// ثبت جایگاه‌های منوی استاندارد
		register_nav_menus(
			array(
				'primary'       => __( 'منوی اصلی هدر', 'hashvich' ),
				'footer_orders' => __( 'فوتر — سفارش', 'hashvich' ),
				'footer_brand'  => __( 'فوتر — هاشویچ', 'hashvich' ),
			)
		);
	}
);

/**
 * بارگذاری استایل‌ها و اسکریپت‌ها
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		$theme_uri = get_template_directory_uri();
		$theme_dir = get_template_directory();

		// ۱. فونت وزیرمتن (سرو محلی با فرمت woff2 بدون نیاز به اینترنت)
		$fonts_path = $theme_dir . '/assets/css/fonts.css';
		$fonts_ver  = file_exists( $fonts_path ) ? (string) filemtime( $fonts_path ) : HASHVICH_VERSION;
		wp_enqueue_style( 'hashvich-fonts', $theme_uri . '/assets/css/fonts.css', array(), $fonts_ver );

		// ۲. استایل اصلی کیت طراحی (Tailwind v4 کامپایل‌شده)
		$app_path = $theme_dir . '/assets/css/app.css';
		$app_ver  = file_exists( $app_path ) ? (string) filemtime( $app_path ) : HASHVICH_VERSION;
		wp_enqueue_style( 'hashvich-app', $theme_uri . '/assets/css/app.css', array( 'hashvich-fonts' ), $app_ver );

		// ۳. اسکریپت هدر و منوی واکنش‌گرا
		$header_js_path = $theme_dir . '/assets/js/header.js';
		$header_js_ver  = file_exists( $header_js_path ) ? (string) filemtime( $header_js_path ) : HASHVICH_VERSION;
		wp_enqueue_script( 'hashvich-header', $theme_uri . '/assets/js/header.js', array(), $header_js_ver, true );
	}
);

/**
 * تنظیم کلاس‌های پایه برای تگ body
 */
add_filter(
	'body_class',
	function ( $classes ) {
		$classes[] = 'hashvich-app';
		$classes[] = 'bg-paper';
		$classes[] = 'text-ink';
		$classes[] = 'antialiased';
		return $classes;
	}
);

/**
 * به‌روزرسانی زنده شمارنده سبد خرید با آژاکس ووکامرس
 */
add_filter(
	'woocommerce_add_to_cart_fragments',
	function ( $fragments ) {
		$count = ( function_exists( 'WC' ) && is_object( WC()->cart ) ) ? WC()->cart->get_cart_contents_count() : 0;
		$fragments['span.hv-cart-count'] = '<span class="tabular-nums hv-cart-count">(' . esc_html( $count ) . ')</span>';
		return $fragments;
	}
);

/**
 * فال‌بک منوی اصلی در صورت تعریف نشدن منو در مدیریت وردپرس
 */
function hashvich_primary_menu_fallback() {
	$current_url = home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
	$current_url = trailingslashit( $current_url );

	$items = array(
		array(
			'title' => __( 'خانه', 'hashvich' ),
			'url'   => home_url( '/' ),
		),
		array(
			'title' => __( 'درباره ما', 'hashvich' ),
			'url'   => home_url( '/about/' ),
		),
		array(
			'title' => __( 'منو و طعم‌ها', 'hashvich' ),
			'url'   => home_url( '/menu/' ),
		),
		array(
			'title' => __( 'پیشنهادها', 'hashvich' ),
			'url'   => home_url( '/offers/' ),
		),
		array(
			'title' => __( 'نظرات', 'hashvich' ),
			'url'   => home_url( '/reviews/' ),
		),
	);

	foreach ( $items as $item ) {
		$item_url  = trailingslashit( $item['url'] );
		$is_active = ( $current_url === $item_url ) || ( home_url( '/' ) === $item['url'] && is_front_page() );

		$base_classes = 'relative inline-flex h-10 items-center text-[15px] transition-colors after:absolute after:inset-x-0 after:bottom-1 after:h-0.5 after:origin-left after:rounded-full after:bg-sun after:transition-transform after:duration-[var(--duration-base)]';

		if ( $is_active ) {
			$classes = $base_classes . ' text-white after:scale-x-100';
			$aria    = ' aria-current="page"';
		} else {
			$classes = $base_classes . ' text-white/85 after:scale-x-0 hover:text-white hover:after:scale-x-100';
			$aria    = '';
		}

		printf(
			'<a href="%s" class="%s"%s>%s</a>',
			esc_url( $item['url'] ),
			esc_attr( $classes ),
			$aria, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			esc_html( $item['title'] )
		);
	}
}
