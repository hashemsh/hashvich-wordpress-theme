<?php
/**
 * بخش فرآیند سه‌مرحله‌ای (process) در صفحه اصلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="container-page pt-24 md:pt-28" aria-labelledby="how">
	<div class="grid gap-10 rounded-[var(--radius-xl)] bg-card p-8 md:p-12 lg:grid-cols-[1.1fr_1.9fr] lg:gap-12 lg:items-center">
		<!-- ستون اطلاعات و آمار -->
		<div>
			<div class="flex flex-col gap-3">
				<h2 class="text-[clamp(1.4rem,1.1rem+0.8vw,1.9rem)] leading-normal font-bold whitespace-nowrap">
					<span id="how"><?php esc_html_e( 'غذای داغ در سه قدم', 'hashvich' ); ?></span>
				</h2>
				<p class="max-w-[480px] text-[15px] leading-relaxed text-muted mt-1">
					<?php esc_html_e( 'نیازی به حساب کاربری نیست. سبد خرید و سفارش‌های شما روی همین دستگاه می‌ماند.', 'hashvich' ); ?>
				</p>
			</div>

			<dl class="mt-8 grid grid-cols-2 gap-x-6 gap-y-5">
				<div>
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'میانگین زمان ارسال', 'hashvich' ); ?></dt>
					<dd class="text-[26px] font-semibold tracking-[-0.02em]"><?php echo esc_html( hashvich_to_persian_num( '۲۸' ) ); ?> <?php esc_html_e( 'دقیقه', 'hashvich' ); ?></dd>
				</div>
				<div>
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'میانگین امتیاز', 'hashvich' ); ?></dt>
					<dd class="text-[26px] font-semibold tracking-[-0.02em]"><?php echo esc_html( hashvich_to_persian_num( '۴٫۸' ) ); ?></dd>
				</div>
				<div>
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'سفارش در هفته', 'hashvich' ); ?></dt>
					<dd class="text-[26px] font-semibold tracking-[-0.02em]"><?php echo esc_html( hashvich_to_persian_num( '+۱٬۵۰۰' ) ); ?></dd>
				</div>
				<div>
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'آشپزخانه زیر یک سقف', 'hashvich' ); ?></dt>
					<dd class="text-[26px] font-semibold tracking-[-0.02em]"><?php echo esc_html( hashvich_to_persian_num( '۷' ) ); ?></dd>
				</div>
			</dl>
		</div>

		<!-- مراحل سه‌گانه -->
		<ol class="grid gap-4 md:grid-cols-3">
			<li>
				<div class="flex h-full flex-col gap-3 rounded-[var(--radius-md)] bg-white p-6 shadow-[var(--shadow-card)]">
					<span class="round flex size-12 items-center justify-center rounded-full bg-sun text-ink">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat size-5" aria-hidden="true"><path d="M10 11v5"></path><path d="M14 11v5"></path><path d="M6 12.65c0-.457-.316-.844-.727-1.041A4 4 0 017.52 4.034a1.53 1.53 0 001.367-.547 4 4 0 016.225 0 1.53 1.53 0 001.367.547 4 4 0 012.248 7.575c-.411.197-.727.584-.727 1.04V19a2 2 0 01-2 2H8a2 2 0 01-2-2z"></path><path d="M6 16h12"></path></svg>
					</span>
					<span class="text-[13px] font-medium text-muted"><?php esc_html_e( 'قدم ۱', 'hashvich' ); ?></span>
					<h3 class="text-[18px] font-semibold"><?php esc_html_e( 'هوستان را انتخاب کنید', 'hashvich' ); ?></h3>
					<p class="text-[14px] leading-relaxed text-muted"><?php esc_html_e( 'هفت آشپزخانه را ببینید، بر اساس رژیم غذایی فیلتر کنید و هر غذا را همان‌طور که دوست دارید بچینید.', 'hashvich' ); ?></p>
				</div>
			</li>
			<li>
				<div class="flex h-full flex-col gap-3 rounded-[var(--radius-md)] bg-white p-6 shadow-[var(--shadow-card)]">
					<span class="round flex size-12 items-center justify-center rounded-full bg-sun text-ink">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag size-5" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
					</span>
					<span class="text-[13px] font-medium text-muted"><?php esc_html_e( 'قدم ۲', 'hashvich' ); ?></span>
					<h3 class="text-[18px] font-semibold"><?php esc_html_e( 'در چند ثانیه سفارش دهید', 'hashvich' ); ?></h3>
					<p class="text-[14px] leading-relaxed text-muted"><?php esc_html_e( 'ارسال یا تحویل حضوری، ساعتی که به شما می‌خورد و کد تخفیف اگر دارید.', 'hashvich' ); ?></p>
				</div>
			</li>
			<li>
				<div class="flex h-full flex-col gap-3 rounded-[var(--radius-md)] bg-white p-6 shadow-[var(--shadow-card)]">
					<span class="round flex size-12 items-center justify-center rounded-full bg-sun text-ink">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin size-5" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
					</span>
					<span class="text-[13px] font-medium text-muted"><?php esc_html_e( 'قدم ۳', 'hashvich' ); ?></span>
					<h3 class="text-[18px] font-semibold"><?php esc_html_e( 'تا دم در دنبالش کنید', 'hashvich' ); ?></h3>
					<p class="text-[14px] leading-relaxed text-muted"><?php esc_html_e( 'سفارش را از آشپزخانه تا پیک و بعد تا در خانه‌تان پیگیری کنید.', 'hashvich' ); ?></p>
				</div>
			</li>
		</ol>
	</div>
</section>
