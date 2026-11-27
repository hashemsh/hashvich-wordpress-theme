<?php
/**
 * ۵ مرحله فرم تسویه‌حساب (تحویل، اطلاعات تماس، آدرس، زمان و روش پرداخت)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
$first_name   = $current_user->exists() ? $current_user->first_name : '';
$last_name    = $current_user->exists() ? $current_user->last_name : '';
$email        = $current_user->exists() ? $current_user->user_email : '';
?>

<div class="flex flex-col gap-6" id="hv-checkout-steps">
	<!-- مرحله ۱: ارسال یا تحویل حضوری -->
	<section class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8" aria-labelledby="step-1">
		<h2 id="step-1" class="mb-5 flex items-center gap-3 text-[20px] font-semibold">
			<span class="round flex size-8 items-center justify-center rounded-full bg-forest text-[14px] text-white">۱</span>
			<?php esc_html_e( 'ارسال یا تحویل حضوری', 'hashvich' ); ?>
		</h2>
		<fieldset>
			<legend class="sr-only"><?php esc_html_e( 'سفارش را چگونه تحویل می‌گیرید؟', 'hashvich' ); ?></legend>
			<div class="grid gap-2.5 grid-cols-2">
				<!-- ارسال با پیک -->
				<label class="hv-delivery-type-label relative flex cursor-pointer items-center gap-3 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors duration-[var(--duration-fast)] min-h-16 px-4 py-3 border-leaf bg-lime-soft" data-type="delivery">
					<input class="sr-only" type="radio" name="hv_delivery_type" value="delivery" checked>
					<span class="shrink-0 text-leaf">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bike size-5" aria-hidden="true"><circle cx="18.5" cy="17.5" r="3.5"></circle><circle cx="5.5" cy="17.5" r="3.5"></circle><circle cx="15" cy="5" r="1"></circle><path d="M12 17.5V14l-3-3 4-3 2 3h2"></path></svg>
					</span>
					<span class="flex min-w-0 flex-1 flex-col">
						<span class="text-[15px] font-medium"><?php esc_html_e( 'ارسال با پیک', 'hashvich' ); ?></span>
						<span class="text-[13px] text-muted"><?php esc_html_e( '۲۵ تا ۳۵ دقیقه', 'hashvich' ); ?></span>
					</span>
					<span class="hv-radio-indicator round flex size-5 shrink-0 items-center justify-center rounded-full border-[1.5px] transition-colors border-leaf bg-leaf text-white" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3" aria-hidden="true"><path d="M20 6 9 17l-5-5"></path></svg>
					</span>
				</label>

				<!-- تحویل حضوری در شعبه -->
				<label class="hv-delivery-type-label relative flex cursor-pointer items-center gap-3 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors duration-[var(--duration-fast)] min-h-16 px-4 py-3 border-line-strong hover:border-muted" data-type="pickup">
					<input class="sr-only" type="radio" name="hv_delivery_type" value="pickup">
					<span class="shrink-0 text-muted">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-store size-5" aria-hidden="true"><path d="M15 21v-5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v5"></path><path d="M17.774 10.31a1.12 1.12 0 0 0-1.549 0 2.5 2.5 0 0 1-3.451 0 1.12 1.12 0 0 0-1.548 0 2.5 2.5 0 0 1-3.452 0 1.12 1.12 0 0 0-1.549 0 2.5 2.5 0 0 1-3.77-3.248l2.889-4.184A2 2 0 0 1 7 2h10a2 2 0 0 1 1.653.873l2.895 4.192a2.5 2.5 0 0 1-3.774 3.244"></path><path d="M4 10.95V19a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8.05"></path></svg>
					</span>
					<span class="flex min-w-0 flex-1 flex-col">
						<span class="text-[15px] font-medium"><?php esc_html_e( 'تحویل حضوری در شعبه', 'hashvich' ); ?></span>
						<span class="text-[13px] text-muted"><?php esc_html_e( 'آماده در ۱۲ تا ۱۸ دقیقه', 'hashvich' ); ?></span>
					</span>
					<span class="hv-radio-indicator round flex size-5 shrink-0 items-center justify-center rounded-full border-[1.5px] transition-colors border-line-strong" aria-hidden="true"></span>
				</label>
			</div>
		</fieldset>
	</section>

	<!-- مرحله ۲: اطلاعات تماس شما -->
	<section class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8" aria-labelledby="step-2">
		<h2 id="step-2" class="mb-5 flex items-center gap-3 text-[20px] font-semibold">
			<span class="round flex size-8 items-center justify-center rounded-full bg-forest text-[14px] text-white">۲</span>
			<?php esc_html_e( 'اطلاعات شما', 'hashvich' ); ?>
		</h2>
		<div class="grid gap-4 sm:grid-cols-2">
			<div class="flex flex-col gap-1.5">
				<label for="billing_first_name" class="text-[14px] font-medium"><?php esc_html_e( 'نام', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12"
					   name="billing_first_name"
					   id="billing_first_name"
					   autocomplete="given-name"
					   value="<?php echo esc_attr( $first_name ); ?>"
					   required>
			</div>
			<div class="flex flex-col gap-1.5">
				<label for="billing_last_name" class="text-[14px] font-medium"><?php esc_html_e( 'نام خانوادگی', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12"
					   name="billing_last_name"
					   id="billing_last_name"
					   autocomplete="family-name"
					   value="<?php echo esc_attr( $last_name ); ?>"
					   required>
			</div>
			<div class="flex flex-col gap-1.5">
				<label for="billing_phone" class="text-[14px] font-medium"><?php esc_html_e( 'شماره موبایل', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12"
					   name="billing_phone"
					   id="billing_phone"
					   type="tel"
					   autocomplete="tel"
					   placeholder="۰۹۱۲۳۴۵۶۷۸۹"
					   required>
				<p class="text-[13px] text-muted"><?php esc_html_e( 'جهت هماهنگی پیک و دریافت پیامک وضعیت سفارش.', 'hashvich' ); ?></p>
			</div>
			<div class="flex flex-col gap-1.5">
				<label for="billing_email" class="text-[14px] font-medium"><?php esc_html_e( 'ایمیل', 'hashvich' ); ?> <span class="text-muted font-normal">(<?php esc_html_e( 'اختیاری', 'hashvich' ); ?>)</span></label>
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12"
					   name="billing_email"
					   id="billing_email"
					   type="email"
					   autocomplete="email"
					   placeholder="name@example.com"
					   value="<?php echo esc_attr( $email ); ?>">
			</div>
		</div>
	</section>

	<!-- مرحله ۳: نشانی ارسال (تنها در حالت ارسال با پیک) -->
	<section class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8" id="hv-step-address" aria-labelledby="step-3">
		<h2 id="step-3" class="mb-5 flex items-center gap-3 text-[20px] font-semibold">
			<span class="round flex size-8 items-center justify-center rounded-full bg-forest text-[14px] text-white">۳</span>
			<?php esc_html_e( 'نشانی ارسال', 'hashvich' ); ?>
		</h2>
		<div class="grid gap-4 sm:grid-cols-[2fr_1fr]">
			<div class="flex flex-col gap-1.5 sm:col-span-2">
				<label for="billing_address_1" class="text-[14px] font-medium"><?php esc_html_e( 'نشانی کامل خیابان و کوچه', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12"
					   name="billing_address_1"
					   id="billing_address_1"
					   autocomplete="street-address"
					   placeholder="<?php esc_attr_e( 'خیابان ولیعصر، بالاتر از میدان ونک، کوچه بهار، پلاک ۲۱۸، واحد ۴', 'hashvich' ); ?>"
					   required>
			</div>
			<div class="flex flex-col gap-1.5">
				<label for="billing_city" class="text-[14px] font-medium"><?php esc_html_e( 'شهر', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12"
					   name="billing_city"
					   id="billing_city"
					   value="<?php esc_attr_e( 'تهران', 'hashvich' ); ?>"
					   required>
			</div>
			<div class="flex flex-col gap-1.5">
				<label for="billing_postcode" class="text-[14px] font-medium"><?php esc_html_e( 'کد پستی', 'hashvich' ); ?> <span class="text-muted font-normal">(<?php esc_html_e( 'اختیاری', 'hashvich' ); ?>)</span></label>
				<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12"
					   name="billing_postcode"
					   id="billing_postcode"
					   inputmode="numeric"
					   autocomplete="postal-code">
			</div>
			<div class="flex flex-col gap-1.5 sm:col-span-2">
				<label for="order_comments" class="text-[14px] font-medium">
					<?php esc_html_e( 'توضیحات تحویل برای پیک', 'hashvich' ); ?>
					<span class="font-normal text-muted">(<?php esc_html_e( 'اختیاری', 'hashvich' ); ?>)</span>
				</label>
				<textarea class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none min-h-20 py-3 resize-y"
						  name="order_comments"
						  id="order_comments"
						  rows="2"
						  placeholder="<?php esc_attr_e( 'کد آیفون، شماره طبقه، تحویل به لابی...', 'hashvich' ); ?>"></textarea>
			</div>
		</div>
	</section>

	<!-- مرحله ۴: زمان آماده‌سازی و ارسال -->
	<section class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8" aria-labelledby="step-4">
		<h2 id="step-4" class="mb-5 flex items-center gap-3 text-[20px] font-semibold">
			<span class="round flex size-8 items-center justify-center rounded-full bg-forest text-[14px] text-white">۴</span>
			<?php esc_html_e( 'زمان تحویل سفارش', 'hashvich' ); ?>
		</h2>
		<div class="flex flex-col gap-1.5">
			<label for="hv_delivery_time" class="text-[14px] font-medium"><?php esc_html_e( 'انتخاب زمان', 'hashvich' ); ?></label>
			<div class="relative">
				<select class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink focus:border-leaf focus:outline-none h-12 appearance-none pr-10"
						name="hv_delivery_time"
						id="hv_delivery_time">
					<option value="asap"><?php esc_html_e( 'در اسرع وقت (۲۵ تا ۳۵ دقیقه)', 'hashvich' ); ?></option>
					<option value="18:00"><?php esc_html_e( 'امروز ساعت ۱۸:۰۰', 'hashvich' ); ?></option>
					<option value="18:30"><?php esc_html_e( 'امروز ساعت ۱۸:۳۰', 'hashvich' ); ?></option>
					<option value="19:00"><?php esc_html_e( 'امروز ساعت ۱۹:۰۰', 'hashvich' ); ?></option>
					<option value="19:30"><?php esc_html_e( 'امروز ساعت ۱۹:۳۰', 'hashvich' ); ?></option>
					<option value="20:00"><?php esc_html_e( 'امروز ساعت ۲۰:۰۰', 'hashvich' ); ?></option>
					<option value="20:30"><?php esc_html_e( 'امروز ساعت ۲۰:۳۰', 'hashvich' ); ?></option>
					<option value="21:00"><?php esc_html_e( 'امروز ساعت ۲۱:۰۰', 'hashvich' ); ?></option>
				</select>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down pointer-events-none absolute top-1/2 right-3.5 size-4 -translate-y-1/2 text-muted" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg>
			</div>
		</div>
	</section>

	<!-- مرحله ۵: روش پرداخت و انعام اختیاری -->
	<section class="rounded-[var(--radius-lg)] border bg-white p-6 md:p-8" aria-labelledby="step-5">
		<h2 id="step-5" class="mb-5 flex items-center gap-3 text-[20px] font-semibold">
			<span class="round flex size-8 items-center justify-center rounded-full bg-forest text-[14px] text-white">۵</span>
			<?php esc_html_e( 'روش پرداخت', 'hashvich' ); ?>
		</h2>

		<fieldset>
			<legend class="sr-only"><?php esc_html_e( 'روش پرداخت را انتخاب کنید', 'hashvich' ); ?></legend>
			<div class="grid gap-2.5 grid-cols-1 sm:grid-cols-2">
				<!-- کارت آنلاین -->
				<label class="hv-payment-method-label relative flex cursor-pointer items-center gap-3 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors duration-[var(--duration-fast)] min-h-16 px-4 py-3 border-leaf bg-lime-soft">
					<input class="sr-only" type="radio" name="payment_method" value="bacs" checked>
					<span class="shrink-0 text-leaf">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card size-5" aria-hidden="true"><rect width="20" height="14" x="2" y="5" rx="2"></rect><line x1="2" x2="22" y1="10" y2="10"></line><path d="M6 14h2"></path></svg>
					</span>
					<span class="flex min-w-0 flex-1 flex-col">
						<span class="text-[15px] font-medium"><?php esc_html_e( 'درگاه پرداخت اینترنتی (شتاب)', 'hashvich' ); ?></span>
						<span class="text-[13px] text-muted"><?php esc_html_e( 'کلیه کارت‌های عضو شبکه شتاب', 'hashvich' ); ?></span>
					</span>
					<span class="hv-radio-indicator round flex size-5 shrink-0 items-center justify-center rounded-full border-[1.5px] transition-colors border-leaf bg-leaf text-white" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check size-3" aria-hidden="true"><path d="M20 6 9 17l-5-5"></path></svg>
					</span>
				</label>

				<!-- پرداخت در محل -->
				<label class="hv-payment-method-label relative flex cursor-pointer items-center gap-3 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors duration-[var(--duration-fast)] min-h-16 px-4 py-3 border-line-strong hover:border-muted">
					<input class="sr-only" type="radio" name="payment_method" value="cod">
					<span class="shrink-0 text-muted">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-banknote size-5" aria-hidden="true"><rect width="20" height="12" x="2" y="6" rx="2"></rect><circle cx="12" cy="12" r="2"></circle><path d="M6 12h.01M18 12h.01"></path></svg>
					</span>
					<span class="flex min-w-0 flex-1 flex-col">
						<span class="text-[15px] font-medium"><?php esc_html_e( 'پرداخت در محل (کارتخوان / نقدی)', 'hashvich' ); ?></span>
						<span class="text-[13px] text-muted"><?php esc_html_e( 'تسویه هنگام تحویل غذا', 'hashvich' ); ?></span>
					</span>
					<span class="hv-radio-indicator round flex size-5 shrink-0 items-center justify-center rounded-full border-[1.5px] transition-colors border-line-strong" aria-hidden="true"></span>
				</label>
			</div>
		</fieldset>

		<!-- انعام اختیاری پیک -->
		<div class="mt-6 border-t pt-5">
			<fieldset>
				<legend class="mb-3 text-[14px] font-medium">
					<?php esc_html_e( 'انعام پیک (۱۰۰٪ مبلغ به راننده اختصاص می‌یابد)', 'hashvich' ); ?>
				</legend>
				<div class="grid gap-2.5 grid-cols-2 sm:grid-cols-4">
					<label class="hv-tip-label relative flex cursor-pointer items-center gap-2 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors min-h-12 px-3 py-2 border-leaf bg-lime-soft" data-tip="0">
						<input class="sr-only" type="radio" name="hv_tip" value="0" checked>
						<span class="text-[14px] font-medium flex-1"><?php esc_html_e( 'بدون انعام', 'hashvich' ); ?></span>
						<span class="hv-radio-indicator round flex size-4 shrink-0 items-center justify-center rounded-full border transition-colors border-leaf bg-leaf text-white">
							<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"></path></svg>
						</span>
					</label>
					<label class="hv-tip-label relative flex cursor-pointer items-center gap-2 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors min-h-12 px-3 py-2 border-line-strong hover:border-muted" data-tip="20000">
						<input class="sr-only" type="radio" name="hv_tip" value="20000">
						<span class="text-[14px] font-medium flex-1">۲۰٬۰۰۰ تومان</span>
						<span class="hv-radio-indicator round flex size-4 shrink-0 items-center justify-center rounded-full border transition-colors border-line-strong"></span>
					</label>
					<label class="hv-tip-label relative flex cursor-pointer items-center gap-2 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors min-h-12 px-3 py-2 border-line-strong hover:border-muted" data-tip="30000">
						<input class="sr-only" type="radio" name="hv_tip" value="30000">
						<span class="text-[14px] font-medium flex-1">۳۰٬۰۰۰ تومان</span>
						<span class="hv-radio-indicator round flex size-4 shrink-0 items-center justify-center rounded-full border transition-colors border-line-strong"></span>
					</label>
					<label class="hv-tip-label relative flex cursor-pointer items-center gap-2 rounded-[var(--radius-sm)] border-[1.5px] bg-white transition-colors min-h-12 px-3 py-2 border-line-strong hover:border-muted" data-tip="50000">
						<input class="sr-only" type="radio" name="hv_tip" value="50000">
						<span class="text-[14px] font-medium flex-1">۵۰٬۰۰۰ تومان</span>
						<span class="hv-radio-indicator round flex size-4 shrink-0 items-center justify-center rounded-full border transition-colors border-line-strong"></span>
					</label>
				</div>
			</fieldset>
		</div>
	</section>
</div>
