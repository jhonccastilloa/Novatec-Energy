<?php
include("conection.php");

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sub Categorias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item active">Sub Categoria</li>
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
                  <h3 class="card-title">Agregue, Edite o Elimine sus SubCategorias</h3>
                </div>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <form class="form-horizontal" action="subCategoryEvalua.php" method="GET">
                    <input type="hidden" name="idCat" id="idCat" value="">
                    <div class="form-group">
                      <label for="nombres" class="col-sm-12 ">Sub Categoria: </label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="subCategory" name="subcategory" placeholder="Escriba el Nombre de la SubCategoria">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="area" class="col-sm-12 ">Categoria:</label>
                      <div class="col-sm-12">
                        <select name="category" id="selectCategory" class="form-control">
                          <?php
                          $queryCategory = "SELECT * FROM category";
                          $resultCategory = $conn->query($queryCategory);
                          while ($rowCategory = $resultCategory->fetch_assoc()) {

                          ?>
                            <option value="<?php echo $rowCategory['id'] ?>" ><?php echo $rowCategory['category'] ?></option>
                          <?php
                          }
                          ?>

                        </select>
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
                        <th>Sub Categoria</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT subcategory.id,subcategory.subcategory,category.category,category.id as idCategoria  FROM subcategory LEFT JOIN category ON subcategory.id_category = category.id";
                      $result = $conn->query($query);
                      while ($row = $result->fetch_assoc()) {
                      ?>
                        <tr>
                          <td><?php echo $row['subcategory'] ?></td>
                          <td><?php echo $row['category'] ?></td>
                          <td><i class="fas fa-edit " onclick="dataEditSub(event)" id='<?php echo $row['id'] ?>' category='<?php echo $row['idCategoria'] ?>' subcategory="<?php echo $row['subcategory'] ?>" title="Editar"></i></td>
                          <td><a href="subCategoryEvalua.php?op=delete&id=<?php echo $row['id'] ?>" class="p-3 py-6 text-danger" title="Eliminar"><i class="fas fa-trash  icono "></i></a></td>
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