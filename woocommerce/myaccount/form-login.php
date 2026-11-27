<?php
/**
 * بازنویسی فرم ورود و ثبت‌نام ووکامرس هاشویچ
 *
 * @package Hashvich
 * @version 9.9.0
 */

defined( 'ABSPATH' ) || exit;

$registration_enabled = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
$home_url             = home_url( '/' );
$active_tab           = ( ! empty( $_POST['register'] ) ) ? 'register' : 'login';
?>

<!-- هیرو بخش ورود / حساب کاربری -->
<section class="on-dark doodles relative overflow-hidden bg-forest text-white hv-account-hero" aria-label="<?php esc_attr_e( 'حساب کاربری', 'hashvich' ); ?>">
	<div class="container-page flex flex-col items-center text-center">
		<nav class="flex items-center gap-2 text-[13px] text-white/70 mb-3" aria-label="<?php esc_attr_e( 'مسیر راهنما', 'hashvich' ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>" class="hover:text-sun transition-colors"><?php esc_html_e( 'خانه', 'hashvich' ); ?></a>
			<span class="text-white/40">/</span>
			<span class="text-sun font-medium"><?php esc_html_e( 'ورود به حساب کاربری', 'hashvich' ); ?></span>
		</nav>
		<h1 class="text-[24px] md:text-[30px] font-bold tracking-tight text-white">
			<?php esc_html_e( 'حساب کاربری و سفارش‌ها', 'hashvich' ); ?>
		</h1>
		<p class="mt-2 max-w-[520px] text-[14px] md:text-[15px] leading-relaxed text-on-forest-muted">
			<?php esc_html_e( 'برای مشاهده سوابق خرید، پیگیری آنلاین پیک و ذخیره آدرس‌های تحویل وارد شوید.', 'hashvich' ); ?>
		</p>
	</div>
</section>

<main class="container-page hv-account-container">
	<!-- پیام‌ها و خطاهای ووکامرس -->
	<div class="max-w-xl mx-auto mb-6">
		<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
	</div>

	<div class="max-w-xl mx-auto rounded-[var(--radius-xl)] bg-card border border-line/50 p-6 sm:p-8 md:p-10 shadow-sm">
		<?php if ( $registration_enabled ) : ?>
			<!-- زبانه‌های سوییچ بین ورود و ثبت‌نام -->
			<div class="mb-8 flex rounded-full bg-white p-1.5 border border-line/60 shadow-inner">
				<button type="button"
						id="hv-tab-login-btn"
						onclick="hvSwitchAccountTab('login')"
						class="flex-1 rounded-full py-2.5 text-center text-[15px] font-semibold transition-all <?php echo ( 'login' === $active_tab ) ? 'bg-forest text-white shadow-sm' : 'text-muted hover:text-ink'; ?>">
					<?php esc_html_e( 'ورود به حساب', 'hashvich' ); ?>
				</button>
				<button type="button"
						id="hv-tab-register-btn"
						onclick="hvSwitchAccountTab('register')"
						class="flex-1 rounded-full py-2.5 text-center text-[15px] font-semibold transition-all <?php echo ( 'register' === $active_tab ) ? 'bg-forest text-white shadow-sm' : 'text-muted hover:text-ink'; ?>">
					<?php esc_html_e( 'ثبت‌نام جدید', 'hashvich' ); ?>
				</button>
			</div>
		<?php else : ?>
			<div class="mb-6 flex items-center gap-3 pb-4 border-b border-line/40">
				<span class="flex size-10 shrink-0 items-center justify-center rounded-full bg-forest/10 text-forest">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
				</span>
				<div>
					<h2 class="text-[19px] font-bold text-ink leading-tight"><?php esc_html_e( 'ورود به حساب کاربری', 'hashvich' ); ?></h2>
					<p class="text-[13px] text-muted mt-0.5"><?php esc_html_e( 'اطلاعات ورود خود را وارد نمایید', 'hashvich' ); ?></p>
				</div>
			</div>
		<?php endif; ?>

		<!-- فرم ورود (Login) -->
		<div id="hv-login-section" class="<?php echo ( 'login' === $active_tab ) ? 'block' : 'hidden'; ?>">
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
						<?php esc_html_e( 'رمز عبور را فراموش کردید؟', 'hashvich' ); ?>
					</a>
				</div>

				<div class="pt-2">
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

		<?php if ( $registration_enabled ) : ?>
			<!-- فرم ثبت‌نام (Register) -->
			<div id="hv-register-section" class="<?php echo ( 'register' === $active_tab ) ? 'block' : 'hidden'; ?>">
				<form method="post" class="woocommerce-form woocommerce-form-register register flex flex-col gap-5" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
						<div class="flex flex-col gap-1.5">
							<label for="reg_username" class="text-[14px] font-medium text-ink">
								<?php esc_html_e( 'نام کاربری دلخواه', 'hashvich' ); ?> <span class="text-tomato-ink">*</span>
							</label>
							<input type="text"
								   class="w-full rounded-[var(--radius-md)] border-[1.5px] border-line bg-white px-4 py-3 text-[15px] text-ink placeholder:text-faint focus:border-leaf focus:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.12)] transition-all"
								   name="username"
								   id="reg_username"
								   autocomplete="username"
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

					<div class="pt-2">
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<button type="submit"
								class="round inline-flex w-full select-none items-center justify-center gap-2 rounded-full bg-forest px-6 py-3.5 text-[15px] font-bold text-white shadow-sm transition-all hover:bg-leaf hover:shadow hover:scale-[1.01]"
								name="register"
								value="<?php esc_attr_e( 'ثبت‌نام', 'hashvich' ); ?>">
							<span><?php esc_html_e( 'ایجاد حساب کاربری', 'hashvich' ); ?></span>
						</button>
					</div>

					<?php do_action( 'woocommerce_register_form_end' ); ?>
				</form>
			</div>
		<?php endif; ?>

		<!-- باکس راهنمای سفارش سریع و مهمان -->
		<div class="mt-8 rounded-[var(--radius-md)] bg-white p-4 border border-line/40 flex items-start gap-3">
			<span class="flex size-7 shrink-0 items-center justify-center rounded-full bg-sun text-ink font-bold text-[13px] mt-0.5">
				!
			</span>
			<div class="text-[13px] leading-relaxed text-muted">
				<p class="font-semibold text-ink"><?php esc_html_e( 'سفارش بدون نیاز به ثبت‌نام', 'hashvich' ); ?></p>
				<p class="mt-0.5"><?php esc_html_e( 'در هاشویچ خرید به صورت مهمان امکان‌پذیر است و بعد از انتخاب غذاها در سبد خرید، مستقیماً آدرس خود را وارد و پرداخت می‌کنید.', 'hashvich' ); ?></p>
			</div>
		</div>
	</div>
</main>

<script>
function hvSwitchAccountTab(tab) {
	var loginSec = document.getElementById('hv-login-section');
	var regSec = document.getElementById('hv-register-section');
	var loginBtn = document.getElementById('hv-tab-login-btn');
	var regBtn = document.getElementById('hv-tab-register-btn');

	if (!loginSec || !regSec) return;

	if (tab === 'register') {
		loginSec.classList.add('hidden');
		loginSec.classList.remove('block');
		regSec.classList.remove('hidden');
		regSec.classList.add('block');

		if (loginBtn && regBtn) {
			loginBtn.className = 'flex-1 rounded-full py-2.5 text-center text-[15px] font-semibold transition-all text-muted hover:text-ink';
			regBtn.className = 'flex-1 rounded-full py-2.5 text-center text-[15px] font-semibold transition-all bg-forest text-white shadow-sm';
		}
	} else {
		regSec.classList.add('hidden');
		regSec.classList.remove('block');
		loginSec.classList.remove('hidden');
		loginSec.classList.add('block');

		if (loginBtn && regBtn) {
			regBtn.className = 'flex-1 rounded-full py-2.5 text-center text-[15px] font-semibold transition-all text-muted hover:text-ink';
			loginBtn.className = 'flex-1 rounded-full py-2.5 text-center text-[15px] font-semibold transition-all bg-forest text-white shadow-sm';
		}
	}
}
</script>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
