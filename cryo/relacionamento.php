<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Relacionamento com o cliente";

if ($user_nivel == 9)
	{	
	$http_edit = 'relacionamento_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'relacionamento.php';
//	$http_ver = 'sistema.php';
	$tabela = "ic_contact_local";
	$cdf = array('id_rl','rl_nome','rl_ativo');
	$cdm = array('Código','Descricao','Ativo');
	$masc = array('','','SN');
	$busca = true;
	$offset = 20;
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>