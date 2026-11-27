<?php
/**
 * تمپلیت اصلی و فال‌بک قالب هاشویچ
 *
 * @package Hashvich
 */

get_header();
?>
<main id="main" class="site-main container mx-auto px-4 py-12">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	else :
		echo '<p class="text-muted text-center py-8">' . esc_html__( 'محتوایی یافت نشد.', 'hashvich' ) . '</p>';
	endif;
	?>
</main>
<?php
get_footer();
