/**
 * منطق تعاملی صفحه منو و کاتالوگ قالب هاشویچ
 * شامل فیلتر آنی دسته‌بندی‌ها، رژیم غذایی، جست‌وجوی زنده، مرتب‌سازی و علاقه‌مندی‌ها
 *
 * @package Hashvich
 */

(function ($) {
	'use strict';

	/**
	 * تبدیل اعداد انگلیسی به فارسی
	 *
	 * @param {number|string} n عدد ورودی
	 * @returns {string} رشته با ارقام فارسی
	 */
	function toPersianDigits(n) {
		var s = String(n || 0);
		var en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
		var fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
		for (var i = 0; i < 10; i++) {
			s = s.replace(new RegExp(en[i], 'g'), fa[i]);
		}
		return s;
	}

	/**
	 * نرمال‌سازی متن فارسی برای جست‌وجوی منعطف
	 *
	 * @param {string} str متن ورودی
	 * @returns {string} متن تمیزشده
	 */
	function normalizePersian(str) {
		return (str || '')
			.toLowerCase()
			.replace(/[\u064B-\u065F]/g, '') // حذف اعراب
			.replace(/ي/g, 'ی')
			.replace(/ك/g, 'ک')
			.replace(/[\u200C\u200B]/g, ' ') // تبدیل نیم‌فاصله به فاصله
			.trim();
	}

	// ۱. کانتینر توئست‌ها
	var toastContainer = document.querySelector('[role="status"][aria-live="polite"]');
	if (!toastContainer) {
		toastContainer = document.createElement('div');
		toastContainer.setAttribute('role', 'status');
		toastContainer.setAttribute('aria-live', 'polite');
		toastContainer.className = 'pointer-events-none fixed inset-x-0 bottom-6 z-[70] flex flex-col items-center gap-2 px-4';
		document.body.appendChild(toastContainer);
	}

	/**
	 * نمایش توئست اعلان
	 *
	 * @param {string} message متن پیام
	 * @param {string} [actionUrl] آدرس دکمه اقدام
	 * @param {string} [actionText] متن دکمه اقدام
	 */
	function showToast(message, actionUrl, actionText) {
		var toast = document.createElement('div');
		toast.className = 'pointer-events-auto flex items-center gap-3 rounded-full bg-forest px-5 py-3 text-white shadow-[0_10px_30px_rgba(0,0,0,0.35)] text-[14px] transition-all duration-300 translate-y-4 opacity-0 border border-white/10';

		var checkSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-sun shrink-0"><polyline points="20 6 9 17 4 12"></polyline></svg>';
		var html = checkSvg + '<span>' + message + '</span>';

		if (actionUrl && actionText) {
			html += '<a href="' + actionUrl + '" class="round ml-1 rounded-full bg-sun px-3 py-1 text-[12px] font-semibold text-ink hover:bg-sun-2 transition-colors">' + actionText + '</a>';
		}

		toast.innerHTML = html;
		toastContainer.appendChild(toast);

		requestAnimationFrame(function () {
			toast.classList.remove('translate-y-4', 'opacity-0');
		});

		setTimeout(function () {
			toast.classList.add('opacity-0', 'translate-y-2');
			setTimeout(function () {
				if (toast.parentNode) {
					toast.parentNode.removeChild(toast);
				}
			}, 300);
		}, 3200);
	}

	// ۲. مدیریت وضعیت علاقه‌مندی‌ها (Favorites) در LocalStorage
	var FAV_STORAGE_KEY = 'hv_favorites';

	function getFavorites() {
		try {
			var raw = localStorage.getItem(FAV_STORAGE_KEY);
			return raw ? JSON.parse(raw) : [];
		} catch (e) {
			return [];
		}
	}

	function saveFavorites(favs) {
		try {
			localStorage.setItem(FAV_STORAGE_KEY, JSON.stringify(favs));
		} catch (e) {
			// ignore storage quota error
		}
	}

	function updateFavoritesCountBadge(count) {
		var badge = document.getElementById('hv-fav-count');
		if (badge) {
			badge.textContent = '(' + toPersianDigits(count) + ')';
		}
	}

	// ۳. متغیرهای وضعیت منو
	var state = {
		category: 'all',
		diet: null,
		search: '',
		sort: 'popular',
		favorites: getFavorites()
	};

	// ۴. اعمال فیلترها و مرتب‌سازی روی کارت‌های منو
	function applyFiltersAndSort() {
		var grid = document.getElementById('menu-product-grid');
		if (!grid) {
			return;
		}

		var cards = grid.querySelectorAll('.hv-menu-card');
		var emptyState = document.getElementById('hv-menu-empty');
		var countEl = document.getElementById('menu-dish-count');
		var visibleCards = [];

		var normSearch = normalizePersian(state.search);

		cards.forEach(function (card) {
			var cardCat = card.getAttribute('data-category') || 'all';
			var cardDiet = card.getAttribute('data-diet') || '';
			var cardId = card.getAttribute('data-id') || '';
			var cardTitle = normalizePersian(card.getAttribute('data-title') || '');
			var cardCatName = normalizePersian(card.getAttribute('data-category-name') || '');

			// الف) تطابق دسته‌بندی
			var matchCat = (state.category === 'all' || cardCat === state.category);

			// ب) تطابق رژیم غذایی یا علاقه‌مندی‌ها
			var matchDiet = true;
			if (state.diet === 'favorite') {
				matchDiet = (state.favorites.indexOf(cardId) !== -1);
			} else if (state.diet) {
				matchDiet = (cardDiet.indexOf(state.diet) !== -1);
			}

			// ج) تطابق جست‌وجو
			var matchSearch = true;
			if (normSearch) {
				matchSearch = (cardTitle.indexOf(normSearch) !== -1 || cardCatName.indexOf(normSearch) !== -1);
			}

			// نتیجه کلی تطابق
			if (matchCat && matchDiet && matchSearch) {
				card.classList.remove('hidden');
				visibleCards.push(card);
			} else {
				card.classList.add('hidden');
			}
		});

		// مرتب‌سازی کارت‌های قابل مشاهده
		visibleCards.sort(function (a, b) {
			if (state.sort === 'rating') {
				var rA = parseFloat(a.getAttribute('data-rating')) || 0;
				var rB = parseFloat(b.getAttribute('data-rating')) || 0;
				return rB - rA;
			} else if (state.sort === 'price-asc') {
				var pA = parseInt(a.getAttribute('data-price'), 10) || 0;
				var pB = parseInt(b.getAttribute('data-price'), 10) || 0;
				return pA - pB;
			} else if (state.sort === 'price-desc') {
				var pA2 = parseInt(a.getAttribute('data-price'), 10) || 0;
				var pB2 = parseInt(b.getAttribute('data-price'), 10) || 0;
				return pB2 - pA2;
			} else if (state.sort === 'fastest') {
				var mA = parseInt(a.getAttribute('data-minutes'), 10) || 999;
				var mB = parseInt(b.getAttribute('data-minutes'), 10) || 999;
				return mA - mB;
			} else {
				// محبوب‌ترین (پیش‌فرض)
				var popA = parseInt(a.getAttribute('data-popular'), 10) || 0;
				var popB = parseInt(b.getAttribute('data-popular'), 10) || 0;
				if (popB !== popA) {
					return popB - popA;
				}
				var idA = parseInt(a.getAttribute('data-id'), 10) || 0;
				var idB = parseInt(b.getAttribute('data-id'), 10) || 0;
				return idA - idB;
			}
		});

		// مرتب‌سازی دوباره المان‌ها در دام (DOM)
		visibleCards.forEach(function (card) {
			if (emptyState) {
				grid.insertBefore(card, emptyState);
			} else {
				grid.appendChild(card);
			}
		});

		// به‌روزرسانی شمارنده تعداد غذاها
		if (countEl) {
			countEl.textContent = toPersianDigits(visibleCards.length) + ' غذا';
		}

		// کنترل نمایش یا مخفی‌سازی حالت خالی
		if (emptyState) {
			if (visibleCards.length === 0) {
				emptyState.classList.remove('hidden');
			} else {
				emptyState.classList.add('hidden');
			}
		}
	}

	// ۵. رویداد دکمه‌های دسته‌بندی
	function setupCategoryButtons() {
		var catButtons = document.querySelectorAll('.hv-cat-btn');
		catButtons.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var cat = btn.getAttribute('data-category') || 'all';
				state.category = cat;

				// به‌روزرسانی استایل فعال دکمه‌ها
				catButtons.forEach(function (b) {
					b.setAttribute('aria-pressed', 'false');
					b.className = 'hv-cat-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft';
				});

				btn.setAttribute('aria-pressed', 'true');
				btn.className = 'hv-cat-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-forest bg-forest text-white';

				// همگام‌سازی با URL بدون رفرش
				if (window.history && window.history.replaceState) {
					var url = new URL(window.location.href);
					if (cat === 'all') {
						url.searchParams.delete('category');
					} else {
						url.searchParams.set('category', cat);
					}
					window.history.replaceState(null, '', url.toString());
				}

				applyFiltersAndSort();
			});
		});
	}

	// ۶. رویداد دکمه‌های فیلتر رژیم غذایی
	function setupDietButtons() {
		var dietButtons = document.querySelectorAll('.hv-diet-btn');
		dietButtons.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var diet = btn.getAttribute('data-diet');

				if (state.diet === diet) {
					// لغو فیلتر فعال در صورت کلیک دوباره
					state.diet = null;
					btn.setAttribute('aria-pressed', 'false');
					btn.className = 'hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft';
				} else {
					state.diet = diet;
					dietButtons.forEach(function (b) {
						b.setAttribute('aria-pressed', 'false');
						b.className = 'hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft';
					});

					btn.setAttribute('aria-pressed', 'true');
					btn.className = 'hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-forest bg-forest text-white';
				}

				applyFiltersAndSort();
			});
		});
	}

	// ۷. رویداد فیلد جست‌وجوی زنده (Live Search) با دیبانس
	function setupLiveSearch() {
		var searchInput = document.getElementById('menu-search');
		var clearBtn = document.getElementById('menu-search-clear');
		if (!searchInput) {
			return;
		}

		var debounceTimer = null;
		searchInput.addEventListener('input', function () {
			clearTimeout(debounceTimer);
			var query = searchInput.value.trim();

			if (clearBtn) {
				if (query.length > 0) {
					clearBtn.classList.remove('hidden');
				} else {
					clearBtn.classList.add('hidden');
				}
			}

			debounceTimer = setTimeout(function () {
				state.search = query;
				applyFiltersAndSort();
			}, 160);
		});

		if (clearBtn) {
			clearBtn.addEventListener('click', function (e) {
				e.preventDefault();
				searchInput.value = '';
				clearBtn.classList.add('hidden');
				state.search = '';
				applyFiltersAndSort();
				searchInput.focus();
			});
		}
	}

	// ۸. رویداد منوی کرکره‌ای مرتب‌سازی
	function setupSortDropdown() {
		var sortSelect = document.getElementById('menu-sort');
		if (sortSelect) {
			sortSelect.addEventListener('change', function () {
				state.sort = sortSelect.value;
				applyFiltersAndSort();
			});
		}
	}

	// ۹. رویداد دکمه‌های علاقه‌مندی (قلب)
	function setupFavoriteButtons() {
		updateFavoritesCountBadge(state.favorites.length);

		var favButtons = document.querySelectorAll('.hv-fav-btn');
		favButtons.forEach(function (btn) {
			var id = btn.getAttribute('data-product-id');
			var svg = btn.querySelector('svg');

			// اعمال وضعیت ذخیره‌شده اولیه
			if (state.favorites.indexOf(id) !== -1) {
				btn.setAttribute('aria-pressed', 'true');
				if (svg) {
					svg.setAttribute('fill', 'currentColor');
					svg.classList.add('text-tomato');
					svg.classList.remove('text-muted');
				}
			}

			btn.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				var index = state.favorites.indexOf(id);
				if (index === -1) {
					state.favorites.push(id);
					btn.setAttribute('aria-pressed', 'true');
					if (svg) {
						svg.setAttribute('fill', 'currentColor');
						svg.classList.add('text-tomato');
						svg.classList.remove('text-muted');
					}
					showToast('به لیست علاقه‌مندی‌های شما اضافه شد.');
				} else {
					state.favorites.splice(index, 1);
					btn.setAttribute('aria-pressed', 'false');
					if (svg) {
						svg.setAttribute('fill', 'none');
						svg.classList.remove('text-tomato');
						svg.classList.add('text-muted');
					}
					showToast('از لیست علاقه‌مندی‌ها حذف شد.');
				}

				saveFavorites(state.favorites);
				updateFavoritesCountBadge(state.favorites.length);

				// اگر فیلتر فعال، بخش ذخیره‌شده‌ها بود بلافاصله بازنشانی شود
				if (state.diet === 'favorite') {
					applyFiltersAndSort();
				}
			});
		});
	}

	// ۱۰. رویداد دکمه پاک کردن فیلترها در حالت خالی (Reset Filters)
	function setupResetButton() {
		var resetBtn = document.getElementById('hv-reset-filters');
		if (resetBtn) {
			resetBtn.addEventListener('click', function (e) {
				e.preventDefault();

				// بازنشانی جست‌وجو
				var searchInput = document.getElementById('menu-search');
				var clearBtn = document.getElementById('menu-search-clear');
				if (searchInput) {
					searchInput.value = '';
				}
				if (clearBtn) {
					clearBtn.classList.add('hidden');
				}
				state.search = '';

				// بازنشانی دسته‌بندی به همه غذاها
				state.category = 'all';
				var catButtons = document.querySelectorAll('.hv-cat-btn');
				catButtons.forEach(function (b) {
					var cat = b.getAttribute('data-category');
					if (cat === 'all') {
						b.setAttribute('aria-pressed', 'true');
						b.className = 'hv-cat-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-forest bg-forest text-white';
					} else {
						b.setAttribute('aria-pressed', 'false');
						b.className = 'hv-cat-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft';
					}
				});

				// بازنشانی رژیم غذایی
				state.diet = null;
				var dietButtons = document.querySelectorAll('.hv-diet-btn');
				dietButtons.forEach(function (b) {
					b.setAttribute('aria-pressed', 'false');
					b.className = 'hv-diet-btn round inline-flex h-10 shrink-0 items-center gap-2 rounded-full border px-4 text-[14px] font-medium transition-colors duration-[var(--duration-fast)] prs:scale-[0.97] border-line-strong bg-white text-ink hov:border-forest hov:bg-lime-soft';
				});

				// بازنشانی مرتب‌سازی به محبوب‌ترین
				state.sort = 'popular';
				var sortSelect = document.getElementById('menu-sort');
				if (sortSelect) {
					sortSelect.value = 'popular';
				}

				// پاک کردن پارامتر از URL
				if (window.history && window.history.replaceState) {
					var url = new URL(window.location.href);
					url.searchParams.delete('category');
					window.history.replaceState(null, '', url.toString());
				}

				applyFiltersAndSort();
			});
		}
	}

	// ۱۱. همگام‌سازی وضعیت اولیه با پارامترهای آدرس URL
	function syncWithUrlParams() {
		if (!window.location.search) {
			return;
		}

		var params = new URLSearchParams(window.location.search);
		var catParam = params.get('category');
		if (catParam) {
			var matchingCatBtn = document.querySelector('.hv-cat-btn[data-category="' + catParam + '"]');
			if (matchingCatBtn) {
				matchingCatBtn.click();
			}
		}

		var searchParam = params.get('s') || params.get('search');
		if (searchParam) {
			var searchInput = document.getElementById('menu-search');
			if (searchInput) {
				searchInput.value = searchParam;
				state.search = searchParam;
				var clearBtn = document.getElementById('menu-search-clear');
				if (clearBtn) {
					clearBtn.classList.remove('hidden');
				}
				applyFiltersAndSort();
			}
		}
	}

	// ۱۲. رویداد افزودن آژاکس به سبد خرید ووکامرس (AJAX Add to Cart)
	$(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {
		if ($button && $button.length) {
			var card = $button.closest('article');
			var itemName = 'غذا';
			if (card.length) {
				var heading = card.find('h3');
				if (heading.length) {
					itemName = heading.text().trim();
				}
			}

			$button.addClass('bg-leaf-2 ring-2 ring-leaf ring-offset-2');
			setTimeout(function () {
				$button.removeClass('bg-leaf-2 ring-2 ring-leaf ring-offset-2');
			}, 800);

			var cartUrl = (window.hashvichData && window.hashvichData.cartUrl) ? window.hashvichData.cartUrl : '/cart/';
			var viewCart = (window.hashvichData && window.hashvichData.viewCart) ? window.hashvichData.viewCart : 'مشاهده سبد';
			showToast('«' + itemName + '» به سبد خرید شما اضافه شد.', cartUrl, viewCart);
		}
	});

	// مقداردهی اولیه پس از بارگذاری DOM
	$(document).ready(function () {
		setupCategoryButtons();
		setupDietButtons();
		setupLiveSearch();
		setupSortDropdown();
		setupFavoriteButtons();
		setupResetButton();
		syncWithUrlParams();
	});

})(jQuery);
