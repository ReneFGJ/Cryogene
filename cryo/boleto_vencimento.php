<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Boletos Bancários Abertos";
if ($user_nivel == 9)
	{	
//	$http_edit = 'cidade_edit.php'; 
//	$editar = true;
	}
	$http_redirect = 'boleto_vencimento.php';
//	$http_ver = '';
//	$http_ver_para = '" target="new" alt = "';
//	$http_edit = 'boleto_edit.php';
	$tabela = "cr_boleto";
	$cdf = array('id_bol','bol_data_vencimento','bol_sacado','bol_contrato','bol_nosso_numero','bol_valor_boleto','bol_tx_boleto');
	$cdm = array('Código','venc','Sacado','Contrato','nossonumero','valor','tx.bol');
	$masc = array('','HD','','','','$R','$R','$R','$R');
	$busca = true;
	$offset = 60;
	$pre_where = " (bol_status = 'A') ";
	$order  = "bol_data_vencimento ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>