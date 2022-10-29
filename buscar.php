<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Novatec Energy | Tienda especializada en produtos de energias renovables">

  <!-- title -->
  <title>Buscar | Novatec Energy</title>

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
require("./administrador/conection.php");
include_once("head.php");
$product = $conn->real_escape_string(isset($_GET['producto']) ? $_GET['producto'] : '');
?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>BUSCANDO:</p>
          <h1><?php echo $product ?></h1>
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
      $where = "where 1=1";
      if (!empty($product)) {
        $where = "where nombre like '%" . $product . "%'";

        $query = "SELECT * FROM productos $where ";

        if (isset($_REQUEST['categoria'])) {
          $query = "SELECT * FROM productos WHERE id_categoria={$_REQUEST['categoria']}";
        }
        $result = $conn->query($query);
        $numRow = $result->num_rows;
        if ($numRow > 0) {
          while ($row = $result->fetch_assoc()) {
            $array = explode('.', $row['imagen']);
            $ext = end($array);
            $nameImage = $row['imagen'];
            $imageExtencion = pathinfo($nameImage, PATHINFO_EXTENSION);
            $image = basename($nameImage, '.' . $imageExtencion);
      ?>
            <div class="col-lg-4 col-md-6 text-center card-content <?php echo $row['id_subcategory'] ?> ">
              <div class="single-product-item">
                <div class="product-image" width="300" height="300">
                  <a href="producto.php?id=<?php echo $row['id'] ?>"><img src="./productsImg/<?php echo $row['id'] . '.' . $ext ?>" alt="<?php echo $image ?>" width="300" height="300"></a>
                </div>
                <h3><?php echo $row['nombre'] ?></h3>
                <p class="product-price"> S/.<?php echo $row['precio_normal'] ?> </p>
                <a href="producto.php?id=<?php echo $row['id'] ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Leer Mas</a>
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