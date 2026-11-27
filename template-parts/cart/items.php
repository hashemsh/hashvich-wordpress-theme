<?php
/**
 * فهرست اقلام سبد خرید، کد تخفیف و نوار پیشرفت ارسال رایگان
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$img_dir_uri = get_template_directory_uri() . '/assets/images/';
$cart        = WC()->cart;
$subtotal    = (float) $cart->get_subtotal();

// حدنصاب ارسال رایگان (۵۰۰٬۰۰۰ تومان)
$free_shipping_threshold = 500000;
$pct_free_shipping       = min( 100, round( ( $subtotal / $free_shipping_threshold ) * 100 ) );
$diff_free_shipping      = max( 0, $free_shipping_threshold - $subtotal );
?>

<div class="flex flex-col gap-6" id="hv-cart-items-container">
	<!-- نوار پیشرفت ارسال رایگان -->
	<div class="rounded-[var(--radius-sm)] bg-lime-soft p-4">
		<p class="flex items-center gap-2 text-[14px] font-medium text-forest">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck size-4" aria-hidden="true"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"></path><path d="M15 18H9"></path><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"></path><circle cx="17" cy="18" r="2"></circle><circle cx="7" cy="18" r="2"></circle></svg>
			<?php if ( $diff_free_shipping <= 0 ) : ?>
				<?php esc_html_e( 'ارسال رایگان برای شما فعال شد!', 'hashvich' ); ?>
			<?php else : ?>
				<?php echo sprintf( esc_html__( 'فقط %s تا ارسال رایگان سفارش!', 'hashvich' ), '<strong>' . hashvich_format_price( $diff_free_shipping ) . '</strong>' ); ?>
			<?php endif; ?>
		</p>
		<div class="mt-3 h-2 overflow-hidden rounded-full bg-white" role="progressbar" aria-label="<?php esc_attr_e( 'پیشرفت تا ارسال رایگان', 'hashvich' ); ?>" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr( $pct_free_shipping ); ?>">
			<div class="h-full rounded-full bg-leaf transition-[width] duration-[var(--duration-slow)] ease-[var(--ease-out)]" style="width: <?php echo esc_attr( $pct_free_shipping ); ?>%;"></div>
		</div>
	</div>

	<!-- لیست اقلام سبد خرید -->
	<div class="rounded-[var(--radius-lg)] border bg-white p-5 md:p-7">
		<div class="flex items-center justify-between border-b pb-4">
			<h2 class="text-[18px] font-bold">
				<?php esc_html_e( 'اقلام سفارش', 'hashvich' ); ?>
				<span class="text-[14px] font-normal text-muted tabular-nums">(<?php echo esc_html( hashvich_to_persian_num( $cart->get_cart_contents_count() ) ); ?> مورد)</span>
			</h2>
		</div>

		<ul class="divide-y divide-line-strong/60" id="hv-cart-items-list">
			<?php
			foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) :
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 ) {
					continue;
				}

				$title     = $_product->get_name();
				$permalink = $_product->get_permalink( $cart_item );
				$quantity  = $cart_item['quantity'];

				// تصویر شاخص یا پیش‌فرض
				$thumb_id  = $_product->get_image_id();
				$image_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'thumbnail' ) : '';
				if ( ! $image_url && function_exists( 'hashvich_get_dish_image_fallback' ) ) {
					$image_url = hashvich_get_dish_image_fallback( $_product->get_slug() );
				}
				if ( ! $image_url ) {
					$image_url = $img_dir_uri . 'photos/burger.webp';
				}

				// قیمت واحد و قیمت کل آیتم
				$line_price = $cart->get_product_subtotal( $_product, $quantity );

				// اندازه‌ها و افزودنی‌ها
				$hv_size   = $cart_item['hv_size'] ?? '';
				$hv_extras = $cart_item['hv_extras'] ?? array();
				$hv_note   = $cart_item['hv_note'] ?? '';
			?>
				<li class="hv-cart-item flex flex-col gap-4 py-5 sm:flex-row sm:items-center sm:justify-between" data-key="<?php echo esc_attr( $cart_item_key ); ?>">
					<div class="flex items-center gap-4 min-w-0">
						<div class="flex size-20 shrink-0 items-center justify-center rounded-[var(--radius-sm)] bg-card overflow-hidden">
							<img alt="<?php echo esc_attr( $title ); ?>" class="select-none object-contain size-16" loading="lazy" decoding="async" src="<?php echo esc_url( $image_url ); ?>">
						</div>
						<div class="min-w-0 flex-1">
							<h3 class="text-[16px] font-semibold leading-snug">
								<a class="hover:text-leaf transition-colors" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
							</h3>
							<?php if ( ! empty( $hv_size ) || ! empty( $hv_extras ) ) : ?>
								<p class="mt-1 text-[13px] text-muted">
									<?php
									$parts = array();
									if ( ! empty( $hv_size ) ) {
										$parts[] = esc_html( $hv_size );
									}
									if ( ! empty( $hv_extras ) && is_array( $hv_extras ) ) {
										$parts[] = esc_html( implode( '، ', $hv_extras ) );
									}
									echo implode( ' | ', $parts );
									?>
								</p>
							<?php endif; ?>
							<?php if ( ! empty( $hv_note ) ) : ?>
								<p class="mt-1 text-[12px] text-amber-700 bg-amber-50 rounded px-2 py-0.5 inline-block">
									<?php echo esc_html__( 'یادداشت:', 'hashvich' ) . ' ' . esc_html( $hv_note ); ?>
								</p>
							<?php endif; ?>
						</div>
					</div>

					<div class="flex items-center justify-between sm:gap-6">
						<!-- کنترل تعداد -->
						<div role="group" aria-label="<?php esc_attr_e( 'تعداد', 'hashvich' ); ?>" class="round inline-flex items-center rounded-full border border-line-strong bg-white">
							<button type="button"
									class="hv-cart-qty-btn hv-cart-minus round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 size-9 [&_svg]:size-3.5"
									data-key="<?php echo esc_attr( $cart_item_key ); ?>"
									data-qty="<?php echo esc_attr( $quantity ); ?>"
									aria-label="<?php esc_attr_e( 'کاهش تعداد', 'hashvich' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus"><path d="M5 12h14"></path></svg>
							</button>
							<span class="text-center font-medium tabular-nums w-8 text-[14px]"><?php echo esc_html( hashvich_to_persian_num( $quantity ) ); ?></span>
							<button type="button"
									class="hv-cart-qty-btn hv-cart-plus round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 size-9 [&_svg]:size-3.5"
									data-key="<?php echo esc_attr( $cart_item_key ); ?>"
									data-qty="<?php echo esc_attr( $quantity ); ?>"
									aria-label="<?php esc_attr_e( 'افزایش تعداد', 'hashvich' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
							</button>
						</div>

						<!-- قیمت کل آیتم -->
						<span class="font-semibold tabular-nums text-[16px] min-w-[110px] text-left">
							<?php echo $line_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>

						<!-- حذف آیتم -->
						<button type="button"
								class="hv-cart-remove round inline-flex size-9 items-center justify-center rounded-full text-muted transition-colors hover:bg-tomato/10 hover:text-tomato"
								data-key="<?php echo esc_attr( $cart_item_key ); ?>"
								aria-label="<?php esc_attr_e( 'حذف از سبد', 'hashvich' ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
						</button>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<!-- کادر اعمال کد تخفیف -->
	<div class="rounded-[var(--radius-lg)] border bg-white p-5 md:p-6">
		<div class="flex flex-col gap-2">
			<label for="hv-cart-coupon" class="text-[14px] font-medium"><?php esc_html_e( 'کد تخفیف دارید؟', 'hashvich' ); ?></label>
			<form id="hv-coupon-form" class="flex gap-2" onsubmit="return false;">
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink placeholder:text-muted focus:border-leaf focus:outline-none h-12 uppercase"
					   id="hv-cart-coupon"
					   placeholder="<?php esc_attr_e( 'مثال: FIRSTBITE', 'hashvich' ); ?>"
					   autocomplete="off">
				<button type="button"
						id="hv-apply-coupon-btn"
						class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-all duration-[var(--duration-fast)] border-[1.5px] border-leaf text-leaf hov:bg-leaf hov:text-white h-12 px-6 text-[15px] shrink-0">
					<span><?php esc_html_e( 'اعمال کد', 'hashvich' ); ?></span>
				</button>
			</form>

			<?php
			$applied_coupons = $cart->get_applied_coupons();
			if ( ! empty( $applied_coupons ) ) :
			?>
				<div class="mt-2 flex flex-wrap gap-2">
					<?php foreach ( $applied_coupons as $coupon_code ) : ?>
						<span class="inline-flex items-center gap-2 rounded-full bg-lime-soft px-3 py-1 text-[13px] font-medium text-forest">
							<span><?php echo esc_html( strtoupper( $coupon_code ) ); ?></span>
							<button type="button" class="hv-remove-coupon text-forest hover:text-tomato" data-code="<?php echo esc_attr( $coupon_code ); ?>" aria-label="<?php esc_attr_e( 'حذف تخفیف', 'hashvich' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
							</button>
						</span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
