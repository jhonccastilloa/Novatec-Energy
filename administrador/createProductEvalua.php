<?php

require "conection.php";
if (isset($_REQUEST['idDelete'])) {
  session_start();
  $id = $conn->real_escape_string($_REQUEST['idDelete'] ?? '');
  $image = $conn->real_escape_string($_REQUEST['image'] ?? '');
  $query = "DELETE from productos where id='{$id}'";
  $_SESSION['estate'] = 'danger';
  $_SESSION['msg'] = "Registro Eliminado Correctamente.";
  $result = $conn->query($query);

  $array = explode('.', $image);
  $ext = end($array);

  if ($result) {
    $dir = '../productsImg';
    $file = $dir . '/' . $id . '.' . $ext;
    if (file_exists($file)){
      unlink($file);
    }
      header("location:index.php?module=product");
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al <?php echo $estate ?> producto <?php echo mysqli_error($conn); ?>
    </div>
  <?php
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  session_start();
  if (isset($_REQUEST['idEdit'])) {
    $name = $conn->real_escape_string($_REQUEST['name']);
    $category = $conn->real_escape_string($_REQUEST['category']);
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $description = $conn->real_escape_string($_REQUEST['description']);
    $price = $conn->real_escape_string($_REQUEST['price']);
    $breve = $conn->real_escape_string($_REQUEST['breve']);
    $idEdit = $conn->real_escape_string($_REQUEST['idEdit']);
    $image = $_FILES['image']['name'];
    $imageAux = $conn->real_escape_string($_REQUEST['imageAux']);
    if (!$image) {
      $image = $imageAux;
    }

    $query = "UPDATE productos SET id='{$idEdit}',nombre='{$name}',descripcion='{$description}',precio_normal='{$price}',breve_descripcion='{$breve}',imagen='{$image}',id_categoria='{$category}',id_subcategory='{$subcategory}' WHERE id='{$idEdit}'";
    $id_insert = $idEdit;
    $_SESSION['msg'] = "Registro Editado Correctamente";
    $_SESSION['estate'] = 'warning ';
    $result = $conn->query($query);
  } else {

    $name = $conn->real_escape_string($_REQUEST['name']);
    $category = $conn->real_escape_string($_REQUEST['category']);
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $description = $conn->real_escape_string($_REQUEST['description']);
    $price = $conn->real_escape_string($_REQUEST['price']);
    $breve = $conn->real_escape_string($_REQUEST['breve']);
    $image = $_FILES['image']['name'];


    $query = "INSERT INTO productos(id,nombre,descripcion,precio_normal,breve_descripcion,imagen,id_categoria,id_subcategory) VALUES (NULL,'{$name}','{$description}',{$price},'{$breve}','{$image}','{$category}',{$subcategory})";
    $_SESSION['estate'] = 'success';
    $_SESSION['msg'] = "Producto Guardado Correctamente";
    $result = $conn->query($query);

    $id_insert = $conn->insert_id;
  }

  if ($result) {
    if ($_FILES['image']['error'] == 0) {
      $permitidos = array("image/jpg", "image/jpeg", "image/png");
      if (in_array($_FILES['image']['type'], $permitidos)) {
        $dir = '../productsImg';
        $infoImg = pathinfo($_FILES['image']['name']);
        $file = $dir . '/' . $id_insert . '.' . $infoImg['extension'];
        if (!file_exists($dir)) {
          mkdir($dir, 0777);
        }
        $result = @move_uploaded_file($_FILES['image']['tmp_name'], $file);

        if (!$result) {
          echo "Error al guardar Imagen";
        }
      } else {
        echo "Formato de imagen no permitido";
      }
    }
    header("location:index.php?module=product");
  } else {
  ?>
    <div class="alert alert-danger" role="alert">
      Error al <?php echo $estate ?> producto <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}





?>