<?php
include("conection.php");
require_once __DIR__ . "/components/adminAlert.php";

if (!function_exists('subcategoryHtml')) {
  function subcategoryHtml($text)
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
          <h1 class="font-weight-bold">Sub Categoria</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item active">Sub Categorias</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <style>
    #tableSubcategory .col-actions {
      width: 94px;
    }

    #tableSubcategory .taxonomy-actions {
      display: flex;
      gap: 0.35rem;
      justify-content: center;
      white-space: nowrap;
    }

    #tableSubcategory .taxonomy-actions .btn {
      align-items: center;
      display: inline-flex;
      height: 32px;
      justify-content: center;
      width: 32px;
    }
  </style>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-success" id="cardSubCategory">
            <div class="card-header">
              <h3 class="card-title font-weight-bold title-subcategory">AGREGAR SUB CATEGORIA:</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php
              renderAdminSessionAlert();
              ?>
              <div class="row">
                <div class="col-sm-4">
                  <form class="form-horizontal" action="subCategoryEvalua.php" method="GET">
                    <input type="hidden" name="idEdit" id="idCat" value="">
                    <div class="form-group">
                      <label for="area" class="col-sm-12 ">Categoria:</label>
                      <div class="col-sm-12">
                        <select name="category" id="selectCategory" class="form-control" required>
                          <?php
                          $queryCategory = "SELECT * FROM category";
                          $resultCategory = $conn->query($queryCategory);
                          while ($rowCategory = $resultCategory->fetch_assoc()) {

                          ?>
                            <option value="<?php echo $rowCategory['id'] ?>"><?php echo $rowCategory['category'] ?></option>
                          <?php
                          }
                          ?>

                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nombres" class="col-sm-12 ">Sub Categoria: </label>
                      <div class="col-sm-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="subCategory" name="subcategory" placeholder="Escriba el Nombre de la SubCategoria" required>
                          <div class="input-group-append">
                            <button type="button" onclick="erasedTextSub()" class="btn btn-outline-secondary" title="Borrar">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" onclick="cancelSubCategory()" class="btn btn-secondary" id="btnCancelSubCategory" hidden>Cancelar</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-sm-8">
                  <table class="table" id="tableSubcategory">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Sub Categoria</th>
                        <th class="col-actions">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT subcategory.id,subcategory.subcategory,category.category,category.id as idCategoria  FROM subcategory LEFT JOIN category ON subcategory.id_category = category.id";
                      $result = $conn->query($query);
                      while ($row = $result->fetch_assoc()) {
                      ?>
                        <tr>
                          <td><?php echo $row['id'] ?></td>
                          <td><?php echo subcategoryHtml($row['category']) ?></td>
                          <td><?php echo subcategoryHtml($row['subcategory']) ?></td>
                          <td class="col-actions">
                            <div class="taxonomy-actions">
                              <button type="button" onclick="dataEditSub(event)" id="<?php echo $row['id'] ?>" data-category="<?php echo $row['idCategoria'] ?>" data-subcategory="<?php echo subcategoryHtml($row['subcategory']) ?>" class="btn btn-sm btn-info" title="Editar" aria-label="Editar">
                                <i class="fas fa-edit"></i>
                              </button>
                              <a href="subCategoryEvalua.php?op=delete&idEdit=<?php echo $row['id'] ?>" onclick="deleteSubCategory(event)" class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar">
                                <i class="fas fa-trash"></i>
                              </a>
                            </div>
                          </td>
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
