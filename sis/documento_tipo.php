<?
require("cab.php");
require('include/sisdoc_colunas.php');

$label = "Cadastro de Tipos de Documentos";
if ($user_nivel == 9)
	{	
	$http_edit = 'documento_tipo_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'documento_tipo.php';
//	$http_ver = 'sistema.php';
	$tabela = "documento_tipo";
	$cdf = array('id_dt','dt_descricao','dt_codigo');
	$cdm = array('Código','Descricao','Código');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (dt_ativo = 1) ";
	$order  = "dt_descricao ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>