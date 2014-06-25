<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de usuários";
	$tab_max = $tab_max -20;
	$http_edit = 'user_edit.php';
	$http_redirect = 'user.php';
//	$http_ver = 'sistema.php';
	$tabela = "usuario";
	$cdf = array('id_us','us_nome','us_login');
	$cdm = array('Código','Nome','Login');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
//	$pre_where = " (us_ativo = 1) ";
	$order  = "us_nome ";
	$editar = true;
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>