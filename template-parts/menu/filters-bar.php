<?php
/**
 * نوار فیلترهای رژیم غذایی و مرتب‌سازی صفحه منو
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

// تعداد اولیه محصولات
$total_products = isset( $args['total_products'] ) ? (int) $args['total_products'] : 15;
?>

<div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
	<div class="no-scrollbar -mx-4 flex gap-2 overflow-x-auto px-4 lg:mx-0 lg:px-0" role="group" aria-label="<?php esc_attr_e( 'فیلترهای رژیم غذایی', 'hashvich' ); ?>">
		<button type="button"
				data-diet="vegetarian"
				aria-pressed="false"
				class="hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft">
			<?php esc_html_e( 'گیاهی', 'hashvich' ); ?>
		</button>
		<button type="button"
				data-diet="vegan"
				aria-pressed="false"
				class="hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft">
			<?php esc_html_e( 'وگان', 'hashvich' ); ?>
		</button>
		<button type="button"
				data-diet="spicy"
				aria-pressed="false"
				class="hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft">
			<?php esc_html_e( 'تند', 'hashvich' ); ?>
		</button>
		<button type="button"
				data-diet="gluten-free"
				aria-pressed="false"
				class="hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft">
			<?php esc_html_e( 'بدون گلوتن', 'hashvich' ); ?>
		</button>
		<button type="button"
				data-diet="favorite"
				aria-pressed="false"
				class="hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart size-4" aria-hidden="true"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path></svg>
			<?php esc_html_e( 'ذخیره‌شده‌ها', 'hashvich' ); ?> <span id="hv-fav-count" class="tabular-nums">(۰)</span>
		</button>
	</div>

	<div class="flex items-center gap-3">
		<p id="menu-dish-count" class="text-[14px] whitespace-nowrap text-muted" aria-live="polite">
			<?php echo esc_html( hashvich_to_persian_num( $total_products ) ); ?> <?php esc_html_e( 'غذا', 'hashvich' ); ?>
		</p>
		<label for="menu-sort" class="sr-only"><?php esc_html_e( 'ترتیب نمایش', 'hashvich' ); ?></label>
		<div class="w-[210px]">
			<div class="relative">
				<select id="menu-sort" class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[15px] text-ink placeholder:text-faint transition-[border-color,box-shadow] duration-[var(--duration-fast)] hov:border-muted focus:border-leaf focus:outline-none focus-visible:outline-none focus:shadow-[0_0_0_4px_rgb(23_96_60/0.15)] h-12 appearance-none pr-10">
					<option value="popular"><?php esc_html_e( 'محبوب‌ترین', 'hashvich' ); ?></option>
					<option value="rating"><?php esc_html_e( 'بهترین امتیاز', 'hashvich' ); ?></option>
					<option value="price-asc"><?php esc_html_e( 'قیمت: ارزان به گران', 'hashvich' ); ?></option>
					<option value="price-desc"><?php esc_html_e( 'قیمت: گران به ارزان', 'hashvich' ); ?></option>
					<option value="fastest"><?php esc_html_e( 'سریع‌ترین', 'hashvich' ); ?></option>
				</select>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down pointer-events-none absolute top-1/2 right-3.5 size-4 -translate-y-1/2 text-muted" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg>
			</div>
		</div>
	</div>
</div>
