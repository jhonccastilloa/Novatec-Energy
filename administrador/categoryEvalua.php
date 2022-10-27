<?php
session_start();
include("conection.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $op = isset($_REQUEST['op']) ? $conn->real_escape_string($_REQUEST['op']) : '';
  $id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : '';


  if ($op == 'delete') {
    $query = "DELETE FROM category WHERE id='{$id}'";
    $_SESSION['estate']='danger';
    $_SESSION['msg']="Registro Eliminado Correctamente.";
    try {
    $result=$conn->query($query);
    //code...
    } catch (\Throwable $th) {
      $_SESSION['estate']='danger';
      $_SESSION['msg']="ERROR. Tiene que  Borrar Antes Todas las Subcategorias y Productos Enlazados con esta Categoria";
    header("location:index.php?module=category");
    }
  } elseif ($id) {
    $category = $conn->real_escape_string($_REQUEST['category']);
    $query = "UPDATE category SET category='{$category}' WHERE id='{$id}'";
    $_SESSION['msg']="Registro Editado Correctamente.";
    $_SESSION['estate']='warning ';
    $result=$conn->query($query);

  } else {
    $category = $conn->real_escape_string($_REQUEST['category']);
    $query = "INSERT INTO category(id,category) VALUES(NULL,'{$category}')";
    $_SESSION['estate']='success';
    $_SESSION['msg']="Registro Guardado Correctamente.";
    $result=$conn->query($query);
  }

  if ($result) {
    header("location:index.php?module=category");
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al <?php echo $estate ?> Categoria <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}
