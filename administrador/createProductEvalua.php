<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $conn->real_escape_string($_REQUEST['name']);
  $category = $conn->real_escape_string($_REQUEST['category']);
  $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
  $description = $conn->real_escape_string($_REQUEST['description']);
  $price = $conn->real_escape_string($_REQUEST['price']);
  $stock = $conn->real_escape_string($_REQUEST['stock']);
  $image = $_FILES['image']['name'];


  $query = "INSERT INTO productos(id,nombre,descripcion,precio_normal,cantidad,imagen,id_categoria,id_subcategory) VALUES (NULL,'{$name}','{$description}',{$price},{$stock},'{$image}','{$category}',{$subcategory})";
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
        $result = @move_uploaded_file($_FILES['image']['tmp_name'], $archivo);
        if ($result) {
          echo "la imagen se guardo correctamente";
        } else {
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