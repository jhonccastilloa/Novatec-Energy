<?php
require("./administrador/conection.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $phone = $_REQUEST['phone'];
  $subject = $_REQUEST['subject'];
  $message = $_REQUEST['message'];
  $headers =  'From: '.$name.''       . "\r\n" .
              'Reply-To: '.$email.'' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

  $to = "gpro1pro@gmail.com";
  $messages  = "De: $name \n";
  $messages  .= "Correo: $email \n";
  $messages  .= "Telefono: $phone \n";
  $messages  .= "Mensaje: $message ";

  $mail = mail($to, $subject, $messages, $headers);

  if ($mail) {
    header("location: contacto");
  }
}

?>