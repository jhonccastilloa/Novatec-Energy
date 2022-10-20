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
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, ratione! Laboriosam est, assumenda. Perferendis, quo alias quaerat aliquid. Corporis ipsum minus voluptate? Dolore, esse natus!</p>
				</div>
				<div id="form_status"></div>
				<div class="contact-form">
					<form type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
						<p>
							<input type="text" placeholder="Name" name="name" id="Nombre">
							<input type="email" placeholder="Email" name="email" id="Correo Electrónico">
						</p>
						<p>
							<input type="tel" placeholder="Phone" name="phone" id="Celular">
							<input type="text" placeholder="Subject" name="subject" id="Asunto">
						</p>
						<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Mensaje"></textarea></p>
						<input type="hidden" name="token" value="FsWga4&@f6aw" />
						<p><input type="submit" value="Submit"></p>
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
						<h4><i class="far fa-clock"></i> Hora de Atencion</h4>
						<p>Lunes - viernes: 8 AM hasta las 9 PM <br> SAT - SUN: 10 to 8 PM </p>
					</div>
					<div class="contact-form-box">
						<h4><i class="fas fa-address-book"></i> Contact</h4>
						<p>Cel: 951 828 275 <br>tel : 51 603 939 <br> Email: cefecu@putlook.com</p>
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
				<p> <i class="fas fa-map-marker-alt"></i> Find Our Location</p>
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


<!-- footer -->
<div class="footer-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="footer-box about-widget">
					<h2 class="widget-title">Acerca de Nosotos</h2>
					<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="footer-box get-in-touch">
					<h2 class="widget-title">Contactenos</h2>
					<ul>
						<li>Av. El Sol N° 986 - Puno, Puno, Peru</li>
						<li>support@novatec.com</li>
						<li>+00 111 222 3333</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="footer-box pages">
					<h2 class="widget-title">Paginas</h2>
					<ul>
						<li><a href="index.html">Inicio</a></li>
						<li><a href="about.html">Nosotros</a></li>
						<li><a href="services.html">Productos</a></li>
						<li><a href="contact.html">Contacto</a></li>
					</ul>
				</div>
			</div>
			<!-- <div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.html">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div> -->
		</div>
	</div>
</div>
<!-- end footer -->

<!-- copyright -->
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Novatec</a>, Todos Los Derechos Reservados.<br>
					<!-- Distributed By - <a href="https://themewagon.com/">Themewagon</a> -->
				</p>
			</div>
			<div class="col-lg-6 text-right col-md-12">
				<div class="social-icons">
					<ul>
						<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end copyright -->

<!-- jquery -->
<script src="assets/js/jquery-1.11.3.min.js"></script>
<!-- bootstrap -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- count down -->
<script src="assets/js/jquery.countdown.js"></script>
<!-- isotope -->
<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
<!-- waypoints -->
<script src="assets/js/waypoints.js"></script>
<!-- owl carousel -->
<script src="assets/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- mean menu -->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!-- sticker js -->
<script src="assets/js/sticker.js"></script>
<!-- form validation js -->
<script src="assets/js/form-validate.js"></script>
<!-- main js -->
<script src="assets/js/main.js"></script>

</body>

</html>