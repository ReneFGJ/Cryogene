<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Boletos Bancários Quitados";
if ($user_nivel == 9)
	{	
//	$http_edit = 'cidade_edit.php'; 
//	$editar = true;
	}
	$http_redirect = 'boleto_quitado.php';
//	$http_ver = '';
//	$http_ver_para = '" target="new" alt = "';
//	$http_edit = 'boleto_edit.php';
	$tabela = "cr_boleto";
	$cdf = array('id_bol','bol_sacado','bol_contrato','bol_data_vencimento','bol_data_pago','bol_nosso_numero','bol_valor_boleto','bol_tx_boleto','bol_valor_pago');
	$cdm = array('Código','Sacado','Contrato','venc','data paga','nossonumero','valor','tx.bol','vlr pago');
	$masc = array('','','','D','D','','$R','$R','$R','$R');
	$busca = true;
	$offset = 20;
	$pre_where = " (bol_status = 'B') ";
	$order  = "bol_data_pago desc ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>