<?php
include("conection.php");
$query = "SELECT productos.id,productos.nombre,productos.descripcion,productos.precio_normal,productos.cantidad,productos.imagen,category.category,subcategory.subcategory 
FROM productos LEFT JOIN category ON productos.id_categoria = category.id LEFT JOIN subcategory ON productos.id_subcategory=subcategory.id";
$results = $conn->query($query);
if (isset($_REQUEST['idDelete'])) {
  $id = $conn->real_escape_string($_REQUEST['idDelete'] ?? '');
  $query = "DELETE from productos where id='{$id}'";
  $result = $conn->query($query);
  deleteDir("../imgProducts/" . $id);
  if ($result) {
?>
    <div class="alert alert-warning float-right" role="alert">
      Producto borrado con exito
    </div>
  <?php
  } else {
  ?>
    <div class="alert alert-danger float-right" role="alert">
      Error al borrar <?php echo mysqli_error($con); ?>
    </div>
<?php
  }
}
function deleteDir($directory)
{
  foreach (glob($directory . "/*") as $file_directory) {
    if (is_dir($file_directory)) {
      deleteDir($directory);
    } else {
      unlink($file_directory);
    }
    # code...
  }
  // rmdir($directory);
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Productos</h1>
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

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h3 class="card-title">Panel de los Productos</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../createProduct.php"><i class="fa fa-plus"></i> Agregar Nuevo Producto</a></li>
                  </ol>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tableProducts" class="table table-bordered table-hover table-responsive " style="width:100%">
                <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripccion</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Categoria</th>
                    <th>Sub Categoria</th>
                    <th>Editar</th>
                    <th>Elimnar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $results->fetch_assoc()) {
                  ?>
                    <tr>
                      <td><img class="img-thumbnail" src="../imgProducts/<?php echo $row['id'] ?>/<?php echo $row['imagen']; ?>" width="50"></td>
                      <td><?php echo $row['nombre'] ?></td>
                      <td><?php echo strip_tags(substr($row['descripcion'], 0, 250)) . "..."  ?></td>
                      <td><?php echo $row['precio_normal'] ?></td>
                      <td><?php echo $row['cantidad'] ?></td>
                      <td><?php echo $row['category'] ?></td>
                      <td><?php echo $row['subcategory'] ?></td>
                      <td><a href="../editProduct?id=<?php echo $row['id'] ?>" class="p-3 py-6"><i class="fas fa-edit" title="Editar"></i></a></td>
                      <td><a href="index.php?module=product&idDelete=<?php echo $row['id'] ?>" class="p-3 py-6 text-danger" title="Eliminar"><i class="fas fa-trash  icono "></i></a></td>
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