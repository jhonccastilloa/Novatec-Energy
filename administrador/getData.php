<?php 
require("conection.php");

if(isset($_REQUEST['id'])){
$id=$conn->real_escape_string($_REQUEST['id']);
$query="SELECT * FROM category WHERE id=${id}";
$result=$conn->query($query);
$row=$result->fetch_assoc();
echo json_encode($row);
}else{
$query="SELECT * FROM category";
$result=$conn->query($query);
$dataArray=array();
while($row=$result->fetch_assoc()){
  $item=array(
    "id"=>$row['id'],
    "category"=>$row['category']
  );
  array_push($dataArray,$item);
}
echo json_encode($dataArray);}
