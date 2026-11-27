<?php
/**
 * بخش کارت‌های کدهای تخفیف با امکان کپی آسان
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$coupons = array(
	array(
		'code'        => 'FIRSTBITE',
		'title'       => __( '۲۰٪ تخفیف اولین سفارش', 'hashvich' ),
		'description' => __( 'برای سفارش‌های بالای ۲۵۰ هزار تومان در اولین خرید.', 'hashvich' ),
		'icon_bg'     => 'bg-sun',
		'icon_color'  => 'text-ink',
	),
	array(
		'code'        => 'FREESHIP',
		'title'       => __( 'ارسال رایگان سفارش', 'hashvich' ),
		'description' => __( 'برای سفارش‌های بالای ۳۲۰ هزار تومان بدون محدودیت مقصد.', 'hashvich' ),
		'icon_bg'     => 'bg-leaf',
		'icon_color'  => 'text-white',
	),
	array(
		'code'        => 'FEAST10',
		'title'       => __( '۱۰۰ هزار تومان تخفیف مهمانی', 'hashvich' ),
		'description' => __( 'برای سفارش‌های بالای ۹۰۰ هزار تومان مخصوص جمع‌های دوستانه.', 'hashvich' ),
		'icon_bg'     => 'bg-forest',
		'icon_color'  => 'text-white',
	),
);
?>

<section class="container-page pt-14" aria-labelledby="codes">
	<div class="flex flex-col gap-3">
		<h2 class="text-[clamp(1.9rem,1.2rem+1.8vw,2.6rem)] leading-[1.1] font-semibold text-ink">
			<span id="codes"><?php esc_html_e( 'کدهای تخفیف', 'hashvich' ); ?></span>
		</h2>
		<p class="max-w-[560px] text-[16px] leading-relaxed text-muted">
			<?php esc_html_e( 'هر سفارش یک کد. کدها هنگام پرداخت در سبد یا تسویه‌حساب به‌صورت خودکار محاسبه و کسر می‌شوند.', 'hashvich' ); ?>
		</p>
	</div>

	<div class="mt-8 grid gap-5 md:grid-cols-3">
		<?php foreach ( $coupons as $c ) : ?>
			<article class="relative flex overflow-hidden rounded-[var(--radius-md)] border-[1.5px] border-dashed border-line-strong bg-white shadow-sm hover:border-leaf transition-colors">
				<div class="flex w-20 sm:w-24 shrink-0 items-center justify-center <?php echo esc_attr( $c['icon_bg'] ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket-percent <?php echo esc_attr( $c['icon_color'] ); ?>" aria-hidden="true">
						<path d="M2 9a3 3 0 1 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 1 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
						<path d="M9 9h.01"></path>
						<path d="m15 9-6 6"></path>
						<path d="M15 15h.01"></path>
					</svg>
				</div>
				<div class="flex min-w-0 flex-1 flex-col gap-3 p-5">
					<div>
						<h3 class="text-[17px] font-semibold text-ink"><?php echo esc_html( $c['title'] ); ?></h3>
						<p class="text-[13px] text-muted mt-1"><?php echo esc_html( $c['description'] ); ?></p>
					</div>
					<div class="flex flex-wrap items-center justify-between gap-3 mt-auto pt-2 border-t border-line/40">
						<code class="rounded-[8px] bg-card px-3 py-1.5 text-[14px] font-bold tracking-wider text-ink font-mono uppercase">
							<?php echo esc_html( $c['code'] ); ?>
						</code>
						<button type="button"
								class="hv-copy-coupon round inline-flex items-center gap-1.5 rounded-full border border-line-strong px-3 py-1 text-[13px] font-medium text-ink hover:bg-card hover:border-leaf transition-colors"
								data-code="<?php echo esc_attr( $c['code'] ); ?>"
								aria-label="<?php echo esc_attr( sprintf( __( 'کپی کد %s', 'hashvich' ), $c['code'] ) ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path></svg>
							<span><?php esc_html_e( 'کپی کد', 'hashvich' ); ?></span>
						</button>
					</div>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
