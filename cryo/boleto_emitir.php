<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Emitir Boleto para Clientes";
if ($user_nivel > 0)
	{	
	$editar = true;
	}
	$http_redirect = 'boleto_emitir.php';
	$http_ver = 'boleto_emitir_a.php';
//	$http_ver = 'sistema.php';
	$tabela = "contrato";
	$cdf = array('id_ctr','ctr_responsavel_nome','ctr_numero','ctr_dt_assinatura');
	$cdm = array('Código','Nome','contrato','dt.assinatura');
	$masc = array('','@','@','D');
	$busca = true;
	$offset = 20;
	//$pre_where = " (ctr_status <> 'N')";
	$order = "ctr_responsavel_nome";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	