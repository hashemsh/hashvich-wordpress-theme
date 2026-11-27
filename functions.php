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

		// ۳. استایل اصلی قالب
		wp_enqueue_style( 'hashvich-style', get_stylesheet_uri(), array( 'hashvich-app' ), HASHVICH_VERSION );

		// ۴. اسکریپت هدر و منوی واکنش‌گرا
		$header_js_path = $theme_dir . '/assets/js/header.js';
		$header_js_ver  = file_exists( $header_js_path ) ? (string) filemtime( $header_js_path ) : HASHVICH_VERSION;
		wp_enqueue_script( 'hashvich-header', $theme_uri . '/assets/js/header.js', array(), $header_js_ver, true );

		// ۵. فعال‌سازی اسکریپت آژاکس سبد خرید ووکامرس در تمامی صفحات
		if ( function_exists( 'WC' ) ) {
			wp_enqueue_script( 'wc-add-to-cart' );
		}

		// ۶. اسکریپت تعاملی صفحه اصلی
		if ( is_front_page() || is_home() ) {
			$home_js_path = $theme_dir . '/assets/js/home.js';
			$home_js_ver  = file_exists( $home_js_path ) ? (string) filemtime( $home_js_path ) : HASHVICH_VERSION;
			wp_enqueue_script( 'hashvich-home', $theme_uri . '/assets/js/home.js', array( 'jquery' ), $home_js_ver, true );
			wp_localize_script(
				'hashvich-home',
				'hashvichData',
				array(
					'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
					'cartUrl'    => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' ),
					'addedText'  => __( 'به سبد خرید اضافه شد', 'hashvich' ),
					'viewCart'   => __( 'مشاهده سبد', 'hashvich' ),
				)
			);
		}

		// ۷. اسکریپت تعاملی صفحه منو و کاتالوگ فروشگاه
		$is_menu_catalog = is_page( 'menu' ) || is_page_template( 'page-menu.php' ) || ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() );
		if ( $is_menu_catalog ) {
			$menu_js_path = $theme_dir . '/assets/js/menu.js';
			$menu_js_ver  = file_exists( $menu_js_path ) ? (string) filemtime( $menu_js_path ) : HASHVICH_VERSION;
			wp_enqueue_script( 'hashvich-menu', $theme_uri . '/assets/js/menu.js', array( 'jquery' ), $menu_js_ver, true );
			wp_localize_script(
				'hashvich-menu',
				'hashvichData',
				array(
					'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
					'cartUrl'    => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' ),
					'addedText'  => __( 'به سبد خرید اضافه شد', 'hashvich' ),
					'viewCart'   => __( 'مشاهده سبد', 'hashvich' ),
				)
			);
		}

		// ۸. اسکریپت تعاملی صفحه تکی غذا / محصول
		if ( function_exists( 'is_product' ) && is_product() ) {
			$dish_js_path = $theme_dir . '/assets/js/dish.js';
			$dish_js_ver  = file_exists( $dish_js_path ) ? (string) filemtime( $dish_js_path ) : HASHVICH_VERSION;
			wp_enqueue_script( 'hashvich-dish', $theme_uri . '/assets/js/dish.js', array( 'jquery' ), $dish_js_ver, true );
			wp_localize_script(
				'hashvich-dish',
				'hashvichData',
				array(
					'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
					'cartUrl'    => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' ),
					'addedText'  => __( 'به سبد خرید اضافه شد', 'hashvich' ),
					'viewCart'   => __( 'مشاهده سبد', 'hashvich' ),
				)
			);
		}
	}
);

/**
 * دریافت آدرس تصویر پیش‌فرض غذاها در صورت عدم بارگذاری تصویر شاخص
 *
 * @param string $slug اسلاگ محصول.
 * @param string $cat_slug اسلاگ دسته‌بندی.
 * @return string
 */
function hashvich_get_dish_image_fallback( $slug = '', $cat_slug = '' ) {
	$img_dir_uri = get_template_directory_uri() . '/assets/images/photos/';
	$slug        = strtolower( (string) $slug );
	$cat_slug    = strtolower( (string) $cat_slug );

	if ( strpos( $slug, 'pizza' ) !== false || 'pizza' === $cat_slug ) {
		if ( strpos( $slug, 'pepperoni' ) !== false || strpos( $slug, 'spicy' ) !== false || strpos( $slug, 'bbq' ) !== false ) {
			return $img_dir_uri . 'pizza-pepperoni.webp';
		}
		return $img_dir_uri . 'pizza-margherita.webp';
	}
	if ( strpos( $slug, 'veggie' ) !== false ) {
		return $img_dir_uri . 'veggie-burger.webp';
	}
	if ( strpos( $slug, 'chicken-burger' ) !== false ) {
		return $img_dir_uri . 'chicken-burger.webp';
	}
	if ( strpos( $slug, 'burger' ) !== false || 'burgers' === $cat_slug ) {
		return $img_dir_uri . 'burger.webp';
	}
	if ( strpos( $slug, 'fries' ) !== false ) {
		return $img_dir_uri . 'fries.webp';
	}
	if ( strpos( $slug, 'hotdog' ) !== false || strpos( $slug, 'hot-dog' ) !== false ) {
		return $img_dir_uri . 'hotdog.webp';
	}
	if ( strpos( $slug, 'bucket' ) !== false || strpos( $slug, 'crispy' ) !== false || strpos( $slug, 'wings' ) !== false ) {
		return $img_dir_uri . 'wings.webp';
	}
	if ( strpos( $slug, 'wrap' ) !== false || 'wraps' === $cat_slug ) {
		return $img_dir_uri . 'wrap.webp';
	}
	if ( strpos( $slug, 'taco' ) !== false ) {
		return $img_dir_uri . 'tacos.webp';
	}
	if ( strpos( $slug, 'salad' ) !== false || 'healthy' === $cat_slug ) {
		return $img_dir_uri . 'salad.webp';
	}
	if ( strpos( $slug, 'soup' ) !== false ) {
		return $img_dir_uri . 'soup.webp';
	}
	if ( strpos( $slug, 'pasta' ) !== false ) {
		return $img_dir_uri . 'pasta.webp';
	}
	if ( strpos( $slug, 'cake' ) !== false || 'desserts' === $cat_slug ) {
		return $img_dir_uri . 'cake.webp';
	}
	if ( strpos( $slug, 'shake' ) !== false || 'drinks' === $cat_slug ) {
		return $img_dir_uri . 'shake.webp';
	}

	return $img_dir_uri . 'burger.webp';
}

/**
 * تبدیل ارقام انگلیسی به فارسی
 *
 * @param mixed $number عدد یا رشته حاوی ارقام.
 * @return string
 */
function hashvich_to_persian_num( $number ) {
	$en = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.' );
	$fa = array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٫' );
	return str_replace( $en, $fa, (string) $number );
}

/**
 * قالب‌بندی قیمت به تومان با ارقام فارسی
 *
 * @param float|int|string $price قیمت خام.
 * @return string
 */
function hashvich_format_price( $price ) {
	if ( function_exists( 'wc_price' ) && function_exists( 'get_woocommerce_currency' ) ) {
		return wc_price( $price );
	}
	$formatted = number_format( (float) $price, 0, '.', '٬' );
	return hashvich_to_persian_num( $formatted ) . ' تومان';
}

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

/**
 * ذخیره فیلدهای سفارشی غذا (اندازه، افزودنی‌ها، یادداشت) در آیتم سبد خرید ووکامرس
 */
add_filter(
	'woocommerce_add_cart_item_data',
	function ( $cart_item_data, $product_id ) {
		if ( ! empty( $_POST['hv_size'] ) ) {
			$cart_item_data['hv_size'] = sanitize_text_field( wp_unslash( $_POST['hv_size'] ) );
		}
		if ( ! empty( $_POST['hv_extras'] ) && is_array( $_POST['hv_extras'] ) ) {
			$cart_item_data['hv_extras'] = array_map( 'sanitize_text_field', wp_unslash( $_POST['hv_extras'] ) );
		}
		if ( ! empty( $_POST['hv_note'] ) ) {
			$cart_item_data['hv_note'] = sanitize_textarea_field( wp_unslash( $_POST['hv_note'] ) );
		}
		if ( isset( $_POST['hv_extra_price'] ) && (float) $_POST['hv_extra_price'] > 0 ) {
			$cart_item_data['hv_extra_price'] = (float) $_POST['hv_extra_price'];
		}

		if ( ! empty( $cart_item_data['hv_size'] ) || ! empty( $cart_item_data['hv_extras'] ) || ! empty( $cart_item_data['hv_note'] ) ) {
			$cart_item_data['unique_key'] = md5( microtime() . wp_rand() );
		}

		return $cart_item_data;
	},
	10,
	2
);

/**
 * محاسبه قیمت سفارشی‌شده بر حسب اندازه و افزودنی‌ها در سبد خرید
 */
add_action(
	'woocommerce_before_calculate_totals',
	function ( $cart ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}
		foreach ( $cart->get_cart() as $cart_item ) {
			if ( isset( $cart_item['hv_extra_price'] ) && (float) $cart_item['hv_extra_price'] > 0 ) {
				$base_price = (float) $cart_item['data']->get_price();
				$new_price  = $base_price + (float) $cart_item['hv_extra_price'];
				$cart_item['data']->set_price( $new_price );
			}
		}
	},
	10,
	1
);

/**
 * نمایش اندازه، افزودنی‌ها و یادداشت در جدول سبد خرید و تسویه‌حساب
 */
add_filter(
	'woocommerce_get_item_data',
	function ( $item_data, $cart_item ) {
		if ( ! empty( $cart_item['hv_size'] ) ) {
			$item_data[] = array(
				'key'     => __( 'اندازه', 'hashvich' ),
				'value'   => $cart_item['hv_size'],
				'display' => '',
			);
		}
		if ( ! empty( $cart_item['hv_extras'] ) && is_array( $cart_item['hv_extras'] ) ) {
			$item_data[] = array(
				'key'     => __( 'افزودنی‌ها', 'hashvich' ),
				'value'   => implode( '، ', $cart_item['hv_extras'] ),
				'display' => '',
			);
		}
		if ( ! empty( $cart_item['hv_note'] ) ) {
			$item_data[] = array(
				'key'     => __( 'یادداشت برای آشپزخانه', 'hashvich' ),
				'value'   => $cart_item['hv_note'],
				'display' => '',
			);
		}
		return $item_data;
	},
	10,
	2
);

/**
 * انتقال متادیتای سفارشی به سفارش نهایی ثبت‌شده در ووکامرس
 */
add_action(
	'woocommerce_checkout_create_order_line_item',
	function ( $item, $cart_item_key, $values, $order ) {
		if ( ! empty( $values['hv_size'] ) ) {
			$item->add_meta_data( __( 'اندازه', 'hashvich' ), $values['hv_size'], true );
		}
		if ( ! empty( $values['hv_extras'] ) && is_array( $values['hv_extras'] ) ) {
			$item->add_meta_data( __( 'افزودنی‌ها', 'hashvich' ), implode( '، ', $values['hv_extras'] ), true );
		}
		if ( ! empty( $values['hv_note'] ) ) {
			$item->add_meta_data( __( 'یادداشت برای آشپزخانه', 'hashvich' ), $values['hv_note'], true );
		}
	},
	10,
	4
);

/**
 * هندلر اختصاصی آژاکس افزودن به سبد خرید برای محصولات سفارشی‌شده (متغیر و ساده)
 */
function hashvich_ajax_add_to_cart_handler() {
	if ( ! function_exists( 'WC' ) || ! is_object( WC()->cart ) ) {
		wp_send_json_error( array( 'message' => __( 'ووکامرس فعال نیست.', 'hashvich' ) ) );
	}

	$product_id   = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
	$quantity     = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;
	$variation_id = 0;
	$variation    = array();

	$size_val = ! empty( $_POST['hv_size'] ) ? sanitize_text_field( wp_unslash( $_POST['hv_size'] ) ) : '';

	if ( $product_id ) {
		$product = wc_get_product( $product_id );
		if ( $product && $product->is_type( 'variable' ) && ! empty( $size_val ) ) {
			$available_variations = $product->get_available_variations();
			foreach ( $available_variations as $v ) {
				foreach ( $v['attributes'] as $attr_val ) {
					if ( $attr_val === $size_val ) {
						$variation_id = (int) $v['variation_id'];
						$variation    = $v['attributes'];
						break 2;
					}
				}
			}
		}
	}

	$cart_item_data = array();
	if ( ! empty( $size_val ) ) {
		$cart_item_data['hv_size'] = $size_val;
	}
	if ( ! empty( $_POST['hv_extras'] ) && is_array( $_POST['hv_extras'] ) ) {
		$cart_item_data['hv_extras'] = array_map( 'sanitize_text_field', wp_unslash( $_POST['hv_extras'] ) );
	}
	if ( ! empty( $_POST['hv_note'] ) ) {
		$cart_item_data['hv_note'] = sanitize_textarea_field( wp_unslash( $_POST['hv_note'] ) );
	}
	if ( isset( $_POST['hv_extra_price'] ) && (float) $_POST['hv_extra_price'] > 0 ) {
		$cart_item_data['hv_extra_price'] = (float) $_POST['hv_extra_price'];
	}
	$cart_item_data['unique_key'] = md5( microtime() . wp_rand() );

	$cart_item_key = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data );

	if ( $cart_item_key ) {
		do_action( 'woocommerce_ajax_added_to_cart', $product_id );
		WC_AJAX::get_refreshed_fragments();
	} else {
		wp_send_json_error( array( 'message' => __( 'خطا در ثبت آیتم در سبد خرید.', 'hashvich' ) ) );
	}
}
add_action( 'wp_ajax_hashvich_add_to_cart', 'hashvich_ajax_add_to_cart_handler' );
add_action( 'wp_ajax_nopriv_hashvich_add_to_cart', 'hashvich_ajax_add_to_cart_handler' );
