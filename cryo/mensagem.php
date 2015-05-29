<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Cadastro de Informação / Documento / Mensagem";

	$http_edit = 'mensagem_ed.php'; 
	$editar = true;

	$http_redirect = 'mensagem.php';

	$tabela = "ic_noticia";

	$cdf = array('id_nw','nw_titulo','nw_ref','nw_dt_de','nw_dt_ate');
	$cdm = array('Código','Titulo','ref','de','ate');
	$masc = array('','','','D','D');
	$busca = true;
	$offset = 20;
	$pre_where = " (nw_ativo = 1) ";
	$order  = "nw_dt_de ";
	
	require($include.'sisdoc_row.php');	
	
echo $hd->foot();
?>