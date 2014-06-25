<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
$label = "Cadastro de Mailing";
if ($user_nivel == 9)
	{	
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99=mail'; 
	$editar = true;
	}
	$http_redirect = 'ed_sistema.php';
	$http_ver = 'ed_mail_in.php';
	$tabela = "mail";
	$cdf = array('id_mail','mail_nome','mail_codigo','mail_table','mail_ativo');
	$cdm = array('Código','Nome da lista','codigo','tabela','ativo');
	$masc = array('','','','','SN');
	$busca = true;
	$offset = 20;
	if (strlen($dd[0]) == 0)
		{
		$pre_where = " (mail_ativo = 1) ";
		}
	$order  = "mail_nome ";
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>