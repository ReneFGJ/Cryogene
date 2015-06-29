<?
require("cab.php");
require($include."sisdoc_colunas.php");


$tabela = "iso_pesquisa_field";
$idcp = "pfl";
$label = "Campos dos Formulários de Documentos";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'_iso.php';
$cdf = array('id_'.$idcp,$idcp.'_descricao',$idcp.'_ordem',$idcp.'_codigo',$idcp.'_obrigatorio',$idcp.'_ativo');
$cdm = array('Código','descricao','ordem','codigo','ativo');
$masc = array('','','','','SN','SN','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_ordem ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>