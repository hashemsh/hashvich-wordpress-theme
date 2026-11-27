<?php
/**
 * منوی ناوبری حساب کاربری ووکامرس
 *
 * @package Hashvich
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation flex flex-col gap-1.5 rounded-[var(--radius-xl)] bg-card border border-line/50 p-4 shadow-sm" aria-label="<?php esc_attr_e( 'منوی حساب کاربری', 'hashvich' ); ?>">
	<div class="px-3 py-2 text-[13px] font-bold text-forest uppercase tracking-wider border-b border-line/40 mb-1">
		<?php esc_html_e( 'بخش‌های حساب', 'hashvich' ); ?>
	</div>
	<ul class="flex flex-col gap-1">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : 
			$is_active = wc_is_current_account_menu_item( $endpoint );
		?>
			<li class="<?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
				   class="flex items-center justify-between rounded-lg px-4 py-3 text-[14px] font-medium transition-colors <?php echo $is_active ? 'bg-forest text-white font-bold shadow-sm' : 'text-ink hover:bg-white hover:text-forest'; ?>"
				   <?php echo $is_active ? 'aria-current="page"' : ''; ?>>
					<span><?php echo esc_html( $label ); ?></span>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="rotate-180 opacity-60"><path d="m9 18 6-6-6-6"></path></svg>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
