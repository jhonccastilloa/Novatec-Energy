<?php
include("conection.php");
$query = "SELECT productos.id,productos.nombre,productos.descripcion,productos.precio_normal,productos.breve_descripcion,productos.imagen,category.category,subcategory.subcategory 
FROM productos LEFT JOIN category ON productos.id_categoria = category.id LEFT JOIN subcategory ON productos.id_subcategory=subcategory.id";
$results = $conn->query($query);

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
  </style>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h3 class="card-title font-weight-bold">PANEL DE LOS PRODUCTOS:</h3>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php
              if (isset($_SESSION["msg"]) and isset($_SESSION['estate'])) {
              ?>
                <div class="alert alert-<?= $_SESSION["estate"] ?> alert-dismissible fade show" role="alert">
                  <strong><?= $_SESSION["msg"] ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php
                unset($_SESSION["msg"]);
                unset($_SESSION["estate"]);
              } ?>
              <div class="col-sm-6 float-right">
                <ol class="breadcrumb float-sm-right ">
                  <li class="breadcrumb-item font-weight-bold"><a href="../createProduct.php"><i class="fa fa-plus"></i> Agregar Nuevo Producto</a></li>
                </ol>
              </div>
              <table id="tableProducts" class="table table-bordered table-hover table-responsive " style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Breve Descripci??n</th>
                    <th>Descripccion</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Sub Categoria</th>
                    <th>Editar</th>
                    <th>Elimnar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $results->fetch_assoc()) {
                    $array = explode('.', $row['imagen']);
                    $ext = end($array);
                  ?>
                    <tr>
                      <td><?php echo $row['id'] ?></td>
                      <td><img class="img-thumbnail" src="../productsImg/<?php echo $row['id'] . '.' . $ext ?> " width="50"></td>
                      <td><?php echo $row['nombre'] ?></td>
                      <td><?php echo strip_tags(substr($row['breve_descripcion'], 0, 250)) . "..."  ?></td>
                      <td>
                        <a href="../producto?id=<?= $row['id']?>&click=1" target="_blanck">
                          <button type="button" class="btn btn-primary font-weight-bold">
                            Ver Contenido
                          </button>
                        </a>
                      </td>
                      <td><?php echo $row['precio_normal'] ?></td>
                      <td><?php echo $row['category'] ?></td>
                      <td><?php echo $row['subcategory'] ?></td>
                      <td><a href="../editProduct?id=<?php echo $row['id'] ?>" class="p-3 py-6"><i class="fas fa-edit" title="Editar"></i></a></td>
                      <td><a href="createProductEvalua.php?idDelete=<?php echo $row['id'] ?>&image=<?php echo $row['imagen'] ?>" onclick="deleteProduct(event)" class="p-3 py-6 text-danger" title="Eliminar"><i class="fas fa-trash  icono "></i></a></td>
                    </tr>

                  <?php } ?>
                </tbody>
              </table>
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