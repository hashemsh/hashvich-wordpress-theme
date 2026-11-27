<?php
/**
 * بخش فرآیند سه‌مرحله‌ای (process) در صفحه اصلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="container-page pt-20 md:pt-24" aria-labelledby="how">
	<div class="rounded-[var(--radius-xl)] bg-card border border-line/40 p-6 md:p-10 lg:p-12 shadow-sm">
		<div class="grid gap-10 lg:grid-cols-[1fr_1.9fr] lg:gap-12 lg:items-center">
			<!-- ستون اطلاعات و آمار -->
			<div>
				<div class="flex flex-col gap-2">
					<span class="text-[13px] font-bold text-forest uppercase tracking-wider">
						<?php esc_html_e( 'چگونه کار می‌کند؟', 'hashvich' ); ?>
					</span>
					<h2 class="text-[22px] sm:text-[24px] md:text-[26px] font-bold text-ink leading-tight whitespace-nowrap">
						<span id="how"><?php esc_html_e( 'غذای داغ در سه قدم', 'hashvich' ); ?></span>
					</h2>
					<p class="text-[14px] md:text-[15px] leading-relaxed text-muted mt-1">
						<?php esc_html_e( 'نیازی به حساب کاربری نیست. سبد خرید و سفارش‌های شما روی همین دستگاه می‌ماند.', 'hashvich' ); ?>
					</p>
				</div>

				<dl class="mt-6 grid grid-cols-2 gap-x-4 gap-y-4 pt-5 border-t border-line/40">
					<div>
						<dt class="text-[12px] text-muted"><?php esc_html_e( 'میانگین زمان ارسال', 'hashvich' ); ?></dt>
						<dd class="text-[22px] font-bold text-forest tracking-[-0.02em] mt-0.5">
							<?php echo esc_html( hashvich_to_persian_num( '۲۸' ) ); ?> <?php esc_html_e( 'دقیقه', 'hashvich' ); ?>
						</dd>
					</div>
					<div>
						<dt class="text-[12px] text-muted"><?php esc_html_e( 'میانگین امتیاز', 'hashvich' ); ?></dt>
						<dd class="text-[22px] font-bold text-forest tracking-[-0.02em] mt-0.5">
							<?php echo esc_html( hashvich_to_persian_num( '۴٫۸' ) ); ?> <span class="text-sun text-[16px]">★</span>
						</dd>
					</div>
					<div>
						<dt class="text-[12px] text-muted"><?php esc_html_e( 'سفارش در هفته', 'hashvich' ); ?></dt>
						<dd class="text-[22px] font-bold text-forest tracking-[-0.02em] mt-0.5">
							<?php echo esc_html( hashvich_to_persian_num( '+۱٬۵۰۰' ) ); ?>
						</dd>
					</div>
					<div>
						<dt class="text-[12px] text-muted"><?php esc_html_e( 'آشپزخانه زیر یک سقف', 'hashvich' ); ?></dt>
						<dd class="text-[22px] font-bold text-forest tracking-[-0.02em] mt-0.5">
							<?php echo esc_html( hashvich_to_persian_num( '۷' ) ); ?> <?php esc_html_e( 'شعبه', 'hashvich' ); ?>
						</dd>
					</div>
				</dl>
			</div>

			<!-- مراحل سه‌گانه -->
			<ol class="grid gap-4 sm:grid-cols-3">
				<li>
					<div class="flex h-full flex-col gap-3 rounded-[var(--radius-md)] bg-white p-5 md:p-6 border border-line/50 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
						<div class="flex items-center justify-between">
							<span class="round flex size-11 items-center justify-center rounded-full bg-sun text-ink shadow-sm">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat" aria-hidden="true"><path d="M10 11v5"></path><path d="M14 11v5"></path><path d="M6 12.65c0-.457-.316-.844-.727-1.041A4 4 0 017.52 4.034a1.53 1.53 0 001.367-.547 4 4 0 016.225 0 1.53 1.53 0 001.367.547 4 4 0 012.248 7.575c-.411.197-.727.584-.727 1.04V19a2 2 0 01-2 2H8a2 2 0 01-2-2z"></path><path d="M6 16h12"></path></svg>
							</span>
							<span class="rounded-full bg-forest/8 px-2.5 py-0.5 text-[12px] font-semibold text-forest">
								<?php esc_html_e( 'قدم ۱', 'hashvich' ); ?>
							</span>
						</div>
						<h3 class="text-[16px] font-bold text-ink mt-1"><?php esc_html_e( 'هوستان را انتخاب کنید', 'hashvich' ); ?></h3>
						<p class="text-[13px] leading-relaxed text-muted"><?php esc_html_e( 'هفت آشپزخانه را ببینید، بر اساس رژیم غذایی فیلتر کنید و هر غذا را همان‌طور که دوست دارید بچینید.', 'hashvich' ); ?></p>
					</div>
				</li>
				<li>
					<div class="flex h-full flex-col gap-3 rounded-[var(--radius-md)] bg-white p-5 md:p-6 border border-line/50 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
						<div class="flex items-center justify-between">
							<span class="round flex size-11 items-center justify-center rounded-full bg-sun text-ink shadow-sm">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
							</span>
							<span class="rounded-full bg-forest/8 px-2.5 py-0.5 text-[12px] font-semibold text-forest">
								<?php esc_html_e( 'قدم ۲', 'hashvich' ); ?>
							</span>
						</div>
						<h3 class="text-[16px] font-bold text-ink mt-1"><?php esc_html_e( 'در چند ثانیه سفارش دهید', 'hashvich' ); ?></h3>
						<p class="text-[13px] leading-relaxed text-muted"><?php esc_html_e( 'ارسال یا تحویل حضوری، ساعتی که به شما می‌خورد و کد تخفیف اگر دارید.', 'hashvich' ); ?></p>
					</div>
				</li>
				<li>
					<div class="flex h-full flex-col gap-3 rounded-[var(--radius-md)] bg-white p-5 md:p-6 border border-line/50 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
						<div class="flex items-center justify-between">
							<span class="round flex size-11 items-center justify-center rounded-full bg-sun text-ink shadow-sm">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
							</span>
							<span class="rounded-full bg-forest/8 px-2.5 py-0.5 text-[12px] font-semibold text-forest">
								<?php esc_html_e( 'قدم ۳', 'hashvich' ); ?>
							</span>
						</div>
						<h3 class="text-[16px] font-bold text-ink mt-1"><?php esc_html_e( 'تا دم در دنبالش کنید', 'hashvich' ); ?></h3>
						<p class="text-[13px] leading-relaxed text-muted"><?php esc_html_e( 'سفارش را از آشپزخانه تا پیک و بعد تا در خانه‌تان پیگیری کنید.', 'hashvich' ); ?></p>
					</div>
				</li>
			</ol>
		</div>
	</div>
</section>
