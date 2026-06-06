<?php
require("./administrador/conection.php");
require_once __DIR__ . '/includes/seo.php';
security_headers();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
	header("location: productos.php");
	exit;
}

$row = get_product((int) $id);
if (!$row) {
	header("location: productos.php");
	exit;
}

$title = $row['nombre'];
$ext = image_extension((string) $row['imagen']);
$pageDescription = excerpt($row['breve_descripcion'] ?: 'Novatec Energy | Tienda especializada en produtos de energias renovables', 155);
$pageSeo = [
	'title' => $title . ' | Novatec Energy',
	'description' => $pageDescription,
	'canonical' => site_url('producto.php?id=' . (int) $row['id']),
	'path' => 'producto.php',
	'image' => product_image_relative($row),
	'type' => 'product',
	'breadcrumbs' => [
		['name' => 'Inicio', 'url' => 'index'],
		['name' => 'Productos', 'url' => 'productos'],
		['name' => $title, 'url' => 'producto.php?id=' . (int) $row['id']],
	],
	'schema' => [product_schema($row)],
];
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- title -->
	<title><?php echo e($pageSeo['title']); ?></title>
	<meta name="description" content="<?php echo e($pageDescription); ?>">
	<?php render_seo_tags($pageSeo); ?>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>
<?php
include_once("head.php");

$link = site_url('producto.php?id=' . (int) $row['id']);
$message = rawurlencode('Estoy interesado en el ' . $row['nombre'] . "\n" . $link);

?>


<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1> Detalles del producto</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- single product -->
<div class="single-product pt-150 mb-150" id="text-description">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<img class="img-product" src="./productsImg/<?php echo (int) $row['id'] . '.' . e($ext) ?>" alt="<?php echo e($row['nombre']) ?>">
			</div>
			<div class="col-md-7">
				<div class="single-product-content">
					<h3><?php echo e($row['nombre']) ?></h3>
					<p class="single-product-pricing"> S/.<?php echo e($row['precio_normal']) ?></p>
					<p><?php echo e($row['breve_descripcion']) ?></p>
					<div class="single-product-form">
						<p><strong>Categoria: </strong><?php echo e(($row['category'] ?? '') . "/" . ($row['subcategory'] ?? '')) ?></p>
						<br>
						<a href="https://api.whatsapp.com/send?phone=+51 951828275&amp;text=<?php echo e($message) ?>" class="cart-btn" target="_blank"><i class="fab fa-whatsapp "></i> Contactar via WhatsApp</a>
						<!-- <p><strong>Categories: </strong>Fruits, Organic</p> -->
					</div>
					<h4>Compartir:</h4>
					<ul class="product-share">
						<li><a href="http://www.facebook.com/sharer.php?u=<?php echo e(rawurlencode($link)) ?>&amp;t=pagina de desarrollo web" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="https://twitter.com/intent/tweet?url=<?php echo e(rawurlencode($link)) ?>&amp;hashtags=#NovatecEnergy" target="_blank"><i class="fab fa-twitter"></i></a></li>

					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end single product -->
<div class="single-product mt-150 mb-150">
	<div class="container text-description">

		<?php echo $row['descripcion'] ?>


	</div>
</div>

<a id="click" href="#text-description" hidden>click</a>

<?php
if (isset($_GET['click'])) {
?>
	<script>
		document.getElementById("click").click();
	</script>
<?php
}
include_once("footer.php")
?>
