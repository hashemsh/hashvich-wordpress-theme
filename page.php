<?php
/**
 * تمپلیت برگه وردپرس — سازگار کامل با ویرایشگر المنتور و کانتینرهای تمام‌عرض
 *
 * @package Hashvich
 */

get_header();

while ( have_posts() ) :
	the_post();
	the_content();
endwhile;

get_footer();
