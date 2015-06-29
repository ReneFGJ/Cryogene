<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de cidades";
if ($user_nivel == 9)
	{	
	$http_edit = 'local_coleta_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'local_coleta.php';
//	$http_ver = 'sistema.php';
	$tabela = "local_coleta";
	$cdf = array('id_lc','lc_local','lc_fone_1','lc_fone_2');
	$cdm = array('Código','Local','Telefone 1','Telefone 2');
	$masc = array('','','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "lc_local ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>