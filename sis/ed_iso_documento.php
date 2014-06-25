<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");


$tabela = "iso_documento";
$idcp = "iso_doc";
$label = "ISO - Documentos da Qualidade";
$http_ver = 'ed_iso_documento_detalhe.php'; 
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_iso_documento.php';
$cdf = array('iso_doc_codigo',$idcp.'_nrdoc',$idcp.'_descricao',$idcp.'_versao',$idcp.'_lastupdate',$idcp.'_ativo');
$cdm = array('Código','doc. nº','título','revisao','atualizado','ativo');
$masc = array('','','','','D','SN','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp.'_nrdoc';
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>