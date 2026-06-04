<?php
include("conection.php");
require_once __DIR__ . "/components/adminAlert.php";

if (!function_exists('categoryHtml')) {
  function categoryHtml($text)
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
  <style>
    .taxonomy-admin-row {
      row-gap: 1rem;
    }

    #tableCategory {
      min-width: 420px;
    }

    #tableCategory .col-actions {
      width: 94px;
    }

    #tableCategory .taxonomy-actions {
      display: flex;
      gap: 0.35rem;
      justify-content: center;
      white-space: nowrap;
    }

    #tableCategory .taxonomy-actions .btn {
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
          <div class="card card-success" id="cardCategory">
            <div class="card-header">
              <h3 class="card-title font-weight-bold title-category">AGREGAR CATEGORIA:</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php
              renderAdminSessionAlert();
              ?>

              <div class="row taxonomy-admin-row">
                <div class="col-lg-4">
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
                <div class="col-lg-8 admin-table-panel">
                  <div class="admin-table-scroll">
                  <table class="table table-sm  table-hover" id="tableCategory">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th class="col-actions">Acciones</th>
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
                          <td><?php echo categoryHtml($row['category']) ?></td>
                          <td class="col-actions">
                            <div class="taxonomy-actions">
                              <button type="button" onclick="dataEdit(event)" id="<?php echo $row['id'] ?>" data-category="<?php echo categoryHtml($row['category']) ?>" class="btn btn-sm btn-info" title="Editar" aria-label="Editar">
                                <i class="fas fa-edit"></i>
                              </button>
                              <a href="categoryEvalua.php?op=delete&id=<?php echo $row['id'] ?>" onclick="deleteCategory(event)" class="btn btn-sm btn-danger" title="Eliminar" aria-label="Eliminar">
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
