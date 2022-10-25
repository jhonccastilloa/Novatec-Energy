<?php
require "conection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $conn->real_escape_string($_REQUEST['name']);
  $category = $conn->real_escape_string($_REQUEST['category']);
  $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
  $description = $conn->real_escape_string($_REQUEST['description']);
  $price = $conn->real_escape_string($_REQUEST['price']);
  $stock = $conn->real_escape_string($_REQUEST['stock']);
  $idEdit = $conn->real_escape_string($_REQUEST['idEdit']);
  $image = $_FILES['image']['name'];
  $imageAux = $conn->real_escape_string($_REQUEST['imageAux']);
  if (!$image) {
    $image = $imageAux;
  }

  $query = "UPDATE productos SET id='{$idEdit}',nombre='{$name}',descripcion='{$description}',precio_normal='{$price}',cantidad='{$stock}',imagen='{$image}',id_categoria='{$category}',id_subcategory='{$subcategory}' WHERE id='{$idEdit}'";
  $id_insert = $idEdit;
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
  $result = $conn->query($query);

  if ($result) {
    echo '<meta http-equiv="refresh" content="0; url=index.php?module=product&mensaje=Producto editado exitosamente" />  ';
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al editar producto <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}
?>