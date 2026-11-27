<?php
/**
 * بخش ارزش‌های اساسی برند هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="bg-card py-16 lg:py-20" aria-labelledby="values">
	<div class="container-page">
		<div class="flex flex-col gap-3">
			<h2 class="text-[clamp(1.9rem,1.2rem+1.8vw,2.6rem)] leading-[1.1] font-semibold text-ink">
				<span id="values"><?php esc_html_e( 'از چه چیزی کوتاه نمی‌آییم؟', 'hashvich' ); ?></span>
			</h2>
			<p class="max-w-[560px] text-[16px] leading-relaxed text-muted">
				<?php esc_html_e( 'اصول غیرقابل مذاکره‌ای که از اولین روز تاسیس هاشویچ تا به امروز به آن‌ها پایبند مانده‌ایم.', 'hashvich' ); ?>
			</p>
		</div>

		<div class="mt-10 grid gap-6 md:grid-cols-3">
			<!-- ارزش ۱ -->
			<div class="flex flex-col gap-4 rounded-[var(--radius-md)] bg-white p-7 shadow-sm border border-line/40 hover:shadow-md transition-shadow">
				<span class="round flex size-12 items-center justify-center rounded-full bg-forest text-sun">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf size-5" aria-hidden="true"><path d="M11 20a10 10 0 0010-10 25.9 25.9 0 00-1.04-7.281 1 1 0 00-1.755-.325C15.833 5.5 13 5.5 9.8 6.1A7 7 0 0011 20"></path><path d="M2 21a5 5 0 012.911-4.544C7.613 15.212 8.351 15.24 11 13"></path></svg>
				</span>
				<h3 class="text-[19px] font-semibold text-ink"><?php esc_html_e( 'ساخت همین امروز صبح', 'hashvich' ); ?></h3>
				<p class="text-[15px] leading-relaxed text-muted">
					<?php esc_html_e( 'هیچ گوشت منجمد، سس صنعتی آماده یا نان بسته‌بندی کارخانه‌ای در آشپزخانه ما جایی ندارد. خمیرها بامداد هر روز ورز داده شده و تخمیر می‌شوند.', 'hashvich' ); ?>
				</p>
			</div>

			<!-- ارزش ۲ -->
			<div class="flex flex-col gap-4 rounded-[var(--radius-md)] bg-white p-7 shadow-sm border border-line/40 hover:shadow-md transition-shadow">
				<span class="round flex size-12 items-center justify-center rounded-full bg-forest text-sun">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame size-5" aria-hidden="true"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"></path></svg>
				</span>
				<h3 class="text-[19px] font-semibold text-ink"><?php esc_html_e( 'داغ و برشته به دست شما', 'hashvich' ); ?></h3>
				<p class="text-[15px] leading-relaxed text-muted">
					<?php esc_html_e( 'باکس‌های حرارتی اختصاصی پیک‌ها مجهز به عایق دوگانه هستند تا برگر گرمایش را از دست ندهد و سیب‌زمینی‌ها خمیر یا نرم نشوند.', 'hashvich' ); ?>
				</p>
			</div>

			<!-- ارزش ۳ -->
			<div class="flex flex-col gap-4 rounded-[var(--radius-md)] bg-white p-7 shadow-sm border border-line/40 hover:shadow-md transition-shadow">
				<span class="round flex size-12 items-center justify-center rounded-full bg-forest text-sun">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-handshake size-5" aria-hidden="true"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>
				</span>
				<h3 class="text-[19px] font-semibold text-ink"><?php esc_html_e( 'انصاف و احترام به پیک‌ها', 'hashvich' ); ?></h3>
				<p class="text-[15px] leading-relaxed text-muted">
					<?php esc_html_e( '۱۰۰٪ انعام ثبت‌شده مستقیماً به سفیر تعلق می‌گیرد و هیچ جریمه یا تاخیری جان و سلامت سفیران را به خطر نمی‌اندازد.', 'hashvich' ); ?>
				</p>
			</div>
		</div>
	</div>
</section>
