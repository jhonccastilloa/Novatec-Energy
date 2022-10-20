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
					<p>Productos de Calidad</p>
					<h1>Productos</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- products -->
<div class="product-section mt-30 mb-150">
	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<div class="product-category">
					<h3>Categoria:</h3>
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


		<div class="row product-lists">
			<?php
			$query = "SELECT * FROM productos ";

			if (isset($_REQUEST['categoria'])) {
				$query = "SELECT * FROM productos WHERE id_categoria={$_REQUEST['categoria']}";
			}
			$result = $conn->query($query);
			while ($row = $result->fetch_assoc()) {
			?>
				<div class="col-lg-4 col-md-6 text-center <?php echo $row['id_subcategory'] ?> ">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="./imgProducts/<?php echo $row['id'] ?>/<?php echo $row['imagen']; ?>" alt=""></a>
						</div>
						<h3><?php echo $row['nombre'] ?></h3>
						<p class="product-price"><span>S/.</span> S/.<?php echo $row['precio_normal'] ?> </p>
						<a href="producto.php?id=<?php echo $row['id'] ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Leer Mas</a>
					</div>
				</div>

			<?php
			}
			?>

		</div>

		<div class="row">
			<div class="col-lg-12 text-center">
				<div class="pagination-wrap">
					<ul>
						<li><a href="#">Prev</a></li>
						<li><a href="#">1</a></li>
						<li><a class="active" href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end products -->



<?php

include_once("footer.php");



?>
<script>

</script>

<?php

?>