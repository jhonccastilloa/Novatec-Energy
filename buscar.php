<?php
require("./administrador/conection.php");
require_once __DIR__ . '/includes/seo.php';
security_headers();

$product = trim((string) ($_GET['producto'] ?? ''));
$categoryId = filter_input(INPUT_GET, 'categoria', FILTER_VALIDATE_INT);
$pageDescription = 'Resultados de busqueda de productos de energia renovable en Novatec Energy.';
$pageSeo = [
  'title' => 'Buscar | Novatec Energy',
  'description' => $pageDescription,
  'canonical' => site_url('buscar'),
  'path' => 'buscar',
  'robots' => 'noindex,follow',
];
$products = $product !== '' ? get_products($categoryId ?: null, $product) : [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo e($pageDescription); ?>">

  <!-- title -->
  <title><?php echo e($pageSeo['title']); ?></title>
  <?php render_seo_tags($pageSeo); ?>

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
<?php
include_once("head.php");
?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>BUSCANDO:</p>
          <h1><?php echo e($product) ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<div class="product-section mt-30 mb-150">
  <div class="container">
    <br>
    <br>
    <!-- products -->

    <div class="row product-lists">
      <?php
      if (!empty($product)) {
        if (count($products) > 0) {
          foreach ($products as $row) {
            $array = explode('.', $row['imagen']);
            $ext = image_extension((string) $row['imagen']);
            $nameImage = $row['imagen'];
            $imageExtencion = pathinfo($nameImage, PATHINFO_EXTENSION);
            $image = basename($nameImage, '.' . $imageExtencion);
      ?>
            <div class="col-lg-4 col-md-6 text-center card-content <?php echo (int) $row['id_subcategory'] ?> ">
              <div class="single-product-item">
                <div class="product-image" width="300" height="300">
                  <a href="producto.php?id=<?php echo (int) $row['id'] ?>"><img src="./productsImg/<?php echo (int) $row['id'] . '.' . e($ext) ?>" alt="<?php echo e($image) ?>" width="300" height="300"></a>
                </div>
                <h3><?php echo e($row['nombre']) ?></h3>
                <p class="product-price"> S/.<?php echo e($row['precio_normal']) ?> </p>
                <a href="producto.php?id=<?php echo (int) $row['id'] ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Leer Mas</a>
              </div>
            </div>
          <?php
          }
        } else {
          ?>
          <div class="container">
            <div class="row">
              <div class="col-lg-12 text-center ">
                <p class="text-search"> No se encontraron resultados</p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo '<div class="container">
        <div class="row">
          <div class="col-lg-12 text-center text-search">
            <p class="text-search"> Busque Algún Producto</p>
          </div>
        </div>
      </div>';
      }
      ?>


    </div>
  </div>
</div>
<!-- end products -->

<?php
include_once("footer.php");

?>
