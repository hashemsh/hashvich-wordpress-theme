<?php
/**
 * بخش صورت‌حساب و مجموع ارقام سبد خرید (Cart Totals)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$cart     = WC()->cart;
$checkout = wc_get_checkout_url();
$menu_url = home_url( '/menu/' );
?>

<aside class="lg:sticky lg:top-[108px] lg:self-start" aria-label="<?php esc_attr_e( 'خلاصه سبد خرید', 'hashvich' ); ?>" id="hv-cart-totals-sidebar">
	<div class="rounded-[var(--radius-lg)] bg-card p-6 md:p-7">
		<h2 class="text-[20px] font-semibold border-b border-line-strong/60 pb-3">
			<?php esc_html_e( 'خلاصه سفارش', 'hashvich' ); ?>
		</h2>

		<dl class="mt-5 flex flex-col gap-3 text-[15px]">
			<div class="flex items-baseline justify-between gap-4">
				<dt class="text-muted"><?php esc_html_e( 'جمع جزء', 'hashvich' ); ?></dt>
				<dd class="tabular-nums font-medium" id="hv-summary-subtotal">
					<?php wc_cart_totals_subtotal_html(); ?>
				</dd>
			</div>

			<?php if ( $cart->needs_shipping() && $cart->show_shipping() ) : ?>
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php esc_html_e( 'هزینه ارسال', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium" id="hv-summary-shipping">
						<?php
						$shipping_total = (float) $cart->get_shipping_total();
						if ( $shipping_total <= 0 ) {
							esc_html_e( 'رایگان', 'hashvich' );
						} else {
							echo hashvich_format_price( $shipping_total );
						}
						?>
					</dd>
				</div>
			<?php endif; ?>

			<?php foreach ( $cart->get_coupons() as $code => $coupon ) : ?>
				<div class="flex items-baseline justify-between gap-4 text-forest">
					<dt class="flex items-center gap-1">
						<span><?php esc_html_e( 'تخفیف', 'hashvich' ); ?> (<?php echo esc_html( strtoupper( $code ) ); ?>)</span>
					</dt>
					<dd class="tabular-nums font-medium">
						-<?php wc_cart_totals_coupon_html( $coupon ); ?>
					</dd>
				</div>
			<?php endforeach; ?>

			<?php foreach ( $cart->get_fees() as $fee ) : ?>
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php echo esc_html( $fee->name ); ?></dt>
					<dd class="tabular-nums font-medium">
						<?php wc_cart_totals_fee_html( $fee ); ?>
					</dd>
				</div>
			<?php endforeach; ?>

			<?php if ( wc_tax_enabled() && ! $cart->display_prices_including_tax() ) : ?>
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php esc_html_e( 'مالیات بر ارزش افزوده', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium">
						<?php wc_cart_totals_taxes_total_html(); ?>
					</dd>
				</div>
			<?php endif; ?>

			<div class="flex items-baseline justify-between gap-4 text-[18px] font-bold border-t border-line-strong/60 pt-4 mt-2">
				<dt class="text-ink"><?php esc_html_e( 'مبلغ قابل پرداخت', 'hashvich' ); ?></dt>
				<dd class="tabular-nums text-forest text-[20px]" id="hv-summary-total">
					<?php wc_cart_totals_order_total_html(); ?>
				</dd>
			</div>
		</dl>

		<div class="mt-6 flex flex-col gap-3">
			<a href="<?php echo esc_url( $checkout ); ?>" class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-all duration-[var(--duration-fast)] bg-sun text-ink hov:bg-sun-2 hov:shadow-[0_10px_24px_-10px_rgb(247_195_46/0.9)] prs:scale-[0.98] h-14 px-8 text-[16px] w-full">
				<span><?php esc_html_e( 'ادامه جهت تسویه‌حساب و پرداخت', 'hashvich' ); ?></span>
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left rotate-180" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
			</a>

			<a href="<?php echo esc_url( $menu_url ); ?>" class="inline-flex min-h-10 items-center justify-center text-[14px] text-muted hover:text-ink transition-colors">
				<?php esc_html_e( 'افزودن غذای بیشتر از منو', 'hashvich' ); ?>
			</a>
		</div>
	</div>
</aside>
