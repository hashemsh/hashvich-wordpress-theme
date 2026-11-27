<?php
/**
 * سایدبار خلاصه سفارش و دکمه پرداخت
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

if ( ! WC()->cart || WC()->cart->is_empty() ) {
	return;
}

$cart_subtotal   = WC()->cart->get_subtotal();
$cart_total      = WC()->cart->total;
$threshold       = 320000; // سقف ارسال رایگان به تومان
$subtotal_val    = WC()->cart->subtotal;
$percent         = min( 100, max( 0, ( $subtotal_val / $threshold ) * 100 ) );
$remaining       = max( 0, $threshold - $subtotal_val );
$applied_coupons = WC()->cart->get_applied_coupons();
?>

<aside class="lg:sticky lg:top-[108px] lg:self-start" aria-label="<?php esc_attr_e( 'خلاصه سفارش', 'hashvich' ); ?>" id="hv-order-review-aside">
	<div class="rounded-[var(--radius-lg)] bg-card p-6 md:p-7 shadow-sm border border-line/60">
		<h2 class="text-[20px] font-semibold text-ink"><?php esc_html_e( 'سفارش شما', 'hashvich' ); ?></h2>

		<!-- لیست اقلام سبد خرید -->
		<ul class="mt-2 divide-y divide-line-strong/60 max-h-[380px] overflow-y-auto pr-1">
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					$thumbnail         = $_product->get_image( 'thumbnail', array( 'class' => 'select-none object-contain size-16', 'alt' => esc_attr( $_product->get_name() ) ) );
					$size              = isset( $cart_item['hv_size'] ) ? $cart_item['hv_size'] : '';
					$extras            = isset( $cart_item['hv_extras'] ) && is_array( $cart_item['hv_extras'] ) ? $cart_item['hv_extras'] : array();
					$note              = isset( $cart_item['hv_note'] ) ? $cart_item['hv_note'] : '';
					?>
					<li class="flex gap-4 py-4" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
						<div class="flex size-20 shrink-0 items-center justify-center rounded-[var(--radius-sm)] bg-card-muted/50 p-1 border border-line/40">
							<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<div class="min-w-0 flex-1">
							<div class="flex items-start justify-between gap-3">
								<div class="min-w-0">
									<?php if ( $product_permalink ) : ?>
										<a class="text-[15px] leading-snug font-semibold text-ink hover:text-leaf transition-colors" href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo esc_html( $_product->get_name() ); ?>
										</a>
									<?php else : ?>
										<span class="text-[15px] leading-snug font-semibold text-ink">
											<?php echo esc_html( $_product->get_name() ); ?>
										</span>
									<?php endif; ?>

									<?php
									$meta_parts = array();
									if ( ! empty( $size ) ) {
										$size_labels = array(
											'standard' => 'سایز معمولی',
											'double'   => 'سایز دوبل',
											'combo'    => 'کمبو با سیب‌زمینی و نوشیدنی',
											'family'   => 'خانواده',
										);
										$meta_parts[] = isset( $size_labels[ $size ] ) ? $size_labels[ $size ] : $size;
									}
									if ( ! empty( $extras ) ) {
										$extra_labels = array(
											'cheese'     => 'پنیر اضافه',
											'bacon'      => 'بیکن برشته',
											'onion_rings'=> 'پیاز سوخاری',
											'mushroom'   => 'قارچ کبابی',
											'jalapeno'   => 'هالوپینو تند',
										);
										foreach ( $extras as $e ) {
											$meta_parts[] = isset( $extra_labels[ $e ] ) ? $extra_labels[ $e ] : $e;
										}
									}
									if ( ! empty( $meta_parts ) ) :
										?>
										<p class="text-[13px] text-muted line-clamp-1 mt-0.5">
											<?php echo esc_html( implode( '، ', $meta_parts ) ); ?>
										</p>
									<?php endif; ?>
								</div>
								<span class="text-[15px] font-semibold tabular-nums text-ink shrink-0">
									<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							</div>
							<p class="text-[13px] text-muted mt-1">
								<?php
								/* translators: %s: item quantity */
								printf( esc_html__( 'تعداد %s', 'hashvich' ), esc_html( hashvich_to_persian_num( $cart_item['quantity'] ) ) );
								?>
							</p>
						</div>
					</li>
					<?php
				endif;
			endforeach;
			?>
		</ul>

		<!-- پیشرفت ارسال رایگان -->
		<div class="mt-4">
			<div class="rounded-[var(--radius-sm)] bg-lime-soft p-4 border border-leaf/15">
				<?php if ( $remaining <= 0 ) : ?>
					<p class="flex items-center gap-2 text-[14px] font-medium text-forest">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck size-4 text-leaf" aria-hidden="true"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"></path><path d="M15 18H9"></path><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"></path><circle cx="17" cy="18" r="2"></circle><circle cx="7" cy="18" r="2"></circle></svg>
						<?php esc_html_e( 'ارسال رایگان برای سفارش شما فعال شد!', 'hashvich' ); ?>
					</p>
				<?php else : ?>
					<p class="flex items-center gap-2 text-[13px] font-medium text-forest">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck size-4 text-leaf" aria-hidden="true"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"></path><path d="M15 18H9"></path><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"></path><circle cx="17" cy="18" r="2"></circle><circle cx="7" cy="18" r="2"></circle></svg>
						<span>
							<?php
							/* translators: %s: amount remaining */
							printf( esc_html__( '%s تومان تا ارسال رایگان پیک', 'hashvich' ), hashvich_to_persian_num( number_format( $remaining ) ) );
							?>
						</span>
					</p>
				<?php endif; ?>
				<div class="mt-3 h-2 overflow-hidden rounded-full bg-white" role="progressbar" aria-valuenow="<?php echo esc_attr( round( $percent ) ); ?>" aria-valuemin="0" aria-valuemax="100">
					<div class="h-full rounded-full bg-leaf transition-all duration-500 ease-out" style="width: <?php echo esc_attr( round( $percent ) ); ?>%;"></div>
				</div>
			</div>
		</div>

		<!-- کد تخفیف -->
		<div class="mt-5 border-t border-line-strong/60 pt-5">
			<div class="flex flex-col gap-1.5">
				<label for="hv_checkout_coupon_code" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'کد تخفیف', 'hashvich' ); ?></label>
				<div class="flex gap-2">
					<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none h-12 uppercase"
						   id="hv_checkout_coupon_code"
						   name="hv_checkout_coupon_code"
						   placeholder="FIRSTBITE">
					<button type="button"
							id="hv_apply_checkout_coupon_btn"
							class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-colors border-[1.5px] border-leaf text-leaf hover:bg-leaf hover:text-white h-12 px-6 text-[15px] shrink-0">
						<span><?php esc_html_e( 'اعمال', 'hashvich' ); ?></span>
					</button>
				</div>
				<div id="hv-coupon-feedback" class="text-[13px] hidden mt-1"></div>

				<?php if ( ! empty( $applied_coupons ) ) : ?>
					<div class="mt-2 flex flex-wrap gap-2">
						<?php foreach ( $applied_coupons as $coupon_code ) : ?>
							<span class="inline-flex items-center gap-1.5 rounded-full bg-leaf/10 text-leaf px-3 py-1 text-[13px] font-medium">
								<?php echo esc_html( strtoupper( $coupon_code ) ); ?>
								<button type="button" class="hv-remove-coupon hover:text-tomato transition-colors" data-coupon="<?php echo esc_attr( $coupon_code ); ?>" title="<?php esc_attr_e( 'حذف کوپن', 'hashvich' ); ?>">
									&times;
								</button>
							</span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<!-- جزییات مبالغ -->
		<dl class="mt-5 flex flex-col gap-2.5 border-t border-line-strong/60 pt-5 text-[15px]">
			<!-- جمع جزء -->
			<div class="flex items-baseline justify-between gap-4">
				<dt class="text-muted"><?php esc_html_e( 'جمع جزء', 'hashvich' ); ?></dt>
				<dd class="tabular-nums font-medium text-ink" id="hv-summary-subtotal">
					<?php wc_cart_totals_subtotal_html(); ?>
				</dd>
			</div>

			<!-- هزینه ارسال -->
			<div class="flex items-baseline justify-between gap-4">
				<dt class="text-muted"><?php esc_html_e( 'ارسال', 'hashvich' ); ?></dt>
				<dd class="tabular-nums font-medium text-leaf" id="hv-summary-shipping">
					<?php
					$cart_subtotal_raw = (float) WC()->cart->get_subtotal();
					$delivery_type     = ( WC()->session && 'pickup' === WC()->session->get( 'hv_delivery_type' ) ) ? 'pickup' : 'delivery';

					if ( 'pickup' === $delivery_type ) {
						esc_html_e( 'تحویل حضوری (رایگان)', 'hashvich' );
					} elseif ( $cart_subtotal_raw >= 320000 ) {
						esc_html_e( 'رایگان', 'hashvich' );
					} else {
						$shipping_cost = (float) WC()->cart->get_shipping_total();
						if ( $shipping_cost > 0 ) {
							echo hashvich_format_price( $shipping_cost );
						} else {
							echo hashvich_format_price( 35000 );
						}
					}
					?>
				</dd>
			</div>

			<!-- تخفیف کوپن -->
			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<div class="flex items-baseline justify-between gap-4 text-tomato">
					<dt class="flex items-center gap-1">
						<span><?php esc_html_e( 'تخفیف', 'hashvich' ); ?></span>
						<span class="text-[13px] uppercase">(<?php echo esc_html( $code ); ?>)</span>
					</dt>
					<dd class="tabular-nums font-medium">
						-<?php wc_cart_totals_coupon_html( $coupon ); ?>
					</dd>
				</div>
			<?php endforeach; ?>

			<!-- هزینه و کارمزد / انعام اختیاری -->
			<div class="flex items-baseline justify-between gap-4" id="hv-summary-tip-row" style="<?php echo ( isset( WC()->session ) && WC()->session->get( 'hv_courier_tip' ) > 0 ) ? '' : 'display:none;'; ?>">
				<dt class="text-muted"><?php esc_html_e( 'انعام پیک', 'hashvich' ); ?></dt>
				<dd class="tabular-nums font-medium text-ink" id="hv-summary-tip-val">
					<?php
					$saved_tip = ( isset( WC()->session ) && WC()->session->get( 'hv_courier_tip' ) ) ? WC()->session->get( 'hv_courier_tip' ) : 0;
					echo esc_html( number_format( $saved_tip ) . ' ' . get_woocommerce_currency_symbol() );
					?>
				</dd>
			</div>

			<!-- مبلغ کل نهایی -->
			<div class="flex items-baseline justify-between gap-4 text-[18px] font-semibold mt-2 border-t border-line-strong/60 pt-3 text-ink">
				<dt><?php esc_html_e( 'مبلغ کل', 'hashvich' ); ?></dt>
				<dd class="tabular-nums text-forest font-bold" id="hv-summary-total">
					<?php wc_cart_totals_order_total_html(); ?>
				</dd>
			</div>
		</dl>

		<!-- دکمه ثبت نهایی سفارش -->
		<div class="mt-6 flex flex-col gap-3">
			<?php
			$order_button_text = sprintf(
				/* translators: %s: total formatted */
				__( 'ثبت سفارش به مبلغ %s', 'hashvich' ),
				wp_strip_all_tags( WC()->cart->get_total() )
			);
			?>
			<button type="submit"
					class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-bold transition-all bg-sun text-ink hover:bg-sun-2 hover:shadow-[0_10px_24px_-10px_rgb(247_195_46/0.9)] active:translate-y-px h-14 px-8 text-[17px] w-full cursor-pointer disabled:opacity-50"
					name="woocommerce_checkout_place_order"
					id="place_order"
					value="<?php echo esc_attr( $order_button_text ); ?>"
					data-value="<?php echo esc_attr( $order_button_text ); ?>">
				<span id="place_order_text"><?php echo esc_html( $order_button_text ); ?></span>
			</button>

			<p class="text-center text-[13px] text-muted flex items-center justify-center gap-1.5">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check text-leaf"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>
				<?php esc_html_e( 'ضمانت بازگشت وجه در صورت عدم رضایت یا تاخیر', 'hashvich' ); ?>
			</p>
		</div>
	</div>
</aside>
