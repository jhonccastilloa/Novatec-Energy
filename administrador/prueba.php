<?php
include("conection.php");

$stmt = $conn->prepare("INSERT INTO productos (id,nombre,descripcion,precio_normal,precio_rebajado,cantidad,imagen,id_categoria) VALUES ( ?,?, ?, ?, ?, ?, ?, ?)");

$stmt -> bind_param("ssssssss",$id,$nombre,$descripcion,$precio_normal,$precio_rebajado,$cantidad,$imagen,$id_categoria);
$id=NULL;
$nombre='jhon';
$descripcion='descripcion';
$precio_normal='12';
$precio_rebajado='12';
$cantidad='1';
$imagen='1asd';
$id_categoria='1';


$stmt -> execute();

?>