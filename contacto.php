<?php
include_once("head.php")
?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Atención las 24/7</p>
					<h1>Contactenos</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->
<br>
<!-- contact form -->
<div class="contact-from-section  mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mb-5 mb-lg-0">
				<div class="form-title">
					<h2>¿Tiene alguna duda?</h2>
					<p>No dude en contactarnos, le responderemos lo mas rapido posible.</p>
				</div>
				<div id="form_status"></div>
				<div class="contact-form">
					<form  id="fruitkha-contact" action="sendEmail.php" method="POST">
						<p>
							<input type="text" placeholder="Nombre" name="name" id="Nombre" require>
							<input type="email" placeholder="Correo Electrónico" name="email" id="Correo Electrónico" require>
						</p>
						<p>
							<input type="tel" placeholder="Celular" name="phone" id="Celular">
							<input type="text" placeholder="Asunto" name="subject" id="Asunto" require>
						</p>
						<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Mensaje" require></textarea></p>
						<p><input type="submit" value="Enviar"></p>
					</form>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="contact-form-wrap">
					<div class="contact-form-box">
						<h4><i class="fas fa-map"></i> Dirección de la tienda</h4>
						<p>Av. El Sol <br> N° 986. <br> Puno-Perú</p>
					</div>
					<div class="contact-form-box">
						<h4><i class="far fa-clock"></i> Hora de Atención</h4>
						<p>Lunes - viernes: 8 AM hasta las 9 PM  </p>
					</div>
					<div class="contact-form-box">
						<h4><i class="fas fa-address-book"></i> Contacto</h4>
						<p>Cel: 951 828 275 <br>tel : 51 603 939 <br> Email: cefecu@outlook.com</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end contact form -->

<!-- find our location -->
<div class="find-location blue-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<p> <i class="fas fa-map-marker-alt"></i> Nuestro Local</p>
			</div>
		</div>
	</div>
</div>
<!-- end find our location -->

<!-- google map section -->
<div class="embed-responsive embed-responsive-21by9">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d806.9002886355905!2d-70.02166422490467!3d-15.841545209320099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915d698d04094815%3A0xafae726baa423822!2sTermas%20Solares%20Novatec%20Energy!5e0!3m2!1ses-419!2spe!4v1666201668891!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- end google map section -->

<?php 
include_once("footer.php")

?>