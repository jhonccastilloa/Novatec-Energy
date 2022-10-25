<?php
include("conection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $op = isset($_REQUEST['op']) ? $conn->real_escape_string($_REQUEST['op']) : '';
  $id = isset($_REQUEST['idEdit']) ? $conn->real_escape_string($_REQUEST['idEdit']) : '';
  if ($op == 'delete') {
    $query = "DELETE FROM subcategory WHERE id='{$id}'";
    echo $query;
    $_SESSION['estate']='danger';
    $_SESSION['msg']="Registro Eliminado Correctamente";
    $result = $conn->query($query);
  } elseif ($id) {
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $category = $conn->real_escape_string($_REQUEST['category']);
    $query = "UPDATE subcategory SET id_category='{$category}',subcategory='{$subcategory}' WHERE id='{$id}'";
    $_SESSION['msg']="Registro Editado Correctamente";
    $_SESSION['estate']='warning ';
    $result = $conn->query($query);
  } else {
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $category = $conn->real_escape_string($_REQUEST['category']);
    $query = "INSERT INTO subcategory(id,id_category,subcategory) VALUES(NULL,'{$category}','{$subcategory}')";
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
