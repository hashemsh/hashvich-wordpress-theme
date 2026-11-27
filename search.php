<?php
/**
 * برگه نتایج جستجوی غذاها و محصولات
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();

$search_query = get_search_query();
$count        = $wp_query->found_posts;
$img_dir_uri  = get_template_directory_uri() . '/assets/images/photos/';
$menu_url     = home_url( '/menu/' );
?>

<main id="main" class="min-h-[70vh]">
	<!-- هدر جستجو -->
	<section class="on-dark doodles relative overflow-hidden bg-forest text-white">
		<div class="container-page pt-8 pb-14 md:pt-12 md:pb-20">
			<h1 class="max-w-[760px] text-[clamp(2rem,1.4rem+2.5vw,3.5rem)] leading-[1.1] font-bold">
				<?php
				/* translators: %s: search term */
				printf( esc_html__( 'نتایج جستجو برای: «%s»', 'hashvich' ), esc_html( $search_query ) );
				?>
			</h1>
			<p class="mt-4 max-w-[560px] text-[16px] text-on-forest-muted">
				<?php
				/* translators: %s: count */
				printf( esc_html__( '%s مورد در منوی هاشویچ یافت شد.', 'hashvich' ), '<span class="font-bold text-white tabular-nums">' . esc_html( hashvich_to_persian_num( $count ) ) . '</span>' );
				?>
			</p>
		</div>
	</section>

	<div class="container-page py-12 lg:py-16">
		<?php if ( have_posts() ) : ?>
			<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
				<?php
				while ( have_posts() ) :
					the_post();
					global $product;
					if ( ! $product ) {
						continue;
					}

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

					$price_html = $product->get_price_html();
					?>
					<article class="relative flex h-full flex-col rounded-[var(--radius-md)] border bg-white p-5 shadow-sm hover:shadow-md transition-all group">
						<a href="<?php echo esc_url( $dish_link ); ?>" class="relative mb-4 flex h-48 w-full items-center justify-center overflow-hidden rounded-[var(--radius-sm)] bg-card p-3">
							<img alt="<?php echo esc_attr( $dish_title ); ?>"
								 class="select-none object-contain size-40 transition-transform duration-300 group-hover:scale-110"
								 loading="lazy"
								 decoding="async"
								 src="<?php echo esc_url( $image_url ); ?>">
						</a>

						<div class="flex flex-1 flex-col justify-between">
							<div>
								<h2 class="text-[18px] font-semibold text-ink leading-snug">
									<a href="<?php echo esc_url( $dish_link ); ?>" class="hover:text-leaf transition-colors">
										<?php echo esc_html( $dish_title ); ?>
									</a>
								</h2>
								<p class="mt-1 text-[13px] text-muted line-clamp-2">
									<?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?>
								</p>
							</div>

							<div class="mt-5 flex items-center justify-between border-t border-line/50 pt-3">
								<span class="text-[16px] font-bold text-forest tabular-nums">
									<?php echo wp_kses_post( $price_html ); ?>
								</span>

								<a href="<?php echo esc_url( $dish_link ); ?>" class="round inline-flex items-center justify-center rounded-full bg-forest text-white px-4 py-2 text-[13px] font-medium hover:bg-leaf transition-colors">
									<span><?php esc_html_e( 'سفارش غذا', 'hashvich' ); ?></span>
								</a>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="mt-10 flex justify-center">
				<?php the_posts_pagination(); ?>
			</div>

		<?php else : ?>
			<div class="mx-auto max-w-md text-center py-12">
				<div class="mx-auto flex size-20 items-center justify-center rounded-full bg-card text-muted">
					<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-x"><path d="m13.5 8.5-5 5"></path><path d="m8.5 8.5 5 5"></path><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
				</div>
				<h2 class="mt-4 text-[20px] font-semibold text-ink"><?php esc_html_e( 'غذایی با این عبارت پیدا نشد', 'hashvich' ); ?></h2>
				<p class="mt-2 text-[14px] text-muted"><?php esc_html_e( 'می‌توانید املای واژه را بررسی کنید یا همه غذاهای لذیذ را در منوی کامل مشاهده کنید.', 'hashvich' ); ?></p>
				<div class="mt-6">
					<a href="<?php echo esc_url( $menu_url ); ?>" class="round inline-flex items-center justify-center rounded-full bg-sun px-6 py-3 text-[15px] font-semibold text-ink hover:bg-sun-2">
						<?php esc_html_e( 'مشاهده منوی کامل غذاها', 'hashvich' ); ?>
					</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
