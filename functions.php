<?php
/**
 * قالب اختصاصی رستوران و فست‌فود زنجیره‌ای هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

define( 'HASHVICH_VERSION', '1.0.0' );

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

		// ثبت منوهای استاندارد
		register_nav_menus(
			array(
				'primary' => __( 'منوی اصلی هدر', 'hashvich' ),
				'footer'  => __( 'منوی فوتر', 'hashvich' ),
			)
		);
	}
);

/**
 * بارگذاری استایل‌ها و فونت‌های محلی
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
