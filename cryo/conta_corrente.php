<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de conta corrente";
if ($user_nivel == 9)
	{	
	$http_edit = 'conta_corrente_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'conta_corrente.php';
//	$http_ver = 'sistema.php';
	$tabela = "conta_corrente";
	$cdf = array('id_cc','cc_nome','cc_banco','cc_agencia','cc_nr_conta','cc_ativo');
	$cdm = array('Código','Nome','Banco','Agencia','Conta','Ativo');
	$masc = array('','','','','','SN');
	$busca = true;
	$offset = 20;
//	$pre_where = " (cc_ativo = 1) ";
	$order  = "cc_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>