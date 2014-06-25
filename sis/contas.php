<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de moedas";

if ($user_nivel == 9)
	{	
	$http_edit = 'contas_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'contas.php';
//	$http_ver = 'sistema.php';
	$tabela = "contas_tipo";
	$cdf = array('id_ct','ct_descricao','ct_codigo','ct_tipo');
	$cdm = array('Código','Descricao','Codigo','tipo');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (ct_ativo = 1) ";
	$order  = "ct_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>