<?php
include("conection.php");
$query = "SELECT * FROM productos";
$results = $conn->query($query)
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
            <li class="breadcrumb-item active">DataTables</li>
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
                  <h3 class="card-title">Agregue Edite o Elimine sus productos</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?module=createProduct"><i class="fa fa-plus"></i> Agregar Nuevo Producto</a></li>
                  </ol>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tableProducts" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripccion</th>
                    <th>Precio</th>
                    <th>Precio Rebajado</th>
                    <th>Cantidad</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Editar</th>
                    <th>Elimnar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $results->fetch_assoc()) {
                  ?>
                    <tr>

                      <td><?php echo $row['id'] ?></td>
                      <td><?php echo $row['nombre'] ?></td>
                      <td><?php echo $row['descripcion'] ?></td>
                      <td><?php echo $row['precio_normal'] ?></td>
                      <td><?php echo $row['precio_rebajado'] ?></td>
                      <td><?php echo $row['cantidad'] ?></td>
                      <td><?php echo $row['imagen'] ?></td>
                      <td><?php echo $row['id_categoria'] ?></td>
                      <td><a href="index.php?module=editProduct&id=<?php echo $row['id']?>" class="p-3 py-6" ><i class="fas fa-edit" title="Editar"></i></a></td>
                      <td><a href="index.php?module=product&idDelete=<?php echo $row['id']?>" class="p-3 py-6 text-danger" title="Eliminar"><i class="fas fa-trash  icono "  ></i></a></td>
                    </tr>
                  <?php } ?>

                </tbody>


                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripccion</th>
                    <th>Precio</th>
                    <th>Precio Rebajado</th>
                    <th>Cantidad</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Editar</th>
                    <th>Elimnar</th>
                  </tr>
                </tfoot>
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