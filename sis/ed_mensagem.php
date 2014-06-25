<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Cadastro de Informação / Documento / Mensagem";
if ($user_nivel == 9)
	{	
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99=noticia';
	$editar = true;
	}
	$http_redirect = 'ed_mensagem.php';
//	$http_ver = 'sistema.php';
	$tabela = "ic_noticia";
	$cdf = array('id_nw','nw_titulo','nw_ref','nw_dt_de','nw_dt_ate');
	$cdm = array('Código','Titulo','ref','de','ate');
	$masc = array('','','','D','D');
	$busca = true;
	$offset = 20;
	$pre_where = " (nw_ativo = 1) ";
	$order  = "nw_dt_de ";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>