<?php
declare(strict_types=1);

require_once __DIR__ . '/seo.php';

function public_content(?string $section = null)
{
    static $content = null;

    if ($content === null) {
        $content = require __DIR__ . '/public-content.php';
    }

    return $section === null ? $content : ($content[$section] ?? []);
}

function render_public_head(array $pageSeo, array $options = []): void
{
    security_headers();

    $page = seo_page_defaults($pageSeo);
    $extraStyles = (array) ($options['styles'] ?? []);
    $extraHead = (string) ($options['extra_head'] ?? '');
    ?>
<!DOCTYPE html>
<html lang="<?php echo e((string) novatec_config('site')['language']); ?>">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo e($page['title']); ?></title>
	<meta name="description" content="<?php echo e($page['description']); ?>">
	<?php render_seo_tags($page); ?>

	<link rel="shortcut icon" type="image/png" href="<?php echo e(asset_url((string) novatec_config('site')['favicon'])); ?>">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/css/all.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/bootstrap/css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/css/owl.carousel.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/css/magnific-popup.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/css/animate.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/css/meanmenu.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/css/main.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset_url('assets/css/responsive.css')); ?>">
	<?php foreach ($extraStyles as $styleHref) { ?>
		<link rel="stylesheet" href="<?php echo e((string) $styleHref); ?>">
	<?php } ?>
	<?php echo $extraHead; ?>
</head>
<?php
}

function render_site_header(): void
{
    $business = novatec_config('business');
    $navItems = public_content('nav');
    ?>
<body>
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<div class="site-logo">
							<a href="<?php echo e(url_path('index')); ?>">
								<img class="logo-menu" src="<?php echo e(asset_url('assets/img/logo.png')); ?>" alt="Logo de Novatec Energy">
							</a>
						</div>

						<nav class="main-menu">
							<ul>
								<?php foreach ($navItems as $item) { ?>
									<li class="<?php echo is_active_path((string) $item['path']) ? 'current-list-item' : ''; ?>">
										<a href="<?php echo e(url_path((string) $item['url'])); ?>"><?php echo e($item['label']); ?></a>
										<?php if ($item['path'] === 'productos') { ?>
											<ul class="sub-menu">
												<?php foreach (get_categories() as $category) { ?>
													<li><a href="<?php echo e(category_url($category)); ?>"><?php echo e($category['category']); ?></a></li>
												<?php } ?>
											</ul>
										<?php } ?>
									</li>
								<?php } ?>
								<li>
									<div class="header-icons">
										<a href="<?php echo e(whatsapp_url('Hola, deseo adquirir un producto con ustedes')); ?>" target="_blank"><i class="fab fa-whatsapp "></i> <?php echo e($business['phone_display']); ?></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<form action="<?php echo e(url_path('buscar')); ?>" method="get">
								<h3>Busque en Novatec Energy:</h3>
								<input type="text" name="producto" placeholder="Digite un producto">
								<button type="submit">Buscar <i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}

function render_site_footer(array $options = []): void
{
    $business = novatec_config('business');
    $footerPages = public_content('footer_pages');
    $scripts = (array) ($options['scripts'] ?? []);
    ?>
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Acerca de nosotros</h2>
						<p>Elaboramos proyectos con energía solar, instalamos termas solares, iluminación doméstica, bombas para irrigación, congeladores solares y temperadores de piscinas para empresas privadas, entidades públicas, municipalidades y gobiernos regionales.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Contáctenos</h2>
						<ul>
							<li><?php echo e($business['address']['display']); ?></li>
							<li>CEL: <?php echo e($business['phone_display']); ?></li>
							<li>TELF: <?php echo e($business['secondary_phone_display']); ?></li>
							<li>Email: <?php echo e($business['email']); ?></li>
							<li>facebook: Novatec Energy</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Páginas</h2>
						<ul>
							<?php foreach ($footerPages as $page) { ?>
								<li><a href="<?php echo e(url_path((string) $page['url'])); ?>"><?php echo e($page['label']); ?></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> - <a href="<?php echo e(url_path('index')); ?>">Novatec</a>, todos los derechos reservados.<br></p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="<?php echo e(whatsapp_url('Hola, deseo adquirir un producto con ustedes')); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo e(asset_url('assets/js/js.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/jquery-1.11.3.min.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/jquery.countdown.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/jquery.isotope-3.0.6.min.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/waypoints.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/owl.carousel.min.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/jquery.magnific-popup.min.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/jquery.meanmenu.min.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/sticker.js')); ?>"></script>
	<script src="<?php echo e(asset_url('assets/js/main.js')); ?>"></script>
	<?php foreach ($scripts as $script) { ?>
		<?php echo $script; ?>
	<?php } ?>
</body>

</html>
<?php
}

function render_breadcrumb(string $title, string $subtitle = ''): void
{
    ?>
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<?php if ($subtitle !== '') { ?>
						<p><?php echo e($subtitle); ?></p>
					<?php } ?>
					<h1><?php echo e($title); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}

function render_section_title(string $titleHtml, string $descriptionHtml = ''): void
{
    ?>
<div class="row">
	<div class="col-lg-8 offset-lg-2 text-center">
		<div class="section-title">
			<h3><?php echo $titleHtml; ?></h3>
			<?php if ($descriptionHtml !== '') { ?>
				<p><?php echo $descriptionHtml; ?></p>
			<?php } ?>
		</div>
	</div>
</div>
<?php
}

function render_feature_boxes(array $items, string $columnClass = 'col-lg-4 col-md-6'): void
{
    $lastIndex = count($items) - 1;

    foreach ($items as $index => $item) {
        $marginClass = $index === $lastIndex ? '' : 'mb-4 mb-lg-0';
        $boxClass = trim('list-box d-flex align-items-center ' . (string) ($item['box_class'] ?? ''));
        $contentClass = trim('content ' . (string) ($item['content_class'] ?? ''));
        ?>
		<div class="<?php echo e(trim($columnClass . ' ' . $marginClass)); ?>">
			<div class="<?php echo e($boxClass); ?>">
				<div class="list-icon">
					<i class="<?php echo e($item['icon']); ?>"></i>
				</div>
				<div class="<?php echo e($contentClass); ?>">
					<h3><?php echo e($item['title']); ?></h3>
					<p><?php echo e($item['text']); ?></p>
				</div>
			</div>
		</div>
		<?php
    }
}

function render_product_card(array $product, bool $scrollToDescription = false): void
{
    $ext = image_extension((string) ($product['imagen'] ?? ''));
    $imageName = basename((string) ($product['imagen'] ?? ''), '.' . pathinfo((string) ($product['imagen'] ?? ''), PATHINFO_EXTENSION));
    $url = product_url($product) . ($scrollToDescription ? '#text-description' : '');
    ?>
<div class="col-lg-4 col-md-6 text-center card-content <?php echo (int) ($product['id_subcategory'] ?? 0); ?> ">
	<div class="single-product-item">
		<div class="product-image" width="300" height="300">
			<a href="<?php echo e($url); ?>"><img src="<?php echo e(asset_url('productsImg/' . (int) $product['id'] . '.' . $ext)); ?>" alt="<?php echo e($imageName ?: $product['nombre']); ?>" width="300" height="300"></a>
		</div>
		<h3><?php echo e($product['nombre']); ?></h3>
		<p class="product-price"> S/.<?php echo e($product['precio_normal']); ?> </p>
		<a href="<?php echo e($url); ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Leer más</a>
	</div>
</div>
<?php
}

function render_category_card(array $category): void
{
    $ext = image_extension((string) ($category['imagen'] ?? ''));
    ?>
<div class="col-lg-4 col-md-6 product-category-card-col">
	<div class="single-latest-news product-category-card">
		<div class="product-image">
			<img src="<?php echo e(asset_url('productsImg/' . (int) $category['idProduct'] . '.' . $ext)); ?>" alt="<?php echo e($category['category']); ?>">
		</div>
		<div class="news-text-box">
			<h3><?php echo e($category['category']); ?></h3>
			<p class="excerpt">En esta sección encontrará una gran variedad de <strong><?php echo e($category['category']); ?></strong> de buena calidad y a precios muy cómodos.</p>
			<a href="<?php echo e(category_url($category)); ?>" class="read-more-btn">Ver más <i class="fas fa-angle-right"></i></a>
		</div>
	</div>
</div>
<?php
}

function render_team_cards(array $team): void
{
    $lastIndex = count($team) - 1;

    foreach ($team as $index => $member) {
        $offsetClass = $index === $lastIndex ? 'offset-md-3 offset-lg-0' : '';
        ?>
		<div class="col-lg-4 col-md-6 <?php echo e($offsetClass); ?>">
			<div class="single-team-item">
				<div class="team-bg <?php echo e($member['class']); ?>"></div>
				<h4><?php echo e($member['name']); ?> <span><?php echo e($member['role']); ?></span></h4>
			</div>
		</div>
		<?php
    }
}

function render_contact_boxes(array $boxes): void
{
    foreach ($boxes as $box) {
        ?>
		<div class="contact-form-box">
			<h4><i class="<?php echo e($box['icon']); ?>"></i> <?php echo e($box['title']); ?></h4>
			<p><?php echo $box['html']; ?></p>
		</div>
		<?php
    }
}
