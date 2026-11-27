<?php
/**
 * بخش دسته‌بندی‌ها (categories) در صفحه اصلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$img_dir_uri = get_template_directory_uri() . '/assets/images/';
$menu_url    = home_url( '/menu/' );

// فهرست موقعیت‌های شناور دسکتاپ بر اساس طراحی واکنش‌گرا
$positions = array(
	'lg:left-[8%] lg:top-[30%]',
	'lg:left-[27%] lg:top-[4%]',
	'lg:right-[3%] lg:top-[24%]',
	'lg:left-[50%] lg:top-[56%]',
	'lg:left-[25%] lg:top-[66%]',
	'lg:right-[16%] lg:top-[-2%]',
);

// دسته‌بندی‌های پیش‌فرض کیت طراحی
$categories = array(
	array(
		'name'  => __( 'برگر و سیب‌زمینی', 'hashvich' ),
		'slug'  => 'burgers',
		'photo' => 'photos/burger.webp',
		'count' => 3,
		'url'   => add_query_arg( 'category', 'burgers', $menu_url ),
	),
	array(
		'name'  => __( 'دنیای پیتزا', 'hashvich' ),
		'slug'  => 'pizza',
		'photo' => 'photos/pizza-pepperoni.webp',
		'count' => 2,
		'url'   => add_query_arg( 'category', 'pizza', $menu_url ),
	),
	array(
		'name'  => __( 'سوخاری و ترد', 'hashvich' ),
		'slug'  => 'fried',
		'photo' => 'photos/fries.webp',
		'count' => 3,
		'url'   => add_query_arg( 'category', 'fried', $menu_url ),
	),
	array(
		'name'  => __( 'ساندویچ و رپ', 'hashvich' ),
		'slug'  => 'wraps',
		'photo' => 'photos/wrap.webp',
		'count' => 2,
		'url'   => add_query_arg( 'category', 'wraps', $menu_url ),
	),
	array(
		'name'  => __( 'سبک و سالم', 'hashvich' ),
		'slug'  => 'healthy',
		'photo' => 'photos/salad.webp',
		'count' => 3,
		'url'   => add_query_arg( 'category', 'healthy', $menu_url ),
	),
	array(
		'name'  => __( 'دسر و شیرینی', 'hashvich' ),
		'slug'  => 'desserts',
		'photo' => 'photos/cake.webp',
		'count' => 1,
		'url'   => add_query_arg( 'category', 'desserts', $menu_url ),
	),
);

// همگام‌سازی با دسته‌بندی‌های واقعی ووکامرس در صورت وجود
if ( taxonomy_exists( 'product_cat' ) ) {
	$default_cat = (int) get_option( 'default_product_cat' );
	$wc_terms    = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'exclude'    => array( $default_cat ),
			'number'     => 6,
		)
	);

	if ( ! empty( $wc_terms ) && ! is_wp_error( $wc_terms ) ) {
		foreach ( $wc_terms as $idx => $term ) {
			if ( isset( $categories[ $idx ] ) ) {
				$categories[ $idx ]['name']  = $term->name;
				$categories[ $idx ]['slug']  = $term->slug;
				$categories[ $idx ]['count'] = (int) $term->count;
				$categories[ $idx ]['url']   = get_term_link( $term );

				// بررسی تصویر شاخص دسته ووکامرس
				$thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				if ( $thumb_id ) {
					$img_src = wp_get_attachment_image_url( $thumb_id, 'thumbnail' );
					if ( $img_src ) {
						$categories[ $idx ]['full_photo_url'] = $img_src;
					}
				}
			}
		}
	}
}
?>

<section class="mt-24 bg-lime md:mt-28" aria-labelledby="cats">
	<div class="container-page py-16 md:py-20">
		<div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between md:gap-8">
			<h2 class="text-[clamp(1.35rem,1.05rem+0.85vw,1.85rem)] leading-normal font-bold">
				<span id="cats"><?php esc_html_e( 'دسته‌به‌دسته، طعم‌های خوشمزه را کشف کنید', 'hashvich' ); ?></span>
			</h2>
			<div class="flex max-w-[440px] flex-col">
				<p class="text-[15px] leading-relaxed text-muted">
					<?php esc_html_e( 'هفت آشپزخانه زیر یک سقف. هر چه هوس کرده‌اید انتخاب کنید؛ داغ به درتان می‌رسانیم.', 'hashvich' ); ?>
				</p>
			</div>
		</div>

		<div class="relative mt-10 lg:mt-6 lg:h-[560px]">
			<div class="pointer-events-none relative mx-auto hidden aspect-[6/5] w-[min(100%,620px)] lg:absolute lg:top-[2%] lg:right-[4%] lg:block" aria-hidden="true">
				<img alt="" class="select-none object-contain absolute inset-0 size-full drop-shadow-[0_30px_40px_rgb(0_0_0/0.3)]" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/pizza-board.webp' ); ?>">
			</div>

			<ul class="no-scrollbar -mx-4 flex gap-4 overflow-x-auto px-4 pb-4 lg:static lg:mx-0 lg:block lg:overflow-visible lg:p-0">
				<?php
				foreach ( $categories as $i => $cat ) :
					$pos_class = isset( $positions[ $i ] ) ? $positions[ $i ] : '';
					$photo_url = ! empty( $cat['full_photo_url'] ) ? $cat['full_photo_url'] : $img_dir_uri . $cat['photo'];
					$count_fa  = hashvich_to_persian_num( $cat['count'] );
					?>
					<li class="shrink-0 lg:absolute <?php echo esc_attr( $pos_class ); ?>">
						<div>
							<a class="flex w-[150px] flex-col items-center gap-2 rounded-[var(--radius-md)] px-3 py-5 text-center shadow-[var(--shadow-card)] transition-[transform,background-color,box-shadow] duration-[var(--duration-base)] ease-[var(--ease-out)] hov:-translate-y-1 hov:shadow-[var(--shadow-float)] prs:translate-y-0 bg-white text-ink" href="<?php echo esc_url( $cat['url'] ); ?>" data-discover="true">
								<span class="round flex size-14 items-center justify-center rounded-full transition-colors bg-leaf/10">
									<img alt="<?php echo esc_attr( $cat['name'] ); ?>" class="select-none object-contain size-11 drop-shadow-sm transition-transform duration-300 hover:scale-110" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $photo_url ); ?>">
								</span>
								<span class="text-[15px] leading-tight font-semibold"><?php echo esc_html( $cat['name'] ); ?></span>
								<span class="text-[12px] text-muted"><?php echo esc_html( $count_fa ); ?> <?php esc_html_e( 'غذا', 'hashvich' ); ?></span>
							</a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="mt-6 flex justify-end lg:absolute lg:right-0 lg:bottom-0 lg:mt-0">
				<a class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-[background-color,color,border-color,box-shadow,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] prs:translate-y-px prs:scale-[0.98] disabled:pointer-events-none disabled:opacity-45 aria-disabled:pointer-events-none aria-disabled:opacity-45 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 h-10 px-4 text-[14px]" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
					<span><?php esc_html_e( 'دیدن همه دسته‌ها', 'hashvich' ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>
