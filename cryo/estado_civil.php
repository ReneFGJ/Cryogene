<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de cidades";
if ($user_nivel == 9)
	{	
	$http_edit = 'estado_civil_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'estado_civil.php';
//	$http_ver = 'sistema.php';
	$tabela = "estado_civil";
	$cdf = array('id_ec','ec_descricao','ec_tipo');
	$cdm = array('Código','nome','codigo');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "ec_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>