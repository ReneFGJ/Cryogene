<?
require("cab.php");
require($include.'sisdoc_menus.php');
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

if (($user_nivel) >=1) { 
	}
if (($user_nivel) >=9) { 	 
	array_push($menu,array('Médicos','Cadastro de contratos','ed_contrato_medidco.php')); 
	array_push($menu,array('Médicos','Cadastro médicos','ed_medico.php')); 

	array_push($menu,array('Mailling','Campanha (mailing)','ed_mail_pg.php')); 
	array_push($menu,array('Mailling','Mailing (tipo)','ed_mail.php')); 
	array_push($menu,array('Mailling','Lista de e-mail','ed_mailing.php')); 
	array_push($menu,array('Mailling','Resumo','wb_resumo.php')); 
	array_push($menu,array('Mailling','Reseta envio','wb_resumo_zera.php')); 
	array_push($menu,array('Mailling','Importar e-mail (cryo.com.br)','ed_mailing_import.php')); 
	array_push($menu,array('Mailling','e-mail (Clientes)','rel_cliente_email.php')); 
	array_push($menu,array('Mailling','e-mail (Médicos)','rel_medico_email.php')); 
	array_push($menu,array('Mailling','Importar e-mail','ed_mail_in.php')); 
//	array_push($menu,array('Empresa','Empresas','empresa.php')); 
	 }
///////////////////////////////////////////////////// redirecionamento
if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}
echo menus($menu,3);

require("foot.php");	
?>