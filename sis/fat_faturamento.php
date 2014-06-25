<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Faturamento";
	$http_edit = 'fat_faturamento_emitir.php'; 
	$editar = true;
	$http_redirect = 'fat_faturamento.php';
	$http_ver = 'fat_faturamento_ed.php';
//	$http_ver_para = '" target="new" alt = "';
//	$http_edit = 'fteto_edit.php';
	$tabela = "fatura";
	$cdf = array('id_ft','ft_sacado','ft_data_vencimento','ft_contrato','ft_nr','ft_valor_boleto','ft_tx_boleto','ft_negociacao');
	$cdm = array('Código','Sacado','venc','Contrato','fatura','valor','tx.ft','negociacao');
	$masc = array('','H','D','','','$R','$R','','');
	$busca = true;
	$offset = 60;
	$pre_where = " (ft_status > 0) ";
	$order  = "ft_sacado, ft_data_vencimento ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>