<?php
include("conection.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $conn->real_escape_string($_REQUEST['name']);
  $category = $conn->real_escape_string($_REQUEST['category']);
  $description = $conn->real_escape_string($_REQUEST['description']);
  $price = $conn->real_escape_string($_REQUEST['price']);
  $discount = $conn->real_escape_string($_REQUEST['discount']);
  $stock = $conn->real_escape_string($_REQUEST['stock']);
  $idEdit = $conn->real_escape_string($_REQUEST['idEdit']);


  $query = "UPDATE productos SET id='{$idEdit}',nombre='{$name}',descripcion='{$description}',precio_normal='{$price}',precio_rebajado='{$discount}',cantidad='{$stock}',id_categoria='{$category}' WHERE id='{$idEdit}'";
  if ($result = $conn->query($query)) {
    echo '<meta http-equiv="refresh" content="0; url=index.php?module=product&mensaje=Producto ' . $name . ' editado exitosamente" />  ';
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al editar producto <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}
$id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : "";

$query = "SELECT * FROM productos WHERE id='{$id}'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

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
                  <h3 class="card-title">Producto</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">


                  <form action="index.php?module=editProduct" method="post">
                    <input type="text" name="idEdit" value="<?php echo $row['id'] ?>" hidden>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nombre del Producto</label>
                          <input type="text" class="form-control" name="name" value="<?php echo $row['nombre'] ?>" placeholder="Ingerse un nombre">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Categoria</label>
                          <input type="text" class="form-control" name="category" value="<?php echo $row['id_categoria'] ?>" placeholder="Enter ...">
                        </div>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Descripccion</label>

                          <!-- <div id="editor">
                            <p>Hello World!</p>
                            <p>Some initial <strong>bold</strong> text</p>
                            <p><br></p>
                          </div> -->
                          <textarea name="description" id="editor" rows="10" cols="80"> <?php echo $row['descripcion'] ?></textarea>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Precio del Producto</label>
                          <input type="number" class="form-control" name="price" value="<?php echo $row['precio_normal'] ?>" placeholder="Ingrese un precio">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Rebaja</label>
                          <input type="number" class="form-control" name="discount" value="<?php echo $row['precio_rebajado'] ?>" placeholder="Ingrese la Rebaja">
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
                        <label>Imagen</label>
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
</script>