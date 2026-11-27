<?php
/**
 * هدر و بنر تیره صفحه وضعیت لحظه‌ای سفارش
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$order_id_param = isset( $_GET['order_id'] ) ? sanitize_text_field( wp_unslash( $_GET['order_id'] ) ) : '58214';
$order_obj      = false;
if ( function_exists( 'wc_get_order' ) && is_numeric( $order_id_param ) ) {
	$order_obj = wc_get_order( (int) $order_id_param );
}

$display_id = $order_obj ? $order_obj->get_id() : $order_id_param;
$status     = $order_obj ? $order_obj->get_status() : 'completed';
?>

<section class="on-dark doodles relative overflow-hidden bg-forest text-white">
	<div class="container-page pt-8 pb-14 md:pt-12 md:pb-20">
		<div class="mb-4 text-[14px] text-on-forest-muted">
			<a class="inline-flex min-h-10 items-center gap-1.5 hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/orders/' ) ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="m9 18 6-6-6-6"></path></svg>
				<span><?php esc_html_e( 'بازگشت به سفارش‌های من', 'hashvich' ); ?></span>
			</a>
		</div>

		<h1 class="max-w-[760px] text-[clamp(2.4rem,1.4rem+3vw,4rem)] leading-[1.04] font-bold">
			<?php
			if ( 'completed' === $status ) {
				esc_html_e( 'رسید. نوش جان!', 'hashvich' );
			} elseif ( 'processing' === $status ) {
				esc_html_e( 'سفارش در حال پخت و آماده‌سازی است', 'hashvich' );
			} else {
				esc_html_e( 'سفارش شما با موفقیت ثبت شد', 'hashvich' );
			}
			?>
		</h1>

		<p class="mt-4 max-w-[560px] text-[17px] leading-relaxed text-on-forest-muted">
			<?php
			/* translators: %s: Order ID */
			printf( esc_html__( 'سفارش %s با بالاترین استانداردهای بهداشتی پلمب شده است.', 'hashvich' ), '<span class="font-bold text-white">HS-' . esc_html( $display_id ) . '</span>' );
			?>
		</p>
	</div>
</section>
