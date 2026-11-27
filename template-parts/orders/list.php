<?php
/**
 * فهرست تاریخچه سفارش‌های قبلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$tracking_base_url = home_url( '/tracking/' );
$user_id           = get_current_user_id();
$customer_orders   = array();

if ( $user_id && function_exists( 'wc_get_orders' ) ) {
	$customer_orders = wc_get_orders(
		array(
			'customer_id' => $user_id,
			'limit'       => 10,
		)
	);
}
?>

<section aria-labelledby="past">
	<h2 id="past" class="mb-4 text-[22px] font-semibold text-ink"><?php esc_html_e( 'سفارش‌های قبلی', 'hashvich' ); ?></h2>

	<ul class="flex flex-col gap-4">
		<?php if ( ! empty( $customer_orders ) ) : ?>
			<?php foreach ( $customer_orders as $o ) :
				$order_id       = $o->get_id();
				$order_status   = $o->get_status();
				$order_total    = $o->get_formatted_order_total();
				$date_created   = $o->get_date_created() ? $o->get_date_created()->date_i18n( 'j F Y ساعت H:i' ) : '';
				$items          = $o->get_items();
				$item_names     = array();
				foreach ( $items as $it ) {
					$item_names[] = $it->get_quantity() . ' × ' . $it->get_name();
				}
				$items_summary  = implode( '، ', $item_names );
				$status_labels  = wc_get_order_statuses();
				$status_name    = isset( $status_labels[ 'wc-' . $order_status ] ) ? $status_labels[ 'wc-' . $order_status ] : $order_status;
				$track_link     = add_query_arg( 'order_id', $order_id, $tracking_base_url );
			?>
				<li class="flex flex-col gap-4 rounded-[var(--radius-md)] border bg-white p-5 sm:flex-row sm:items-center sm:justify-between shadow-sm">
					<div class="min-w-0 flex-1">
						<div class="flex flex-wrap items-center gap-2">
							<span class="text-[16px] font-bold text-ink">HS-<?php echo esc_html( $order_id ); ?></span>
							<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2.5 text-[12px] font-semibold leading-none whitespace-nowrap bg-leaf/10 text-leaf">
								<?php echo esc_html( $status_name ); ?>
							</span>
						</div>
						<p class="mt-1.5 truncate text-[14px] text-muted">
							<?php echo esc_html( $items_summary ); ?>
						</p>
						<p class="mt-1 text-[13px] text-muted">
							<?php echo esc_html( $date_created ); ?> | <?php echo wp_kses_post( $order_total ); ?>
						</p>
					</div>

					<div class="flex shrink-0 gap-2 items-center">
						<a class="round inline-flex items-center justify-center gap-2 rounded-full border border-leaf text-leaf hover:bg-leaf hover:text-white px-4 h-10 text-[14px] font-medium transition-colors"
						   href="<?php echo esc_url( $track_link ); ?>">
							<span><?php esc_html_e( 'دیدن رسید و پیگیری', 'hashvich' ); ?></span>
						</a>
					</div>
				</li>
			<?php endforeach; ?>
		<?php else : ?>
			<!-- سفارش نمونه برای کاربران مهمان -->
			<li class="flex flex-col gap-4 rounded-[var(--radius-md)] border bg-white p-5 sm:flex-row sm:items-center sm:justify-between shadow-sm">
				<div class="min-w-0 flex-1">
					<div class="flex flex-wrap items-center gap-2">
						<span class="text-[16px] font-bold text-ink">HS-58214</span>
						<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2.5 text-[12px] font-semibold leading-none whitespace-nowrap bg-card text-muted">
							<?php esc_html_e( 'تحویل شد', 'hashvich' ); ?>
						</span>
					</div>
					<p class="mt-1.5 truncate text-[14px] text-muted">
						۱ × برگر ویژه هاشویچ، ۲ × سیب‌زمینی با سس پنیر، ۱ × شیک توت‌فرنگی
					</p>
					<p class="mt-1 text-[13px] text-muted">
						۲ آذر ساعت ۱۴:۳۰ | ارسال با پیک | ۵۸۱٬۴۹۸ تومان
					</p>
				</div>

				<div class="flex shrink-0 gap-2 items-center">
					<a class="round inline-flex items-center justify-center gap-2 rounded-full border border-leaf text-leaf hover:bg-leaf hover:text-white px-4 h-10 text-[14px] font-medium transition-colors"
					   href="<?php echo esc_url( add_query_arg( 'order_id', '58214', $tracking_base_url ) ); ?>">
						<span><?php esc_html_e( 'دیدن رسید و پیگیری', 'hashvich' ); ?></span>
					</a>
				</div>
			</li>
		<?php endif; ?>
	</ul>
</section>
