<?php
require("./administrador/conection.php");
$url = $_SERVER["REQUEST_URI"];
?>


<body>
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index">
								<img src="assets/img/logo.png" alt="Logo de Novatec Energy">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="<?php echo (stripos($url, "index") ? 'current-list-item' : '') ?>"><a href="index">Inicio</a>

								</li>
								<li class="<?php echo (stripos($url, "productos") ? 'current-list-item' : '') ?>"><a href="productos">Productos</a>
									<ul class="sub-menu">
										<?php
										$query = "SELECT * FROM category";
										$result = $conn->query($query);
										while ($row = $result->fetch_assoc()) {
										?>
											<li><a href="productos?categoria=<?php echo $row['id'] ?>"><?php echo $row['category'] ?></a></li>

										<?php
										}
										?>
									</ul>
								</li>
								<li class="<?php echo (stripos($url, "nosotros") ? 'current-list-item' : '') ?>"><a href="nosotros">Nosotros</a></li>

								<li class="<?php echo (stripos($url, "contacto") ? 'current-list-item' : '') ?>"><a href="contacto">Contactenos</a></li>

								<li>
									<div class="header-icons">
										<a href="https://api.whatsapp.com/send?phone=+51 951828275&text=Hola, deseo adquirir un producto con ustedes"  target="_blank"><i class="fab fa-whatsapp "></i> 951 828 275</a>

										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<form action="buscar" method="get">
								<h3>Buesque en Novatec Energy:</h3>
								<input type="text" name="producto" placeholder="Digite un producto">
								<button type="submit">Buscar <i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->