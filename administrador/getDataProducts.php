<?php 
require("conection.php");

if(isset($_REQUEST['idProduct'])){
$id=$conn->real_escape_string($_REQUEST['idProduct']);
$query="SELECT * FROM productos WHERE id_categoria=${id}";
$result=$conn->query($query);
$dataArray=array();
while($row=$result->fetch_assoc()){
  $item=array(
    "id"=>$row['id'],
    "name"=>$row['nombre'],
    "price"=>$row['precio_normal'],
    "stock"=>$row['cantidad'],
    "image"=>$row['imagen'],
    "category"=>$row['id_categoria'],
    "subcategory"=>$row['id_subcategory']
  );
  array_push($dataArray,$item);
}
echo json_encode($dataArray);
}else{
$query="SELECT * FROM productos";
$result=$conn->query($query);
$dataArray=array();
while($row=$result->fetch_assoc()){
  $item=array(
    "id"=>$row['id'],
    "name"=>$row['nombre'],
    "price"=>$row['precio_normal'],
    "stock"=>$row['cantidad'],
    "image"=>$row['imagen'],
    "category"=>$row['id_categoria'],
    "subcategory"=>$row['id_subcategory']

  );
  array_push($dataArray,$item);
}
echo json_encode($dataArray);}
