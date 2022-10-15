<?php
include("conection.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $conn->real_escape_string($_REQUEST['name']);
  $category = $conn->real_escape_string($_REQUEST['category']);
  $description = $conn->real_escape_string($_REQUEST['description']);
  $price = $conn->real_escape_string($_REQUEST['price']);
  $discount = $conn->real_escape_string($_REQUEST['discount']);
  $stock = $conn->real_escape_string($_REQUEST['stock']);
  $image = $_FILES['image']['name'];


  $query = "INSERT INTO productos(id,nombre,descripcion,precio_normal,precio_rebajado,cantidad,imagen,id_categoria) VALUES (NULL,'{$name}','{$description}',{$price},{$discount},{$stock},'{$image}','{$category}')";
  $result = $conn->query($query);

  $id_insert = $conn->insert_id;
  if ($_FILES['image']['error'] > 0) {
    echo "Error al cargar Archivo";
  } else {
    $permitidos = array("image/jpg", "image/jpeg", "image/png");
    $limit_kb = 50000;
    if (in_array($_FILES['image']['type'], $permitidos) and $_FILES['image']['size'] <= $limit_kb * 1024) {
      $ruta = '../imgProducts/' . $id_insert . '/';
      $archivo = $ruta . $_FILES['image']['name'];
      if (!file_exists($ruta)) {
        mkdir($ruta);
      }
      if (!file_exists($archivo)) {
        $result=@move_uploaded_file($_FILES['image']['tmp_name'],$archivo);
        if($result){
          echo "la imagen se guardo correctamente";
        }else{
          echo "la imagen no  se guardo ";

        }
      }
    } else {
      echo "Archivo no permitido o excede el tamaño";
    }
  }
  if ($result) {
    echo '<meta http-equiv="refresh" content="0; url=index.php?module=product&mensaje=Producto agregado exitosamente" />  ';
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al añadir producto <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }

 
}

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Agregar un Nuevo Producto</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Inicio</a></li>
            <li class="breadcrumb-item active">Agregar</li>
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


                  <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="module" value="createProduct" hidden>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nombre del Producto</label>
                          <input type="text" class="form-control" name="name" placeholder="Ingerse un nombre">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Categoria</label>
                          <input type="text" class="form-control" name="category" placeholder="Enter ...">
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
                          <textarea name="description" id="editor" rows="10" cols="80"> </textarea>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Precio del Producto</label>
                          <input type="number" class="form-control" name="price" placeholder="Ingrese un precio">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Rebaja</label>
                          <input type="number" class="form-control" name="discount" placeholder="Ingrese la Rebaja">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Cantidad del Producto</label>
                          <input type="number" class="form-control" name="stock" placeholder="Ingrese el Stock">
                        </div>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Imagen</label>
                          <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
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