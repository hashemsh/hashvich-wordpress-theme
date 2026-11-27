<?php
/**
 * فرم ثبت نظر مشتریان
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

$dishes = get_posts(
	array(
		'post_type'      => 'product',
		'posts_per_page' => 20,
		'post_status'    => 'publish',
	)
);
?>

<section id="write" aria-labelledby="write-h" class="scroll-mt-28 rounded-[var(--radius-lg)] border bg-white p-6 shadow-sm">
	<h2 id="write-h" class="mb-5 text-[18px] font-semibold text-ink"><?php esc_html_e( 'ثبت نظر شما', 'hashvich' ); ?></h2>

	<form id="hv-review-form" class="flex flex-col gap-4" onsubmit="return false;">
		<!-- انتخاب امتیاز ستاره‌ای -->
		<fieldset>
			<legend class="mb-2 text-[14px] font-medium text-ink"><?php esc_html_e( 'امتیاز شما به تجربه سفارش', 'hashvich' ); ?></legend>
			<div class="flex gap-1" id="hv-star-rating-selector" dir="ltr">
				<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
					<label class="group relative cursor-pointer" data-rating="<?php echo esc_attr( $i ); ?>">
						<input class="sr-only" type="radio" value="<?php echo esc_attr( $i ); ?>" name="hv_rating" <?php checked( $i, 5 ); ?>>
						<span class="round flex size-10 items-center justify-center rounded-full transition-colors hover:bg-sun/10 text-sun">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" class="lucide lucide-star size-6 transition-transform group-hover:scale-125"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
						</span>
					</label>
				<?php endfor; ?>
			</div>
		</fieldset>

		<!-- انتخاب غذای سفارش‌داده‌شده -->
		<div class="flex flex-col gap-1.5">
			<label for="hv_review_dish" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'درباره کدام غذا نظر می‌دهید؟', 'hashvich' ); ?></label>
			<select class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[14px] text-ink focus:border-leaf focus:outline-none h-11"
					name="hv_dish_id"
					id="hv_review_dish">
				<option value="0"><?php esc_html_e( 'تجربه کلی از سفارش و تحویل', 'hashvich' ); ?></option>
				<?php foreach ( $dishes as $d ) : ?>
					<option value="<?php echo esc_attr( $d->ID ); ?>"><?php echo esc_html( $d->post_title ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<!-- نام مشتری -->
		<div class="flex flex-col gap-1.5">
			<label for="hv_review_author" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'نام یا نام مستعار شما', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
			<input class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 text-[14px] text-ink focus:border-leaf focus:outline-none h-11"
				   name="hv_author"
				   id="hv_review_author"
				   placeholder="<?php esc_attr_e( 'مثال: علیرضا م.', 'hashvich' ); ?>"
				   required>
		</div>

		<!-- متن نظر -->
		<div class="flex flex-col gap-1.5">
			<label for="hv_review_content" class="text-[14px] font-medium text-ink"><?php esc_html_e( 'متن نظر شما', 'hashvich' ); ?> <span class="text-tomato">*</span></label>
			<textarea class="w-full rounded-[var(--radius-sm)] border-[1.5px] border-line-strong bg-white px-4 py-2.5 text-[14px] text-ink focus:border-leaf focus:outline-none min-h-24 resize-y"
					  name="hv_content"
					  id="hv_review_content"
					  rows="3"
					  placeholder="<?php esc_attr_e( 'از طعم، میزان داغ بودن غذا، بسته‌بندی یا رفتار پیک برایمان بنویسید...', 'hashvich' ); ?>"
					  required></textarea>
		</div>

		<button type="button"
				id="hv-submit-review-btn"
				class="round relative inline-flex select-none items-center justify-center gap-2 whitespace-nowrap rounded-full font-bold transition-all bg-sun text-ink hover:bg-sun-2 active:scale-[0.98] h-12 px-6 text-[15px] cursor-pointer mt-1">
			<span><?php esc_html_e( 'ثبت و انتشار نظر', 'hashvich' ); ?></span>
		</button>
	</form>
</section>
