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
	$http_redirect = 'ed_recibo_2.php';
	$http_ver = 'bb.php';
	$http_ver_para = '" target="new" alt = "';
	$http_edit = 'boleto_edit.php';
	$tabela = "cr_boleto";
	$cdf = array('id_bol','bol_sacado','bol_contrato','bol_data_vencimento','bol_nosso_numero','bol_numero_documento','bol_valor_boleto','bol_tx_boleto','bol_status','bol_lido_data');
	$cdm = array('Código','Sacado','Contrato','venc','nossonumero','doc','valor','tx.bol','s','lido');
	$masc = array('','','','D','','','$R','$R','','D','D','D');
	$busca = true;
	$offset = 20;
	$pre_where = " (bol_data_documento = 20091123 and bol_valor_boleto < 1000 and bol_valor_boleto> 250 and bol_status <> 'X') ";
	$order  = "bol_data_vencimento desc ";
	
//	$sql = "update cr_boleto set bol_valor_boleto = (bol_valor_boleto / 1.098) where ".$pre_where;
//	$rlt = db_query($sql);
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>