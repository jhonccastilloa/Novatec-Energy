<?php
require("./administrador/conection.php");
if (!isset($_REQUEST['id'])) {
	header("location: productos.php");
} else {
	$id = $_REQUEST['id'];
	$query = "SELECT id,nombre,imagen FROM productos WHERE id=" . $id;
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$title = $row['nombre'];
	$array = explode('.', $row['imagen']);
	$ext = end($array);
}
$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];


?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- title -->
	<title><?= $title ?> | Novatec Energy</title>
	<meta name="description" content="Novatec Energy | Tienda especializada en produtos de energias renovables">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= $url ?>">
	<meta property="og:title" content="<?= $title ?> | Novatec Energy">
	<meta property="og:description" content="Novatec Energy | Tienda especializada en produtos de energias renovables">
	<meta property="og:image" content="https://<?= $_SERVER["SERVER_NAME"] ?>/Novatec-Energy/productsImg/<?php echo $row['id'] . '.' . $ext ?>">

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


$id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : "";

$query = "SELECT productos.id,productos.nombre,productos.descripcion,productos.precio_normal,productos.breve_descripcion,productos.imagen,category.category,subcategory.subcategory 
FROM productos LEFT JOIN category ON productos.id_categoria = category.id LEFT JOIN subcategory ON productos.id_subcategory=subcategory.id WHERE productos.id='{$id}'";

$result = $conn->query($query);
$row = $result->fetch_assoc();

$array = explode('.', $row['imagen']);
$ext = end($array);
$url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$message = 'Estoy interesado en el ' . $row['nombre'] . '%0A' . 'https://' . $url;
$link= 'https://' .$url;

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
<div class="single-product mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="product-image">
					<img src="./productsImg/<?php echo $row['id'] . '.' . $ext ?>" alt="">
				</div>
			</div>
			<div class="col-md-7">
				<div class="single-product-content">
					<h3><?php echo $row['nombre'] ?></h3>
					<p class="single-product-pricing"> S/.<?php echo $row['precio_normal'] ?></p>
					<p><?= $row['breve_descripcion'] ?></p>
					<div class="single-product-form">
						<p><strong>Categoria: </strong><?php echo $row['category'] . "/" . $row['subcategory'] ?></p>
						<br>
						<a href="https://api.whatsapp.com/send?phone=+51 951828275&text=<?php echo $message ?>" class="cart-btn" target="_blank"><i class="fab fa-whatsapp "></i> Contactar via WhatsApp</a>
						<!-- <p><strong>Categories: </strong>Fruits, Organic</p> -->
					</div>
					<h4>Compartir:</h4>
						<ul class="product-share">
							<li><a href="http://www.facebook.com/sharer.php?u=<?php echo $link ?>&t=pagina de desarrollo web" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="https://twitter.com/intent/tweet?url=<?php echo $link ?>&hashtags=#NovatecEnergy" target="_blank"><i class="fab fa-twitter"></i></a></li>
							
						</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end single product -->

<div class="single-product mt-150 mb-150">
	<div class="container">
		<?php echo $row['descripcion'] ?>
	</div>
</div>
<!-- more products -->
<!-- <div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="assets/img/products/product-img-1.jpg" alt=""></a>
						</div>
						<h3>Strawberry</h3>
						<p class="product-price"><span>Per Kg</span> 85$ </p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="assets/img/products/product-img-2.jpg" alt=""></a>
						</div>
						<h3>Berry</h3>
						<p class="product-price"><span>Per Kg</span> 70$ </p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="assets/img/products/product-img-3.jpg" alt=""></a>
						</div>
						<h3>Lemon</h3>
						<p class="product-price"><span>Per Kg</span> 35$ </p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
			</div>
		</div>
	</div> -->
<!-- end more products -->

<?php
include_once("footer.php")
?>