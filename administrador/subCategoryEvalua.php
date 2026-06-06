<?php
include("conection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $op = isset($_REQUEST['op']) ? $conn->real_escape_string($_REQUEST['op']) : '';
  $id = isset($_REQUEST['idEdit']) ? $conn->real_escape_string($_REQUEST['idEdit']) : '';
  if ($op == 'delete') {
    $query = "DELETE FROM subcategory WHERE id='{$id}'";
    $_SESSION['estate']='success';
    $_SESSION['msg']="Registro Eliminado Correctamente";
    try {
      $result=$conn->query($query);
      //code...
      } catch (\Throwable $th) {
        $_SESSION['estate']='danger';
        $_SESSION['msg']="ERROR. Tiene que Borrar Antes Todos los Productos Enlazados con esta Sub Categoria";
      header("location:index.php?module=subcategory");
      }
  } elseif ($id) {
    $subcategoryRaw = trim((string) ($_REQUEST['subcategory'] ?? ''));
    $categoryId = (int) ($_REQUEST['category'] ?? 0);
    if (subcategory_name_exists($categoryId, $subcategoryRaw, (int) $id)) {
      $_SESSION['estate']='danger';
      $_SESSION['msg']="Ya existe una sub categoria con ese nombre.";
      header("location:index.php?module=subcategory");
      exit;
    }

    $subcategory = $conn->real_escape_string($subcategoryRaw);
    $category = $conn->real_escape_string((string) $categoryId);
    $slug = $conn->real_escape_string(unique_subcategory_slug($subcategoryRaw, $categoryId, (int) $id));
    $query = "UPDATE subcategory SET id_category='{$category}',subcategory='{$subcategory}',slug='{$slug}' WHERE id='{$id}'";
    $_SESSION['msg']="Registro Editado Correctamente";
    $_SESSION['estate']='success';
    $result = $conn->query($query);
  } else {
    $subcategoryRaw = trim((string) ($_REQUEST['subcategory'] ?? ''));
    $categoryId = (int) ($_REQUEST['category'] ?? 0);
    if (subcategory_name_exists($categoryId, $subcategoryRaw)) {
      $_SESSION['estate']='danger';
      $_SESSION['msg']="Ya existe una sub categoria con ese nombre.";
      header("location:index.php?module=subcategory");
      exit;
    }

    $subcategory = $conn->real_escape_string($subcategoryRaw);
    $category = $conn->real_escape_string((string) $categoryId);
    $slug = $conn->real_escape_string(unique_subcategory_slug($subcategoryRaw, $categoryId));
    $query = "INSERT INTO subcategory(id,id_category,subcategory,slug) VALUES(NULL,'{$category}','{$subcategory}','{$slug}')";
    $_SESSION['estate']='success';
    $_SESSION['msg']="Registro Guardado Correctamente";
    $result = $conn->query($query);
  }

  if ($result) {
    header("location:index.php?module=subcategory");
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al <?php echo $estate ?> Categoria <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}
