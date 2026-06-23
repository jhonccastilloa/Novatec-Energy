<?php
require_once __DIR__ . '/includes/components.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$slug = trim((string) ($_GET['slug'] ?? ''));
if (!$id && isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = (int) $_GET['id'];
}

if (!$id) {
    header('location: productos.php');
    exit;
}

$row = get_product((int) $id);
if (!$row && $slug !== '') {
    $row = get_product_by_slug($slug);
}
if (!$row) {
    header('location: productos.php');
    exit;
}

$canonicalPath = product_path($row);
if (current_request_path() !== $canonicalPath) {
    $location = product_url($row);

    header('Location: ' . $location, true, 301);
    exit;
}

$title = $row['nombre'];
$pageDescription = seo_product_description($row);
$pageSeo = [
    'title' => $title . ' en ' . seo_local_market_label() . ' | Novatec Energy',
    'description' => $pageDescription,
    'canonical' => site_url($canonicalPath),
    'path' => $canonicalPath,
    'image' => product_image_url($row),
    'type' => 'product',
    'breadcrumbs' => [
        ['name' => 'Inicio', 'url' => ''],
        ['name' => 'Productos', 'url' => 'productos'],
        ['name' => $title, 'url' => $canonicalPath],
    ],
    'schema' => [product_schema($row)],
];
$link = site_url($canonicalPath);
$message = product_whatsapp_message($row);
$relatedProducts = get_related_products(
    (int) $row['id'],
    (int) $row['id_categoria'],
    (int) $row['id_subcategory']
);

render_public_head($pageSeo);
render_site_header();
render_breadcrumb($title . ' en ' . seo_local_market_label(), 'Ficha técnica y cotización por WhatsApp');
?>

<div class="single-product pt-150 mb-150" id="text-description">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <?php if (product_has_image($row)) { ?>
                <img class="img-product" src="<?php echo e(product_image_src($row)); ?>" alt="<?php echo e($row['nombre']); ?>">
                <?php } else { ?>
                <div class="product-image-placeholder product-image-placeholder--detail" role="img" aria-label="Imagen pendiente">
                    <i class="fas fa-image" aria-hidden="true"></i>
                    <!-- <span>Imagen pendiente</span> -->
                </div>
                <?php } ?>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h2><?php echo e($row['nombre']); ?></h2>
                    <?php if (product_has_price($row)) { ?>
                    <p class="single-product-pricing">S/.<?php echo e(number_format(product_effective_price($row), 2)); ?></p>
                    <?php } else { ?>
                    <p class="single-product-pricing">Precio a consultar</p>
                    <?php } ?>
                    <p><?php echo e($row['breve_descripcion']); ?></p>
                    <div class="single-product-form">
                        <p><strong>Categoría: </strong><?php echo e(($row['category'] ?? '') . '/' . ($row['subcategory'] ?? '')); ?></p>
                        <br>
                        <a href="<?php echo e(whatsapp_url($message)); ?>" class="whatsapp-contact-btn" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp" aria-hidden="true"></i> Consultar por WhatsApp</a>
                    </div>
                    <h4>Compartir:</h4>
                    <ul class="product-share">
                        <li><a href="http://www.facebook.com/sharer.php?u=<?php echo e(rawurlencode($link)); ?>&amp;t=pagina de desarrollo web" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/intent/tweet?url=<?php echo e(rawurlencode($link)); ?>&amp;hashtags=#NovatecEnergy" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product mt-150 mb-150">
    <div class="container text-description">
        <?php echo $row['descripcion']; ?>
    </div>
</div>

<?php if ($relatedProducts !== []) { ?>
<div class="product-section mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h3>Productos <span class="orange-text">relacionados</span></h3>
                </div>
            </div>
        </div>
        <div class="row product-lists">
            <?php foreach ($relatedProducts as $relatedProduct) {
                render_product_card($relatedProduct);
            } ?>
        </div>
    </div>
</div>
<?php } ?>

<?php
render_site_footer();
?>
