<?php
/**
 * تمپلیت اختصاصی صفحه اصلی هاشویچ
 *
 * @package Hashvich
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="min-h-[70vh]">
	<?php
	// ۱. بخش هیرو و دکمه سفارش سریع
	get_template_part( 'template-parts/home/hero' );

	// ۲. بنرهای پیشنهاد ویژه و کدهای تخفیف
	get_template_part( 'template-parts/home/offers' );

	// ۳. انتخاب‌های ویژه ما (غذاهای پرطرفدار)
	get_template_part( 'template-parts/home/picks' );

	// ۴. دسته‌بندی‌های منو
	get_template_part( 'template-parts/home/categories' );

	// ۵. پیشنهادهای لحظه‌ای و تخفیف‌های ویژه
	get_template_part( 'template-parts/home/deals' );

	// ۶. فرآیند سه مرحله‌ای سفارش تا تحویل
	get_template_part( 'template-parts/home/process' );

	// ۷. نظرات و رضایت مشتریان
	get_template_part( 'template-parts/home/reviews' );
	?>
</main>

<?php
get_footer();
