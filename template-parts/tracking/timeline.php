<?php
/**
 * تایم‌لاین ۵ مرحله‌ای پیشرفت آماده‌سازی و ارسال سفارش
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$order_id_param = isset( $_GET['order_id'] ) ? sanitize_text_field( wp_unslash( $_GET['order_id'] ) ) : '58214';
$order_obj      = false;
if ( function_exists( 'wc_get_order' ) && is_numeric( $order_id_param ) ) {
	$order_obj = wc_get_order( (int) $order_id_param );
}

$status = $order_obj ? $order_obj->get_status() : 'completed';

// تعیین مرحله فعال
$active_step = 5;
if ( 'pending' === $status || 'on-hold' === $status ) {
	$active_step = 1;
} elseif ( 'processing' === $status ) {
	$active_step = 3;
} elseif ( 'completed' === $status ) {
	$active_step = 5;
}

$steps = array(
	1 => array(
		'title' => __( 'سفارش ثبت شد', 'hashvich' ),
		'desc'  => __( 'سفارش شما در سرور تایید و دریافت شد.', 'hashvich' ),
	),
	2 => array(
		'title' => __( 'در حال آماده‌سازی', 'hashvich' ),
		'desc'  => __( 'آشپزخانه در حال گریل و پخت است.', 'hashvich' ),
	),
	3 => array(
		'title' => __( 'بسته‌بندی شد', 'hashvich' ),
		'desc'  => __( 'در پیشخوان با برچسب حرارتی پلمب شد.', 'hashvich' ),
	),
	4 => array(
		'title' => __( 'تحویل به پیک', 'hashvich' ),
		'desc'  => __( 'پیک در باکس عایق در مسیر است.', 'hashvich' ),
	),
	5 => array(
		'title' => __( 'رسید. نوش جان!', 'hashvich' ),
		'desc'  => __( 'سفارش به شما تحویل داده شد.', 'hashvich' ),
	),
);
?>

<div class="flex flex-col gap-8">
	<!-- تایم‌لاین ۵ مرحله‌ای -->
	<section aria-labelledby="progress" class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8 shadow-sm">
		<h2 id="progress" class="text-[20px] font-semibold text-ink mb-6"><?php esc_html_e( 'پیشرفت لحظه‌ای سفارش', 'hashvich' ); ?></h2>

		<ol class="grid gap-6 md:grid-cols-5 md:gap-0 relative">
			<?php foreach ( $steps as $idx => $step ) :
				$is_done    = $idx <= $active_step;
				$is_current = $idx === $active_step;
			?>
				<li class="relative flex items-center gap-4 md:flex-col md:items-start md:gap-3">
					<?php if ( $idx > 1 ) : ?>
						<span class="hidden md:block absolute top-[23px] right-[calc(100%-0px)] left-[-100%] h-0.5 w-full bg-line" aria-hidden="true">
							<span class="block size-full <?php echo $is_done ? 'bg-leaf' : 'bg-line'; ?>"></span>
						</span>
					<?php endif; ?>

					<span class="round relative z-10 flex size-12 shrink-0 items-center justify-center rounded-full transition-colors <?php echo $is_done ? 'bg-leaf text-white' : 'bg-card text-muted border border-line-strong'; ?>">
						<?php if ( $is_done ) : ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-5"><path d="M20 6 9 17l-5-5"></path></svg>
						<?php else : ?>
							<span class="text-[14px] font-bold tabular-nums"><?php echo esc_html( hashvich_to_persian_num( $idx ) ); ?></span>
						<?php endif; ?>
					</span>

					<span class="md:pr-3">
						<span class="block text-[15px] font-semibold text-ink"><?php echo esc_html( $step['title'] ); ?></span>
						<span class="block text-[13px] text-muted mt-0.5"><?php echo esc_html( $step['desc'] ); ?></span>
					</span>
				</li>
			<?php endforeach; ?>
		</ol>
	</section>

	<!-- کارت نظردهی و امتیاز به سفارش -->
	<section class="rounded-[var(--radius-lg)] bg-lime-soft/40 border border-leaf/20 p-6 md:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
		<div class="flex items-center gap-4">
			<div class="flex size-14 shrink-0 items-center justify-center rounded-full bg-sun text-ink shadow-sm">
				<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
			</div>
			<div>
				<h3 class="text-[18px] font-bold text-ink"><?php esc_html_e( 'چطور بود؟ طعم غذا چسبید؟', 'hashvich' ); ?></h3>
				<p class="text-[14px] text-muted mt-1"><?php esc_html_e( 'نظر شما درباره کیفیت پخت و سرعت ارسال، به بهتر شدن روزبه‌روز ما کمک می‌کند.', 'hashvich' ); ?></p>
			</div>
		</div>

		<a class="round inline-flex items-center justify-center gap-2 rounded-full bg-leaf text-white hover:bg-leaf-2 px-6 h-12 text-[14px] font-semibold transition-all shrink-0 active:scale-[0.98]"
		   href="<?php echo esc_url( home_url( '/reviews/#write' ) ); ?>">
			<span><?php esc_html_e( 'ثبت امتیاز و نظر', 'hashvich' ); ?></span>
		</a>
	</section>
</div>
