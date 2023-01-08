<?php
require("./administrador/conection.php");
if (isset($_REQUEST['categoria'])) {
	$id = $_REQUEST['categoria'];
	$query = "SELECT category FROM category WHERE id=" . $id;
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$title = $row['category'];
} else {
	$title = "Productos";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- title -->
	<title><?= $title ?> | La mejor calidad y mejores precios en Novatec Energy</title>
	<meta name="description" content="Contamos con los mejores productos cuando se trata de energía renovables de toda la región del sur">

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

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

</head>
<?php
include_once("head.php");
?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Contamos con los mejores Productos</p>
					<h1>Productos</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- category section-->
<div class="product-section mt-30 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-category">
					<h3>Categorias:</h3>
					<ul>
						<a href="productos.php">
							<li class="<?php echo (!isset($_REQUEST['categoria']) ? 'active' : '') ?>" data-filter="*">Todo</li>
						</a>
						<?php
						$query = "SELECT * FROM category";
						$result = $conn->query($query);
						while ($row = $result->fetch_assoc()) {
						?>
							<a href="productos.php?categoria=<?php echo $row['id'] ?>">
								<li class="<?php echo ((isset($_REQUEST['categoria']) and ($row['id'] == $_REQUEST['categoria'])) ? 'active' : '') ?>"><?php echo $row['category'] ?></li>
							</a>

						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<!-- category section end -->

		<!-- sub category section -->
		<?php
		if (isset($_REQUEST['categoria'])) {
		?>
			<div class="row">
				<div class="col-md-12">
					<div class="product-filters swiper">
						<ul class="swiper-wrapper">
							<li class="active swiper-slide" data-filter="*">Todo</li>
							<?php
							$query = "SELECT * FROM subcategory";
							if (isset($_REQUEST['categoria'])) {
								$query = "SELECT * FROM subcategory WHERE id_category={$_REQUEST['categoria']}";
							}
							$result = $conn->query($query);
							while ($row = $result->fetch_assoc()) {
							?>
								<li class="swiper-slide" data-filter=".<?php echo $row['id'] ?>"><?php echo $row['subcategory'] ?></li>
							<?php
							}
							?>
						</ul>
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>
		<?php } ?>
		<!-- sub category section end-->

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

				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},

			});
		</script>
		<!-- products -->

		<div class="row product-lists">
			<?php
			$query = "SELECT * FROM productos ";

			if (isset($_REQUEST['categoria'])) {
				$query = "SELECT * FROM productos WHERE id_categoria={$_REQUEST['categoria']}";
			}
			$result = $conn->query($query);
			while ($row = $result->fetch_assoc()) {
				$array = explode('.', $row['imagen']);
				$ext = end($array);
				$nameImage = $row['imagen'];
				$imageExtencion = pathinfo($nameImage, PATHINFO_EXTENSION);
				$image = basename($nameImage, '.' . $imageExtencion);
			?>
				<div class="col-lg-4 col-md-6 text-center card-content <?php echo $row['id_subcategory'] ?> ">
					<div class="single-product-item">
						<div class="product-image" width="300" height="300">
							<a href="producto.php?id=<?php echo $row['id'] ?>"><img src="./productsImg/<?php echo $row['id'] . '.' . $ext ?>" alt="<?php echo $image ?>" width="300" height="300"></a>
						</div>
						<h3><?php echo $row['nombre'] ?></h3>
						<p class="product-price"> S/.<?php echo $row['precio_normal'] ?> </p>
						<a href="producto.php?id=<?php echo $row['id'] ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Leer Mas</a>
					</div>
				</div>
			<?php
			}
			?>

		</div>
	</div>
</div>
<!-- end products -->

<?php
include_once("footer.php");

?>