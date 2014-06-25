<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de cidades";
if ($user_nivel == 9)
	{	
	$http_edit = 'cidade_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cidade.php';
//	$http_ver = 'sistema.php';
	$tabela = "cidade";
	$cdf = array('id_c','c_cidade','c_estado','c_pais');
	$cdm = array('Código','cidade','estado','pais');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "c_cidade ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>