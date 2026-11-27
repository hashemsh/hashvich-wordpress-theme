<?php
/**
 * بخش پیشنهادهای لحظه‌ای با شمارنده معکوس و کارت‌های غذا
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

// دریافت غذاهای دارای قیمت حراج یا محبوب
$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 6,
	'post_status'    => 'publish',
);

$deals_query = new WP_Query( $args );
$img_dir_uri = get_template_directory_uri() . '/assets/images/photos/';
?>

<section class="container-page pt-20 pb-24" aria-labelledby="flash">
	<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
		<div class="flex flex-col gap-2">
			<h2 class="text-[clamp(1.9rem,1.2rem+1.8vw,2.6rem)] leading-[1.1] font-semibold text-ink">
				<span id="flash"><?php esc_html_e( 'پیشنهادهای لحظه‌ای', 'hashvich' ); ?></span>
			</h2>
			<p class="max-w-[560px] text-[16px] leading-relaxed text-muted">
				<?php esc_html_e( 'قیمت‌ها با تخفیف ویژه محاسبه شده‌اند. پس از پایان زمان تایمر، تخفیف‌ها به حالت اولیه بازمی‌گردند.', 'hashvich' ); ?>
			</p>
		</div>

		<!-- تایمر معکوس شکیل با ارقام فارسی -->
		<div class="flex items-center gap-2 rounded-[var(--radius-md)] bg-sun/20 border border-sun/40 px-4 py-2.5 text-ink self-start md:self-auto" id="hv-flash-deals-timer">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer text-forest animate-pulse"><line x1="10" x2="14" y1="2" y2="2"></line><line x1="12" x2="15" y1="14" y2="11"></line><circle cx="12" cy="14" r="8"></circle></svg>
			<span class="text-[14px] font-medium text-forest"><?php esc_html_e( 'فرصت باقی‌مانده:', 'hashvich' ); ?></span>
			<span class="font-bold text-[16px] tabular-nums text-forest" id="hv-deals-countdown">۰۲:۴۵:۱۸</span>
		</div>
	</div>

	<div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
		<?php
		if ( $deals_query->have_posts() ) :
			while ( $deals_query->have_posts() ) :
				$deals_query->the_post();
				global $product;

				$dish_title = get_the_title();
				$dish_link  = get_permalink();
				$thumb_id   = $product->get_image_id();
				$image_url  = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';
				if ( ! $image_url && function_exists( 'hashvich_get_dish_image_fallback' ) ) {
					$image_url = hashvich_get_dish_image_fallback( $product->get_slug() );
				}
				if ( ! $image_url ) {
					$image_url = $img_dir_uri . 'burger.webp';
				}

				$reg_price  = (float) $product->get_regular_price();
				$sale_price = (float) $product->get_sale_price();
				$cur_price  = (float) $product->get_price();

				// محاسبه درصد تخفیف
				$pct_discount = 20;
				if ( $reg_price > 0 && $sale_price > 0 && $reg_price > $sale_price ) {
					$pct_discount = round( ( ( $reg_price - $sale_price ) / $reg_price ) * 100 );
				} else {
					$sale_price = round( $cur_price * 0.8 );
				}
				?>
				<article class="relative flex h-full flex-col rounded-[var(--radius-md)] border bg-white p-5 shadow-sm hover:shadow-md transition-all group">
					<div class="flex items-center justify-between">
						<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink">
							<?php echo esc_html( hashvich_to_persian_num( $pct_discount ) . '٪ تخفیف' ); ?>
						</span>
					</div>

					<a href="<?php echo esc_url( $dish_link ); ?>" class="relative my-4 flex h-44 w-full items-center justify-center overflow-hidden rounded-[var(--radius-sm)] bg-card p-3">
						<img alt="<?php echo esc_attr( $dish_title ); ?>"
							 class="select-none object-contain size-36 transition-transform duration-300 group-hover:scale-110"
							 loading="lazy"
							 decoding="async"
							 src="<?php echo esc_url( $image_url ); ?>">
					</a>

					<div class="flex flex-1 flex-col justify-between">
						<div>
							<h3 class="text-[17px] font-semibold text-ink leading-snug">
								<a href="<?php echo esc_url( $dish_link ); ?>" class="hover:text-leaf transition-colors">
									<?php echo esc_html( $dish_title ); ?>
								</a>
							</h3>
							<p class="mt-1 text-[13px] leading-relaxed text-muted line-clamp-2">
								<?php echo esc_html( hashvich_get_dish_excerpt( $product ) ); ?>
							</p>
						</div>

						<div class="mt-4 flex items-center justify-between border-t border-line/50 pt-3">
							<div class="flex flex-col">
								<span class="text-[16px] font-bold text-forest tabular-nums">
									<?php echo wp_kses_post( hashvich_format_price( $sale_price ?: $cur_price ) ); ?>
								</span>
								<?php if ( $reg_price > $sale_price ) : ?>
									<span class="text-[13px] text-muted line-through tabular-nums">
										<?php echo wp_kses_post( hashvich_format_price( $reg_price ) ); ?>
									</span>
								<?php endif; ?>
							</div>

							<button type="button"
									class="hv-add-to-cart-quick round inline-flex items-center justify-center gap-1.5 rounded-full bg-forest text-white px-4 py-2 text-[13px] font-medium hover:bg-leaf transition-colors cursor-pointer"
									data-product-id="<?php echo esc_attr( get_the_ID() ); ?>"
									data-quantity="1">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
								<span><?php esc_html_e( 'افزودن', 'hashvich' ); ?></span>
							</button>
						</div>
					</div>
				</article>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>
</section>
