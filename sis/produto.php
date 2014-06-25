<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de Produtos";
	
	$http_edit = 'produto_edit.php';
	$http_redirect = 'produto.php';
	$http_ver = 'produto_lote.php';
	$tabela = "produto";
	$cdf = array('id_produto','produto_descricao','produto_quantidade','produto_codigo');
	$cdm = array('Código','Descricao','Quant','');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$order  = "upper((produto_descricao))";
	$editar = true;
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>