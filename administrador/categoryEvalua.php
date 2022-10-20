<?php
include("conection.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $op = isset($_REQUEST['op']) ? $conn->real_escape_string($_REQUEST['op']) : '';
  $id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : '';


  if ($op == 'delete') {
    $query = "DELETE FROM category WHERE id='{$id}'";
    $estate=' eliminado ';
    $result=$conn->query($query);
  } elseif ($id) {
    $category = $conn->real_escape_string($_REQUEST['category']);
    $description = $conn->real_escape_string($_REQUEST['description']);
    $query = "UPDATE category SET category='{$category}',description='{$description}' WHERE id='{$id}'";
    $estate=' editado ';
    $result=$conn->query($query);

  } else {
    $category = $conn->real_escape_string($_REQUEST['category']);
    $description = $conn->real_escape_string($_REQUEST['description']);
    $query = "INSERT INTO category(id,category,description) VALUES(NULL,'{$category}','{$description}')";
    $estate=' guardado ';
    $result=$conn->query($query);
  }

  if ($result) {
    echo '<meta http-equiv="refresh" content="0; url=index.php?module=category&mensaje=Categoria '.$estate.' exitosamente" />  ';
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al <?php echo $estate ?> Categoria <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}
