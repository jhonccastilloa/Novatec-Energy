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
								<img class="logo-menu" src="assets/img/logo.png" alt="Logo de Novatec Energy">
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
										$acento=eliminar_acentos($row['category']);
										$name=strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $acento), '-'));
										?>
											<li><a href="productos?categoria=<?php echo $row['id'] ?>&nombre=<?php echo $name ?>"><?php echo $row['category'] ?></a></li>

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
	<?php
	function eliminar_acentos($cadena){
		
		//Reemplazamos la A y a
		$cadena = str_replace(
		array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
		array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
		$cadena
		);

		//Reemplazamos la E y e
		$cadena = str_replace(
		array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
		array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
		$cadena );

		//Reemplazamos la I y i
		$cadena = str_replace(
		array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
		array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
		$cadena );

		//Reemplazamos la O y o
		$cadena = str_replace(
		array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
		array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
		$cadena );

		//Reemplazamos la U y u
		$cadena = str_replace(
		array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
		array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
		$cadena );

		//Reemplazamos la N, n, C y c
		$cadena = str_replace(
		array('Ñ', 'ñ', 'Ç', 'ç'),
		array('N', 'n', 'C', 'c'),
		$cadena
		);
		
		return $cadena;
	}
	?>