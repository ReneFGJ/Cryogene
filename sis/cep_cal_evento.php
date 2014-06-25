<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de Evento em Calendбrio";
	$tab_max = $tab_max -20;
	$http_edit = 'cep_cal_evento_edit.php';
	$http_redirect = 'cep_cal_evento.php';
//	$http_ver = 'sistema.php';
	$tabela = "cep_calendario_tipo";
	$cdf = array('id_ct','ct_descricao','ct_ev');
	$cdm = array('Cуdigo','Descriзгo','cod');
	$masc = array('','','','','','');
	$busca = true;
	$offset = 20;
	$order  = "ct_descricao ";
	$editar = true;
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>