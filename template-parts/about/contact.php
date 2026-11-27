<?php
/**
 * بخش تماس با ما، اطلاعات شعب و فرم ارسال پیام
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="contact" class="container-page grid scroll-mt-24 gap-12 py-16 lg:grid-cols-[1fr_1.4fr] lg:py-24" aria-labelledby="contact-h">
	<!-- اطلاعات تماس و آدرس -->
	<div class="flex flex-col gap-6">
		<div class="flex flex-col gap-3">
			<h2 class="text-[clamp(1.9rem,1.2rem+1.8vw,2.6rem)] leading-[1.1] font-semibold text-ink">
				<span id="contact-h"><?php esc_html_e( 'با ما در تماس باشید', 'hashvich' ); ?></span>
			</h2>
			<p class="max-w-[560px] text-[16px] leading-relaxed text-muted">
				<?php esc_html_e( 'سؤال درباره سفارش، پذیرایی رویدادها، همکاری و پیشنهادها. هر پیام مستقیماً توسط تیم مدیریت مطالعه و پاسخ داده می‌شود.', 'hashvich' ); ?>
			</p>
		</div>

		<ul class="flex flex-col gap-4 text-[15px]">
			<li class="flex items-start gap-3">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin mt-1 size-5 shrink-0 text-leaf" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
				<span class="text-ink">
					<?php esc_html_e( 'تهران، خیابان ولیعصر، بالاتر از میدان ونک، نبش کوچه بهار، پلاک ۲۱۸', 'hashvich' ); ?>
				</span>
			</li>
			<li class="flex items-center gap-3">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone size-5 shrink-0 text-leaf" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
				<a href="tel:+982188774521" class="text-ink hover:text-leaf transition-colors font-medium tabular-nums" dir="ltr">
					۰۲۱ ۸۸۷۷ ۴۵۲۱
				</a>
			</li>
			<li class="flex items-center gap-3">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail size-5 shrink-0 text-leaf" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
				<a href="mailto:salam@hashvich.ir" class="text-ink hover:text-leaf transition-colors font-medium">
					salam@hashvich.ir
				</a>
			</li>
			<li class="flex items-center gap-3">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock size-5 shrink-0 text-leaf" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
				<span class="text-muted">
					<?php esc_html_e( 'ساعات کاری: همه‌روزه از ۱۱:۰۰ صبح تا ۲۳:۳۰ شب', 'hashvich' ); ?>
				</span>
			</li>
		</ul>
	</div>

	<!-- فرم پیام و تماس -->
	<div class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8 shadow-sm">
		<form id="hv-contact-form" class="flex flex-col gap-4" onsubmit="return false;">
			<div class="grid gap-4 sm:grid-cols-2">
				<div class="flex flex-col gap-1.5">
					<label for="contact_name" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'نام شما', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
					<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[14px] text-ink focus:border-leaf focus:outline-none h-11"
						   id="contact_name"
						   name="contact_name"
						   placeholder="<?php esc_attr_e( 'مثال: علی رضایی', 'hashvich' ); ?>"
						   required>
				</div>
				<div class="flex flex-col gap-1.5">
					<label for="contact_phone" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'شماره موبایل یا ایمیل', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
					<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[14px] text-ink focus:border-leaf focus:outline-none h-11"
						   id="contact_phone"
						   name="contact_phone"
						   placeholder="۰۹۱۲۳۴۵۶۷۸۹"
						   required>
				</div>
			</div>

			<div class="flex flex-col gap-1.5">
				<label for="contact_subject" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'موضوع پیام', 'hashvich' ); ?></label>
				<div class="relative">
					<select class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white pr-4 pl-10 text-[14px] text-ink focus:border-leaf focus:outline-none h-11 appearance-none"
							style="-webkit-appearance:none;-moz-appearance:none;appearance:none;background-image:none;"
							id="contact_subject"
							name="contact_subject">
						<option value="order"><?php esc_html_e( 'پیگیری یا سوال درباره سفارش', 'hashvich' ); ?></option>
						<option value="catering"><?php esc_html_e( 'سفارش سازمانی و مهمانی‌ها', 'hashvich' ); ?></option>
						<option value="feedback"><?php esc_html_e( 'انتقاد یا پیشنهاد کیفیت', 'hashvich' ); ?></option>
						<option value="cooperation"><?php esc_html_e( 'همکاری کاری یا تامین مواد اولیه', 'hashvich' ); ?></option>
					</select>
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down pointer-events-none absolute top-1/2 left-3.5 size-4 -translate-y-1/2 text-muted" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg>
				</div>
			</div>

			<div class="flex flex-col gap-1.5">
				<label for="contact_message" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'متن پیام شما', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
				<textarea class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 py-3 text-[14px] text-ink focus:border-leaf focus:outline-none min-h-28 resize-y"
						  id="contact_message"
						  name="contact_message"
						  rows="4"
						  placeholder="<?php esc_attr_e( 'پیام خود را به طور کامل بنویسید...', 'hashvich' ); ?>"
						  required></textarea>
			</div>

			<div class="mt-2">
				<button type="button"
						id="hv-submit-contact-btn"
						class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-bold transition-all bg-forest text-white hover:bg-leaf active:scale-[0.98] h-12 px-8 text-[15px] cursor-pointer">
					<span><?php esc_html_e( 'ارسال پیام به هاشویچ', 'hashvich' ); ?></span>
				</button>
			</div>
		</form>
	</div>
</section>
