<?php
require_once __DIR__ . '/includes/components.php';

$categoryId = filter_input(INPUT_GET, 'categoria', FILTER_VALIDATE_INT);
$category = $categoryId ? get_category((int) $categoryId) : null;
$title = $category ? $category['category'] : 'Productos';
$pageDescription = $category
    ? 'Contamos con productos de ' . $category['category'] . ' para proyectos de energias renovables en Novatec Energy.'
    : 'Contamos con los mejores productos cuando se trata de energía renovables de toda la región del sur';
$pageSeo = [
    'title' => $title . ' | La mejor calidad y mejores precios en Novatec Energy',
    'description' => $pageDescription,
    'canonical' => $category ? site_url('productos?categoria=' . (int) $category['id'] . '&nombre=' . slugify((string) $category['category'])) : site_url('productos'),
    'path' => 'productos',
    'breadcrumbs' => [
        ['name' => 'Inicio', 'url' => 'index'],
        ['name' => 'Productos', 'url' => 'productos'],
    ],
];
$categories = get_categories();
$subcategories = $category ? get_subcategories_by_category((int) $category['id']) : [];
$products = get_products($category ? (int) $category['id'] : null);

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
                            <li class="<?php echo !$categoryId ? 'active' : ''; ?>" data-filter="*">Todo</li>
                        </a>
                        <?php foreach ($categories as $row) { ?>
                            <a href="<?php echo e(category_url($row)); ?>">
                                <li class="<?php echo ($categoryId && ((int) $row['id'] === (int) $categoryId)) ? 'active' : ''; ?>"><?php echo e($row['category']); ?></li>
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
                            <li class="active swiper-slide" data-filter="*">Todo</li>
                            <?php foreach ($subcategories as $row) { ?>
                                <li class="swiper-slide" data-filter=".<?php echo (int) $row['id']; ?>"><?php echo e($row['subcategory']); ?></li>
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
