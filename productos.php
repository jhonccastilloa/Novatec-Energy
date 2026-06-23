<?php
require_once __DIR__ . '/includes/components.php';

$legacyCategoryId = filter_input(INPUT_GET, 'categoria', FILTER_VALIDATE_INT);
if ($legacyCategoryId) {
    $legacyCategory = get_category((int) $legacyCategoryId);
    if ($legacyCategory) {
        header('Location: ' . category_url($legacyCategory), true, 301);
        exit;
    }
}

$categorySlug = trim((string) ($_GET['category_slug'] ?? ''));
$subcategorySlug = trim((string) ($_GET['subcategory_slug'] ?? ''));
$category = $categorySlug !== '' ? get_category_by_slug($categorySlug) : null;
$subcategory = null;

if ($categorySlug !== '' && !$category) {
    http_response_code(404);
}

if ($category && $subcategorySlug !== '') {
    $subcategory = get_subcategory_by_slug((int) $category['id'], $subcategorySlug);
    if (!$subcategory) {
        http_response_code(404);
    }
}

$title = $subcategory ? $subcategory['subcategory'] : ($category ? $category['category'] : 'Productos solares y renovables');
$pageDescription = seo_catalog_description($title, $category, $subcategory);
$canonical = $subcategory && $category
    ? site_url(subcategory_path($category, $subcategory))
    : ($category ? site_url(category_path($category)) : site_url('productos'));
$breadcrumbs = [
    ['name' => 'Inicio', 'url' => ''],
    ['name' => 'Productos', 'url' => 'productos'],
];
if ($category) {
    $breadcrumbs[] = ['name' => $category['category'], 'url' => category_path($category)];
}
if ($subcategory && $category) {
    $breadcrumbs[] = ['name' => $subcategory['subcategory'], 'url' => subcategory_path($category, $subcategory)];
}
$categories = get_categories();
$subcategories = $category ? get_subcategories_by_category((int) $category['id']) : [];
$products = get_products($category ? (int) $category['id'] : null, null, $subcategory ? (int) $subcategory['id'] : null);
$catalogTitle = seo_catalog_title($title);
$pageSeo = [
    'title' => $catalogTitle,
    'description' => $pageDescription,
    'canonical' => $canonical,
    'path' => 'productos',
    'breadcrumbs' => $breadcrumbs,
    'schema' => [product_item_list_schema($products, $catalogTitle)],
];

render_public_head($pageSeo, [
    'styles' => ['https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'],
    'extra_head' => <<<'HTML'
<script>
	(function () {
		try {
			if (sessionStorage.getItem('novatecProductsScrollY') !== null) {
				document.documentElement.classList.add('novatec-products-restoring-scroll');
				window.setTimeout(function () {
					document.documentElement.classList.remove('novatec-products-restoring-scroll');
				}, 1500);
			}
		} catch (error) {
			document.documentElement.classList.remove('novatec-products-restoring-scroll');
		}
	})();
</script>
<style>
	html.novatec-products-restoring-scroll body {
		visibility: hidden;
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
HTML,
]);
render_site_header();
render_breadcrumb($title . ' en ' . seo_local_market_label(), 'Venta y asesoría técnica para proyectos solares');
?>

<div class="product-section mt-30 mb-150">
    <div class="container">
        <nav class="product-catalog-nav" aria-label="Filtros de productos">
            <div class="product-catalog-filter">
                <p class="product-catalog-filter-label" id="product-category-label">Categorías:</p>
                <div class="product-catalog-chip-scroll">
                    <ul class="product-catalog-chips" aria-labelledby="product-category-label">
                        <li>
                            <a href="<?php echo e(url_path('productos')); ?>" class="<?php echo !$category ? 'is-active' : ''; ?>" <?php echo !$category ? ' aria-current="page"' : ''; ?>>Todo</a>
                        </li>
                        <?php foreach ($categories as $row) {
                            $isActiveCategory = $category && ((int) $row['id'] === (int) $category['id']);
                        ?>
                            <li>
                                <a href="<?php echo e(category_url($row)); ?>" class="<?php echo $isActiveCategory ? 'is-active' : ''; ?>" <?php echo $isActiveCategory ? ' aria-current="page"' : ''; ?>><?php echo e($row['category']); ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <?php if ($category && $subcategories !== []) { ?>
                <div class="product-catalog-filter product-catalog-subcategory-filter">
                    <div class="product-catalog-chip-scroll">
                        <ul class="product-catalog-chips" aria-labelledby="product-subcategory-label">
                            <li>
                                <a href="<?php echo e(category_url($category)); ?>" class="<?php echo !$subcategory ? 'is-active' : ''; ?>" <?php echo !$subcategory ? ' aria-current="page"' : ''; ?>>Todo</a>
                            </li>
                            <?php foreach ($subcategories as $row) {
                                $isActiveSubcategory = $subcategory && ((int) $subcategory['id'] === (int) $row['id']);
                            ?>
                                <li>
                                    <a href="<?php echo e(subcategory_url($category, $row)); ?>" class="<?php echo $isActiveSubcategory ? 'is-active' : ''; ?>" <?php echo $isActiveSubcategory ? ' aria-current="page"' : ''; ?>><?php echo e($row['subcategory']); ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </nav>

        <div class="row product-lists">
            <?php foreach ($products as $row) {
                render_product_card($row, true);
            } ?>
        </div>
    </div>
</div>

<?php
render_site_footer([
    'scripts' => [<<<'HTML'
	<script>
		(function () {
			var scrollKey = 'novatecProductsScrollY';
			var restoringClass = 'novatec-products-restoring-scroll';
			var nextFrame = window.requestAnimationFrame || function (callback) {
				return window.setTimeout(callback, 0);
			};

			function showPage() {
				document.documentElement.classList.remove(restoringClass);
			}

			function restoreScroll() {
				var savedScroll = null;

				try {
					savedScroll = sessionStorage.getItem(scrollKey);
				} catch (error) {
					showPage();
					return;
				}

				var scrollY = savedScroll !== null ? parseInt(savedScroll, 10) : NaN;

				try {
					sessionStorage.removeItem(scrollKey);
				} catch (error) {
				}

				if (isNaN(scrollY) || scrollY < 0) {
					showPage();
					return;
				}

				nextFrame(function () {
					window.scrollTo(0, scrollY);
					nextFrame(showPage);
				});
			}

			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', restoreScroll);
			} else {
				restoreScroll();
			}

			document.addEventListener('click', function (event) {
				var link = event.target.closest('.product-catalog-nav a');

				if (!link) {
					return;
				}

				var href = link.getAttribute('href');

				if (!href || href === '#') {
					return;
				}

				try {
					sessionStorage.setItem(scrollKey, String(window.scrollY || window.pageYOffset || 0));
				} catch (error) {
				}
			});
		})();
	</script>
HTML],
]);
?>