<?php
/**
 * بخش مشخصات، سفارشی‌سازی اندازه و افزودنی‌ها و سفارش غذا
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_id = $product ? $product->get_id() : get_the_ID();
$title      = get_the_title();
$price      = (float) ( $product ? $product->get_price() : get_post_meta( $product_id, '_price', true ) );
$reg_price  = (float) ( $product ? $product->get_regular_price() : $price );
$is_on_sale = $product ? $product->is_on_sale() : false;

// دسته‌بندی
$categories = get_the_terms( $product_id, 'product_cat' );
$cat_name   = __( 'غذاها', 'hashvich' );
if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
	foreach ( $categories as $c ) {
		if ( 'uncategorized' !== $c->slug ) {
			$cat_name = $c->name;
			break;
		}
	}
}

// امتیاز و نظرات
$avg_rating  = $product ? $product->get_average_rating() : 0;
$meta_rate   = get_post_meta( $product_id, '_hv_rating', true );
$rating_val  = $avg_rating ? number_format( (float) $avg_rating, 1 ) : ( $meta_rate ? number_format( (float) $meta_rate, 1 ) : '4.8' );
$rating_fa   = hashvich_to_persian_num( $rating_val );
$rev_count   = $product ? $product->get_review_count() : 0;
if ( ! $rev_count ) {
	$rev_count = get_post_meta( $product_id, '_wc_review_count', true ) ?: 1240;
}
$rev_count_fa = hashvich_to_persian_num( number_format( (float) $rev_count ) );

// زمان آماده‌سازی و کالری
$prep_time = get_post_meta( $product_id, '_hv_minutes', true );
if ( ! $prep_time ) {
	$prep_time = get_post_meta( $product_id, '_prep_time', true ) ?: ( 10 + ( ( $product_id * 3 ) % 16 ) );
}
$prep_time_fa = hashvich_to_persian_num( $prep_time );

$calories = get_post_meta( $product_id, '_hv_calories', true );
if ( ! $calories ) {
	$calories = get_post_meta( $product_id, '_calories', true ) ?: ( 350 + ( ( $product_id * 37 ) % 450 ) );
}
$calories_fa = hashvich_to_persian_num( $calories );

// برچسب‌های رژیم غذایی
$diet_labels = array(
	'vegetarian'  => __( 'گیاهی', 'hashvich' ),
	'vegan'       => __( 'وگان', 'hashvich' ),
	'spicy'       => __( 'تند', 'hashvich' ),
	'gluten-free' => __( 'بدون گلوتن', 'hashvich' ),
);
$diet_raw = get_post_meta( $product_id, '_hv_diet', true );
$diet_arr = array();
if ( is_string( $diet_raw ) && ! empty( $diet_raw ) ) {
	$decoded = json_decode( $diet_raw, true );
	if ( is_array( $decoded ) ) {
		$diet_arr = $decoded;
	}
} elseif ( is_array( $diet_raw ) ) {
	$diet_arr = $diet_raw;
}

// اندازه‌ها و افزودنی‌ها
$sizes_raw = get_post_meta( $product_id, '_hv_sizes', true );
$sizes     = array();
if ( is_string( $sizes_raw ) && ! empty( $sizes_raw ) ) {
	$decoded = json_decode( $sizes_raw, true );
	if ( is_array( $decoded ) ) {
		$sizes = $decoded;
	}
}

$extras_raw = get_post_meta( $product_id, '_hv_extras', true );
$extras     = array();
if ( is_string( $extras_raw ) && ! empty( $extras_raw ) ) {
	$decoded = json_decode( $extras_raw, true );
	if ( is_array( $decoded ) ) {
		$extras = $decoded;
	}
}

$description = get_the_excerpt();
if ( ! $description ) {
	$description = wp_strip_all_tags( get_the_content() );
}
?>

<div class="flex min-w-0 flex-col">
	<!-- نشان دسته‌بندی و علاقه‌مندی -->
	<div class="flex items-center justify-between gap-3">
		<div class="flex flex-wrap gap-2">
			<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-lime-soft text-forest">
				<?php echo esc_html( $cat_name ); ?>
			</span>
			<?php foreach ( $diet_arr as $d_tag ) :
				if ( isset( $diet_labels[ $d_tag ] ) ) :
			?>
				<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sand text-ink">
					<?php echo esc_html( $diet_labels[ $d_tag ] ); ?>
				</span>
			<?php 
				endif;
			endforeach; 
			?>
		</div>
		<button type="button"
				aria-pressed="false"
				aria-label="<?php echo esc_attr( sprintf( __( 'ذخیره %s', 'hashvich' ), $title ) ); ?>"
				class="hv-fav-btn round relative z-[2] inline-flex size-10 items-center justify-center rounded-full transition-[color,transform,background-color] hov:bg-black/5 prs:scale-90 text-muted hov:text-ink bg-card"
				data-product-id="<?php echo esc_attr( $product_id ); ?>">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart size-[18px] transition-transform" aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
		</button>
	</div>

	<!-- عنوان غذا -->
	<h1 class="mt-4 text-[clamp(2.2rem,1.6rem+2vw,3.2rem)] leading-[1.05] font-bold">
		<?php echo esc_html( $title ); ?>
	</h1>

	<!-- متادیتا: ستاره، امتیاز، زمان، کالری -->
	<div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2">
		<span class="inline-flex items-center gap-2">
			<span class="inline-flex items-center gap-1">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" class="lucide lucide-star text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
				<span class="text-[13px] font-medium tabular-nums"><?php echo esc_html( $rating_fa ); ?></span>
			</span>
			<span class="text-[14px] text-muted">(<?php echo esc_html( $rev_count_fa ); ?> <?php esc_html_e( 'امتیاز', 'hashvich' ); ?>)</span>
		</span>
		<span class="inline-flex items-center gap-1.5 text-[13px] text-muted">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock size-3.5" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
			<?php echo esc_html( $prep_time_fa ); ?> <?php esc_html_e( 'دقیقه', 'hashvich' ); ?> <span aria-hidden="true">|</span><span class="sr-only">،</span> <?php echo esc_html( $calories_fa ); ?> <?php esc_html_e( 'کیلوکالری', 'hashvich' ); ?>
		</span>
	</div>

	<!-- قیمت غذا -->
	<div class="mt-5">
		<span class="inline-flex items-baseline gap-2">
			<span id="hv-dish-price" class="font-semibold tabular-nums text-[28px]">
				<?php echo hashvich_format_price( $price ); ?>
			</span>
			<?php if ( $is_on_sale && $reg_price > $price ) : ?>
				<span class="text-muted line-through tabular-nums text-[16px]">
					<span class="sr-only"><?php esc_html_e( 'قبلاً', 'hashvich' ); ?> </span><?php echo hashvich_format_price( $reg_price ); ?>
				</span>
			<?php endif; ?>
		</span>
	</div>

	<!-- توضیحات -->
	<?php if ( ! empty( $description ) ) : ?>
		<p class="mt-5 text-[17px] leading-relaxed text-muted">
			<?php echo esc_html( $description ); ?>
		</p>
	<?php endif; ?>

	<!-- فرم سفارشی‌سازی غذا (اندازه، افزودنی‌ها، یادداشت و افزودن به سبد) -->
	<form id="hv-dish-order-form" class="mt-8 flex flex-col gap-7 border-t pt-7" method="post" enctype="multipart/form-data">
		<?php if ( ! empty( $sizes ) ) : ?>
			<fieldset>
				<legend class="mb-2 text-[14px] font-medium"><?php esc_html_e( 'اندازه را انتخاب کنید', 'hashvich' ); ?></legend>
				<div class="grid gap-2.5 grid-cols-1 sm:grid-cols-2">
					<?php foreach ( $sizes as $idx => $s ) :
						$is_first      = ( 0 === $idx );
						$s_label       = esc_html( $s['label'] );
						$s_price       = (int) ( $s['price'] ?? 0 );
						$s_price_label = $s_price > 0 ? ( '+' . hashvich_format_price( $s_price ) ) : __( 'شامل قیمت', 'hashvich' );
					?>
						<label class="hv-size-option relative flex cursor-pointer items-center gap-3 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors duration-[var(--duration-fast)] min-h-16 px-4 py-3 <?php echo $is_first ? 'border-leaf bg-lime-soft' : 'border-line-strong hover:border-muted'; ?>" data-size-price="<?php echo esc_attr( $s_price ); ?>">
							<input class="sr-only" type="radio" name="hv_size" value="<?php echo esc_attr( $s_label ); ?>" <?php checked( $is_first, true ); ?>>
							<span class="flex min-w-0 flex-1 flex-col">
								<span class="text-[15px] font-medium"><?php echo $s_label; ?></span>
								<span class="text-[13px] text-muted"><?php echo $s_price_label; ?></span>
							</span>
							<span class="hv-radio-indicator round flex size-5 shrink-0 items-center justify-center rounded-full border-[1.5px] transition-colors <?php echo $is_first ? 'border-leaf bg-leaf text-white' : 'border-line-strong'; ?>" aria-hidden="true">
								<?php if ( $is_first ) : ?>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3"><path d="M20 6 9 17l-5-5"></path></svg>
								<?php endif; ?>
							</span>
						</label>
					<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

		<?php if ( ! empty( $extras ) ) : ?>
			<fieldset>
				<legend class="mb-1 text-[14px] font-medium"><?php esc_html_e( 'افزودنی‌ها', 'hashvich' ); ?></legend>
				<div class="-mx-3 flex flex-col">
					<?php foreach ( $extras as $e ) :
						$e_label = esc_html( $e['label'] );
						$e_price = (int) ( $e['price'] ?? 0 );
					?>
						<label class="hv-extra-option flex min-h-12 cursor-pointer items-center gap-3 rounded-[var(--radius-sm)] px-3 transition-colors hover:bg-card" data-extra-price="<?php echo esc_attr( $e_price ); ?>">
							<input class="sr-only" type="checkbox" name="hv_extras[]" value="<?php echo esc_attr( $e_label ); ?>">
							<span aria-hidden="true" class="hv-checkbox-indicator flex size-5 shrink-0 items-center justify-center rounded-[6px] border-[1.5px] transition-colors border-line-strong bg-white"></span>
							<span class="flex-1 text-[15px]"><?php echo $e_label; ?></span>
							<span class="text-[14px] text-muted tabular-nums">+<?php echo hashvich_format_price( $e_price ); ?></span>
						</label>
					<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

		<!-- یادداشت برای آشپزخانه -->
		<div class="flex flex-col gap-1.5">
			<label for="hv-kitchen-note" class="text-[14px] font-medium">
				<?php esc_html_e( 'یادداشت برای آشپزخانه', 'hashvich' ); ?><span class="font-normal text-muted"> (<?php esc_html_e( 'اختیاری', 'hashvich' ); ?>)</span>
			</label>
			<textarea class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink placeholder:text-faint transition-[border-color,box-shadow] duration-[var(--duration-fast)] hov:border-muted focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.15)] resize-y py-3 leading-relaxed min-h-20"
					  rows="2"
					  id="hv-kitchen-note"
					  name="hv_note"
					  placeholder="<?php esc_attr_e( 'حساسیت غذایی، بدون پیاز، بیشتر ترد...', 'hashvich' ); ?>"></textarea>
			<p class="text-[13px] text-muted"><?php esc_html_e( 'حساسیت غذایی، بدون پیاز، بیشتر ترد...', 'hashvich' ); ?></p>
		</div>

		<!-- نوار چسبان سفارش و افزودن به سبد خرید -->
		<div class="sticky bottom-0 z-10 -mx-4 mt-4 flex items-center gap-3 border-t bg-white px-4 py-4 sm:static sm:mx-0 sm:border-0 sm:p-0">
			<!-- انتخاب تعداد -->
			<div role="group" aria-label="<?php esc_attr_e( 'تعداد', 'hashvich' ); ?>" class="round inline-flex items-center rounded-full border border-line-strong bg-white">
				<button type="button" id="hv-qty-minus" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-11 [&_svg]:size-4" disabled aria-label="<?php esc_attr_e( 'کاهش تعداد', 'hashvich' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus"><path d="M5 12h14"></path></svg>
				</button>
				<span id="hv-dish-qty" class="text-center font-medium tabular-nums w-8 text-[15px]" aria-live="polite">۱</span>
				<button type="button" id="hv-qty-plus" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-11 [&_svg]:size-4" aria-label="<?php esc_attr_e( 'افزایش تعداد', 'hashvich' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
				</button>
			</div>

			<!-- مقادیر پنهان برای سبد خرید -->
			<input type="hidden" id="hv-product-id" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>">
			<input type="hidden" id="hv-product-base-price" value="<?php echo esc_attr( (int) $price ); ?>">
			<input type="hidden" id="hv-product-qty" name="quantity" value="1">
			<input type="hidden" id="hv-extra-price-input" name="hv_extra_price" value="0">

			<!-- دکمه اقدام اصلی افزودن به سبد -->
			<button type="submit" id="hv-add-to-cart-btn" class="round relative inline-flex select-none items-center justify-between gap-2 whitespace-nowrap rounded-full font-medium transition-[background-color,color,border-color,box-shadow,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] prs:translate-y-px prs:scale-[0.98] bg-sun text-ink hov:bg-sun-2 hov:shadow-[0_10px_24px_-10px_rgb(247_195_46/0.9)] prs:bg-[#e9b41f] h-14 px-5 sm:px-8 text-[17px] min-w-0 flex-1">
				<div class="inline-flex items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag size-5 max-sm:hidden" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
					<span><?php esc_html_e( 'افزودن به سبد', 'hashvich' ); ?></span>
				</div>
				<span id="hv-dish-btn-price" class="tabular-nums font-semibold"><?php echo hashvich_format_price( $price ); ?></span>
			</button>
		</div>
	</form>
</div>
