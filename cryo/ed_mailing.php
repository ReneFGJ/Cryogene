<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
$label = "Cadastro de Mailing";
if ($user_nivel == 9)
	{	
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99=mailing'; 
	$editar = true;
	}
	$http_redirect = 'ed_mailing.php';
//	$http_ver = 'sistema.php';
	$tabela = "mailing";
	$cdf = array('id_ml','ml_email','ml_nome','ml_tipo','ml_codigo','ml_ativo','ml_ativo');
	$cdm = array('Código','e-mail','Nome','Tipo','codigo','env','ativo');
	$masc = array('','','','','','','SN');
	$busca = true;
	$offset = 20;
	if (strlen($dd[1]) == 0)
		{
		$pre_where = " (ml_ativo = 1) ";
		}
	$order  = "ml_email ";
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>