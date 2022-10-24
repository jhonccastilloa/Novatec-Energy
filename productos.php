<?php
require("./administrador/conection.php");
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
					<div class="product-filters">
						<ul>
							<li class="active" data-filter="*">Todo</li>
							<?php
							$query = "SELECT * FROM subcategory";
							if (isset($_REQUEST['categoria'])) {
								$query = "SELECT * FROM subcategory WHERE id_category={$_REQUEST['categoria']}";
							}
							$result = $conn->query($query);
							while ($row = $result->fetch_assoc()) {
							?>
								<li data-filter=".<?php echo $row['id'] ?>"><?php echo $row['subcategory'] ?></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		<?php } ?>
<!-- sub category section end-->


<!-- products -->

		<div class="row product-lists">
			<?php
			$query = "SELECT * FROM productos ";

			if (isset($_REQUEST['categoria'])) {
				$query = "SELECT * FROM productos WHERE id_categoria={$_REQUEST['categoria']}";
			}
			$result = $conn->query($query);
			while ($row = $result->fetch_assoc()) {
			$nameImage=$row['imagen'];
			$imageExtencion=pathinfo($nameImage,PATHINFO_EXTENSION);
			$image=basename($nameImage,'.'.$imageExtencion);
			?>
				<div class="col-lg-4 col-md-6 text-center card-content <?php echo $row['id_subcategory'] ?> ">
					<div class="single-product-item">
						<div class="product-image" width="300" height="300">
							<a href="producto.php?id=<?php echo $row['id'] ?>"><img src="./imgProducts/<?php echo $row['id'] ?>/<?php echo $row['imagen']; ?>" alt="<?php echo $image?>" width="300" height="300"></a>
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