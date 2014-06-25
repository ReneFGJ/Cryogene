<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de serviços prestados";
if ($user_nivel == 9)
	{	
	$http_edit = 'servico_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'servico.php';
//	$http_ver = 'sistema.php';
	$tabela = "servicos";
	$cdf = array('id_ser','ser_nome','ser_valor');
	$cdm = array('Código','Serviço','valor');
	$masc = array('','','$R');
	$busca = true;
	$offset = 20;
//	$pre_where = " (bco_ativo = 1) ";
	$order  = "ser_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>