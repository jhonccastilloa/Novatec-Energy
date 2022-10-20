<?php
include("conection.php");

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Categorias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item active">Categoria</li>
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
                  <h3 class="card-title">Agregue, Edite o Elimine sus Categorias</h3>
                </div>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <form class="form-horizontal" action="categoryEvalua.php" method="GET">
                    <input type="hidden" name="id" id="idCat" value="">
                    <div class="form-group">
                      <label for="nombres" class="col-sm-12 ">Categoria: </label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="category"  name="category"  placeholder="Escriba el nombre de la Categoria">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="area" class="col-sm-12 ">Descripccion:</label>
                      <div class="col-sm-12">
                        <textarea name="description" id="description" class="form-control"  cols="30" rows="5" placeholder="Escriba la Descripcion de la Categoria"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="institucion_listado.php" class="btn btn-danger">Cancelar</a>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-sm-8">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Categoria</th>
                        <th>Descripccion</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM category";
                      $result = $conn->query($query);
                      while ($row = $result->fetch_assoc()) {
                      ?>
                        <tr>
                          <td><?php echo $row['category'] ?></td>
                          <td><?php echo $row['description'] ?></td>
                          <td><i class="fas fa-edit " onclick="dataEdit(event)" id='<?php echo $row['id'] ?>' category='<?php echo $row['category'] ?>' description="<?php echo $row['description'] ?>" title="Editar"></i></td>
                          <td><a href="categoryEvalua.php?op=delete&id=<?php echo $row['id'] ?>" class="p-3 py-6 text-danger" title="Eliminar"><i class="fas fa-trash  icono "></i></a></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
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