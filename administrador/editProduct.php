<?php
include("conection.php");
include("editProductEvalua.php");

$id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : "";
$query = "SELECT * FROM productos WHERE id='{$id}'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$queryCategory = "SELECT * FROM category";
$resultCategory = $conn->query($queryCategory);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edite el producto</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item active">Editar</li>
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
            <!-- /.card-header -->
            <div class="card-body">

              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Editar</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">


                  <form action="index.php?module=editProduct" method="post" enctype="multipart/form-data">
                    <input type="text" name="idEdit" value="<?php echo $row['id'] ?>" hidden>
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nombre del Producto:</label>
                          <input type="text" class="form-control" name="name" value="<?php echo $row['nombre'] ?>" placeholder="Enter ...">

                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Categoria:</label>
                          <select name="category" class="form-control" id="productCategory">
                            <?php
                            while ($rowCategory = $resultCategory->fetch_assoc()) {

                            ?>
                              <option value="<?php echo $rowCategory['id'] ?>" <?php echo ($row['id_categoria'] == $rowCategory['id'] ? 'selected' : '') ?>><?php echo $rowCategory['category'] ?></option>
                            <?php
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Sub Categoria:</label>
                          <select name="subcategory" class="form-control" id="productSubcategory">
                            <?php
                            $querySubcategory='SELECT * FROM subcategory ';
                            $resultSubcategory=$conn->query($querySubcategory);
                            while ($rowSubcategory = $resultSubcategory->fetch_assoc()) {

                            ?>
                              <option value="<?php echo $rowSubcategory['id'] ?>" <?php echo ($rowSubcategory['id'] == $row['id_subcategory'] ? 'selected' : '') ?>><?php echo $rowSubcategory['subcategory'] ?></option>
                            <?php
                            }
                            ?>
                          </select>

                        </div>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Descripccion</label>
                          <textarea name="description" id="editor" rows="10" cols="80"> <?php echo $row['descripcion'] ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Imagen</label>
                          <input type="text" name="imageAux" value="<?php echo $row['imagen'] ?>">
                          <input type="file" class="form-control" name="image" accept="image/*">
                          <?php
                          $path = "../imgProducts/" . $row['id'];
                          echo $path;
                          if (file_exists($path)) {
                            $directory = opendir($path);
                            while ($archivo = readdir($directory)) {
                              if (!is_dir($archivo)) {
                                echo "<div data='" . $path . "/" . $archivo . "'><a href='" . $path . "/" . $archivo . "' title='Ver Archivo Adjunto'><span class='fas fa-file-image'></span></a>";
                                echo "$archivo <button type='button' class='delete' title='Ver Archivo Adjunto'><i class='fas fa-trash' aria-hidden='true'></i></button></div>";
                                echo "<img src='../imgProducts/" . $row['id'] . "/$archivo' width='300'/>";
                              }
                            }
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Precio del Producto</label>
                          <input type="number" class="form-control" name="price" value="<?php echo $row['precio_normal'] ?>" placeholder="Ingrese un precio">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Cantidad del Producto</label>
                          <input type="number" class="form-control" name="stock" value="<?php echo $row['cantidad'] ?>" placeholder="Ingrese el Stock">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">

                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
                <!-- /.card-body -->
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
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="ckeditor/ckeditor.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.delete').click(function() {
      var parent = $(this).parent().attr('id');
      var service = $(this).parent().attr('data');
      var dataString = 'id=' + service;
      $.ajax({
        type: "POST",
        url: "del_file.php",
        data: dataString,
        success: function() {
          location.reload();
        }
      });
    });
  });
  ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
</script>