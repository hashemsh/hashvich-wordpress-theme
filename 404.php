<?php
/**
 * برگه ۴۰۴ (صفحه پیدا نشد)
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();

$menu_url = home_url( '/menu/' );
$home_url = home_url( '/' );
?>

<main id="main" class="min-h-[70vh] flex items-center justify-center py-20">
	<div class="container-page text-center max-w-xl">
		<div class="mx-auto flex size-28 items-center justify-center rounded-full bg-sun/20 text-sun shadow-sm">
			<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils text-forest"><path d="M18 2v6a3 3 0 0 1-3 3 3 3 0 0 1-3-3V2"></path><path d="M15 2v14a3 3 0 0 1-3 3H9"></path><line x1="2" x2="2" y1="2" y2="22"></line><line x1="6" x2="6" y1="2" y2="22"></line></svg>
		</div>

		<h1 class="mt-6 text-[clamp(2.5rem,1.8rem+3vw,4.5rem)] font-extrabold text-forest tabular-nums leading-none">
			۴۰۴
		</h1>
		<h2 class="mt-3 text-[22px] font-bold text-ink">
			<?php esc_html_e( 'اوپس! این غذا در منوی ما پیدا نشد', 'hashvich' ); ?>
		</h2>
		<p class="mt-3 text-[15px] leading-relaxed text-muted">
			<?php esc_html_e( 'صفحه‌ای که به دنبال آن هستید احتمالاً جابه‌جا شده یا آدرس را اشتباه وارد کرده‌اید. اما نگران نباشید، منوی پر از برگر و پیتزای داغ هاشویچ منتظر شماست!', 'hashvich' ); ?>
		</p>

		<div class="mt-8 flex flex-wrap items-center justify-center gap-4">
			<a href="<?php echo esc_url( $menu_url ); ?>"
			   class="round inline-flex items-center justify-center gap-2 rounded-full bg-sun px-7 h-12 text-[15px] font-bold text-ink hover:bg-sun-2 shadow-sm transition-transform hover:scale-105">
				<span><?php esc_html_e( 'مشاهده منوی غذاها', 'hashvich' ); ?></span>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
			</a>

			<a href="<?php echo esc_url( $home_url ); ?>"
			   class="round inline-flex items-center justify-center gap-2 rounded-full border-[1.5px] border-line-strong hover:border-forest px-6 h-12 text-[15px] font-medium text-ink transition-colors">
				<span><?php esc_html_e( 'بازگشت به صفحه اصلی', 'hashvich' ); ?></span>
			</a>
		</div>
	</div>
</main>

<?php
get_footer();
