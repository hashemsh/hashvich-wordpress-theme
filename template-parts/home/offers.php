<?php
/**
 * بخش پیشنهادهای ویژه (offers) در صفحه اصلی
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$img_dir_uri = get_template_directory_uri() . '/assets/images/';
$menu_url    = home_url( '/menu/' );
?>

<section id="offers" class="container-page scroll-mt-24 pt-20 md:pt-28" aria-label="<?php esc_attr_e( 'پیشنهادها', 'hashvich' ); ?>">
	<div class="grid gap-6 lg:grid-cols-2">
		<!-- ستون سمت راست: دو بنر کوچک‌تر -->
		<div class="grid gap-6">
			<!-- بنر ۱: کاسه مرغ ترد -->
			<div>
				<article class="relative isolate flex min-h-[300px] overflow-hidden rounded-[var(--radius-lg)] bg-sun-soft p-7">
					<div class="absolute inset-y-0 left-0 -z-10 w-[56%] bg-sun [clip-path:polygon(22%_0,100%_0,100%_100%,0_100%)]"></div>
					<div class="relative z-10 flex max-w-[56%] flex-col">
						<p class="text-[17px] font-medium leading-normal text-[#5b1d10]/80">غذاهایی که نمی‌شود رد کرد</p>
						<h3 class="mt-3 text-[clamp(1.5rem,1.2rem+0.8vw,1.9rem)] leading-[1.25] font-bold text-[#3a2a0a]">تازه پخته، داغ سرو</h3>
						<div class="mt-auto pt-6">
							<a class="round group/pill inline-flex h-11 items-center gap-2 rounded-full bg-white pr-3 pl-5 text-[14px] font-medium text-ink shadow-[0_6px_18px_-8px_rgb(0_0_0/0.35)] transition-[transform,background-color] duration-[var(--duration-fast)] hov:bg-card prs:scale-[0.97]" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
								<?php esc_html_e( 'همین حالا سفارش دهید', 'hashvich' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="var(--color-sun)" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame size-5 text-tomato group-hover/pill:animate-wiggle" aria-hidden="true"><path d="M12 3q1 4 4 6.5t3 5.5a1 1 0 0 1-14 0 5 5 0 0 1 1-3 1 1 0 0 0 5 0c0-2-1.5-3-1.5-5q0-2 2.5-4"></path></svg>
							</a>
						</div>
					</div>

					<!-- بج تخفیف فارسی -->
					<span class="absolute top-[34%] left-[44%] z-10 flex flex-col items-center justify-center text-center leading-none text-[#5b1d10]">
						<span class="text-[15px] font-medium mb-1">تا</span>
						<span class="flex items-center justify-center text-[38px] font-extrabold tracking-normal leading-none">
							<span>۴۰</span><span class="text-[22px] mr-0.5">٪</span>
						</span>
					</span>

					<img alt="کاسه مرغ ترد با سس لعابی" class="select-none object-contain absolute -left-6 bottom-2 w-[48%] max-w-[260px] drop-shadow-[var(--shadow-food)]" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/chicken-bowl.webp' ); ?>">
					<img alt="سالاد باغ با گوجه، خیار و پنیر فتا" class="select-none object-contain absolute -top-6 left-[2%] w-[30%] max-w-[170px] rotate-12" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/salad.webp' ); ?>">
				</article>
			</div>

			<!-- بنر ۲: پیتزای خوشمزه -->
			<div>
				<article class="on-dark relative isolate flex min-h-[270px] overflow-hidden rounded-[var(--radius-lg)] bg-forest p-7 text-white">
					<svg class="absolute bottom-0 left-0 -z-10 h-[46%] w-[70%]" viewBox="0 0 400 140" preserveAspectRatio="none" aria-hidden="true">
						<path d="M0 40c40-10 60 20 100 10s50-40 90-30 40 40 80 40 60-30 90-20 40 30 40 30v70H0z" fill="var(--color-lime)"></path>
					</svg>
					<div class="relative z-10 flex flex-col">
						<p class="text-[17px] font-semibold text-sun">فوق</p>
						<h3 class="mt-1 max-w-[260px] text-[clamp(1.6rem,1.2rem+1vw,2.1rem)] leading-[1.2] font-bold">پیتزای خوشمزه</h3>
						<div class="mt-auto pt-6">
							<a class="round group/pill inline-flex h-11 items-center gap-2 rounded-full bg-white pr-3 pl-5 text-[14px] font-medium text-ink shadow-[0_6px_18px_-8px_rgb(0_0_0/0.35)] transition-[transform,background-color] duration-[var(--duration-fast)] hov:bg-card prs:scale-[0.97]" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
								<?php esc_html_e( 'همین حالا سفارش دهید', 'hashvich' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="var(--color-sun)" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame size-5 text-tomato group-hover/pill:animate-wiggle" aria-hidden="true"><path d="M12 3q1 4 4 6.5t3 5.5a1 1 0 0 1-14 0 5 5 0 0 1 1-3 1 1 0 0 0 5 0c0-2-1.5-3-1.5-5q0-2 2.5-4"></path></svg>
							</a>
						</div>
					</div>

					<!-- بج دایره‌ای ۵۰٪ تخفیف -->
					<span class="round absolute top-[40%] left-[42%] z-10 flex size-[116px] items-center justify-center rounded-full bg-sun text-ink shadow-[var(--shadow-card)]">
						<span class="flex flex-col items-center justify-center text-center leading-none">
							<span class="text-[15px] font-medium mb-1">تا</span>
							<span class="flex items-center justify-center text-[38px] font-extrabold tracking-normal leading-none">
								<span>۵۰</span><span class="text-[22px] mr-0.5">٪</span>
							</span>
						</span>
					</span>

					<img alt="پیتزا پپرونی با زیتون و هالوپینو" class="select-none object-contain absolute -left-[12%] -bottom-[18%] w-[62%] max-w-[330px] drop-shadow-[var(--shadow-food)]" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/pizza-pepperoni.webp' ); ?>">
				</article>
			</div>
		</div>

		<!-- ستون سمت چپ: بنر بزرگ برگرهای پر و پیمان -->
		<div class="h-full">
			<article class="on-dark relative isolate flex min-h-[580px] flex-col overflow-hidden rounded-[var(--radius-lg)] bg-tomato p-7 text-white h-full">
				<div class="pointer-events-none absolute inset-0 -z-10 flex flex-col justify-center gap-2 overflow-hidden text-[120px] leading-[0.9] font-bold text-white/[0.07] select-none" aria-hidden="true">
					<span class="whitespace-nowrap">برگر برگر</span>
					<span class="whitespace-nowrap pr-24">برگر برگر</span>
					<span class="whitespace-nowrap">برگر برگر</span>
					<span class="whitespace-nowrap pr-24">برگر برگر</span>
					<span class="whitespace-nowrap">برگر برگر</span>
				</div>

				<h3 class="text-[clamp(1.8rem,1.4rem+1.2vw,2.3rem)] leading-snug font-bold">برگرهای پر و پیمان</h3>

				<div class="relative my-4 flex flex-1 items-center justify-center">
					<img alt="چیزبرگر گوشت با گوجه، پیاز قرمز و کاهو" class="select-none object-contain w-[78%] max-w-[360px] -rotate-6 drop-shadow-[var(--shadow-food)] motion-safe:animate-float" draggable="false" loading="lazy" decoding="async" src="<?php echo esc_url( $img_dir_uri . 'photos/burger.webp' ); ?>">

					<!-- بج ستاره‌ای ۳۰٪ تخفیف کاملاً فیکس و تراز وسط -->
					<div class="absolute top-[8%] left-2 sm:left-6 flex size-[124px] items-center justify-center text-tomato-ink">
						<svg viewBox="0 0 100 100" class="absolute inset-0 size-full motion-safe:animate-spin-slow drop-shadow-md" aria-hidden="true">
							<path fill="#ffffff" d="M50 2l6 7 9-4 3 9 10-1-1 10 9 3-4 9 7 6-7 6 4 9-9 3 1 10-10-1-3 9-9-4-6 7-6-7-9 4-3-9-10 1 1-10-9-3 4-9-7-6 7-6-4-9 9-3-1-10 10 1 3-9 9 4z"></path>
						</svg>
						<div class="relative z-10 flex flex-col items-center justify-center text-center leading-none text-tomato-ink">
							<span class="text-[14px] font-semibold mb-0.5">تا</span>
							<span class="flex items-center justify-center text-[34px] font-black tracking-tight leading-none">
								<span>۳۰</span><span class="text-[18px] mr-0.5">٪</span>
							</span>
						</div>
					</div>

					<span class="absolute bottom-[20%] right-1 -rotate-[18deg] rounded-[6px] bg-white px-3 py-1.5 text-[14px] font-bold text-tomato-ink shadow-md">فرصت محدود</span>
					<span class="absolute bottom-[6%] right-[18%] -rotate-[14deg] rounded-[6px] bg-sun px-3 py-1.5 text-[14px] font-bold text-ink shadow-md">تخفیف ویژه</span>
				</div>

				<div class="flex justify-end">
					<a class="round group/pill inline-flex h-11 items-center gap-2 rounded-full bg-white pr-3 pl-5 text-[14px] font-medium text-ink shadow-[0_6px_18px_-8px_rgb(0_0_0/0.35)] transition-[transform,background-color] duration-[var(--duration-fast)] hov:bg-card prs:scale-[0.97]" href="<?php echo esc_url( $menu_url ); ?>" data-discover="true">
						<?php esc_html_e( 'همین حالا سفارش دهید', 'hashvich' ); ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="var(--color-sun)" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame size-5 text-tomato group-hover/pill:animate-wiggle" aria-hidden="true"><path d="M12 3q1 4 4 6.5t3 5.5a1 1 0 0 1-14 0 5 5 0 0 1 1-3 1 1 0 0 0 5 0c0-2-1.5-3-1.5-5q0-2 2.5-4"></path></svg>
					</a>
				</div>
			</article>
		</div>
	</div>
</section>
