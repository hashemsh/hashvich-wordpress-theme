<?php
/**
 * تمپلیت برگه وردپرس — سازگار کامل با ویرایشگر المنتور و برگه‌های استاندارد
 *
 * @package Hashvich
 */

get_header();

while ( have_posts() ) :
	the_post();

	// برگه‌های اختصاصی ووکامرس خود دارای کانتینر و هیرو هستند
	$is_wc_page = function_exists( 'is_woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() );

	if ( $is_wc_page ) {
		the_content();
	} else {
		?>
		<main id="main" class="container-page py-12 md:py-16">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto rounded-[var(--radius-xl)] bg-card border border-line/40 p-6 md:p-10 shadow-sm' ); ?>>
				<h1 class="text-[24px] md:text-[30px] font-bold mb-6 text-ink pb-4 border-b border-line/40"><?php the_title(); ?></h1>
				<div class="leading-relaxed text-[15px] text-muted space-y-4">
					<?php the_content(); ?>
				</div>
			</article>
		</main>
		<?php
	}
endwhile;

get_footer();
