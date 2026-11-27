<?php
/**
 * بخش پیشنهادهای لحظه‌ای (deals) در صفحه اصلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$img_dir_uri = get_template_directory_uri() . '/assets/images/';
$menu_url    = home_url( '/menu/' );
?>

<section class="container-page pt-20 md:pt-24" aria-labelledby="deals">
	<div class="flex flex-col gap-3 items-center text-center">
		<h2 class="text-[clamp(1.4rem,1.1rem+0.9vw,1.9rem)] leading-normal font-bold">
			<span id="deals"><?php esc_html_e( 'پیشنهادهای لحظه‌ای: به‌زودی تمام می‌شود!', 'hashvich' ); ?></span>
		</h2>
		<p class="text-[14px] text-muted">
			<?php esc_html_e( 'تخفیف‌های ویژه روزانه با تعداد محدود و زمان رو به پایان', 'hashvich' ); ?>
		</p>
	</div>

	<div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-[1fr_1.05fr_1fr]">
		<!-- ستون ۱ (راست): دو آیتم لیست -->
		<div class="flex flex-col">
			<!-- آیتم ۱: برگر مرغ هاشویچ -->
			<article class="relative flex flex-col gap-3 border-b py-4 last:border-b-0 sm:px-1">
				<div class="flex gap-3">
					<a class="flex w-[34%] shrink-0 items-center justify-center pt-6" tabindex="-1" aria-hidden="true" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
						<img alt="برگر مرغ سوخاری با سالاد کلم و خیارشور" class="select-none object-contain aspect-square w-full" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/chicken-burger.webp' ); ?>">
					</a>
					<div class="min-w-0 flex-1">
						<div class="flex items-start justify-between gap-1">
							<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink">۴۵٪ تخفیف</span>
							<button type="button" aria-pressed="false" aria-label="ذخیره برگر مرغ هاشویچ" class="round relative z-[2] inline-flex size-10 items-center justify-center rounded-full transition-[color,transform,background-color] hov:bg-black/5 prs:scale-90 text-muted hov:text-ink -mt-2 -ml-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart size-[18px] transition-transform" aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
							</button>
						</div>
						<h3 class="mt-1 text-[15px] leading-snug font-semibold">
							<a class="hover:underline max-sm:inline-flex max-sm:min-h-10 max-sm:items-center" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">برگر مرغ هاشویچ</a>
						</h3>
						<p class="text-[12px] text-muted line-clamp-1 mt-0.5">فیله مرغ سوخاری ترد با سالاد کلم و سس خردل عسلی</p>
						<span class="inline-flex items-center gap-1 mt-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
							<span class="text-[13px] font-medium tabular-nums">۴٫۵</span>
						</span>
						<div class="mt-1">
							<span class="inline-flex items-baseline gap-2">
								<span class="font-semibold tabular-nums text-[15px]">۹۶٬۲۵۰ تومان</span>
								<span class="text-muted line-through tabular-nums text-[13px]"><span class="sr-only">قبلاً </span>۱۷۵٬۰۰۰ تومان</span>
							</span>
						</div>
						<div class="mt-2">
							<div role="group" aria-label="تعداد برگر مرغ هاشویچ" class="round inline-flex items-center rounded-full border border-line-strong bg-white">
								<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-9 [&_svg]:size-3.5" disabled="" aria-label="کاهش تعداد برگر مرغ هاشویچ">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus" aria-hidden="true"><path d="M5 12h14"></path></svg>
								</button>
								<span class="text-center font-medium tabular-nums w-6 text-[13px]" aria-live="polite">۱</span>
								<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-9 [&_svg]:size-3.5" aria-label="افزایش تعداد برگر مرغ هاشویچ">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="flex items-center justify-between gap-2 mt-1">
					<!-- تایمر با استایل چیپ اختصاصی و ارقام فارسی -->
					<div role="timer" aria-label="زمان باقی‌مانده تخفیف" class="hv-timer-chip">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer text-tomato shrink-0 motion-safe:animate-pulse" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
						<span class="hv-timer-badge" data-unit="hours" aria-hidden="true">۰۰</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="minutes" aria-hidden="true">۴۶</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="seconds" aria-hidden="true">۲۱</span>
					</div>

					<button type="button" class="add-to-cart-deal round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-[background-color,color,border-color,box-shadow,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] prs:translate-y-px prs:scale-[0.98] disabled:pointer-events-none disabled:opacity-45 aria-disabled:pointer-events-none aria-disabled:opacity-45 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 h-10 px-4 text-[14px]" data-quantity="1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag size-4" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
						<span>افزودن به سبد</span>
					</button>
				</div>
			</article>

			<!-- آیتم ۲: پاستا قارچ خامه‌ای -->
			<article class="relative flex flex-col gap-3 border-b py-4 last:border-b-0 sm:px-1">
				<div class="flex gap-3">
					<a class="flex w-[34%] shrink-0 items-center justify-center pt-6" tabindex="-1" aria-hidden="true" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
						<img alt="پاستا تالیتله با قارچ و سس خامه‌ای" class="select-none object-contain aspect-square w-full" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/pasta.webp' ); ?>">
					</a>
					<div class="min-w-0 flex-1">
						<div class="flex items-start justify-between gap-1">
							<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink">۴۰٪ تخفیف</span>
							<button type="button" aria-pressed="false" aria-label="ذخیره پاستا قارچ خامه‌ای" class="round relative z-[2] inline-flex size-10 items-center justify-center rounded-full transition-[color,transform,background-color] hov:bg-black/5 prs:scale-90 text-muted hov:text-ink -mt-2 -ml-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart size-[18px] transition-transform" aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
							</button>
						</div>
						<h3 class="mt-1 text-[15px] leading-snug font-semibold">
							<a class="hover:underline max-sm:inline-flex max-sm:min-h-10 max-sm:items-center" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">پاستا قارچ خامه‌ای</a>
						</h3>
						<p class="text-[12px] text-muted line-clamp-1 mt-0.5">پاستا تالیتله ایتالیایی با سس خامه و قارچ دکمه‌ای</p>
						<span class="inline-flex items-center gap-1 mt-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
							<span class="text-[13px] font-medium tabular-nums">۴٫۷</span>
						</span>
						<div class="mt-1">
							<span class="inline-flex items-baseline gap-2">
								<span class="font-semibold tabular-nums text-[15px]">۱۱۷٬۰۰۰ تومان</span>
								<span class="text-muted line-through tabular-nums text-[13px]"><span class="sr-only">قبلاً </span>۱۹۵٬۰۰۰ تومان</span>
							</span>
						</div>
						<div class="mt-2">
							<div role="group" aria-label="تعداد پاستا قارچ خامه‌ای" class="round inline-flex items-center rounded-full border border-line-strong bg-white">
								<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-9 [&_svg]:size-3.5" disabled="" aria-label="کاهش تعداد پاستا قارچ خامه‌ای">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus" aria-hidden="true"><path d="M5 12h14"></path></svg>
								</button>
								<span class="text-center font-medium tabular-nums w-6 text-[13px]" aria-live="polite">۱</span>
								<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-9 [&_svg]:size-3.5" aria-label="افزایش تعداد پاستا قارچ خامه‌ای">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="flex items-center justify-between gap-2 mt-1">
					<div role="timer" aria-label="زمان باقی‌مانده تخفیف" class="hv-timer-chip">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer text-tomato shrink-0 motion-safe:animate-pulse" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
						<span class="hv-timer-badge" data-unit="hours" aria-hidden="true">۰۰</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="minutes" aria-hidden="true">۳۰</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="seconds" aria-hidden="true">۰۴</span>
					</div>

					<button type="button" class="add-to-cart-deal round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-[background-color,color,border-color,box-shadow,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] prs:translate-y-px prs:scale-[0.98] disabled:pointer-events-none disabled:opacity-45 aria-disabled:pointer-events-none aria-disabled:opacity-45 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 h-10 px-4 text-[14px]" data-quantity="1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag size-4" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
						<span>افزودن به سبد</span>
					</button>
				</div>
			</article>
		</div>

		<!-- ستون ۲ (وسط): کارت شاخص پیتزا مرغ باربیکیو تند -->
		<div class="md:order-first md:col-span-2 lg:order-none lg:col-span-1">
			<article class="relative flex h-full flex-col rounded-[var(--radius-md)] border bg-white p-6 shadow-sm">
				<div class="flex items-center justify-between">
					<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2.5 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink">۵۰٪ تخفیف</span>
					<button type="button" aria-pressed="false" aria-label="ذخیره پیتزا مرغ باربیکیو تند" class="round relative z-[2] inline-flex size-10 items-center justify-center rounded-full transition-[color,transform,background-color] hov:bg-black/5 prs:scale-90 text-muted hov:text-ink -ml-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart size-[18px] transition-transform" aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
					</button>
				</div>

				<a class="group mx-auto my-4 block w-[78%] outline-none" tabindex="-1" aria-hidden="true" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
					<img alt="پیتزا پپرونی با زیتون و هالوپینو" class="select-none object-contain aspect-square w-full transition-transform duration-[var(--duration-slow)] group-hover:rotate-12" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/pizza-pepperoni.webp' ); ?>">
				</a>

				<div class="mt-auto flex items-center justify-between gap-2">
					<div role="timer" aria-label="زمان باقی‌مانده تخفیف" class="hv-timer-chip">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer text-tomato shrink-0 motion-safe:animate-pulse" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
						<span class="hv-timer-badge" data-unit="hours" aria-hidden="true">۰۰</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="minutes" aria-hidden="true">۱۳</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="seconds" aria-hidden="true">۴۷</span>
					</div>

					<span class="inline-flex items-center gap-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
						<span class="text-[13px] font-medium tabular-nums">۴٫۷</span>
					</span>
				</div>

				<h3 class="mt-3 text-[19px] font-semibold">
					<a class="hover:underline max-sm:inline-flex max-sm:min-h-10 max-sm:items-center" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">پیتزا مرغ باربیکیو تند</a>
				</h3>
				<div class="mt-1">
					<span class="inline-flex items-baseline gap-2">
						<span class="font-semibold tabular-nums text-[16px]">۱۳۷٬۵۰۰ تومان</span>
						<span class="text-muted line-through tabular-nums text-[13px]"><span class="sr-only">قبلاً </span>۲۷۵٬۰۰۰ تومان</span>
					</span>
				</div>
				<p class="mt-2 line-clamp-2 text-[13px] leading-relaxed text-muted">مرغ باربیکیو دودی، پپرونی، زیتون سیاه، هالوپینو و کمی فلفل قرمز؛ طرفداران طعم تند عاشقش می‌شوند.</p>

				<div class="mt-4 flex items-center gap-3">
					<div role="group" aria-label="تعداد پیتزا مرغ باربیکیو تند" class="round inline-flex items-center rounded-full border border-line-strong bg-white">
						<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-10 [&_svg]:size-3.5" disabled="" aria-label="کاهش تعداد پیتزا مرغ باربیکیو تند">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus" aria-hidden="true"><path d="M5 12h14"></path></svg>
						</button>
						<span class="text-center font-medium tabular-nums w-6 text-[13px]" aria-live="polite">۱</span>
						<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-10 [&_svg]:size-3.5" aria-label="افزایش تعداد پیتزا مرغ باربیکیو تند">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
						</button>
					</div>
					<button type="button" class="add-to-cart-deal round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-[background-color,color,border-color,box-shadow,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] prs:translate-y-px prs:scale-[0.98] disabled:pointer-events-none disabled:opacity-45 aria-disabled:pointer-events-none aria-disabled:opacity-45 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 h-10 px-4 text-[14px] flex-1" data-quantity="1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag size-4" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
						<span>افزودن به سبد</span>
					</button>
				</div>
			</article>
		</div>

		<!-- ستون ۳ (چپ): سالاد باغ تازه -->
		<div class="flex flex-col">
			<article class="relative flex flex-col gap-3 border-b py-4 last:border-b-0 sm:px-1">
				<div class="flex gap-3">
					<a class="flex w-[34%] shrink-0 items-center justify-center pt-6" tabindex="-1" aria-hidden="true" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
						<img alt="سالاد باغ با گوجه، خیار و پنیر فتا" class="select-none object-contain aspect-square w-full" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/salad.webp' ); ?>">
					</a>
					<div class="min-w-0 flex-1">
						<div class="flex items-start justify-between gap-1">
							<span class="inline-flex h-6 items-center gap-1 rounded-[8px] px-2 text-[12px] font-semibold leading-none whitespace-nowrap bg-sun text-ink">۳۰٪ تخفیف</span>
							<button type="button" aria-pressed="false" aria-label="ذخیره سالاد باغ تازه" class="round relative z-[2] inline-flex size-10 items-center justify-center rounded-full transition-[color,transform,background-color] hov:bg-black/5 prs:scale-90 text-muted hov:text-ink -mt-2 -ml-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart size-[18px] transition-transform" aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
							</button>
						</div>
						<h3 class="mt-1 text-[15px] leading-snug font-semibold">
							<a class="hover:underline max-sm:inline-flex max-sm:min-h-10 max-sm:items-center" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">سالاد باغ تازه</a>
						</h3>
						<p class="text-[12px] text-muted line-clamp-1 mt-0.5">کاهو پیچ تازه، گوجه گیلاسی، پنیر فتا و سرکه بالزامیک</p>
						<span class="inline-flex items-center gap-1 mt-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star text-sun" aria-hidden="true"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
							<span class="text-[13px] font-medium tabular-nums">۴٫۸</span>
						</span>
						<div class="mt-1">
							<span class="inline-flex items-baseline gap-2">
								<span class="font-semibold tabular-nums text-[15px]">۱۰۱٬۵۰۰ تومان</span>
								<span class="text-muted line-through tabular-nums text-[13px]"><span class="sr-only">قبلاً </span>۱۴۵٬۰۰۰ تومان</span>
							</span>
						</div>
						<div class="mt-2">
							<div role="group" aria-label="تعداد سالاد باغ تازه" class="round inline-flex items-center rounded-full border border-line-strong bg-white">
								<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-9 [&_svg]:size-3.5" disabled="" aria-label="کاهش تعداد سالاد باغ تازه">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus" aria-hidden="true"><path d="M5 12h14"></path></svg>
								</button>
								<span class="text-center font-medium tabular-nums w-6 text-[13px]" aria-live="polite">۱</span>
								<button type="button" class="round inline-flex items-center justify-center rounded-full text-ink transition-colors hov:bg-card-2 disabled:opacity-35 disabled:pointer-events-none size-9 [&_svg]:size-3.5" aria-label="افزایش تعداد سالاد باغ تازه">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="flex items-center justify-between gap-2 mt-1">
					<div role="timer" aria-label="زمان باقی‌مانده تخفیف" class="hv-timer-chip">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer text-tomato shrink-0 motion-safe:animate-pulse" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
						<span class="hv-timer-badge" data-unit="hours" aria-hidden="true">۰۰</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="minutes" aria-hidden="true">۲۲</span>
						<span class="hv-timer-colon" aria-hidden="true">:</span>
						<span class="hv-timer-badge" data-unit="seconds" aria-hidden="true">۱۵</span>
					</div>

					<button type="button" class="add-to-cart-deal round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-medium transition-[background-color,color,border-color,box-shadow,transform] duration-[var(--duration-fast)] ease-[var(--ease-out)] prs:translate-y-px prs:scale-[0.98] disabled:pointer-events-none disabled:opacity-45 aria-disabled:pointer-events-none aria-disabled:opacity-45 bg-leaf text-white hov:bg-leaf-2 prs:bg-forest-2 h-10 px-4 text-[14px]" data-quantity="1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag size-4" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
						<span>افزودن به سبد</span>
					</button>
				</div>
			</article>
		</div>
	</div>
</section>
