<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
$label = "Cadastro de Mailing";
if ($user_nivel == 9)
	{	
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99=mail_pg'; 
	$editar = true;
	}
	$http_redirect = 'ed_mail_pg.php';
	$http_ver = 'ed_mail_pg_detalhe.php';
	$tabela = "mail_pg";
	$cdf = array('id_mpg','mpg_descricao','mpg_data','mpg_codigo','mpg_mailing','mpg_mailing');
	$cdm = array('Código','Nome da lista','data','codigo','mailing','ativo');
	$masc = array('','','D','','','SN');
	$busca = true;
	$offset = 20;

	$order  = "mpg_data desc ";
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>