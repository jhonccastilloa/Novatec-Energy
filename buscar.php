<?php
require_once __DIR__ . '/includes/components.php';

$product = trim((string) ($_GET['producto'] ?? ''));
$categoryId = filter_input(INPUT_GET, 'categoria', FILTER_VALIDATE_INT);
$pageDescription = 'Resultados de busqueda de productos de energia renovable en Novatec Energy.';
$pageSeo = [
    'title' => 'Buscar | Novatec Energy',
    'description' => $pageDescription,
    'canonical' => site_url('buscar'),
    'path' => 'buscar',
    'robots' => 'noindex,follow',
];
$products = $product !== '' ? get_products($categoryId ?: null, $product) : [];

render_public_head($pageSeo);
render_site_header();
render_breadcrumb($product, 'BUSCANDO:');
?>

<div class="product-section mt-30 mb-150">
    <div class="container">
        <br>
        <br>
        <div class="row product-lists">
            <?php if ($product !== '' && count($products) > 0) { ?>
                <?php foreach ($products as $row) {
                    render_product_card($row);
                } ?>
            <?php } elseif ($product !== '') { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <p class="text-search"> No se encontraron resultados</p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center text-search">
                            <p class="text-search"> Busque Algún Producto</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php render_site_footer(); ?>
