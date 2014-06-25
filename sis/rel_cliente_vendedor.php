<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Clientes Cadastrados";
	$tab_max = $tab_max -20;
	$http_edit = 'produto_edit.php';
	$http_redirect = 'produto.php';
//	$http_ver = 'sistema.php';
	$tabela = "cliente";
	$cdf = array('id_cl','cl_nome','cl_fone_ddd','cl_fone_1','cl_fone_2','cl_fone_3','cl_email');
	$cdm = array('Código','Nome','DDD','fone(1)','fone(2)','fone(3)','e-mail');
	$masc = array('','','','','','','','');
	$busca = false;
	$offset = 200000;
	$order  = "cl_nome";
	$editar = false;
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>