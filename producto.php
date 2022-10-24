<?php 
require("./administrador/conection.php");
include_once("head.php");
if(!isset($_REQUEST['id'])){
	header("location: productos.php");
}

$id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : "";

$query = "SELECT productos.id,productos.nombre,productos.descripcion,productos.precio_normal,productos.cantidad,productos.imagen,category.category,subcategory.subcategory 
FROM productos LEFT JOIN category ON productos.id_categoria = category.id LEFT JOIN subcategory ON productos.id_subcategory=subcategory.id WHERE productos.id='{$id}'";

$result = $conn->query($query);
$row = $result->fetch_assoc();

$url=$_SERVER["HTTP_HOST"].$host= $_SERVER["REQUEST_URI"];
$message='Estoy interesado en el '.$row['nombre'].'%0A'.'https://'.$url;

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
						<img src="./imgProducts/<?php echo $row['id'] ?>/<?php echo $row['imagen']; ?>" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3><?php echo $row['nombre'] ?></h3>
						<p class="single-product-pricing">  S/.<?php echo $row['precio_normal'] ?></p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi cum voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi perferendis eos eum modi! Tempora, earum.</p>
						<div class="single-product-form">
						<p><strong>Categoria: </strong><?php echo $row['category']."/".$row['subcategory']?></p>
							<br>
							<a href="https://api.whatsapp.com/send?phone=941882754&text=<?php echo $message ?>" class="cart-btn" target="_blank"><i class="fab fa-whatsapp "></i> Contactar via WhatsApp</a>
							<!-- <p><strong>Categories: </strong>Fruits, Organic</p> -->
						</div>
						<!-- <h4>Share:</h4>
						<ul class="product-share">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul> -->
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