<?php
/**
 * بخش غذاهای پیشنهادی و مرتبط (Related Dishes)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

global $product;

$current_id = $product ? $product->get_id() : get_the_ID();
$cat_id     = 0;

if ( $product ) {
	$categories = get_the_terms( $current_id, 'product_cat' );
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $c ) {
			if ( 'uncategorized' !== $c->slug ) {
				$cat_id = $c->term_id;
				break;
			}
		}
	}
}

// دریافت ۳ محصول مرتبط
$related_products = array();
if ( function_exists( 'wc_get_products' ) ) {
	$args = array(
		'status'  => 'publish',
		'limit'   => 3,
		'exclude' => array( $current_id ),
		'orderby' => 'rand',
	);

	if ( $cat_id > 0 ) {
		$args['category'] = array( get_term_field( 'slug', $cat_id, 'product_cat' ) );
	}

	$related_products = wc_get_products( $args );

	// اگر کمتر از ۳ محصول در همان دسته بود، محصولات تصادفی دیگر را دریافت می‌کنیم
	if ( count( $related_products ) < 3 ) {
		$needed      = 3 - count( $related_products );
		$rel_ids     = array_map(
			function ( $p ) {
				return $p->get_id();
			},
			$related_products
		);
		$exclude_ids = array_merge( array( $current_id ), $rel_ids );
		$extra       = wc_get_products(
			array(
				'status'  => 'publish',
				'limit'   => $needed,
				'exclude' => $exclude_ids,
				'orderby' => 'rand',
			)
		);
		$related_products = array_merge( $related_products, $extra );
	}
}

if ( empty( $related_products ) ) {
	return;
}

$img_dir_uri = get_template_directory_uri() . '/assets/images/';
?>

<section class="container-page pb-24" aria-labelledby="related-dishes">
	<div class="flex flex-col gap-3">
		<h2 class="text-[clamp(1.9rem,1.2rem+1.8vw,2.6rem)] leading-[1.1] font-semibold">
			<span id="related-dishes"><?php esc_html_e( 'شاید این‌ها را هم دوست داشته باشید', 'hashvich' ); ?></span>
		</h2>
	</div>

	<div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-8">
		<?php
		foreach ( $related_products as $rel_product ) :
			$rel_id       = $rel_product->get_id();
			$title        = $rel_product->get_name();
			$permalink    = $rel_product->get_permalink();
			$price        = (float) $rel_product->get_price();
			$reg_price    = (float) $rel_product->get_regular_price();
			$sale_price   = (float) $rel_product->get_sale_price();
			$is_on_sale   = $rel_product->is_on_sale();
			$sku          = $rel_product->get_sku();

			// تخفیف
			$discount_pct = 0;
			if ( $is_on_sale && $reg_price > 0 && $sale_price > 0 ) {
				$discount_pct = round( ( ( $reg_price - $sale_price ) / $reg_price ) * 100 );
			}

			// امتیاز
			$avg_rating = $rel_product->get_average_rating();
			$meta_rate  = get_post_meta( $rel_id, '_hv_rating', true );
			$rating_val = $avg_rating ? number_format( (float) $avg_rating, 1 ) : ( $meta_rate ? number_format( (float) $meta_rate, 1 ) : '4.8' );
			$rating_fa  = hashvich_to_persian_num( $rating_val );

			// دسته‌بندی
			$rel_cats = get_the_terms( $rel_id, 'product_cat' );
			$rel_cat_name = __( 'غذاها', 'hashvich' );
			$rel_cat_slug = 'all';
			if ( ! empty( $rel_cats ) && ! is_wp_error( $rel_cats ) ) {
				foreach ( $rel_cats as $rc ) {
					if ( 'uncategorized' !== $rc->slug ) {
						$rel_cat_name = $rc->name;
						$rel_cat_slug = $rc->slug;
						break;
					}
				}
			}

			// زمان آماده‌سازی و کالری
			$minutes_raw = get_post_meta( $rel_id, '_hv_minutes', true );
			if ( ! $minutes_raw ) {
				$minutes_raw = get_post_meta( $rel_id, '_prep_time', true ) ?: ( 10 + ( ( $rel_id * 3 ) % 16 ) );
			}
			$minutes_fa = hashvich_to_persian_num( $minutes_raw );

			$calories_raw = get_post_meta( $rel_id, '_hv_calories', true );
			if ( ! $calories_raw ) {
				$calories_raw = get_post_meta( $rel_id, '_calories', true ) ?: ( 350 + ( ( $rel_id * 37 ) % 450 ) );
			}
			$calories_fa = hashvich_to_persian_num( $calories_raw );

			// تصویر
			$thumb_id  = $rel_product->get_image_id();
			$image_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';
			if ( ! $image_url && function_exists( 'hashvich_get_dish_image_fallback' ) ) {
				$image_url = hashvich_get_dish_image_fallback( $rel_product->get_slug(), $rel_cat_slug );
			}
			if ( ! $image_url ) {
				$image_url = $img_dir_uri . 'photos/burger.webp';
			}

			$add_to_cart_url = $rel_product->add_to_cart_url();
		?>
			<article class="group relative flex flex-col rounded-[var(--radius-md)] bg-card p-5 transition-[background-color,transform,box-shadow] duration-[var(--duration-base)] ease-[var(--ease-out)] hov:-translate-y-1 hov:bg-card-2 hov:shadow-[var(--shadow-card)] has-[a:focus-visible]:outline-3 has-[a:focus-visible]:outline-offset-2 has-[a:focus-visible]:outline-leaf">
				<div class="flex h-10 items-center justify-between">
					<div class="flex items-center gap-1">
						<button type="button"
								aria-pressed="false"
								aria-label="<?php echo esc_attr( sprintf( __( 'ذخیره %s', 'hashvich' ), $title ) ); ?>"
								class="hv-fav-btn round relative z-[2] inline-flex size-10 items-center justify-center rounded-full transition-[color,transform,background-color] hov:bg-black/5 prs:scale-90 text-muted hov:text-ink -ml-2"
								data-product-id="<?php echo esc_attr( $rel_id ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart size-[18px] transition-transform" aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
						</button>
						<?php if ( $is_on_sale && $discount_pct > 0 ) : ?>
							<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink">
								<?php echo esc_html( hashvich_to_persian_num( $discount_pct ) ); ?>٪ <?php esc_html_e( 'تخفیف', 'hashvich' ); ?>
							</span>
						<?php endif; ?>
					</div>
					<span class="inline-flex items-center gap-1 text-[14px] font-medium">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star size-4 text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
						<span class="sr-only"><?php esc_html_e( 'امتیاز', 'hashvich' ); ?> </span><?php echo esc_html( $rating_fa ); ?>
					</span>
				</div>

				<div class="flex aspect-[16/10] items-center justify-center">
					<img alt="<?php echo esc_attr( $title ); ?>" class="select-none object-contain h-full w-auto max-w-[78%] transition-transform duration-[var(--duration-slow)] ease-[var(--ease-out)] group-hover:scale-[1.06] group-hover:-rotate-2" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $image_url ); ?>">
				</div>

				<h3 class="mt-4 text-[18px] leading-snug font-semibold">
					<a class="stretched outline-none" href="<?php echo esc_url( $permalink ); ?>" data-discover="true"><?php echo esc_html( $title ); ?></a>
				</h3>
				<p class="mt-0.5 text-[14px] text-muted"><?php echo esc_html( $rel_cat_name ); ?></p>
				<span class="inline-flex items-center gap-1.5 text-[13px] text-muted mt-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock size-3.5" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
					<?php echo esc_html( $minutes_fa ); ?> <?php esc_html_e( 'دقیقه', 'hashvich' ); ?> <span aria-hidden="true">|</span><span class="sr-only">،</span> <?php echo esc_html( $calories_fa ); ?> <?php esc_html_e( 'کیلوکالری', 'hashvich' ); ?>
				</span>

				<div class="mt-4 flex items-center justify-between">
					<span class="inline-flex items-baseline gap-2">
						<span class="font-semibold tabular-nums text-[20px]"><?php echo hashvich_format_price( $price ); ?></span>
						<?php if ( $is_on_sale && $reg_price > $price ) : ?>
							<span class="text-muted line-through tabular-nums text-[13px]">
								<span class="sr-only"><?php esc_html_e( 'قبلاً', 'hashvich' ); ?> </span><?php echo hashvich_format_price( $reg_price ); ?>
							</span>
						<?php endif; ?>
					</span>
					<a href="<?php echo esc_url( $add_to_cart_url ); ?>"
					   data-quantity="1"
					   data-product_id="<?php echo esc_attr( $rel_id ); ?>"
					   data-product_sku="<?php echo esc_attr( $sku ); ?>"
					   class="button product_type_simple add_to_cart_button ajax_add_to_cart round inline-flex shrink-0 items-center justify-center rounded-full transition-[background-color,color,transform,border-color] duration-[var(--duration-fast)] prs:scale-90 disabled:pointer-events-none disabled:opacity-40 size-10 [&_svg]:size-4 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 relative z-[2]"
					   aria-label="<?php echo esc_attr( sprintf( __( 'افزودن %s به سبد', 'hashvich' ), $title ) ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
					</a>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
