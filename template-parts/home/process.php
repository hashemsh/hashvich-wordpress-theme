<?php
/**
 * بخش فرآیند سه‌مرحله‌ای (process) در صفحه اصلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="container-page pt-20 md:pt-28" aria-labelledby="how">
	<div class="rounded-[var(--radius-xl)] bg-card border border-line/40 p-6 sm:p-8 md:p-12 shadow-sm">
		<!-- سرتیتر بخش فرآیند -->
		<div class="mx-auto max-w-2xl text-center mb-10 md:mb-14">
			<span class="inline-flex items-center gap-1.5 rounded-full bg-forest/10 px-3.5 py-1 text-[13px] font-bold text-forest">
				<?php esc_html_e( 'سفارش آسان و سریع', 'hashvich' ); ?>
			</span>
			<h2 class="mt-3 text-[clamp(1.8rem,1.3rem+1.4vw,2.5rem)] font-bold text-ink leading-tight">
				<span id="how"><?php esc_html_e( 'غذای داغ در سه قدم ساده', 'hashvich' ); ?></span>
			</h2>
			<p class="mt-2 text-[15px] leading-relaxed text-muted">
				<?php esc_html_e( 'بدون پیچیدگی و بدون نیاز به ثبت‌نام اجباری، تنها در چند دقیقه سفارش دهید و داغ تحویل بگیرید.', 'hashvich' ); ?>
			</p>
		</div>

		<!-- مراحل سه‌گانه -->
		<ol class="grid gap-6 md:grid-cols-3">
			<!-- قدم ۱ -->
			<li>
				<div class="flex h-full flex-col items-center text-center rounded-[var(--radius-lg)] bg-white p-7 border border-line/50 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1">
					<div class="hv-process-icon-wrap">
						<div class="hv-process-icon-bg">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils text-forest" aria-hidden="true"><path d="M18 2v6a3 3 0 0 1-3 3 3 3 0 0 1-3-3V2"></path><path d="M15 2v19"></path><path d="M21 2v19"></path><path d="M5 2a3 3 0 0 0-3 3v4a3 3 0 0 0 3 3v9"></path><path d="M5 2v19"></path></svg>
						</div>
						<span class="hv-process-step-badge">۱</span>
					</div>
					<h3 class="text-[18px] font-bold text-ink"><?php esc_html_e( 'غذای دلخواه را انتخاب کنید', 'hashvich' ); ?></h3>
					<p class="mt-2 text-[14px] leading-relaxed text-muted"><?php esc_html_e( 'منوی متنوع برگرها، پیتزاهای تنوری، سوخاری و سالادها را بررسی کرده و مخلفات را سفارشی‌سازی کنید.', 'hashvich' ); ?></p>
				</div>
			</li>

			<!-- قدم ۲ -->
			<li>
				<div class="flex h-full flex-col items-center text-center rounded-[var(--radius-lg)] bg-white p-7 border border-line/50 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1">
					<div class="hv-process-icon-wrap">
						<div class="hv-process-icon-bg">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin text-forest" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
						</div>
						<span class="hv-process-step-badge">۲</span>
					</div>
					<h3 class="text-[18px] font-bold text-ink"><?php esc_html_e( 'نشانی و زمان تحویل را وارد کنید', 'hashvich' ); ?></h3>
					<p class="mt-2 text-[14px] leading-relaxed text-muted"><?php esc_html_e( 'ارسال سریع با پیک موتوری ویژه حرارتی یا تحویل حضوری در نزدیک‌ترین شعبه را مشخص نمایید.', 'hashvich' ); ?></p>
				</div>
			</li>

			<!-- قدم ۳ -->
			<li>
				<div class="flex h-full flex-col items-center text-center rounded-[var(--radius-lg)] bg-white p-7 border border-line/50 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-1">
					<div class="hv-process-icon-wrap">
						<div class="hv-process-icon-bg">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame text-tomato" aria-hidden="true"><path d="M12 3q1 4 4 6.5t3 5.5a1 1 0 0 1-14 0 5 5 0 0 1 1-3 1 1 0 0 0 5 0c0-2-1.5-3-1.5-5q0-2 2.5-4"></path></svg>
						</div>
						<span class="hv-process-step-badge">۳</span>
					</div>
					<h3 class="text-[18px] font-bold text-ink"><?php esc_html_e( 'داغ و تازه نوش جان کنید', 'hashvich' ); ?></h3>
					<p class="mt-2 text-[14px] leading-relaxed text-muted"><?php esc_html_e( 'سفارش در باکس‌های حرارتی پلمب‌شده نگه‌داری شده و حداکثر در ۲۸ دقیقه کاملاً گرم به دستتان می‌رسد.', 'hashvich' ); ?></p>
				</div>
			</li>
		</ol>

		<!-- آمار و شاخص‌های کلیدی زیر قدم‌ها -->
		<div class="mt-10 md:mt-12 rounded-[var(--radius-lg)] bg-white/70 border border-line/40 p-5 md:p-6 backdrop-blur-sm">
			<dl class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x md:divide-x-reverse divide-line/40">
				<div class="pt-2 md:pt-0 hv-process-stat-card">
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'میانگین زمان ارسال', 'hashvich' ); ?></dt>
					<dd class="hv-process-stat-num">
						<span class="tabular-nums">۲۸</span>
						<span class="text-[15px] font-medium text-muted"><?php esc_html_e( 'دقیقه', 'hashvich' ); ?></span>
					</dd>
				</div>
				<div class="pt-4 md:pt-0 hv-process-stat-card">
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'رضایت خریداران', 'hashvich' ); ?></dt>
					<dd class="hv-process-stat-num">
						<span class="tabular-nums">۴.۸</span>
						<span class="text-sun text-[18px]">★</span>
					</dd>
				</div>
				<div class="pt-4 md:pt-0 hv-process-stat-card">
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'سفارش در هفته', 'hashvich' ); ?></dt>
					<dd class="hv-process-stat-num" dir="ltr">
						<span class="text-forest font-bold">+</span><span class="tabular-nums">۱٬۵۰۰</span>
					</dd>
				</div>
				<div class="pt-4 md:pt-0 hv-process-stat-card">
					<dt class="text-[13px] text-muted"><?php esc_html_e( 'شعب فعال تهران', 'hashvich' ); ?></dt>
					<dd class="hv-process-stat-num">
						<span class="tabular-nums">۷</span>
						<span class="text-[15px] font-medium text-muted"><?php esc_html_e( 'شعبه', 'hashvich' ); ?></span>
					</dd>
				</div>
			</dl>
		</div>
	</div>
</section>
