<?php
/**
 * بخش نمایش بصری و تصویر غذا (Showcase)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

global $product;

$thumb_id  = $product ? $product->get_image_id() : get_post_thumbnail_id();
$image_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : '';

if ( ! $image_url && function_exists( 'hashvich_get_dish_image_fallback' ) ) {
	$slug      = $product ? $product->get_slug() : get_post_field( 'post_name' );
	$image_url = hashvich_get_dish_image_fallback( $slug );
}

if ( ! $image_url ) {
	$image_url = get_template_directory_uri() . '/assets/images/photos/burger.webp';
}

$title = get_the_title();
?>

<div class="flex flex-col gap-5 self-start lg:sticky lg:top-[110px]">
	<!-- سگمنت عکس اصلی غذا -->
	<div class="relative flex aspect-square items-center justify-center overflow-hidden rounded-[var(--radius-xl)] bg-card border border-line/40 shadow-sm">
		<div class="absolute inset-[14%] rounded-full bg-lime/60 blur-2xl" aria-hidden="true"></div>
		<img alt="<?php echo esc_attr( $title ); ?>"
			 class="select-none object-contain relative w-[72%] drop-shadow-[0_30px_30px_rgb(0_0_0/0.22)] motion-safe:animate-float"
			 draggable="false"
			 loading="eager"
			 decoding="async"
			 src="<?php echo esc_url( $image_url ); ?>">
	</div>

	<!-- توضیحات و استانداردهای پخت زیر سگمنت عکس -->
	<div class="rounded-[var(--radius-lg)] bg-card border border-line/40 p-5 shadow-sm">
		<div class="flex items-center gap-2.5 pb-3 border-b border-line/40">
			<span class="flex size-7 shrink-0 items-center justify-center rounded-full bg-forest text-white">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>
			</span>
			<h3 class="text-[14px] font-bold text-ink">
				<?php esc_html_e( 'استاندارد آماده‌سازی و ارسال هاشویچ', 'hashvich' ); ?>
			</h3>
		</div>
		<p class="mt-3 text-[13px] leading-relaxed text-muted">
			<?php
			if ( function_exists( 'hashvich_get_dish_excerpt' ) ) {
				echo esc_html( hashvich_get_dish_excerpt( $product, 32 ) );
			} else {
				esc_html_e( 'تمامی غذاهای هاشویچ با گوشت کشتار روز و نان تازه پخت شده و در بسته‌بندی عایق حرارتی ارسال می‌گردد.', 'hashvich' );
			}
			?>
		</p>
		<ul class="mt-3.5 flex flex-col gap-2 pt-3 border-t border-line/30 text-[12.5px] text-muted">
			<li class="flex items-center gap-2">
				<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-forest shrink-0"><path d="M20 6 9 17l-5-5"></path></svg>
				<span><?php esc_html_e( 'آماده‌سازی فوری پس از ثبت سفارش در آشپزخانه تخصصی', 'hashvich' ); ?></span>
			</li>
			<li class="flex items-center gap-2">
				<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-forest shrink-0"><path d="M20 6 9 17l-5-5"></path></svg>
				<span><?php esc_html_e( 'بسته‌بندی بهداشتی پلمب با برچسب اطمینان حرارتی', 'hashvich' ); ?></span>
			</li>
			<li class="flex items-center gap-2">
				<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-forest shrink-0"><path d="M20 6 9 17l-5-5"></path></svg>
				<span><?php esc_html_e( 'ضمانت تحویل داغ و تازه یا جایگزینی فوری سفارش', 'hashvich' ); ?></span>
			</li>
		</ul>
	</div>
</div>
