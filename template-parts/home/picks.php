<?php
/**
 * بخش انتخاب‌های ویژه ما (picks) در صفحه اصلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

// دریافت محصولات ویژه یا پرطرفدار از ووکامرس در صورت فعال بودن
$wc_active = function_exists( 'wc_get_products' );
$products  = array();

if ( $wc_active ) {
	// ۱. تلاش برای خواندن محصولات ویژه (Featured)
	$products = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => 6,
			'featured' => true,
		)
	);

	// ۲. اگر محصول ویژه نبود، ۶ محصول منتشرشده اخیر را بگیر
	if ( empty( $products ) ) {
		$products = wc_get_products(
			array(
				'status'  => 'publish',
				'limit'   => 6,
				'orderby' => 'date',
				'order'   => 'DESC',
			)
		);
	}
}

$img_dir_uri = get_template_directory_uri() . '/assets/images/';
$menu_url    = home_url( '/menu/' );
?>

<section class="container-page pt-24 md:pt-28" aria-labelledby="picks">
	<div class="flex flex-col gap-3 items-center text-center">
		<h2 class="text-[clamp(1.4rem,1.1rem+1vw,1.9rem)] leading-normal font-bold">
			<span id="picks"><?php esc_html_e( 'انتخاب‌های ویژه ما', 'hashvich' ); ?></span>
		</h2>
		<a class="inline-flex min-h-10 items-center gap-1.5 text-[15px] font-medium text-leaf hover:underline" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
			<?php esc_html_e( 'دیدن منوی کامل', 'hashvich' ); ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right size-4 rotate-180" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
		</a>
	</div>

	<div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
		<?php
		if ( ! empty( $products ) ) :
			foreach ( $products as $product ) :
				$product_id   = $product->get_id();
				$title        = $product->get_name();
				$permalink    = $product->get_permalink();
				$price        = $product->get_price();
				$reg_price    = $product->get_regular_price();
				$sale_price   = $product->get_sale_price();
				$is_on_sale   = $product->is_on_sale();
				$avg_rating   = $product->get_average_rating();
				$rating_val   = $avg_rating ? number_format( (float) $avg_rating, 1 ) : '4.8';
				$rating_fa    = hashvich_to_persian_num( $rating_val );

				// دسته‌بندی
				$categories = get_the_terms( $product_id, 'product_cat' );
				$cat_name   = ( ! empty( $categories ) && ! is_wp_error( $categories ) ) ? $categories[0]->name : __( 'غذای اصلی', 'hashvich' );

				// درصد تخفیف در صورت حراج
				$discount_pct = 0;
				if ( $is_on_sale && (float) $reg_price > 0 && (float) $sale_price > 0 ) {
					$discount_pct = round( ( ( (float) $reg_price - (float) $sale_price ) / (float) $reg_price ) * 100 );
				}

				// تصویر محصول یا فال‌بک
				$thumb_id  = $product->get_image_id();
				$image_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';
				if ( ! $image_url ) {
					// انتخاب تصویر پیش‌فرض متناسب با اسلاگ یا شناسه
					$slug = $product->get_slug();
					if ( strpos( $slug, 'pizza' ) !== false ) {
						$image_url = $img_dir_uri . 'photos/pizza-margherita.webp';
					} elseif ( strpos( $slug, 'salad' ) !== false ) {
						$image_url = $img_dir_uri . 'photos/salad.webp';
					} elseif ( strpos( $slug, 'taco' ) !== false ) {
						$image_url = $img_dir_uri . 'photos/tacos.webp';
					} elseif ( strpos( $slug, 'soup' ) !== false ) {
						$image_url = $img_dir_uri . 'photos/soup.webp';
					} elseif ( strpos( $slug, 'cake' ) !== false ) {
						$image_url = $img_dir_uri . 'photos/cake.webp';
					} else {
						$image_url = $img_dir_uri . 'photos/burger.webp';
					}
				}

				// زمان آماده‌سازی و کالری (از متادیتا یا مقادیر منطقی)
				$prep_time = get_post_meta( $product_id, '_prep_time', true );
				if ( ! $prep_time ) {
					$prep_time = hashvich_to_persian_num( 10 + ( ( $product_id * 3 ) % 16 ) );
				}
				$calories = get_post_meta( $product_id, '_calories', true );
				if ( ! $calories ) {
					$calories = hashvich_to_persian_num( 350 + ( ( $product_id * 37 ) % 450 ) );
				}

				$add_to_cart_url = $product->add_to_cart_url();
				?>
				<div>
					<article class="group relative flex flex-col rounded-[var(--radius-md)] bg-card p-5 transition-[background-color,transform,box-shadow] duration-[var(--duration-base)] ease-[var(--ease-out)] hov:-translate-y-1 hov:bg-card-2 hov:shadow-[var(--shadow-card)] has-[a:focus-visible]:outline-3 has-[a:focus-visible]:outline-offset-2 has-[a:focus-visible]:outline-leaf">
						<div class="flex h-10 items-center justify-between">
							<div class="flex items-center gap-1">
								<?php if ( $is_on_sale && $discount_pct > 0 ) : ?>
									<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink">
										<?php echo esc_html( hashvich_to_persian_num( $discount_pct ) ); ?>٪ تخفیف
									</span>
								<?php endif; ?>
							</div>
							<span class="inline-flex items-center gap-1 text-[14px] font-medium">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star size-4 text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
								<span class="sr-only"><?php esc_html_e( 'امتیاز', 'hashvich' ); ?> </span><?php echo esc_html( $rating_fa ); ?>
							</span>
						</div>

						<div class="flex aspect-[16/10] items-center justify-center">
							<img alt="<?php echo esc_attr( $title ); ?>" class="hv-product-image select-none object-contain h-full w-auto max-w-[78%] transition-transform duration-[var(--duration-slow)] ease-[var(--ease-out)] group-hover:scale-[1.06] group-hover:-rotate-2" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $image_url ); ?>">
						</div>

						<h3 class="mt-4 text-[18px] leading-snug font-semibold">
							<a class="stretched outline-none" href="<?php echo esc_url( $permalink ); ?>" data-discover="true"><?php echo esc_html( $title ); ?></a>
						</h3>
						<p class="mt-0.5 text-[14px] text-muted"><?php echo esc_html( $cat_name ); ?></p>
						<span class="inline-flex items-center gap-1.5 text-[13px] text-muted mt-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock size-3.5" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
							<?php echo esc_html( $prep_time ); ?> دقیقه <span aria-hidden="true">|</span><span class="sr-only">،</span> <?php echo esc_html( $calories ); ?> کیلوکالری
						</span>

						<div class="mt-4 flex items-center justify-between">
							<span class="inline-flex items-baseline gap-2">
								<span class="font-semibold tabular-nums text-[20px]"><?php echo hashvich_format_price( $price ); ?></span>
								<?php if ( $is_on_sale && (float) $reg_price > (float) $price ) : ?>
									<span class="text-muted line-through tabular-nums text-[13px]">
										<span class="sr-only"><?php esc_html_e( 'قبلاً', 'hashvich' ); ?> </span><?php echo hashvich_format_price( $reg_price ); ?>
									</span>
								<?php endif; ?>
							</span>
							<a href="<?php echo esc_url( $add_to_cart_url ); ?>"
							   data-quantity="1"
							   data-product_id="<?php echo esc_attr( $product_id ); ?>"
							   data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
							   class="button product_type_simple add_to_cart_button ajax_add_to_cart round inline-flex shrink-0 items-center justify-center rounded-full transition-[background-color,color,transform,border-color] duration-[var(--duration-fast)] prs:scale-90 disabled:pointer-events-none disabled:opacity-40 size-10 [&_svg]:size-4 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 relative z-[2]"
							   aria-label="<?php echo esc_attr( sprintf( __( 'افزودن %s به سبد', 'hashvich' ), $title ) ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
							</a>
						</div>
					</article>
				</div>
			<?php
			endforeach;
		else :
			// اگر هیچ محصولی در ووکامرس نبود، ۶ آیتم نمونه کیت طراحی نمایش داده می‌شوند
			$mock_items = array(
				array(
					'title'    => 'برگر ویژه هاشویچ',
					'cat'      => 'برگر و سیب‌زمینی',
					'rating'   => '۴٫۸',
					'photo'    => 'photos/burger.webp',
					'time'     => '۱۸',
					'calories' => '۷۸۰',
					'price'    => 185000,
					'old'      => 0,
					'discount' => 0,
				),
				array(
					'title'    => 'تاکوی خیابانی گوشت',
					'cat'      => 'ساندویچ و رپ',
					'rating'   => '۴٫۶',
					'photo'    => 'photos/tacos.webp',
					'time'     => '۱۵',
					'calories' => '۶۴۰',
					'price'    => 165000,
					'old'      => 0,
					'discount' => 0,
				),
				array(
					'title'    => 'سوپ گوجه فرنگی',
					'cat'      => 'سبک و سالم',
					'rating'   => '۴٫۸',
					'photo'    => 'photos/soup.webp',
					'time'     => '۸',
					'calories' => '۲۹۰',
					'price'    => 89000,
					'old'      => 0,
					'discount' => 0,
				),
				array(
					'title'    => 'سالاد باغ تازه',
					'cat'      => 'سبک و سالم',
					'rating'   => '۴٫۸',
					'photo'    => 'photos/salad.webp',
					'time'     => '۸',
					'calories' => '۳۲۰',
					'price'    => 101500,
					'old'      => 145000,
					'discount' => '۳۰',
				),
				array(
					'title'    => 'پیتزا مارگاریتا',
					'cat'      => 'دنیای پیتزا',
					'rating'   => '۴٫۸',
					'photo'    => 'photos/pizza-margherita.webp',
					'time'     => '۳۰',
					'calories' => '۹۸۰',
					'price'    => 245000,
					'old'      => 0,
					'discount' => 0,
				),
				array(
					'title'    => 'کیک شکلات سه‌لایه',
					'cat'      => 'دسر و شیرینی',
					'rating'   => '۴٫۸',
					'photo'    => 'photos/cake.webp',
					'time'     => '۵',
					'calories' => '۶۲۰',
					'price'    => 78000,
					'old'      => 0,
					'discount' => 0,
				),
			);

			foreach ( $mock_items as $item ) :
				?>
				<div>
					<article class="group relative flex flex-col rounded-[var(--radius-md)] bg-card p-5 transition-[background-color,transform,box-shadow] duration-[var(--duration-base)] ease-[var(--ease-out)] hov:-translate-y-1 hov:bg-card-2 hov:shadow-[var(--shadow-card)] has-[a:focus-visible]:outline-3 has-[a:focus-visible]:outline-offset-2 has-[a:focus-visible]:outline-leaf">
						<div class="flex h-10 items-center justify-between">
							<div class="flex items-center gap-1">
								<?php if ( ! empty( $item['discount'] ) ) : ?>
									<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink"><?php echo esc_html( $item['discount'] ); ?>٪ تخفیف</span>
								<?php endif; ?>
							</div>
							<span class="inline-flex items-center gap-1 text-[14px] font-medium">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star size-4 text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
								<span class="sr-only"><?php esc_html_e( 'امتیاز', 'hashvich' ); ?> </span><?php echo esc_html( $item['rating'] ); ?>
							</span>
						</div>

						<div class="flex aspect-[16/10] items-center justify-center">
							<img alt="<?php echo esc_attr( $item['title'] ); ?>" class="hv-product-image select-none object-contain h-full w-auto max-w-[78%] transition-transform duration-[var(--duration-slow)] ease-[var(--ease-out)] group-hover:scale-[1.06] group-hover:-rotate-2" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . $item['photo'] ); ?>">
						</div>

						<h3 class="mt-4 text-[18px] leading-snug font-semibold">
							<a class="stretched outline-none" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true"><?php echo esc_html( $item['title'] ); ?></a>
						</h3>
						<p class="mt-0.5 text-[14px] text-muted"><?php echo esc_html( $item['cat'] ); ?></p>
						<span class="inline-flex items-center gap-1.5 text-[13px] text-muted mt-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock size-3.5" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
							<?php echo esc_html( $item['time'] ); ?> دقیقه <span aria-hidden="true">|</span><span class="sr-only">،</span> <?php echo esc_html( $item['calories'] ); ?> کیلوکالری
						</span>

						<div class="mt-4 flex items-center justify-between">
							<span class="inline-flex items-baseline gap-2">
								<span class="font-semibold tabular-nums text-[20px]"><?php echo hashvich_format_price( $item['price'] ); ?></span>
								<?php if ( ! empty( $item['old'] ) ) : ?>
									<span class="text-muted line-through tabular-nums text-[13px]"><span class="sr-only"><?php esc_html_e( 'قبلاً', 'hashvich' ); ?> </span><?php echo hashvich_format_price( $item['old'] ); ?></span>
								<?php endif; ?>
							</span>
							<a href="<?php echo esc_url( $menu_url ); ?>" class="round inline-flex shrink-0 items-center justify-center rounded-full transition-[background-color,color,transform,border-color] duration-[var(--duration-fast)] prs:scale-90 disabled:pointer-events-none disabled:opacity-40 size-10 [&_svg]:size-4 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 relative z-[2]" aria-label="<?php echo esc_attr( sprintf( __( 'مشاهده %s', 'hashvich' ), $item['title'] ) ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
							</a>
						</div>
					</article>
				</div>
				<?php
			endforeach;
		endif;
		?>
	</div>
</section>
