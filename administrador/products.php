<?php
include("conection.php");
require_once __DIR__ . "/components/adminAlert.php";
require_once __DIR__ . "/../includes/functions.php";
$query = "SELECT productos.id,productos.nombre,productos.slug,productos.descripcion,productos.precio_normal,productos.breve_descripcion,productos.imagen,category.category,subcategory.subcategory
FROM productos LEFT JOIN category ON productos.id_categoria = category.id LEFT JOIN subcategory ON productos.id_subcategory=subcategory.id";
$results = $conn->query($query);

if (!function_exists('cleanProductText')) {
  function cleanProductText($text, $limit = null)
  {
    $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $text)));

    if ($limit === null) {
      return $text;
    }

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
      return mb_strlen($text, 'UTF-8') > $limit ? mb_substr($text, 0, $limit, 'UTF-8') . '...' : $text;
    }

    return strlen($text) > $limit ? substr($text, 0, $limit) . '...' : $text;
  }
}

if (!function_exists('productHtml')) {
  function productHtml($text)
  {
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
  }
}

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
            <li class="breadcrumb-item active">Productos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <style>
    .modal-body .table {
      table-layout: fixed;
    }

    #tableProducts {
      font-size: 0.92rem;
      min-width: 1020px;
      table-layout: fixed;
    }

    #tableProducts th,
    #tableProducts td {
      padding: 0.45rem 0.6rem;
      vertical-align: middle;
    }

    #tableProducts th {
      white-space: nowrap;
    }

    #tableProducts .col-image {
      text-align: center;
      width: 88px !important;
    }

    #tableProducts .col-product {
      width: auto !important;
    }

    #tableProducts td.col-product {
      overflow: hidden;
    }

    #tableProducts .col-price {
      width: 92px !important;
    }

    #tableProducts .col-category {
      width: 145px !important;
    }

    #tableProducts .col-subcategory {
      width: 145px !important;
    }

    #tableProducts .col-actions {
      width: 132px !important;
    }

    .product-info{
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      min-width: 0;
      width: 100%;
    }

    .products-card-header {
      align-items: center;
      display: flex;
      gap: 1rem;
      justify-content: space-between;
    }

    .products-card-header .card-title {
      margin: 0;
    }

    .products-add-btn {
      align-items: center;
      display: inline-flex;
      gap: 0.35rem;
      white-space: nowrap;
    }

    #tableProducts .product-thumb {
      width: 44px;
      height: 44px;
      object-fit: cover;
      padding: 2px;
    }

    #tableProducts .product-title {
      color: #212529;
      display: block;
      font-weight: 700;
      line-height: 1.2;
      max-width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      width: 100%;
    }

    #tableProducts .product-excerpt {
      color: #6c757d;
      display: block;
      font-size: 0.82rem;
      line-height: 1.25;
      max-width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      width: 100%;
    }

    #tableProducts .product-price {
      white-space: nowrap;
    }

    #tableProducts .product-category {
      display: block;
      max-width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    #tableProducts .product-actions {
      display: flex;
      gap: 0.35rem;
      justify-content: center;
      white-space: nowrap;
    }

    #tableProducts .product-actions .btn {
      align-items: center;
      display: inline-flex;
      height: 32px;
      justify-content: center;
      width: 32px;
    }

    @media (max-width: 767px) {
      .products-card-header {
        align-items: flex-start;
        flex-direction: column;
      }
    }
  </style>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="products-card-header">
                <h3 class="card-title font-weight-bold">PANEL DE LOS PRODUCTOS:</h3>
                <a href="index.php?module=createProduct" class="btn btn-primary btn-sm products-add-btn">
                  <i class="fa fa-plus"></i>
                  <span>Agregar Nuevo Producto</span>
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php
              renderAdminSessionAlert();
              ?>
              <div class="admin-table-scroll">
                <table id="tableProducts" class="table table-sm  table-hover" style="width:100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th class="col-image">Imagen</th>
                      <th class="col-product">Producto</th>
                      <th class="col-price">Precio</th>
                      <th class="col-category">Categoria</th>
                      <th class="col-subcategory">Sub Categoria</th>
                      <th class="col-actions">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = $results->fetch_assoc()) {
                      $array = explode('.', $row['imagen']);
                      $ext = end($array);
                      $briefDescription = cleanProductText($row['breve_descripcion']);
                      $searchDescription = cleanProductText($row['descripcion']);
                      $productPreviewUrl = '../' . product_path($row) . '#text-description';
                    ?>
                      <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td class="col-image"><img class="img-thumbnail product-thumb" src="../productsImg/<?php echo $row['id'] . '.' . $ext ?> " alt="<?php echo productHtml($row['nombre']) ?>"></td>
                        <td class="col-product">
                          <div class="product-info">
                          <span class="product-title"><?php echo productHtml($row['nombre']) ?></span>
                          <span class="product-excerpt"><?php echo productHtml($briefDescription) ?></span>
                          <span class="d-none"><?php echo productHtml($searchDescription) ?></span>
                          </div>
                        </td>
                        <td class="col-price product-price">S/. <?php echo productHtml($row['precio_normal']) ?></td>
                        <td class="col-category"><span class="product-category" title="<?php echo productHtml($row['category']) ?>"><?php echo productHtml($row['category']) ?></span></td>
                        <td class="col-subcategory"><span class="product-category" title="<?php echo productHtml($row['subcategory']) ?>"><?php echo productHtml($row['subcategory']) ?></span></td>
                        <td class="col-actions">
                          <div class="product-actions">
                            <a href="<?php echo productHtml($productPreviewUrl) ?>" target="_blank" class="btn btn-sm btn-primary" title="Ver contenido" aria-label="Ver contenido">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="index.php?module=editProduct&id=<?php echo $row['id'] ?>" class="btn btn-sm btn-info" title="Editar" aria-label="Editar">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="createProductEvalua.php?idDelete=<?php echo $row['id'] ?>&image=<?php echo productHtml($row['imagen']) ?>" onclick="deleteProduct(event)" class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      </tr>

                    <?php } ?>
                  </tbody>
                </table>
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
