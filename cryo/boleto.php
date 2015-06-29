<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Boletos Bancários";
if ($user_nivel == 9)
	{	
//	$http_edit = 'cidade_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'boleto.php';
	$http_ver = 'boleto_detalhe_mst.php';
	$http_ver_para = '" target="new" alt = "';
	$http_edit = 'boleto_edit.php';
	$tabela = "cr_boleto";
	$cdf = array('id_bol','bol_sacado','bol_contrato','bol_data_vencimento','bol_nosso_numero','bol_numero_documento','bol_valor_boleto','bol_tx_boleto','bol_status','bol_lido_data','bol_fatura');
	$cdm = array('Código','Sacado','Contrato','venc','nossonumero','doc','valor','tx.bol','s','lido','fatura');
	$masc = array('','','','D','','','$R','$R','','D','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bol_status = 1) ";
	$order  = "bol_data_vencimento desc ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>