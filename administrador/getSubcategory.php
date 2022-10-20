<?php 
require("conection.php");

if(isset($_REQUEST['idCategory'])){
$id=$conn->real_escape_string($_REQUEST['idCategory']);
$query="SELECT * FROM subcategory WHERE id_category=${id}";
$result=$conn->query($query);
$dataArray=array();
while($row=$result->fetch_assoc()){
  $item=array(
    "id"=>$row['id'],
    "category"=>$row['id_category'],
    "subcategory"=>$row['subcategory'],
  );
  array_push($dataArray,$item);
}
echo json_encode($dataArray);
}else{
$query="SELECT * FROM subcategory";
$result=$conn->query($query);
$dataArray=array();
while($row=$result->fetch_assoc()){
  $item=array(
    "id"=>$row['id'],
    "category"=>$row['id_category'],
    "subcategory"=>$row['subcategory'],
  );
  array_push($dataArray,$item);
}
echo json_encode($dataArray);}
