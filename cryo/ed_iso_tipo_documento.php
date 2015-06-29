<?
require("cab.php");
require($include."sisdoc_colunas.php");


$tabela = "iso_tipo_documento";
$idcp = "iso_tdoc";
$label = "ISO - Documentos da Qualidade";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'_iso.php';
$cdf = array('id_'.$idcp,$idcp.'_codigo_desc',$idcp.'_descricao',$idcp.'_codigo',$idcp.'_codigo');
$cdm = array('Código','descricao','codigo','ativo');
$masc = array('','','','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_codigo_desc ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>