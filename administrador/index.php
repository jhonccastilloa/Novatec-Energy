<?php
require "conection.php";
require_once __DIR__ . "/components/adminAlert.php";
session_start();

if (isset($_REQUEST['session']) and $_REQUEST['session'] == 'exit') {
  session_destroy();
  header("location: login");
}
if (!isset($_SESSION['id'])) {
  header("location: login");
}
$name = $_SESSION['name'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novatec | Dashboard</title>
	<link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/react/product-taxonomy.css">
  <style>
    .admin-floating-alert {
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      margin-bottom: 0;
      max-width: calc(100vw - 2rem);
      min-width: 280px;
      position: fixed;
      right: 1rem;
      bottom: 1rem;
      width: 420px;
      z-index: 1080;
    }

    .admin-table-panel {
      min-width: 0;
    }

    .admin-table-scroll {
      -webkit-overflow-scrolling: touch;
      overflow-x: auto;
      padding-bottom: 0.25rem;
      width: 100%;
    }

    .admin-table-scroll table.dataTable,
    .admin-table-scroll table.table {
      margin-bottom: 0.75rem !important;
      width: 100% !important;
    }

    .admin-table-scroll th,
    .admin-table-scroll td {
      vertical-align: middle;
    }

    .admin-table-scroll th {
      white-space: nowrap;
    }

    .admin-table-scroll .col-actions {
      text-align: center;
      white-space: nowrap;
    }

    .admin-table-scroll::-webkit-scrollbar {
      height: 8px;
    }

    .admin-table-scroll::-webkit-scrollbar-thumb {
      background-color: #ced4da;
      border-radius: 999px;
    }

    .dataTables_wrapper {
      width: 100%;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
      align-items: center;
      display: flex;
      margin-bottom: 0.85rem;
    }

    .dataTables_wrapper .dataTables_length {
      justify-content: flex-start;
    }

    .dataTables_wrapper .dataTables_filter {
      justify-content: flex-end;
    }

    .dataTables_wrapper .dataTables_filter input {
      height: 36px;
      margin-left: 0.45rem;
      max-width: 220px;
      width: 100%;
    }

    .dataTables_wrapper .dataTables_info {
      padding-top: 0.35rem;
      white-space: normal;
    }

    .dataTables_wrapper .dataTables_paginate {
      align-items: center;
      display: flex;
      flex-wrap: wrap;
      gap: 0.25rem;
      justify-content: flex-end;
      padding-top: 0.35rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      border-radius: 0.25rem;
      margin-left: 0;
      min-width: 34px;
      text-align: center;
    }

    @media (max-width: 575.98px) {
      .admin-floating-alert {
        left: 1rem;
        min-width: 0;
        right: 1rem;
        width: auto;
      }

      .content-wrapper > .content {
        padding-left: 0;
        padding-right: 0;
      }

      .content .container-fluid {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
      }

      .content .card-body {
        padding: 1rem;
      }

      .dataTables_wrapper .dataTables_length,
      .dataTables_wrapper .dataTables_filter,
      .dataTables_wrapper .dataTables_info,
      .dataTables_wrapper .dataTables_paginate {
        float: none;
        justify-content: center;
        text-align: center;
        width: 100%;
      }

      .dataTables_wrapper .dataTables_length,
      .dataTables_wrapper .dataTables_filter {
        align-items: center;
        flex-direction: column;
        gap: 0.4rem;
      }

      .dataTables_wrapper .dataTables_filter input {
        margin-left: 0;
        max-width: 100%;
      }

      .dataTables_wrapper .dataTables_info {
        margin-bottom: 0.5rem;
      }
    }
  </style>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
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
          <a class="nav-link text-danger" href="index.php?session=exit" role="button">
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
        <img src="../assets/img/favicon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Novatec Energy</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo $_SESSION['name']  ?> </a>
          </div>
        </div>

    

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-tasks"></i>
                <p>
                  Panel de la Tienda
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php" class="nav-link <?php echo (!isset($_REQUEST['module'])) ? 'active' : '' ?>  ">
                    <i class="fa fa-home av-icon " aria-hidden="true"></i>
                    <p>Inicio</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?module=product" class="nav-link <?php echo (isset($_REQUEST['module']) and in_array($_REQUEST['module'], ['product', 'createProduct', 'editProduct'])) ? 'active' : '' ?>  ">
                    <i class="fa fa-shopping-cart av-icon " aria-hidden="true"></i>
                    <p>Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?module=category" class="nav-link <?php echo (isset($_REQUEST['module']) and $_REQUEST['module'] == 'category') ? 'active' : '' ?> ">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <p>Categorias</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?module=subcategory" class="nav-link <?php echo (isset($_REQUEST['module']) and $_REQUEST['module'] == 'subcategory') ? 'active' : '' ?>">
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
      renderAdminAlert($_REQUEST['mensaje'], 'primary');
    }
    if (!isset($_REQUEST['module'])) {
      require_once('statistics.php');
    } elseif ($_REQUEST['module'] == 'product') {
      require_once('products.php');
    } elseif ($_REQUEST['module'] == 'category') {
      require_once('category.php');
    } elseif ($_REQUEST['module'] == 'subcategory') {
      require_once('subcategory.php');
    } elseif ($_REQUEST['module'] == 'createProduct') {
      define('NOVATEC_ADMIN_LAYOUT', true);
      require_once('../createProduct.php');
    } elseif ($_REQUEST['module'] == 'editProduct') {
      define('NOVATEC_ADMIN_LAYOUT', true);
      require_once('../editProduct.php');
    } elseif ($_REQUEST['module'] == 'categoryEvalua') {
      require_once('categoryEvalua.php');
    }

    ?>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Novate Energy</a>.</strong>
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
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <!-- <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script> -->
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- query editor -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <!-- datatables query -->

  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="module" src="../assets/react/product-taxonomy.js"></script>
  <script src="./js/main.js"></script>

  <script>
    // var quill = new Quill('#editor', {
    //   theme: 'snow'
    // });


    document.querySelectorAll('oembed[url]').forEach(element => {
      // Create the <a href="..." class="embedly-card"></a> element that Embedly uses
      // to discover the media.
      const anchor = document.createElement('a');

      anchor.setAttribute('href', element.getAttribute('url'));
      anchor.className = 'embedly-card';

      element.appendChild(anchor);
    });
  </script>
</body>

</html>
