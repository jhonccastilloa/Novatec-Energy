<?php

require "conection.php";
if (isset($_REQUEST['idDelete'])) {
  session_start();
  $id = $conn->real_escape_string($_REQUEST['idDelete'] ?? '');
  $image = $conn->real_escape_string($_REQUEST['image'] ?? '');
  $query = "DELETE from productos where id='{$id}'";
  $_SESSION['estate'] = 'success';
  $_SESSION['msg'] = "Registro Eliminado Correctamente.";
  $result = $conn->query($query);

  if ($result) {
    if ($image !== '' && product_has_image(['id' => $id, 'imagen' => $image])) {
      $dir = '../productsImg';
      $file = $dir . '/' . $id . '.' . image_extension($image);
      if (file_exists($file)){
        unlink($file);
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
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  session_start();
  $uploadedImage = $_FILES['image'] ?? null;
  $uploadError = is_array($uploadedImage) ? (int) ($uploadedImage['error'] ?? UPLOAD_ERR_NO_FILE) : UPLOAD_ERR_NO_FILE;
  $hasUploadedImage = is_array($uploadedImage) && $uploadError === UPLOAD_ERR_OK;
  $allowedImageTypes = array("image/jpg", "image/jpeg", "image/png");
  $isEditing = false;
  $previousImageForRollback = '';

  if ($uploadError !== UPLOAD_ERR_NO_FILE && $uploadError !== UPLOAD_ERR_OK) {
    $_SESSION['estate'] = 'danger';
    $_SESSION['msg'] = "Error al cargar Imagen";
    header("location:index.php?module=product");
    exit;
  }

  if ($hasUploadedImage && !in_array((string) ($uploadedImage['type'] ?? ''), $allowedImageTypes, true)) {
    $_SESSION['estate'] = 'danger';
    $_SESSION['msg'] = "Formato de imagen no permitido";
    header("location:index.php?module=product");
    exit;
  }

  if (isset($_REQUEST['idEdit'])) {
    $isEditing = true;
    $nameRaw = trim((string) ($_REQUEST['name'] ?? ''));
    $category = $conn->real_escape_string($_REQUEST['category']);
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $description = $conn->real_escape_string($_REQUEST['description']);
    $price = $conn->real_escape_string($_REQUEST['price']);
    $breve = $conn->real_escape_string($_REQUEST['breve']);
    $idEdit = $conn->real_escape_string($_REQUEST['idEdit']);
    if (product_name_exists($nameRaw, (int) $idEdit)) {
      $_SESSION['estate'] = 'danger';
      $_SESSION['msg'] = "Ya existe un producto con ese nombre.";
      header("location:index.php?module=product");
      exit;
    }

    $name = $conn->real_escape_string($nameRaw);
    $image = $hasUploadedImage ? (string) $uploadedImage['name'] : '';
    $imageAux = trim((string) ($_REQUEST['imageAux'] ?? ''));
    $previousImageForRollback = $imageAux;
    $slug = $conn->real_escape_string(unique_product_slug($nameRaw, (int) $idEdit));
    if (!$image) {
      $image = $imageAux;
    }
    $imageSql = $image !== '' ? "'" . $conn->real_escape_string($image) . "'" : "NULL";

    $query = "UPDATE productos SET id='{$idEdit}',nombre='{$name}',slug='{$slug}',descripcion='{$description}',precio_normal='{$price}',breve_descripcion='{$breve}',imagen={$imageSql},id_categoria='{$category}',id_subcategory='{$subcategory}' WHERE id='{$idEdit}'";
    $id_insert = $idEdit;
    $_SESSION['msg'] = "Registro Editado Correctamente";
    $_SESSION['estate'] = 'success';
    $result = $conn->query($query);
  } else {

    $nameRaw = trim((string) ($_REQUEST['name'] ?? ''));
    $category = $conn->real_escape_string($_REQUEST['category']);
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $description = $conn->real_escape_string($_REQUEST['description']);
    $price = $conn->real_escape_string($_REQUEST['price']);
    $breve = $conn->real_escape_string($_REQUEST['breve']);
    $image = $hasUploadedImage ? (string) $uploadedImage['name'] : '';
    if (product_name_exists($nameRaw)) {
      $_SESSION['estate'] = 'danger';
      $_SESSION['msg'] = "Ya existe un producto con ese nombre.";
      header("location:index.php?module=product");
      exit;
    }

    $name = $conn->real_escape_string($nameRaw);
    $slug = $conn->real_escape_string(unique_product_slug($nameRaw));
    $imageSql = $image !== '' ? "'" . $conn->real_escape_string($image) . "'" : "NULL";


    $query = "INSERT INTO productos(id,nombre,slug,descripcion,precio_normal,breve_descripcion,imagen,id_categoria,id_subcategory) VALUES (NULL,'{$name}','{$slug}','{$description}',{$price},'{$breve}',{$imageSql},'{$category}',{$subcategory})";
    $_SESSION['estate'] = 'success';
    $_SESSION['msg'] = "Producto Guardado Correctamente";
    $result = $conn->query($query);

    $id_insert = $conn->insert_id;
  }

  if ($result) {
    if ($hasUploadedImage) {
      $permitidos = array("image/jpg", "image/jpeg", "image/png");
      if (in_array((string) $uploadedImage['type'], $permitidos, true)) {
        $dir = '../productsImg';
        $file = $dir . '/' . $id_insert . '.' . image_extension((string) $uploadedImage['name']);
        if (!file_exists($dir)) {
          mkdir($dir, 0777);
        }
        $result = @move_uploaded_file((string) $uploadedImage['tmp_name'], $file);

        if (!$result) {
          $rollbackImageSql = $isEditing && $previousImageForRollback !== '' ? "'" . $conn->real_escape_string($previousImageForRollback) . "'" : "NULL";
          $conn->query("UPDATE productos SET imagen={$rollbackImageSql} WHERE id='{$id_insert}'");
          $_SESSION['estate'] = 'danger';
          $_SESSION['msg'] = "Error al guardar Imagen";
        }
      } else {
        $_SESSION['estate'] = 'danger';
        $_SESSION['msg'] = "Formato de imagen no permitido";
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
