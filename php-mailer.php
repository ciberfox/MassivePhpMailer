<?php

require 'phpmailer/PHPMailerAutoload.php';
//connesione al server
$connetto = new mysqli('localhost', 'user', 'password', 'db');
//query
//cerco status non inviato
$sql = "";
//eseguo query
$result=mysqli_query($connetto,$sql);
//conto quante non inviate
$conta = mysqli_num_rows($result); 

//ciclo per invio basato su query
if($conta >0) {
$i = 0; 
while($i < $conta){
$sql = ""; //query dati
$result=mysqli_query($connetto,$sql);
$dati = mysqli_fetch_array($result);
$mailsped= $dati['mail'];
$path= "/file/path/"; // file

//procedura invio
$mail = new PHPMailer();

$mail->IsSMTP(); // chiamo classe smtp
$mail->Host       = "smtp.server.mail"; // SMTP server
$mail->SMTPDebug  = 2;                     // 1 = errors and messages 2 = messages only
$mail->SMTPAuth   = true;                  // abilito autenticazione SMTP
$mail->SMTPSecure = "tls";                 
$mail->Host       = "smtp.server.mail";      // SMTP server
$mail->Port       = 587;                   // porta smtp
$mail->Username   = "user";  // username
$mail->Password   = "pass";            // password
$mail->SetFrom('indirizzo.di@invio', 'Intestazione');
$mail->Subject    = "oggetto";
$mail->MsgHTML('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>titolo html</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
Corpo HTML
</body>
</html>    ');
$mail->AddAttachment($path);
$address = $mailsped;
//$mail->AddBCC("ccmail1", $dati_agente['mail']); // CC
// $mail ->AddBCC("ccmail2"); // CC
$mail->AddAddress($address, "Nome mittente");


//aggiorno status inviato
if(!$mail->Send()) {
 echo "Errore: " . $mail->ErrorInfo;
 } else {
  echo "Spedito a ".$mailsped;
  $connetto = new mysqli('localhost', 'user', 'password', 'database');
$sqlu = "";  
  $result=mysqli_query($connetto,$sqlu);

}
$i++;
}
}

?>
