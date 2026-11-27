<?php
/**
 * چارچوب کلی صفحه پرداخت و تسویه‌حساب هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

// اگر سبد خرید خالی باشد
if ( WC()->cart->is_empty() ) :
	?>
	<main id="main" class="min-h-[70vh]">
		<?php get_template_part( 'template-parts/checkout/hero' ); ?>
		<div class="container-page py-16 text-center">
			<div class="mx-auto max-w-md rounded-[var(--radius-lg)] border bg-white p-8 shadow-sm">
				<div class="mx-auto flex size-16 items-center justify-center rounded-full bg-lime-soft text-leaf">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
				</div>
				<h2 class="mt-4 text-[20px] font-semibold text-ink"><?php esc_html_e( 'سبد خرید شما خالی است', 'hashvich' ); ?></h2>
				<p class="mt-2 text-[14px] text-muted"><?php esc_html_e( 'برای ثبت سفارش، ابتدا غذای مورد علاقه خود را به سبد خرید اضافه کنید.', 'hashvich' ); ?></p>
				<div class="mt-6">
					<a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="round inline-flex items-center justify-center rounded-full bg-sun px-6 py-3 text-[15px] font-semibold text-ink hover:bg-sun-2">
						<?php esc_html_e( 'مشاهده منوی غذاها', 'hashvich' ); ?>
					</a>
				</div>
			</div>
		</div>
	</main>
	<?php
	return;
endif;
?>

<main id="main" class="min-h-[70vh]">
	<!-- هدر سبز بنر پرداخت -->
	<?php get_template_part( 'template-parts/checkout/hero' ); ?>

	<!-- فرم اصلی پرداخت و تسویه‌حساب -->
	<form id="hv-checkout-form"
		  name="checkout"
		  method="post"
		  class="checkout woocommerce-checkout container-page grid gap-8 py-12 lg:grid-cols-[1.5fr_1fr] lg:gap-10 lg:py-16"
		  action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
		  enctype="multipart/form-data">

		<?php
		// اکشن قبل از فرم پرداخت
		do_action( 'woocommerce_before_checkout_form', WC()->checkout() );
		?>

		<!-- ۵ مرحله تسویه حساب (ستون چپ) -->
		<?php get_template_part( 'template-parts/checkout/steps' ); ?>

		<!-- سایدبار بررسی سفارش و پرداخت (ستون راست) -->
		<?php get_template_part( 'template-parts/checkout/review' ); ?>

		<!-- فیلدهای امنیتی و توکن ووکامرس -->
		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
		<input type="hidden" name="woocommerce_checkout_update_totals" value="1" />

		<?php do_action( 'woocommerce_after_checkout_form', WC()->checkout() ); ?>
	</form>
</main>
