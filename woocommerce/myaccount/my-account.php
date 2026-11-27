<?php
/**
 * برگه پیشخوان حساب کاربری ووکامرس هاشویچ
 *
 * @package Hashvich
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
$home_url     = home_url( '/' );
?>

<!-- هیرو بخش حساب کاربری -->
<section class="on-dark bg-forest text-white py-8 md:py-10 border-b border-white/10" aria-label="<?php esc_attr_e( 'حساب کاربری', 'hashvich' ); ?>">
	<div class="container-page flex flex-col md:flex-row md:items-center md:justify-between gap-4">
		<div>
			<nav class="flex items-center gap-2 text-[13px] text-white/70 mb-2" aria-label="<?php esc_attr_e( 'مسیر راهنما', 'hashvich' ); ?>">
				<a href="<?php echo esc_url( $home_url ); ?>" class="hover:text-sun transition-colors"><?php esc_html_e( 'خانه', 'hashvich' ); ?></a>
				<span class="text-white/40">/</span>
				<span class="text-sun font-medium"><?php esc_html_e( 'حساب کاربری', 'hashvich' ); ?></span>
			</nav>
			<h1 class="text-[24px] md:text-[28px] font-bold tracking-tight text-white">
				<?php
				/* translators: %s: User display name */
				printf( esc_html__( 'سلام، %s خوش آمدید!', 'hashvich' ), esc_html( $current_user->display_name ) );
				?>
			</h1>
		</div>
		<div class="flex items-center gap-3">
			<a href="<?php echo esc_url( wc_logout_url() ); ?>" class="round inline-flex items-center gap-2 rounded-full bg-white/10 hover:bg-white/20 px-4 py-2 text-[13px] text-white transition-colors">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
				<span><?php esc_html_e( 'خروج از حساب', 'hashvich' ); ?></span>
			</a>
		</div>
	</div>
</section>

<main class="container-page py-10 md:py-14">
	<div class="grid gap-8 lg:grid-cols-[280px_1fr] lg:gap-10 items-start">
		<!-- ستون سایدبار ناوبری -->
		<aside class="w-full">
			<?php
			/**
			 * My Account navigation.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_navigation' );
			?>
		</aside>

		<!-- محتوای بخش انتخاب‌شده (سفارش‌ها، آدرس‌ها، اطلاعات حساب و ...) -->
		<div class="woocommerce-MyAccount-content min-w-0 rounded-[var(--radius-xl)] bg-card border border-line/50 p-6 md:p-8 shadow-sm">
			<?php
			/**
			 * My Account content.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
			?>
		</div>
	</div>
</main>
