<!doctype html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="light">
	<meta name="theme-color" content="#104a2f">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
	<a href="#main" class="sr-only rounded-full bg-sun px-4 py-2 text-ink focus:not-sr-only focus:absolute focus:top-3 focus:left-3 focus:z-50">
		<?php esc_html_e( 'رفتن به محتوا', 'hashvich' ); ?>
	</a>

	<!-- هدر اصلی و چسبان سایت -->
	<header class="site-header on-dark sticky top-0 z-40 bg-forest transition-shadow duration-[var(--duration-base)]">
		<div class="container-page flex h-[84px] items-center justify-between gap-6">

			<!-- نشان تجاری و لوگو -->
			<a aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="rounded-[10px]" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="inline-flex items-center gap-2.5 font-semibold tracking-[-0.02em] text-white">
					<svg viewBox="0 0 40 40" class="size-9" aria-hidden="true">
						<path d="M6 26c4 6 12 9 20 6" stroke="var(--color-sun)" stroke-width="3.4" fill="none" stroke-linecap="round"></path>
						<path d="M3 19c2 4 5 7 9 8.5" stroke="var(--color-sun)" stroke-width="3.4" fill="none" stroke-linecap="round" opacity=".55"></path>
						<path d="M17 5v9a4 4 0 0 0 3 3.8V33a2 2 0 0 0 4 0V17.8A4 4 0 0 0 27 14V5M22 5v8M33 5c-2.2 0-3.6 4.4-3.6 10 0 2 1 3.6 2.6 4V33a2 2 0 0 0 4 0V5z" stroke="currentColor" stroke-width="2.6" fill="none" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
					<span class="text-[24px] leading-none"><?php bloginfo( 'name' ); ?></span>
				</span>
			</a>

			<!-- منوی ناوبری اصلی دسکتاپ -->
			<nav aria-label="<?php esc_attr_e( 'اصلی', 'hashvich' ); ?>" class="hidden items-center gap-10 lg:flex">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'items_wrap'     => '%3$s',
							'walker'         => new Hashvich_Nav_Walker(),
							'fallback_cb'    => 'hashvich_primary_menu_fallback',
						)
					);
				} else {
					hashvich_primary_menu_fallback();
				}
				?>
			</nav>

			<!-- دکمه‌های کنترلی (سبد خرید، حساب کاربری، منوی موبایل) -->
			<div class="flex items-center gap-2 sm:gap-4">
				<?php
				$cart_url   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' );
				$cart_count = ( function_exists( 'WC' ) && is_object( WC()->cart ) ) ? WC()->cart->get_cart_contents_count() : 0;
				?>
				<a href="<?php echo esc_url( $cart_url ); ?>" class="round inline-flex h-10 items-center gap-2 rounded-full px-3 text-[15px] text-white transition-colors hover:bg-white/10" aria-label="<?php echo esc_attr( sprintf( __( 'سبد خرید، %d مورد', 'hashvich' ), $cart_count ) ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag size-[18px] sm:hidden" aria-hidden="true">
						<path d="M16 10a4 4 0 0 1-8 0"></path>
						<path d="M3.103 6.034h17.794"></path>
						<path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path>
					</svg>
					<span class="hidden sm:inline"><?php esc_html_e( 'سبد خرید', 'hashvich' ); ?></span>
					<span class="tabular-nums hv-cart-count">(<?php echo esc_html( hashvich_to_persian_num( $cart_count ) ); ?>)</span>
				</a>

				<?php
				$orders_url = function_exists( 'wc_get_account_endpoint_url' ) ? wc_get_account_endpoint_url( 'orders' ) : home_url( '/orders/' );
				?>
				<a class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-[background-color,color,border-color,box-shadow,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] prs:translate-y-px prs:scale-[0.98] on-dark border-[1.5px] border-white/85 text-white hov:bg-white hov:text-forest prs:bg-white/85 prs:text-forest h-10 px-6 text-[14px] max-sm:hidden" href="<?php echo esc_url( $orders_url ); ?>">
					<span><?php esc_html_e( 'سفارش‌های من', 'hashvich' ); ?></span>
				</a>

				<!-- دکمه همبرگری موبایل -->
				<button type="button" id="hv-mobile-menu-toggle" class="round inline-flex shrink-0 items-center justify-center rounded-full transition-[background-color,color,transform,border-color] duration-[var(--duration-fast)] prs:scale-90 size-10 [&_svg]:size-4 on-dark border-[1.5px] border-white/70 text-white hov:bg-white hov:text-forest lg:hidden" aria-label="<?php esc_attr_e( 'باز کردن منو', 'hashvich' ); ?>" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu" aria-hidden="true">
						<path d="M4 5h16"></path>
						<path d="M4 12h16"></path>
						<path d="M4 19h16"></path>
					</svg>
				</button>
			</div>
		</div>
	</header>

	<!-- دراور منوی موبایل (Mobile Drawer) -->
	<div id="hv-mobile-drawer" class="fixed inset-0 z-50 hidden lg:hidden" aria-modal="true" role="dialog">
		<div id="hv-mobile-drawer-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>
		<div class="fixed inset-y-0 right-0 z-50 w-full max-w-xs bg-forest p-6 text-white shadow-2xl flex flex-col justify-between overflow-y-auto">
			<div>
				<div class="flex items-center justify-between pb-6 border-b border-white/10">
					<span class="text-xl font-bold"><?php bloginfo( 'name' ); ?></span>
					<button type="button" id="hv-mobile-drawer-close" class="p-2 text-white/80 hover:text-white" aria-label="<?php esc_attr_e( 'بستن منو', 'hashvich' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-6">
							<path d="M18 6 6 18"></path>
							<path d="m6 6 12 12"></path>
						</svg>
					</button>
				</div>
				<nav class="flex flex-col gap-4 pt-6" aria-label="<?php esc_attr_e( 'منوی موبایل', 'hashvich' ); ?>">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'items_wrap'     => '%3$s',
								'walker'         => new Hashvich_Nav_Walker(),
								'fallback_cb'    => 'hashvich_primary_menu_fallback',
							)
						);
					} else {
						hashvich_primary_menu_fallback();
					}
					?>
				</nav>
			</div>
			<div class="pt-6 border-t border-white/10 flex flex-col gap-3">
				<a class="round flex h-11 items-center justify-center rounded-full bg-sun font-medium text-ink transition-colors hover:bg-sun-2" href="<?php echo esc_url( $orders_url ); ?>">
					<span><?php esc_html_e( 'سفارش‌های من', 'hashvich' ); ?></span>
				</a>
				<p class="text-xs text-center text-on-forest-muted"><?php esc_html_e( 'پشتیبانی و سفارش تلفنی: ۰۲۱ ۸۸۷۷ ۴۵۲۱', 'hashvich' ); ?></p>
			</div>
		</div>
	</div>
