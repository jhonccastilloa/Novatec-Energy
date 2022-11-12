<?php
require "./administrador/conection.php";
session_start();

if (isset($_REQUEST['session']) and $_REQUEST['session'] == 'exit') {
  session_destroy();
  header("location: ./administrador/login");
}
if (!isset($_SESSION['id'])) {
  header("location: ./administrador/login");
}
$name = $_SESSION['name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatec | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./administrador/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./administrador/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./administrador/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./administrador/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./administrador/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./administrador/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <!-- Editor de descripcion -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <!-- ck editor video frame -->
  <script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" role="button">Bienvenido <?php echo $_SESSION['name'] ?></a>

        </li>

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="./administrador/index.php?session=exit" role="button">
            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Salir
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../" class="brand-link" target="_blank">
        <img src="./administrador/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Novatec Energy</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="./administrador/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo $_SESSION['name']  ?> </a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="./administrador" class="nav-link active">
                <i class="nav-icon fa fa-tasks"></i>
                <p>
                  Panel de la Tienda
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="./administrador/index.php?module=product" class="nav-link  active">
                    <i class="fa fa-shopping-cart av-icon " aria-hidden="true"></i>
                    <p>Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./administrador/index.php?module=category" class="nav-link <?php echo (isset($_REQUEST['module']) and $_REQUEST['module'] == 'category') ? 'active' : '' ?> ">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <p>Categorias</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./administrador/index.php?module=subcategory" class="nav-link <?php echo (isset($_REQUEST['module']) and $_REQUEST['module'] == 'subcategory') ? 'active' : '' ?>">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <p>SubCategorias</p>
                  </a>
                </li>
              </ul>
            </li>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <?php

    if (isset($_REQUEST['mensaje'])) {
    ?>
      <div class="alert alert-primary alert-dismissible fade show float-right" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <?php echo $_REQUEST['mensaje'] ?>
      </div>
    <?php
    }
    ?>
    <?php
    include("./administrador/conection.php");
    include("./administrador/editProductEvalua.php");

    $id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : "";
    $query = "SELECT * FROM productos WHERE id='{$id}'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $queryCategory = "SELECT * FROM category";
    $resultCategory = $conn->query($queryCategory);

    ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="font-weight-bold">Productos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                <li class="breadcrumb-item active">Editar</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">

                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title font-weight-bold">EDITAR PRODUCTO:</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form action="./administrador/createProductEvalua.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="idEdit" value="<?php echo $row['id'] ?>" hidden>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Nombre del Producto:</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $row['nombre'] ?>" required>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Categoria:</label>
                                <select name="category" id="productCategory" class="form-control" required>
                                  <option value="">Seleccione Una Categoria</option>
                                  <?php
                                  while ($rowCategory = $resultCategory->fetch_assoc()) {
                                  ?>
                                    <option value="<?php echo $rowCategory['id'] ?>" <?php echo ($row['id_categoria'] == $rowCategory['id'] ? 'selected' : '') ?>><?php echo $rowCategory['category'] ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Sub Categoria:</label>
                                <select name="subcategory" id="productSubcategory" class="form-control" required>
                                  <?php
                                  $querySubcategory = 'SELECT * FROM subcategory WHERE id_category=' . $row['id_categoria'];
                                  $resultSubcategory = $conn->query($querySubcategory);
                                  while ($rowSubcategory = $resultSubcategory->fetch_assoc()) {

                                  ?>
                                    <option value="<?php echo $rowSubcategory['id'] ?>" <?php echo ($rowSubcategory['id'] == $row['id_subcategory'] ? 'selected' : '') ?>><?php echo $rowSubcategory['subcategory'] ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Breve Descripción del Producto:</label>
                                <textarea class="form-control" name="breve" maxlength="400" rows="8" required><?= $row['breve_descripcion'] ?></textarea>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">

                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Descripccion</label>
                              <textarea name="description" id="editor" rows="10" cols="80"> <?php echo $row['descripcion'] ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                              <label>Imagen</label>
                              <input type="text" name="imageAux" value="<?php echo $row['imagen'] ?>" hidden>
                              <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                              <label>Precio del Producto</label>
                              <input type="number" class="form-control" name="price" value="<?php echo $row['precio_normal'] ?>" placeholder="Ingrese un precio" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <?php
                          $array = explode('.', $row['imagen']);
                          $ext = end($array);
                          ?>
                          <div class="col-sm-4">
                            <div class="form-group">

                              <img src="./productsImg/<?php echo $row['id'] . '.' . $ext ?> " alt="">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">

                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </form>
                    </div>
                    <!-- /.card-body -->
                  </div>

                </div>
                <!-- /.card-body -->
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

  </div>
  <!-- ./wrapper -->
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
  <script src="ckeditor/ckeditor.js"></script>

  <script type="text/javascript">
   
    CKEDITOR.replace('editor', {
      filebrowserUploadUrl: 'ckeditor/ck_upload.php',
      filebrowserUploadMethod: 'form'
    });
  </script>


  <script>
    CKEDITOR.replace('editor', {
      filebrowserUploadUrl: 'ckeditor/ck_upload.php',
      filebrowserUploadMethod: 'form'
    });
  </script>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">Novate Energy</a>.</strong>
    Todos los derechos Reservados
    <!-- <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div> -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <script src="./administrador/js/main.js"></script>

  <!-- jQuery -->
  <script src="./administrador/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./administrador/plugins/jquery-ui/jquery-ui.min.js"></script>

  <script src="./administrador/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="./administrador/plugins/chart.js/Chart.min.js"></script>

  <script src="./administrador/plugins/sparklines/sparkline.js"></script>

  <script src="./administrador/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="./administrador/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

  <script src="./administrador/dist/js/adminlte.js"></script>

  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#tableProducts').DataTable();
    });

    document.querySelectorAll('oembed[url]').forEach(element => {
      const anchor = document.createElement('a');
      anchor.setAttribute('href', element.getAttribute('url'));
      anchor.className = 'embedly-card';

      element.appendChild(anchor);
    });
  </script>
</body>

</html>