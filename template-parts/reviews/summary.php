<?php
/**
 * سایدبار تفکیک امتیازها
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$ratings = array(
	5 => array( 'percent' => 74, 'count' => 184 ),
	4 => array( 'percent' => 18, 'count' => 45 ),
	3 => array( 'percent' => 5,  'count' => 12 ),
	2 => array( 'percent' => 2,  'count' => 5 ),
	1 => array( 'percent' => 1,  'count' => 2 ),
);
?>

<section aria-labelledby="breakdown" class="rounded-[var(--radius-lg)] bg-card p-6 shadow-sm border border-line/50">
	<h2 id="breakdown" class="mb-4 text-[18px] font-semibold text-ink"><?php esc_html_e( 'تفکیک امتیازها', 'hashvich' ); ?></h2>
	<ul class="flex flex-col gap-2.5">
		<?php foreach ( $ratings as $star => $data ) : ?>
			<li class="flex items-center gap-3 text-[14px]">
				<span class="flex w-8 items-center gap-1 tabular-nums font-medium text-ink">
					<?php echo esc_html( hashvich_to_persian_num( $star ) ); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" class="lucide lucide-star size-3.5 text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
				</span>
				<span class="h-2 flex-1 overflow-hidden rounded-full bg-white border border-line/40" aria-hidden="true">
					<span class="block h-full rounded-full bg-sun transition-all duration-500" style="width: <?php echo esc_attr( $data['percent'] ); ?>%;"></span>
				</span>
				<span class="w-8 text-left text-muted tabular-nums"><?php echo esc_html( hashvich_to_persian_num( $data['count'] ) ); ?></span>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
