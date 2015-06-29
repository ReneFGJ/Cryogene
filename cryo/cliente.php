<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Cadastro de clientes";
if ($user_nivel > 0)
	{	
	$http_edit = 'cliente_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cliente.php';
	$http_ver = 'cliente_ver.php';
//	$http_ver = 'sistema.php';
	$tabela = "cliente";
	$cdf = array('id_cl','cl_nome','cl_cpf','cl_fone_ddd','cl_fone_1','cl_fone_2','cl_dt_cadastro');
	$cdm = array('Código','Nome','cpf','ddd/ddi','fone 1','fone 2','dt.update');
	$masc = array('','@','@','@','','','D');
	$busca = true;
	$offset = 200;
	$order = "cl_nome";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	