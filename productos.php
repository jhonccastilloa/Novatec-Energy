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

$title = $subcategory ? $subcategory['subcategory'] : ($category ? $category['category'] : 'Productos');
$pageDescription = $subcategory
    ? 'Contamos con productos de ' . $subcategory['subcategory'] . ' en ' . $category['category'] . ' para proyectos de energias renovables en Novatec Energy.'
    : ($category
    ? 'Contamos con productos de ' . $category['category'] . ' para proyectos de energias renovables en Novatec Energy.'
    : 'Contamos con los mejores productos cuando se trata de energía renovables de toda la región del sur');
$canonical = $subcategory && $category
    ? site_url(subcategory_path($category, $subcategory))
    : ($category ? site_url(category_path($category)) : site_url('productos'));
$breadcrumbs = [
    ['name' => 'Inicio', 'url' => 'index'],
    ['name' => 'Productos', 'url' => 'productos'],
];
if ($category) {
    $breadcrumbs[] = ['name' => $category['category'], 'url' => category_path($category)];
}
if ($subcategory && $category) {
    $breadcrumbs[] = ['name' => $subcategory['subcategory'], 'url' => subcategory_path($category, $subcategory)];
}
$pageSeo = [
    'title' => $title . ' | La mejor calidad y mejores precios en Novatec Energy',
    'description' => $pageDescription,
    'canonical' => $canonical,
    'path' => 'productos',
    'breadcrumbs' => $breadcrumbs,
];
$categories = get_categories();
$subcategories = $category ? get_subcategories_by_category((int) $category['id']) : [];
$products = get_products($category ? (int) $category['id'] : null, null, $subcategory ? (int) $subcategory['id'] : null);

render_public_head($pageSeo, [
    'styles' => ['https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'],
    'extra_head' => '<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>',
]);
render_site_header();
render_breadcrumb('Productos', 'Contamos con los mejores Productos');
?>

<div class="product-section mt-30 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-category">
                    <h3>Categorias:</h3>
                    <ul>
                        <a href="<?php echo e(url_path('productos')); ?>">
                            <li class="<?php echo !$category ? 'active' : ''; ?>" data-filter="*">Todo</li>
                        </a>
                        <?php foreach ($categories as $row) { ?>
                            <a href="<?php echo e(category_url($row)); ?>">
                                <li class="<?php echo ($category && ((int) $row['id'] === (int) $category['id'])) ? 'active' : ''; ?>"><?php echo e($row['category']); ?></li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php if ($category) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters swiper">
                        <ul class="swiper-wrapper">
                            <li class="<?php echo !$subcategory ? 'active ' : ''; ?>swiper-slide" data-filter="*"><a href="<?php echo e(category_url($category)); ?>">Todo</a></li>
                            <?php foreach ($subcategories as $row) { ?>
                                <li class="<?php echo ($subcategory && (int) $subcategory['id'] === (int) $row['id']) ? 'active ' : ''; ?>swiper-slide" data-filter=".<?php echo (int) $row['id']; ?>"><a href="<?php echo e(subcategory_url($category, $row)); ?>"><?php echo e($row['subcategory']); ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <script>
                const swiper = new Swiper('.swiper', {
                    slidesPerView: "auto",
                    spaceBetween: 10,
                    slidesPerGroup: 3,
                    freeMode: true,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
            </script>
        <?php } ?>

        <div class="row product-lists">
            <?php foreach ($products as $row) {
                render_product_card($row, true);
            } ?>
        </div>
    </div>
</div>

<?php render_site_footer(); ?>
