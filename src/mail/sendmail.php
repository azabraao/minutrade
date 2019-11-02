<?php
header('Access-Control-Allow-Origin: *');
require("class.phpmailer.php");  
$writeHTML = $email_reply = $nome = $email_to ='';
$not__in = array("tipo_formulario","form_send_to","arquivo","msg_sucesso_formulario");
$tipo_form = $_POST['tipo_formulario'];
$msg_sucesso_formulario = isset($_POST['msg_sucesso_formulario'])?base64_decode($_POST['msg_sucesso_formulario']):'Enviado com sucesso.';
$location_sender = "";

if((isset($_POST['form_send_to']) && !empty($_POST['form_send_to'])))
{
	$_POST['form_send_to'] = base64_decode($_POST['form_send_to']);
	if(strpos($_POST['form_send_to'],",")!==false)$email_to = explode(",",$_POST['form_send_to']);
	else if(strpos($_POST['form_send_to'],";")!==false)$email_to = explode(";",$_POST['form_send_to']);
	else $email_to = $_POST['form_send_to'];
}else{
	$email_to = 'thiago_sto@hotmail.com';
}

foreach($_POST AS $k=>$v)
{
	if(!empty($v))
	{
		if($k=="E-mail")$email_reply = $v;
		if($k=="email")$email_reply = $v;
		if($k=="Nome")$nome = $v;
		if($k=="nome")$nome = $v;
		if(!in_array($k,$not__in))
		{
			$writeHTML .= '<tr><td>'. $k .'</td><td>'. $v .'</td></tr>';
		}
	}
}
$message_content  = '<style>table.zebra{margin:0 auto;}table.zebra tbody tr:nth-child(odd){background:#F9F9F9;}</style><table class="zebra"><thead><td width="200"><b>Campo</b></td><td><b>Valor</b></td></thead><tbody>';
$message_content .= $writeHTML;
$message_content .= '</tbody></table>';

$retorno = array();

#define a mensagem sem anexo
$message = "<style type=\"text/css\">
		/* Resets: see reset.css for details */
		.ReadMsgBody { width: 100%; background-color: #0162A2;}
		.ExternalClass {width: 100%; background-color: #0162A2;}
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
		body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
		body {margin:0; padding:0;}
		table {border-spacing:0;margin:0 auto;}
		table.border_bottom {border-bottom:1px solid #333;}
		table td {border-collapse:collapse;line-height:25px;vertical-align: top;}
		.yshortcuts a {border-bottom: none !important;}
		/* Constrain email width for small screens */
		@media screen and (max-width: 600px) {
			table[class=\"container\"] {
				width: 95% !important;
			}
		}
		/* Give content more room on mobile */
		@media screen and (max-width: 480px) {
			td[class=\"container-padding\"] {
				padding-left: 12px !important;
				padding-right: 12px !important;
			}
		 }
			/* Styles for forcing columns to rows */
			@media only screen and (max-width : 600px) {

				/* force container columns to (horizontal) blocks */
				td[class=\"force-col\"] {
					display: block;
					padding-right: 0 !important;
				}
				table[class=\"col-2\"] {
					/* unset table align=\"left/right\" */
					float: none !important;
					width: 100% !important;

					/* change left/right padding and margins to top/bottom ones */
					margin-bottom: 12px;
					padding-bottom: 12px;
					border-bottom: 1px solid #eee;
				}
				/* remove bottom border for last column/row */
				table[id=\"last-col-2\"] {
					border-bottom: none !important;
					margin-bottom: 0;
				}
				/* align images right and shrink them a bit */
				img[class=\"col-2-img\"] {
					float: right;
					margin-left: 6px;
					max-width: 130px;
				}
			}
			</style>
		</head>
		<body style=\"margin:0 auto; padding:0;border-top:2px solid #BC0923;\" bgcolor=\"#ffffff\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">
		<!-- 100% wrapper (grey background) -->
		<table border=\"0\" width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#fff\">
		  <tr>
			<td align=\"left\" valign=\"top\" bgcolor=\"#ffffff\" style=\"background-color: #ffffff;\">
			  <!-- 600px container (white background) -->
			  <table border=\"0\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\" class=\"container\" bgcolor=\"#ffffff\">
				<tr>
				  <td class=\"container-padding\" bgcolor=\"#ffffff\" style=\"background-color: #ffffff; padding-left: 30px; padding-right: 30px; font-size: 14px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;\">
					<br>
					<div style=\"font-weight: bold; font-size: 24px; line-height: 24px; color: #2C3538;\">
						<div style=\"text-align:center;background:#ffffff;padding:15px;\">
							<img src=\"https://www.utidosdados.com.br/wp-content/themes/utidosdados/images/layout/logo-menu.png\" width=\"117\" />
						</div>
						<div style=\"font-weight: bold; font-size: 20px; line-height: 24px; color: #2C3538;\">
						</div>
					</div>
					<br>
					<div style=\"font-size: 14px; line-height: 24px; color: #0162A2;text-align:center; \"><br>
						Form $tipo_form
					</div>
					<div style=\"font-size: 12px; line-height: 24px; color: #333333;\"><br>
						$message_content
					<br>
					</div>
				</td>
				</tr>
			  </table>
			  <!--/600px container -->
			</td>
		  </tr>
		</table>
		<!--/100% wrapper-->";

/* Condição para mensagem sem anexo */
// Inicia a classe PHPMailer
$mail = new PHPMailer();
$mail->IsSMTP(); // Define que a mensagem será SMTP
//$mail->SMTPDebug = 1;     
$mail->Host = "smtp.sparkpostmail.com";
$mail->Port = 2525;
$mail->SMTPAuth = true;
$mail->Username = 'SMTP_Injection';
$mail->Password = 'c63f29f9d57ded6a2c7c336a962e187308692abb'; 
$mail->Security = 'TLS';
 
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->SetFrom('contato@utidosdados.com.br', 'UTI dos Dados');
$fromName = isset($nome) ? $nome : "Nova mensagem";
$mail->FromName = $fromName; // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
if(isset($array->send_to))
	$mail->AddAddress("{$array->send_to}", "$fromName");
else{
	if(is_array($email_to))
	{
		foreach($email_to AS $emailt)$mail->AddAddress("$emailt", "$fromName");
	}else{
		$mail->AddAddress("$email_to", "$fromName");
	}
}
// Define e-mail de resposta
$mail->addReplyTo($email_reply, $fromName);
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "$tipo_form - Mensagem do Sr(a). $nome"; // Assunto da mensagem
$mail->Body = "$message";
// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
if(isset($_FILES) && array_key_exists("arquivo",$_FILES))
{
	$file = (isset($_FILES["arquivo"]))?$_FILES["arquivo"]:FALSE;
	for($x=0; $x<count($_FILES['arquivo']['name']); $x++)
	{
		if(empty($file['name'][$x]))
		{ 
			unset($file['name'][$x]);
			unset($file['tmp_name'][$x]);
		}else{
			if(is_array($_FILES['arquivo']['name']))
				$mail->AddAttachment($file['tmp_name'][$x],$file['name'][$x]);
			else{
				$mail->AddAttachment($file['tmp_name'],$file['name']);
			}
		}
	}
}
// Envia o e-mail
$enviado = $mail->Send();
// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
// Exibe uma mensagem de resultado

if($enviado) 
{
	$retorno['success'] = true;
	$retorno['content'] = "$msg_sucesso_formulario";
}else{
	$retorno['success'] = false;
	$retorno['content'] = "Oops! Ocorreu um erro.";	
}
#define a ação final
echo json_encode($retorno);
/*echo "Informações do erro: 
" . $mail->ErrorInfo;*/