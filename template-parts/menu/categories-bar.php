<?php
/**
 * نوار دسته‌بندی چسبان (Sticky) صفحه منو با آیکون‌های اختصاصی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$img_dir_uri = get_template_directory_uri() . '/assets/images/';

// نگاشت آیکون دسته‌بندی‌ها
$cat_icons = array(
	'burgers'  => $img_dir_uri . 'photos/burger.webp',
	'pizza'    => $img_dir_uri . 'photos/pizza-pepperoni.webp',
	'fried'    => $img_dir_uri . 'photos/fries.webp',
	'wraps'    => $img_dir_uri . 'photos/wrap.webp',
	'healthy'  => $img_dir_uri . 'photos/salad.webp',
	'desserts' => $img_dir_uri . 'photos/cake.webp',
	'drinks'   => $img_dir_uri . 'photos/shake.webp',
);

// فهرست دسته‌های پیش‌فرض منطبق بر کیت طراحی
$default_cats = array(
	array(
		'slug' => 'burgers',
		'name' => __( 'برگر و سیب‌زمینی', 'hashvich' ),
		'icon' => $cat_icons['burgers'],
	),
	array(
		'slug' => 'pizza',
		'name' => __( 'دنیای پیتزا', 'hashvich' ),
		'icon' => $cat_icons['pizza'],
	),
	array(
		'slug' => 'fried',
		'name' => __( 'سوخاری و ترد', 'hashvich' ),
		'icon' => $cat_icons['fried'],
	),
	array(
		'slug' => 'wraps',
		'name' => __( 'ساندویچ و رپ', 'hashvich' ),
		'icon' => $cat_icons['wraps'],
	),
	array(
		'slug' => 'healthy',
		'name' => __( 'سبک و سالم', 'hashvich' ),
		'icon' => $cat_icons['healthy'],
	),
	array(
		'slug' => 'desserts',
		'name' => __( 'دسر و شیرینی', 'hashvich' ),
		'icon' => $cat_icons['desserts'],
	),
	array(
		'slug' => 'drinks',
		'name' => __( 'شیک و نوشیدنی', 'hashvich' ),
		'icon' => $cat_icons['drinks'],
	),
);

// اگر ووکامرس فعال است دسته‌ها را با شناسه و اسلاگ ووکامرس تطبیق می‌دهیم
$categories_list = $default_cats;
if ( taxonomy_exists( 'product_cat' ) ) {
	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
		)
	);

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$dynamic_cats = array();
		foreach ( $terms as $term ) {
			if ( 'uncategorized' === $term->slug ) {
				continue;
			}
			$slug = $term->slug;
			$icon = $cat_icons[ $slug ] ?? ( $img_dir_uri . 'photos/burger.webp' );
			$dynamic_cats[] = array(
				'slug' => $slug,
				'name' => $term->name,
				'icon' => $icon,
			);
		}
		if ( ! empty( $dynamic_cats ) ) {
			$categories_list = $dynamic_cats;
		}
	}
}

// بررسی دسته‌بندی پیش‌فرض از روی پارامتر URL
$current_cat = isset( $_GET['category'] ) ? sanitize_text_field( wp_unslash( $_GET['category'] ) ) : 'all';
?>

<div class="sticky top-[84px] z-30 border-b bg-white/95 backdrop-blur" id="hv-sticky-categories">
	<div class="container-page no-scrollbar flex gap-2 overflow-x-auto py-3" role="group" aria-label="<?php esc_attr_e( 'دسته‌ها', 'hashvich' ); ?>">
		<button type="button"
				data-category="all"
				aria-pressed="<?php echo 'all' === $current_cat ? 'true' : 'false'; ?>"
				class="hv-cat-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] <?php echo 'all' === $current_cat ? 'border-forest bg-forest text-white' : 'border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft'; ?>">
			<?php esc_html_e( 'همه غذاها', 'hashvich' ); ?>
		</button>

		<?php foreach ( $categories_list as $cat ) : 
			$is_active = ( $current_cat === $cat['slug'] );
		?>
			<button type="button"
					data-category="<?php echo esc_attr( $cat['slug'] ); ?>"
					aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>"
					class="hv-cat-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] <?php echo $is_active ? 'border-forest bg-forest text-white' : 'border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft'; ?>">
				<img alt="" class="select-none object-contain size-6" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $cat['icon'] ); ?>">
				<?php echo esc_html( $cat['name'] ); ?>
			</button>
		<?php endforeach; ?>
	</div>
</div>
