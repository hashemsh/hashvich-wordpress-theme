<?php
/**
 * فوتر اختصاصی قالب هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

	<!-- فوتر سراسری سایت -->
	<footer class="site-footer on-dark doodles bg-forest text-white mt-auto">
		<!-- گرید اختصاصی ۴ ستونه تک‌ردیفه: دو ستون کناری عریض‌تر و دو ستون میانی جمع‌وجور -->
		<div class="container-page hv-footer-grid pt-16 pb-12">

			<!-- ستون ۱ (کناری راست - عریض): مشخصات، معرفی و تماس برند -->
			<div class="flex flex-col gap-4">
				<span class="inline-flex items-center gap-2.5 font-semibold tracking-[-0.02em] text-white">
					<svg viewBox="0 0 40 40" class="size-9" aria-hidden="true">
						<path d="M6 26c4 6 12 9 20 6" stroke="var(--color-sun)" stroke-width="3.4" fill="none" stroke-linecap="round"></path>
						<path d="M3 19c2 4 5 7 9 8.5" stroke="var(--color-sun)" stroke-width="3.4" fill="none" stroke-linecap="round" opacity=".55"></path>
						<path d="M17 5v9a4 4 0 0 0 3 3.8V33a2 2 0 0 0 4 0V17.8A4 4 0 0 0 27 14V5M22 5v8M33 5c-2.2 0-3.6 4.4-3.6 10 0 2 1 3.6 2.6 4V33a2 2 0 0 0 4 0V5z" stroke="currentColor" stroke-width="2.6" fill="none" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
					<span class="text-[24px] leading-none"><?php bloginfo( 'name' ); ?></span>
				</span>
				<p class="max-w-[340px] text-[15px] leading-relaxed text-on-forest-muted">
					<?php
					$desc = get_bloginfo( 'description' );
					echo esc_html( ! empty( $desc ) ? $desc : 'غذای سریع تازه در تهران؛ داغ در حدود ۳۰ دقیقه به دستتان می‌رسد یا آماده تحویل حضوری است.' );
					?>
				</p>
				<div class="text-[14px] text-on-forest-muted flex flex-col gap-1">
					<p><?php esc_html_e( 'تهران، خیابان ولیعصر، نبش کوچه بهار، پلاک ۲۱۸', 'hashvich' ); ?></p>
					<p><a href="tel:+982188774521" class="inline-flex min-h-8 items-center hover:text-white transition-colors tabular-nums" dir="ltr">۰۲۱ ۸۸۷۷ ۴۵۲۱</a></p>
					<p><a href="mailto:salam@hashvich.ir" class="inline-flex min-h-8 items-center hover:text-white transition-colors">salam@hashvich.ir</a></p>
				</div>
			</div>

			<!-- ستون ۲ (وسط - عرض کمتر): منوی سفارش -->
			<div>
				<h2 class="mb-4 text-[16px] font-semibold text-sun"><?php esc_html_e( 'سفارش', 'hashvich' ); ?></h2>
				<?php
				if ( has_nav_menu( 'footer_orders' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer_orders',
							'container'      => false,
							'menu_class'     => 'flex flex-col gap-1',
							'fallback_cb'    => false,
						)
					);
				} else {
					?>
					<ul class="flex flex-col gap-1">
						<li><a class="inline-flex min-h-9 items-center text-[15px] text-on-forest-muted hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/menu/' ) ); ?>"><?php esc_html_e( 'منوی کامل', 'hashvich' ); ?></a></li>
						<li><a class="inline-flex min-h-9 items-center text-[15px] text-on-forest-muted hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/offers/' ) ); ?>"><?php esc_html_e( 'پیشنهادها و کدها', 'hashvich' ); ?></a></li>
						<li><a class="inline-flex min-h-9 items-center text-[15px] text-on-forest-muted hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/tracking/' ) ); ?>"><?php esc_html_e( 'پیگیری سفارش', 'hashvich' ); ?></a></li>
					</ul>
					<?php
				}
				?>
			</div>

			<!-- ستون ۳ (وسط - عرض کمتر): درباره هاشویچ -->
			<div>
				<h2 class="mb-4 text-[16px] font-semibold text-sun"><?php esc_html_e( 'هاشویچ', 'hashvich' ); ?></h2>
				<?php
				if ( has_nav_menu( 'footer_brand' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer_brand',
							'container'      => false,
							'menu_class'     => 'flex flex-col gap-1',
							'fallback_cb'    => false,
						)
					);
				} else {
					?>
					<ul class="flex flex-col gap-1">
						<li><a class="inline-flex min-h-9 items-center text-[15px] text-on-forest-muted hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'درباره ما', 'hashvich' ); ?></a></li>
						<li><a class="inline-flex min-h-9 items-center text-[15px] text-on-forest-muted hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/reviews/' ) ); ?>"><?php esc_html_e( 'نظرات مشتریان', 'hashvich' ); ?></a></li>
						<li><a class="inline-flex min-h-9 items-center text-[15px] text-on-forest-muted hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/about/#contact' ) ); ?>"><?php esc_html_e( 'تماس با ما', 'hashvich' ); ?></a></li>
					</ul>
					<?php
				}
				?>
			</div>

			<!-- ستون ۴ (کناری چپ - عریض): فرم عضویت خبرنامه -->
			<div class="flex flex-col gap-3">
				<h2 class="text-[16px] font-semibold text-sun"><?php esc_html_e( 'تخفیف‌ها در ایمیل شما', 'hashvich' ); ?></h2>
				<p class="text-[14px] leading-relaxed text-on-forest-muted"><?php esc_html_e( 'هفته‌ای یک ایمیل با غذاهای جدید و بهترین کدها. هر وقت خواستید لغو کنید.', 'hashvich' ); ?></p>
				<form method="post" action="" class="mt-1" onsubmit="event.preventDefault(); alert('ایمیل شما با موفقیت ثبت شد!');">
					<div class="flex items-center gap-2 w-full">
						<label for="footer-email-input" class="sr-only"><?php esc_html_e( 'ایمیل', 'hashvich' ); ?></label>
						<input class="w-full flex-1 min-w-0 rounded-full border-[1.5px] border-line-strong bg-white px-5 text-[15px] text-ink placeholder:text-faint transition-[border-color,box-shadow] duration-[var(--duration-fast)] hov:border-muted focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.15)] h-12" id="footer-email-input" autocomplete="email" placeholder="you@example.com" type="email" required>
						<button type="submit" class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-semibold transition-[background-color,color,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] bg-sun text-ink hover:bg-sun-2 h-12 px-6 text-[15px] shrink-0 shadow-[0_4px_14px_rgba(247,195,46,0.3)]">
							<span><?php esc_html_e( 'عضویت', 'hashvich' ); ?></span>
						</button>
					</div>
				</form>
			</div>

		</div>

		<!-- نوار کپی‌رایت و امضای توسعه‌دهنده -->
		<div class="container-page flex flex-col gap-4 border-t border-white/10 py-6 text-[13px] text-on-forest-muted sm:flex-row sm:items-center sm:justify-between">
			<div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
				<p>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'تمامی حقوق محفوظ است.', 'hashvich' ); ?></p>
				<p><?php esc_html_e( 'دوشنبه تا پنج‌شنبه ۱۱:۰۰ تا ۲۳:۰۰', 'hashvich' ); ?></p>
			</div>

			<!-- امضای رسمی توسعه‌دهنده -->
			<div class="flex items-center gap-2 text-[12px]">
				<span>Designed &amp; Developed by <strong>Hashem Sh</strong></span>
				<span>•</span>
				<a href="https://github.com/hashemsh" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" title="GitHub">گیت‌هاب</a>
				<span>•</span>
				<a href="https://www.linkedin.com/in/hashemsheikhypour" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" title="LinkedIn">لینکدین</a>
				<span>•</span>
				<a href="https://t.me/init10" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors" title="Telegram">تلگرام</a>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
