<?php
/**
 * هدر و بنر تیره صفحه نظرات
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="on-dark doodles relative overflow-hidden bg-forest text-white">
	<div class="container-page pt-8 pb-14 md:pt-12 md:pb-20">
		<h1 class="max-w-[760px] text-[clamp(2.4rem,1.4rem+3vw,4rem)] leading-[1.04] font-bold">
			<?php esc_html_e( 'نظرات مشتریان', 'hashvich' ); ?>
		</h1>
		<p class="mt-4 max-w-[560px] text-[17px] leading-relaxed text-on-forest-muted">
			<?php esc_html_e( 'هر نظر اینجا از یک سفارش واقعی آمده است. ببینید همراهان هاشویچ درباره کیفیت طعم، سرعت تحویل و تجربه سفارش چه می‌گویند.', 'hashvich' ); ?>
		</p>
		<div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3">
			<span class="text-[32px] font-bold text-sun tabular-nums">۴.۸</span>
			<div class="flex items-center gap-1 text-sun">
				<?php for ( $i = 0; $i < 5; $i++ ) : ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" class="lucide lucide-star size-5"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
				<?php endfor; ?>
			</div>
			<span class="text-[15px] text-on-forest-muted">
				<?php
				/* translators: %s: reviews count */
				printf( esc_html__( 'بر اساس %s نظر ثبت‌شده', 'hashvich' ), '<strong>۲۴۸</strong>' );
				?>
			</span>
		</div>
	</div>
</section>
