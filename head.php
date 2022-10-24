<?php
require("./administrador/conection.php");
$url = $_SERVER["REQUEST_URI"];



?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Novatec Energy</title>

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
										<a href="https://api.whatsapp.com/send?phone=941882754&text=Hola, deseo adquirir un producto con ustedes"  target="_blank"><i class="fab fa-whatsapp "></i> 951 828 275</a>

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