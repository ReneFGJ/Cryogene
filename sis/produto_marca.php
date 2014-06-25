<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de Marcas de Produtos";
	$tab_max = $tab_max -20;
	$http_edit = 'produto_marca_edit.php';
	$http_redirect = 'produto_marca.php';
//	$http_ver = 'sistema.php';
	$tabela = "produto_marca";
	$cdf = array('id_pm','pm_descricao','pm_codigo');
	$cdm = array('Código','Nome','Codigo');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (us_ativo = 1) ";
	$order  = "pm_descricao ";
	$editar = true;
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>