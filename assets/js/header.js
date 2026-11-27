/**
 * اسکریپت تعاملی هدر و منوی واکنش‌گرای هاشویچ
 * هدر چسبان + دراور منوی موبایل با دسترسی‌پذیری کامل
 */
document.addEventListener('DOMContentLoaded', () => {
	const header = document.querySelector('header.site-header');
	const menuToggle = document.getElementById('hv-mobile-menu-toggle');
	const mobileDrawer = document.getElementById('hv-mobile-drawer');
	const drawerClose = document.getElementById('hv-mobile-drawer-close');
	const drawerBackdrop = document.getElementById('hv-mobile-drawer-backdrop');

	// ۱. افکت اسکرول هدر (سایه و پس‌زمینه پویا)
	if (header) {
		const handleScroll = () => {
			if (window.scrollY > 20) {
				header.classList.add('shadow-[0_4px_20px_rgba(0,0,0,0.18)]');
			} else {
				header.classList.remove('shadow-[0_4px_20px_rgba(0,0,0,0.18)]');
			}
		};
		window.addEventListener('scroll', handleScroll, { passive: true });
		handleScroll();
	}

	// ۲. مدیریت دراور منوی موبایل
	if (menuToggle && mobileDrawer) {
		const openDrawer = () => {
			mobileDrawer.classList.remove('hidden');
			document.body.style.overflow = 'hidden';
			menuToggle.setAttribute('aria-expanded', 'true');
		};

		const closeDrawer = () => {
			mobileDrawer.classList.add('hidden');
			document.body.style.overflow = '';
			menuToggle.setAttribute('aria-expanded', 'false');
		};

		menuToggle.addEventListener('click', openDrawer);

		if (drawerClose) {
			drawerClose.addEventListener('click', closeDrawer);
		}

		if (drawerBackdrop) {
			drawerBackdrop.addEventListener('click', closeDrawer);
		}

		// بستن دراور با فشردن دکمه Escape کیبورد
		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape' && !mobileDrawer.classList.contains('hidden')) {
				closeDrawer();
			}
		});
	}
});
