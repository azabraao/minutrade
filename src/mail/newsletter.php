<?php   

error_reporting ( E_ALL );

include "PHPMailerAutoload.php"; 

$mail = new PHPMailer(); 
$email->SMTPDebug = 1;
$mail->IsSMTP(); 
$mail->Host = "smtp.sparkpostmail.com"; 
$mail->SMTPAuth = true; 
$mail->Port = 2525;
$email->SMTPSecure = 'tls';
$mail->Username = "SMTP_Injection";
$mail->Password = '85d670579843b63c5e1749fe5907bf6ddd4bd145'; 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
$mail->From = "william.felix@newbrasilag.com.br";
$mail->FromName = "Minutrade"; 

// $mail->AddAddress("az.abraao@gmail.com", "Abraao"); 
$mail->IsHTML(true);

$mail->CharSet = 'UTF-8'; 
$mail->Subject = "Assinatura de Newsletter"; 
$mail->clearAddresses();
$mail->Body = "Alguém assinou sua newsletter. <br/> email:".$_GET['email'];

$mail->AddAddress('ivens.costa@minutrade.com', 'Ivens');
$mail->AddAddress('Mayara.reis@minutrade.com', 'Mayara');
$mail->AddAddress('Oswaldo.oggiam@minutrade.com', 'Oswaldo');
// $mail->AddAddress('william.felix@newbrasilag.com.br', 'Willian');
// $mail->AddAddress('az.abraao@gmail.com', 'Ivens');

$enviado = $mail->Send() or die('Erro no envio aos destinarários finais'.$mail->ErrorInfo);

if ($enviado) { 
    echo "Seu email foi enviado com sucesso!"; 
} else { 
    echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
} 


?>