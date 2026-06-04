<?php
include("conection.php");
require_once __DIR__ . "/components/adminAlert.php";

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="font-weight-bold">Categorias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item active">Categorias</li>
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
          <div class="card card-success" id="cardCategory">
            <div class="card-header">
              <h3 class="card-title font-weight-bold title-category">AGREGAR CATEGORIA:</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php
              renderAdminSessionAlert();
              ?>

              <div class="row">
                <div class="col-sm-4">
                  <form class="form-horizontal" action="categoryEvalua.php" method="GET">
                    <input type="hidden" name="id" id="idCat" value="">
                    <div class="form-group">
                      <label for="nombres" class="col-sm-12 ">Categoria: </label>
                      <div class="col-sm-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="category" name="category" placeholder="Escriba el nombre de la Categoria" required>
                          <div class="input-group-append">
                            <button type="button" onclick="erasedText()" class="btn btn-outline-secondary" title="Borrar">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" onclick="cancelCategory()" class="btn btn-secondary" id="btnCancelCategory" hidden>Cancelar</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-sm-8">
                  <table class="table" id="tableCategory">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Categoria</th>
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
                          <td><?php echo $row['id'] ?></td>
                          <td><?php echo $row['category'] ?></td>
                          <td><i class="fas fa-edit " onclick="dataEdit(event)" id='<?php echo $row['id'] ?>' category='<?php echo $row['category'] ?>' title="Editar"></i></td>
                          <td><a href="categoryEvalua.php?op=delete&id=<?php echo $row['id'] ?>" onclick="deleteCategory(event)" class="p-3 py-6 text-danger" title="Eliminar"><i class="fas fa-trash  icono "></i></a></td>
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
