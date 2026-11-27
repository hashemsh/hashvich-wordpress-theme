<?php
/**
 * سایدبار جزئیات آدرس و رسید پرداخت سفارش
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$order_id_param = isset( $_GET['order_id'] ) ? sanitize_text_field( wp_unslash( $_GET['order_id'] ) ) : '58214';
$order_obj      = false;
if ( function_exists( 'wc_get_order' ) && is_numeric( $order_id_param ) ) {
	$order_obj = wc_get_order( (int) $order_id_param );
}

$address = $order_obj ? $order_obj->get_formatted_billing_address() : 'تهران، خیابان ولیعصر، بالاتر از میدان ونک، نبش کوچه بهار، پلاک ۲۱۸';
$menu_url = home_url( '/menu/' );
?>

<aside class="flex flex-col gap-6" aria-label="<?php esc_attr_e( 'جزئیات سفارش و رسید', 'hashvich' ); ?>">
	<!-- کارت نشانی ارسال -->
	<section class="rounded-[var(--radius-lg)] bg-card p-6 shadow-sm border border-line/50">
		<h2 class="text-[18px] font-semibold text-ink"><?php esc_html_e( 'تحویل و ارسال به', 'hashvich' ); ?></h2>
		<p class="mt-2.5 flex items-start gap-2.5 text-[15px] text-ink leading-relaxed">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bike mt-0.5 size-4 shrink-0 text-leaf" aria-hidden="true"><circle cx="18.5" cy="17.5" r="3.5"></circle><circle cx="5.5" cy="17.5" r="3.5"></circle><circle cx="15" cy="5" r="1"></circle><path d="M12 17.5V14l-3-3 4-3 2 3h2"></path></svg>
			<span><?php echo wp_strip_all_tags( $address ); ?></span>
		</p>
		<p class="mt-3 flex items-center gap-2 text-[14px] text-muted border-t border-line/40 pt-3">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone size-4 text-leaf"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
			<span><?php esc_html_e( 'پشتیبانی فوری آشپزخانه:', 'hashvich' ); ?></span>
			<a href="tel:+982188774521" class="font-medium text-ink hover:text-leaf transition-colors tabular-nums" dir="ltr">۰۲۱ ۸۸۷۷ ۴۵۲۱</a>
		</p>
	</section>

	<!-- کارت رسید مالی -->
	<section class="rounded-[var(--radius-lg)] bg-card p-6 shadow-sm border border-line/50">
		<h2 class="text-[18px] font-semibold text-ink"><?php esc_html_e( 'رسید پرداخت', 'hashvich' ); ?></h2>

		<?php if ( $order_obj ) : ?>
			<ul class="mt-3 flex flex-col gap-3">
				<?php foreach ( $order_obj->get_items() as $item ) : ?>
					<li class="flex justify-between gap-3 text-[14px]">
						<span class="text-ink font-medium"><?php echo esc_html( $item->get_quantity() . ' × ' . $item->get_name() ); ?></span>
						<span class="tabular-nums font-semibold"><?php echo wp_kses_post( wc_price( $item->get_total(), array( 'currency' => $order_obj->get_currency() ) ) ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>

			<dl class="mt-4 flex flex-col gap-2 border-t border-line-strong/60 pt-4 text-[14px]">
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php esc_html_e( 'جمع جزء', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium"><?php echo wp_kses_post( $order_obj->get_subtotal_to_display() ); ?></dd>
				</div>
				<?php if ( $order_obj->get_total_discount() > 0 ) : ?>
					<div class="flex items-baseline justify-between gap-4 text-tomato">
						<dt><?php esc_html_e( 'تخفیف', 'hashvich' ); ?></dt>
						<dd class="tabular-nums font-medium">-<?php echo wp_kses_post( wc_price( $order_obj->get_total_discount() ) ); ?></dd>
					</div>
				<?php endif; ?>
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php esc_html_e( 'ارسال', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium text-leaf"><?php echo wp_kses_post( $order_obj->get_shipping_to_display() ); ?></dd>
				</div>
				<div class="flex items-baseline justify-between gap-4 text-[17px] font-bold mt-2 border-t border-line/60 pt-3 text-ink">
					<dt><?php esc_html_e( 'مبلغ کل پرداخت‌شده', 'hashvich' ); ?></dt>
					<dd class="tabular-nums text-forest"><?php echo wp_kses_post( $order_obj->get_formatted_order_total() ); ?></dd>
				</div>
			</dl>
		<?php else : ?>
			<!-- رسید پیش‌فرض نمونه -->
			<ul class="mt-3 flex flex-col gap-3">
				<li class="flex justify-between gap-3 text-[14px]">
					<span class="text-ink font-medium">۱ × برگر ویژه هاشویچ</span>
					<span class="tabular-nums font-semibold">۲۶۵٬۰۰۰ تومان</span>
				</li>
				<li class="flex justify-between gap-3 text-[14px]">
					<span class="text-ink font-medium">۲ × سیب‌زمینی با سس پنیر</span>
					<span class="tabular-nums font-semibold">۲۵۲٬۰۰۰ تومان</span>
				</li>
				<li class="flex justify-between gap-3 text-[14px]">
					<span class="text-ink font-medium">۱ × شیک توت‌فرنگی</span>
					<span class="tabular-nums font-semibold">۹۲٬۰۰۰ تومان</span>
				</li>
			</ul>

			<dl class="mt-4 flex flex-col gap-2 border-t border-line-strong/60 pt-4 text-[14px]">
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php esc_html_e( 'جمع جزء', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium">۶۰۹٬۰۰۰ تومان</dd>
				</div>
				<div class="flex items-baseline justify-between gap-4 text-forest">
					<dt><?php esc_html_e( 'تخفیف (FIRSTBITE)', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium">−۱۲۱٬۸۰۰ تومان</dd>
				</div>
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php esc_html_e( 'ارسال', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium text-leaf"><?php esc_html_e( 'رایگان', 'hashvich' ); ?></dd>
				</div>
				<div class="flex items-baseline justify-between gap-4">
					<dt class="text-muted"><?php esc_html_e( 'انعام پیک', 'hashvich' ); ?></dt>
					<dd class="tabular-nums font-medium">۲۰٬۰۰۰ تومان</dd>
				</div>
				<div class="flex items-baseline justify-between gap-4 text-[17px] font-bold mt-2 border-t border-line/60 pt-3 text-ink">
					<dt><?php esc_html_e( 'مبلغ کل پرداخت‌شده', 'hashvich' ); ?></dt>
					<dd class="tabular-nums text-forest">۵۰۷٬۲۰۰ تومان</dd>
				</div>
			</dl>
		<?php endif; ?>

		<div class="mt-5">
			<a class="round inline-flex items-center justify-center gap-2 rounded-full border-[1.5px] border-leaf text-leaf hover:bg-leaf hover:text-white px-6 h-12 text-[15px] font-medium transition-all w-full"
			   href="<?php echo esc_url( $menu_url ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rotate-ccw"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path></svg>
				<span><?php esc_html_e( 'ثبت سفارش جدید از منو', 'hashvich' ); ?></span>
			</a>
		</div>
	</section>
</aside>
