<?php
require("./administrador/conection.php");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name=$_REQUEST['name'];
  $email=$_REQUEST['email'];
  $phone=$_REQUEST['phone'];
  $subject=$_REQUEST['subject'];
  $message=$_REQUEST['message'];

  $to="gpro1pro@gmail.com";
  $headers  = "De: $name \n";
  $headers  .= "Correo: $email \n";
  $headers  .= "Telefono: $phone \n";
  $headers  .= "Mensaje: $message ";

  $mail=mail($to,$subject,$headers);

  if($mail){
    header("location: contacto");
  }

}


?>