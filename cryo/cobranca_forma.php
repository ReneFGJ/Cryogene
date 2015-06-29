<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Formas de cobrança";
if ($user_nivel == 9)
	{	
	$http_edit = 'cobranca_forma_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cobranca_forma.php';
//	$http_ver = 'sistema.php';
	$tabela = "cobranca_forma";
	$cdf = array('id_fc','fc_nome','fc_codigo','fc_parcela','fc_ativo');
	$cdm = array('Código','Nome cobrança','codigo','parcelas','ativo');
	$masc = array('','','','','SN');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "fc_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>