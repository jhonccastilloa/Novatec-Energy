<?php
session_start();
include("conection.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $op = isset($_REQUEST['op']) ? $conn->real_escape_string($_REQUEST['op']) : '';
  $id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : '';


  if ($op == 'delete') {
    $query = "DELETE FROM category WHERE id='{$id}'";
    $_SESSION['estate']='success';
    $_SESSION['msg']="Registro eliminado correctamente.";
    try {
    $result=$conn->query($query);
    //code...
    } catch (\Throwable $th) {
      $_SESSION['estate']='danger';
      $_SESSION['msg']="Error. Debe borrar antes todas las subcategorías y productos enlazados con esta categoría.";
    header("location:index.php?module=category");
    }
  } elseif ($id) {
    $categoryRaw = trim((string) ($_REQUEST['category'] ?? ''));
    if (category_name_exists($categoryRaw, (int) $id)) {
      $_SESSION['estate']='danger';
      $_SESSION['msg']="Ya existe una categoría con ese nombre.";
      header("location:index.php?module=category");
      exit;
    }

    $category = $conn->real_escape_string($categoryRaw);
    $slug = $conn->real_escape_string(unique_category_slug($categoryRaw, (int) $id));
    $query = "UPDATE category SET category='{$category}', slug='{$slug}' WHERE id='{$id}'";
    $_SESSION['msg']="Registro editado correctamente.";
    $_SESSION['estate']='success';
    $result=$conn->query($query);

  } else {
    $categoryRaw = trim((string) ($_REQUEST['category'] ?? ''));
    if (category_name_exists($categoryRaw)) {
      $_SESSION['estate']='danger';
      $_SESSION['msg']="Ya existe una categoría con ese nombre.";
      header("location:index.php?module=category");
      exit;
    }

    $category = $conn->real_escape_string($categoryRaw);
    $slug = $conn->real_escape_string(unique_category_slug($categoryRaw));
    $query = "INSERT INTO category(id,category,slug) VALUES(NULL,'{$category}','{$slug}')";
    $_SESSION['estate']='success';
    $_SESSION['msg']="Registro guardado correctamente.";
    $result=$conn->query($query);
  }

  if ($result) {
    header("location:index.php?module=category");
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al <?php echo $estate ?> categoría <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}
