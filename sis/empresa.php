<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Cadastro de moedas";
//$sql= 'CREATE TABLE empresa ( id_e serial NOT NULL,   e_nome char(50),   e_codigo char(3), e_ativo int2 ) ';
//$rlt = db_query($sql);

if ($user_nivel == 9)
	{	
	$http_edit = 'empresa_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'empresa.php';
//	$http_ver = 'sistema.php';
	$tabela = "empresa";
	$cdf = array('id_e','e_nome','e_codigo','e_ativo');
	$cdm = array('Código','Descricao','Codigo','ativo');
	$masc = array('','','','SN');
	$busca = true;
	$offset = 20;
	$pre_where = " (e_ativo = 1) ";
	$order  = "e_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>