<?php
include("conection.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $op = isset($_REQUEST['op']) ? $conn->real_escape_string($_REQUEST['op']) : '';
  $id = isset($_REQUEST['id']) ? $conn->real_escape_string($_REQUEST['id']) : '';


  if ($op == 'delete') {
    $query = "DELETE FROM subcategory WHERE id='{$id}'";
    $estate=' eliminado ';
    $result=$conn->query($query);
  } elseif ($id) {
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $category = $conn->real_escape_string($_REQUEST['category']);
    $query = "UPDATE subcategory SET id_category='{$category}',subcategory='{$subcategory}' WHERE id='{$id}'";
    $estate=' editado ';
    $result=$conn->query($query);

  } else {
    $subcategory = $conn->real_escape_string($_REQUEST['subcategory']);
    $category = $conn->real_escape_string($_REQUEST['category']);
    $query = "INSERT INTO subcategory(id,id_category,subcategory) VALUES(NULL,'{$category}','{$subcategory}')";
    $estate=' guardado ';
    $result=$conn->query($query);
  }

  if ($result) {
    echo '<meta http-equiv="refresh" content="0; url=index.php?module=subcategory&mensaje=Sub Categoria '.$estate.' exitosamente" />  ';
  } else {
?>
    <div class="alert alert-danger" role="alert">
      Error al <?php echo $estate ?> Categoria <?php echo mysqli_error($conn); ?>
    </div>
<?php
  }
}
