<?php
require_once __DIR__ . '/includes/components.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id && isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = (int) $_GET['id'];
}

if (!$id) {
    header('location: productos.php');
    exit;
}

$row = get_product((int) $id);
if (!$row) {
    header('location: productos.php');
    exit;
}

$canonicalPath = product_path($row);
if (current_request_path() !== $canonicalPath) {
    $location = product_url($row);
    if (isset($_GET['click'])) {
        $location .= '?click=1#text-description';
    }

    header('Location: ' . $location, true, 301);
    exit;
}

$title = $row['nombre'];
$ext = image_extension((string) $row['imagen']);
$pageDescription = excerpt($row['breve_descripcion'] ?: 'Novatec Energy | Tienda especializada en produtos de energias renovables', 155);
$pageSeo = [
    'title' => $title . ' | Novatec Energy',
    'description' => $pageDescription,
    'canonical' => site_url($canonicalPath),
    'path' => $canonicalPath,
    'image' => product_image_relative($row),
    'type' => 'product',
    'breadcrumbs' => [
        ['name' => 'Inicio', 'url' => 'index'],
        ['name' => 'Productos', 'url' => 'productos'],
        ['name' => $title, 'url' => $canonicalPath],
    ],
    'schema' => [product_schema($row)],
];
$link = site_url($canonicalPath);
$message = 'Estoy interesado en el ' . $row['nombre'] . "\n" . $link;

render_public_head($pageSeo);
render_site_header();
render_breadcrumb('Detalles del producto');
?>

<div class="single-product pt-150 mb-150" id="text-description">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img class="img-product" src="<?php echo e(asset_url('productsImg/' . (int) $row['id'] . '.' . $ext)); ?>" alt="<?php echo e($row['nombre']); ?>">
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3><?php echo e($row['nombre']); ?></h3>
                    <p class="single-product-pricing"> S/.<?php echo e($row['precio_normal']); ?></p>
                    <p><?php echo e($row['breve_descripcion']); ?></p>
                    <div class="single-product-form">
                        <p><strong>Categoria: </strong><?php echo e(($row['category'] ?? '') . '/' . ($row['subcategory'] ?? '')); ?></p>
                        <br>
                        <a href="<?php echo e(whatsapp_url($message)); ?>" class="cart-btn" target="_blank"><i class="fab fa-whatsapp "></i> Contactar via WhatsApp</a>
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

<a id="click" href="#text-description" hidden>click</a>

<?php
$scripts = [];
if (isset($_GET['click'])) {
    $scripts[] = '<script>document.getElementById("click").click();</script>';
}

render_site_footer(['scripts' => $scripts]);
?>
