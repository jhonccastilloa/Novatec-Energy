<?php
// require("./administrador/conection.php");
include_once("head.php");
?>

<!-- home page slider -->
<div class="homepage-slider">
	<!-- single home slider -->
	<div class="single-homepage-slider homepage-bg-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Empresa Líder en Energía Renovable</p>
							<h1>Novatec Energy</h1>
							<div class="hero-btns">
								<a href="shop.html" class="boxed-btn">Productos</a>
								<a href="contact.html" class="bordered-btn">Contactenos</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- single home slider -->
	<div class="single-homepage-slider homepage-bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Cuidando y Construyendo un mundo mejor con energías renovables</p>
							<h1>Novatec Energy</h1>
							<div class="hero-btns">
								<a href="shop.html" class="boxed-btn">Productos</a>
								<a href="contact.html" class="bordered-btn">Contactenos</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- single home slider -->
	<div class="single-homepage-slider homepage-bg-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-right">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Contamos con los mejores productos y equipo especializado!</p>
							<h1>Tienda Especializada en Energias Renovables</h1>
							<div class="hero-btns">
								<a href="shop.html" class="boxed-btn">Productos</a>
								<a href="contact.html" class="bordered-btn">Contactenos</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end home page slider -->

<!-- features list section -->
<div class="list-section pt-80 pb-80">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-shipping-fast"></i>
					</div>
					<div class="content">
						<h3>Envio Gratis</h3>
						<p>Cuando la orden es mas de los s/.75</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-phone-volume"></i>
					</div>
					<div class="content">
						<h3>Soporte 24/7 </h3>
						<p>Obtenga soporte todos los dias</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="list-box d-flex justify-content-start align-items-center">
					<div class="list-icon">
						<i class="fas fa-sync"></i>
					</div>
					<div class="content">
						<h3>Reembolso</h3>
						<p>¡Obtenga un reembolso dentro de los 3 días!</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- end features list section -->

<!-- product category start -->
<div class="latest-news pt-150 pb-150">
	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Nuestros</span> Productos</h3>
					<p>En <strong>Novatec Energy</strong> contamos con los productos más sofisticados del mercado de la energía solar donde encontraras una gran selección de productos de buena índole</p>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
			$query = "SELECT  category.id,category.category,productos.id as 'idProduct',productos.imagen FROM category LEFT JOIN productos ON category.id=productos.id_categoria";
			$result = $conn->query($query);
			$aux = '';
			while ($row = $result->fetch_assoc()) {
				$array = explode('.', $row['imagen']);
				$ext = end($array);
				if ($row['id'] == $aux) {
					continue;
				}
			?>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<div class="product-image">
							<img src="./productsImg/<?php echo $row['idProduct'] . '.' . $ext ?>"  alt="" width="200" height="260">
						</div>
						<div class="news-text-box">
							<h3><?php echo $row['category'] ?></h3>
							<p class="excerpt">En esta sección va encontrar gran variedad de <strong><?php echo $row['category'] ?></strong> , de buena calidad y a precios muy comodos
							<p>
								<a href="productos?categoria=<?php echo $row['id'] ?>" class="read-more-btn">Ver Mas <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			<?php
				$aux = $row['id'];
			}
			?>

		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="productos" class="boxed-btn">Ver Todo los Productos</a>
			</div>
		</div>
	</div>
</div>
<!-- end product category  -->

<!-- advertisement section -->
<div class="abt-section mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<div class="abt-bg">
					<a href="https://scontent.faqp2-3.fna.fbcdn.net/v/t39.25447-2/309642288_409532974687357_4021677118693873468_n.mp4?_nc_cat=105&vs=7c5edd7adfc02abe&_nc_vs=HBksFQAYJEdEREVkQko5NUhyVGQzUUJBRHlYRUIwSTNzODNibWRqQUFBRhUAAsgBABUAGCRHS1N2c1JCeTJSekp3aWdCQUFLak5IeXE5d0pMYnY0R0FBQUYVAgLIAQBLB4gScHJvZ3Jlc3NpdmVfcmVjaXBlATENc3Vic2FtcGxlX2ZwcwAQdm1hZl9lbmFibGVfbnN1YgAgbWVhc3VyZV9vcmlnaW5hbF9yZXNvbHV0aW9uX3NzaW0AKGNvbXB1dGVfc3NpbV9vbmx5X2F0X29yaWdpbmFsX3Jlc29sdXRpb24AHXVzZV9sYW5jem9zX2Zvcl92cW1fdXBzY2FsaW5nABFkaXNhYmxlX3Bvc3RfcHZxcwAVACUAHAAAJq61jqqf8WwVAigCQzMYC3Z0c19wcmV2aWV3HBdATa7ZFocrAhg5ZGFzaF9pNGxpdGViYXNpY181c2VjZ29wXzQ4MF9jcmZfMjhfbWFpbl8zLjBfZnJhZ18yX3ZpZGVvEgAYGHZpZGVvcy52dHMuY2FsbGJhY2sucHJvZDgSVklERU9fVklFV19SRVFVRVNUGwqIFW9lbV90YXJnZXRfZW5jb2RlX3RhZwZvZXBfc2QTb2VtX3JlcXVlc3RfdGltZV9tcwEwDG9lbV9jZmdfcnVsZQpzZF91bm11dGVkE29lbV9yb2lfcmVhY2hfY291bnQCMjIRb2VtX2lzX2V4cGVyaW1lbnQADG9lbV92aWRlb19pZBAxMDY1NTQzMjA3MzYzNjQ3Em9lbV92aWRlb19hc3NldF9pZA8zMjAwOTUwNjM0MjY4OTMVb2VtX3ZpZGVvX3Jlc291cmNlX2lkDzIzOTQ0MDA0MTcyNTI3MRxvZW1fc291cmNlX3ZpZGVvX2VuY29kaW5nX2lkDzYxNjgxMzQwNjgxNTQ1Mg52dHNfcmVxdWVzdF9pZAAlAhwAJcQBGweIAXMENTk4MQJjZAoyMDIyLTA1LTA3A3JjYgEwA2FwcA9WaWRlb3MgZW4gV2F0Y2gCY3QZQ09OVEFJTkVEX1BPU1RfQVRUQUNITUVOVBNvcmlnaW5hbF9kdXJhdGlvbl9zCTU5LjM5NjMzMwJ0cxRwcm9ncmVzc2l2ZV9vcmRlcmluZwA%3D&ccb=1-7&_nc_sid=2001ee&efg=eyJ2ZW5jb2RlX3RhZyI6Im9lcF9zZCJ9&_nc_eui2=AeEgW8vdUBRkNw_y70-bcDHVK_HVvsK9LsQr8dW-wr0uxOi-qkrZCRhCqtT6ki4O4aCVqzTrNGOTVwOyMBtdEBiS&_nc_ohc=cII2oTW5f3IAX9IGVII&_nc_rml=0&_nc_ht=scontent.faqp2-3.fna&oh=00_AT8T-pzWKxVSdpLwcVZ32u3iftIaKvg0RmLT1v22hyk_uw&oe=635751E4&_nc_rid=587485373475917" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="abt-text">
					<p class="top-sub">Desde el año del 2018 </p>
					<h2>Somos <span class="orange-text">Novatec Energy</span></h2>
					<p>Una empresa comprometida con la intencion de ayudar a la poblacion en general a tener una mejor calidad de vida a través del aprovechamiento de energía solar para las viviendas, brindando el mejor servicio de la mano de especialistas a un precio accesible.</p>
					<p>Nos guiamos por la confianza y el compromiso. Apostamos por la confianza mutua como principio esencial de las relaciones con nuestros colaboradores, con los socios estratégicos y con nuestro clientes.</p>
					<a href="nosotros" class="boxed-btn mt-4">Saber mas</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end advertisement section -->


<?php
include_once("footer.php")
?>

