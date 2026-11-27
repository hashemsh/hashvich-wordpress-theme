<?php
/**
 * بخش نظرات مشتریان صفحه جزئیات غذا
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_id = $product ? $product->get_id() : get_the_ID();
$title      = get_the_title();
$permalink  = get_permalink();

$people_uri = get_template_directory_uri() . '/assets/images/people/';

// دریافت دیدگاه‌های ثبت‌شده در وردپرس برای این غذا
$wp_comments = get_comments(
	array(
		'post_id' => $product_id,
		'status'  => 'approve',
		'number'  => 3,
	)
);

// نظرات پیش‌فرض در صورت نبود دیدگاه در وردپرس
$fallback_reviews = array(
	array(
		'name'   => __( 'سارا محمدی', 'hashvich' ),
		'avatar' => $people_uri . 'avatar-1.svg',
		'rating' => 5,
		'date'   => __( '۱۱ آبان', 'hashvich' ),
		'text'   => __( 'بهترین برگری که سال‌ها خورده‌ام. در ۲۲ دقیقه رسید و نانش هنوز گرم بود. دوباره سفارش دادم.', 'hashvich' ),
	),
	array(
		'name'   => __( 'امیر تهرانی', 'hashvich' ),
		'avatar' => $people_uri . 'avatar-2.svg',
		'rating' => 5,
		'date'   => __( '۸ آبان', 'hashvich' ),
		'text'   => __( 'طعم گوشت و پتی فوق‌العاده باکیفیت است و سس مخصوص توازن بی‌نظیری دارد. بسته‌بندی عالی بود.', 'hashvich' ),
	),
	array(
		'name'   => __( 'مهدی رضایی', 'hashvich' ),
		'avatar' => $people_uri . 'avatar-3.svg',
		'rating' => 5,
		'date'   => __( '۲ آبان', 'hashvich' ),
		'text'   => __( 'سیب‌زمینی‌ها کاملاً ترد و داغ بودند و حجم غذا کاملاً سیرکننده بود. حتماً پیشنهاد می‌کنم.', 'hashvich' ),
	),
);

$display_reviews = array();

if ( ! empty( $wp_comments ) ) {
	foreach ( $wp_comments as $idx => $comment ) {
		$rate_meta = get_comment_meta( $comment->comment_ID, 'rating', true );
		$display_reviews[] = array(
			'name'   => $comment->comment_author,
			'avatar' => $people_uri . 'avatar-' . ( ( $idx % 6 ) + 1 ) . '.svg',
			'rating' => $rate_meta ? (int) $rate_meta : 5,
			'date'   => hashvich_to_persian_num( get_comment_date( 'j F', $comment ) ),
			'text'   => $comment->comment_content,
		);
	}
} else {
	$display_reviews = $fallback_reviews;
}
?>

<section class="container-page pb-16" aria-labelledby="dish-reviews">
	<div class="flex flex-col gap-3">
		<h2 class="text-[clamp(1.9rem,1.2rem+1.8vw,2.6rem)] leading-[1.1] font-semibold">
			<span id="dish-reviews"><?php esc_html_e( 'نظر مشتریان', 'hashvich' ); ?></span>
		</h2>
	</div>

	<div class="mt-8 grid gap-6 md:grid-cols-3">
		<?php foreach ( $display_reviews as $rev ) : 
			$stars = (int) ( $rev['rating'] ?? 5 );
		?>
			<figure class="flex h-full flex-col gap-4 rounded-[var(--radius-md)] p-6 bg-card">
				<span class="inline-flex items-center gap-1" role="img" aria-label="<?php echo esc_attr( sprintf( __( 'امتیاز %d از ۵', 'hashvich' ), $stars ) ); ?>">
					<?php for ( $i = 1; $i <= 5; $i++ ) : 
						$is_fill = ( $i <= $stars );
					?>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="<?php echo $is_fill ? 'currentColor' : 'none'; ?>" stroke="currentColor" stroke-width="<?php echo $is_fill ? '0' : '1.5'; ?>" class="<?php echo $is_fill ? 'text-sun' : 'text-line-strong'; ?>" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
					<?php endfor; ?>
				</span>

				<blockquote class="flex-1 text-[16px] leading-relaxed">
					<?php echo esc_html( $rev['text'] ); ?>
				</blockquote>

				<figcaption class="flex items-center gap-3">
					<img alt="" class="round size-11 rounded-full" src="<?php echo esc_url( $rev['avatar'] ); ?>">
					<div class="min-w-0">
						<p class="text-[15px] font-semibold"><?php echo esc_html( $rev['name'] ); ?></p>
						<p class="truncate text-[13px] text-muted">
							<a class="hover:underline" href="<?php echo esc_url( $permalink ); ?>" data-discover="true"><?php echo esc_html( $title ); ?></a>، <?php echo esc_html( $rev['date'] ); ?>
						</p>
					</div>
				</figcaption>
			</figure>
		<?php endforeach; ?>
	</div>
</section>
