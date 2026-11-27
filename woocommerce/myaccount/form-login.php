<?php
/**
 * بازنویسی فرم ورود و ثبت‌نام ووکامرس هاشویچ — چیدمان کنار هم (Side by Side)
 *
 * @package Hashvich
 * @version 9.9.0
 */

defined( 'ABSPATH' ) || exit;

$registration_enabled = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
$home_url             = home_url( '/' );
?>

<!-- هیرو بخش ورود / حساب کاربری -->
<section class="on-dark doodles relative overflow-hidden bg-forest text-white hv-account-hero" aria-label="<?php esc_attr_e( 'حساب کاربری', 'hashvich' ); ?>">
	<div class="container-page flex flex-col items-center text-center">
		<nav class="flex items-center gap-2 text-[13px] text-white/70 mb-3" aria-label="<?php esc_attr_e( 'مسیر راهنما', 'hashvich' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>" class="hover:text-sun transition-colors"><?php esc_html_e( 'خانه', 'hashvich' ); ?></a>
			<span class="text-white/40">/</span>
			<span class="text-sun font-medium"><?php esc_html_e( 'ورود یا عضویت', 'hashvich' ); ?></span>
		</nav>
		<h1 class="text-[24px] md:text-[30px] font-bold tracking-tight text-white">
			<?php esc_html_e( 'حساب کاربری و عضویت در هاشویچ', 'hashvich' ); ?>
		</h1>
		<p class="mt-2 max-w-[540px] text-[14px] md:text-[15px] leading-relaxed text-on-forest-muted">
			<?php esc_html_e( 'برای مشاهده سوابق خرید، پیگیری آنلاین پیک و ذخیره آدرس‌های تحویل وارد شوید یا ثبت‌نام کنید.', 'hashvich' ); ?>
		</p>
	</div>
</section>

<main class="container-page hv-account-container">
	<div class="max-w-5xl mx-auto">
		<!-- پیام‌ها و خطاهای ووکامرس -->
		<div class="mb-8">
			<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
		</div>

		<!-- گرید ۲ ستونه: ورود در یک ستون و ثبت‌نام در ستون کنار آن -->
		<div class="grid gap-8 <?php echo $registration_enabled ? 'md:grid-cols-2 lg:gap-10' : 'max-w-md mx-auto'; ?> items-stretch" id="customer_login">
			
			<!-- ستون ۱: فرم ورود (Login) -->
			<div class="rounded-[var(--radius-xl)] bg-card border border-line/50 p-6 sm:p-8 md:p-9 shadow-sm flex flex-col justify-between">
				<div>
					<div class="mb-6 flex items-center gap-3 pb-4 border-b border-line/40">
						<span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-sun/25 text-ink">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" x2="3" y1="12" y2="12"></line></svg>
						</span>
						<div>
							<h2 class="text-[19px] font-bold text-ink leading-tight"><?php esc_html_e( 'ورود به حساب کاربری', 'hashvich' ); ?></h2>
							<p class="text-[13px] text-muted mt-0.5"><?php esc_html_e( 'اگر قبلاً در هاشویچ ثبت‌نام کرده‌اید', 'hashvich' ); ?></p>
						</div>
					</div>

					<form class="woocommerce-form woocommerce-form-login login flex flex-col gap-5" method="post" novalidate>
						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<div class="flex flex-col gap-1.5">
							<label for="username" class="text-[14px] font-medium text-ink flex items-center justify-between">
								<span><?php esc_html_e( 'نام کاربری یا آدرس ایمیل', 'hashvich' ); ?> <span class="text-tomato-ink">*</span></span>
							</label>
							<input type="text"
								   class="w-full rounded-[var(--radius-md)] border-[1.5px] border-line bg-white px-4 py-3 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.12)] transition-all"
								   name="username"
								   id="username"
								   autocomplete="username"
								   placeholder="مثال: salam@hashvich.ir"
								   value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
								   required
								   aria-required="true">
						</div>

						<div class="flex flex-col gap-1.5">
							<label for="password" class="text-[14px] font-medium text-ink flex items-center justify-between">
								<span><?php esc_html_e( 'رمز عبور', 'hashvich' ); ?> <span class="text-tomato-ink">*</span></span>
							</label>
							<input type="password"
								   class="w-full rounded-[var(--radius-md)] border-[1.5px] border-line bg-white px-4 py-3 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.12)] transition-all"
								   name="password"
								   id="password"
								   autocomplete="current-password"
								   placeholder="••••••••"
								   required
								   aria-required="true">
						</div>

						<?php do_action( 'woocommerce_login_form' ); ?>

						<div class="flex items-center justify-between pt-1 text-[13px]">
							<label class="inline-flex items-center gap-2 cursor-pointer select-none text-muted hover:text-ink">
								<input class="size-4 rounded accent-forest border-line text-forest focus:ring-forest"
									   name="rememberme"
									   type="checkbox"
									   id="rememberme"
									   value="forever">
								<span><?php esc_html_e( 'مرا به خاطر بسپار', 'hashvich' ); ?></span>
							</label>

							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-forest font-medium hover:underline">
								<?php esc_html_e( 'فراموشی رمز عبور؟', 'hashvich' ); ?>
							</a>
						</div>

						<div class="pt-3">
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit"
									class="round inline-flex w-full select-none items-center justify-center gap-2 rounded-full bg-sun px-6 py-3.5 text-[15px] font-bold text-ink shadow-sm transition-all hover:bg-sun-2 hover:shadow hover:scale-[1.01]"
									name="login"
									value="<?php esc_attr_e( 'ورود به حساب', 'hashvich' ); ?>">
								<span><?php esc_html_e( 'ورود به حساب کاربری', 'hashvich' ); ?></span>
							</button>
						</div>

						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</form>
				</div>
			</div>

			<?php if ( $registration_enabled ) : ?>
				<!-- ستون ۲: فرم ثبت‌نام جدید (Register) کنار فرم ورود -->
				<div class="rounded-[var(--radius-xl)] bg-card border border-line/50 p-6 sm:p-8 md:p-9 shadow-sm flex flex-col justify-between">
					<div>
						<div class="mb-6 flex items-center gap-3 pb-4 border-b border-line/40">
							<span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-forest/10 text-forest">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><line x1="19" x2="19" y1="8" y2="14"></line><line x1="22" x2="16" y1="11" y2="11"></line></svg>
							</span>
							<div>
								<h2 class="text-[19px] font-bold text-ink leading-tight"><?php esc_html_e( 'ثبت‌نام جدید در هاشویچ', 'hashvich' ); ?></h2>
								<p class="text-[13px] text-muted mt-0.5"><?php esc_html_e( 'ایجاد حساب کاربری در کمتر از یک دقیقه', 'hashvich' ); ?></p>
							</div>
						</div>

						<form method="post" class="woocommerce-form woocommerce-form-register register flex flex-col gap-5" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
							<?php do_action( 'woocommerce_register_form_start' ); ?>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
								<div class="flex flex-col gap-1.5">
									<label for="reg_username" class="text-[14px] font-medium text-ink">
										<?php esc_html_e( 'نام کاربری', 'hashvich' ); ?> <span class="text-tomato-ink">*</span>
									</label>
									<input type="text"
										   class="w-full rounded-[var(--radius-md)] border-[1.5px] border-line bg-white px-4 py-3 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.12)] transition-all"
										   name="username"
										   id="reg_username"
										   autocomplete="username"
										   placeholder="مثال: ali_tehrani"
										   value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
										   required
										   aria-required="true">
								</div>
							<?php endif; ?>

							<div class="flex flex-col gap-1.5">
								<label for="reg_email" class="text-[14px] font-medium text-ink">
									<?php esc_html_e( 'آدرس ایمیل', 'hashvich' ); ?> <span class="text-tomato-ink">*</span>
								</label>
								<input type="email"
									   class="w-full rounded-[var(--radius-md)] border-[1.5px] border-line bg-white px-4 py-3 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.12)] transition-all"
									   name="email"
									   id="reg_email"
									   autocomplete="email"
									   placeholder="name@example.com"
									   value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"
									   required
									   aria-required="true">
							</div>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
								<div class="flex flex-col gap-1.5">
									<label for="reg_password" class="text-[14px] font-medium text-ink">
										<?php esc_html_e( 'رمز عبور', 'hashvich' ); ?> <span class="text-tomato-ink">*</span>
									</label>
									<input type="password"
										   class="w-full rounded-[var(--radius-md)] border-[1.5px] border-line bg-white px-4 py-3 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.12)] transition-all"
										   name="password"
										   id="reg_password"
										   autocomplete="new-password"
										   placeholder="••••••••"
										   required
										   aria-required="true">
								</div>
							<?php else : ?>
								<p class="text-[13px] text-muted leading-relaxed">
									<?php esc_html_e( 'لینک تنظیم گذرواژه به آدرس ایمیل شما ارسال خواهد شد.', 'hashvich' ); ?>
								</p>
							<?php endif; ?>

							<?php do_action( 'woocommerce_register_form' ); ?>

							<div class="pt-3">
								<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
								<button type="submit"
										class="round inline-flex w-full select-none items-center justify-center gap-2 rounded-full bg-forest px-6 py-3.5 text-[15px] font-bold text-white shadow-sm transition-all hover:bg-leaf hover:shadow hover:scale-[1.01]"
										name="register"
										value="<?php esc_attr_e( 'ثبت‌نام', 'hashvich' ); ?>">
									<span><?php esc_html_e( 'ثبت‌نام و عضویت در هاشویچ', 'hashvich' ); ?></span>
								</button>
							</div>

							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
					</div>
				</div>
			<?php endif; ?>

		</div>

		<!-- باکس راهنمای سفارش سریع و مهمان زیر هر دو فرم -->
		<div class="mt-8 rounded-[var(--radius-lg)] bg-card border border-line/40 p-4 sm:p-5 flex items-start gap-3 shadow-sm">
			<span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-sun text-ink font-bold text-[14px] mt-0.5 shadow-sm">
				!
			</span>
			<div class="text-[13px] leading-relaxed text-muted">
				<p class="font-bold text-ink text-[14px]"><?php esc_html_e( 'سفارش بدون نیاز به ثبت‌نام', 'hashvich' ); ?></p>
				<p class="mt-0.5"><?php esc_html_e( 'در هاشویچ خرید به صورت مهمان نیز امکان‌پذیر است. پس از افزودن غذاها به سبد خرید، مستقیماً به صفحه تسویه‌حساب رفته و سفارش خود را تکمیل کنید.', 'hashvich' ); ?></p>
			</div>
		</div>
	</div>
</main>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
