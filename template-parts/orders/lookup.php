<?php
/**
 * کادر استعلام و پیگیری سریع سفارش
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
$tracking_url = home_url( '/tracking/' );
?>

<section class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8 shadow-sm">
	<div class="flex flex-col gap-2">
		<h2 class="text-[20px] font-semibold text-ink"><?php esc_html_e( 'پیگیری سریع وضعیت سفارش', 'hashvich' ); ?></h2>
		<p class="text-[14px] text-muted"><?php esc_html_e( 'شماره سفارش مندرج در پیامک (مثال: ۵۸۲۱۴) را وارد کنید تا وضعیت آماده‌سازی و موقعیت پیک را مشاهده کنید.', 'hashvich' ); ?></p>
	</div>

	<form action="<?php echo esc_url( $tracking_url ); ?>" method="get" class="mt-5 flex flex-col sm:flex-row gap-3">
		<div class="relative flex-1">
			<input type="text"
				   name="order_id"
				   class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none h-12 uppercase"
				   placeholder="<?php esc_attr_e( 'شماره سفارش (مثال: HS-58214 یا ۵۸۲۱۴)', 'hashvich' ); ?>"
				   required>
		</div>
		<button type="submit"
				class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-bold transition-all bg-leaf text-white hover:bg-leaf-2 active:scale-[0.98] h-12 px-7 text-[15px] shrink-0 cursor-pointer">
			<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
			<span><?php esc_html_e( 'پیگیری زنده سفارش', 'hashvich' ); ?></span>
		</button>
	</form>
</section>
