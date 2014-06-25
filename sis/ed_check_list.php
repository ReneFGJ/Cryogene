<?
require("cab.php");
require($include."sisdoc_colunas.php");


$tabela = "check_list";
$idcp = "chk";
$label = "Documentos para Check-list";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';
$cdf = array('id_'.$idcp,$idcp.'_descricao',$idcp.'_codigo',$idcp.'_obrigatorio','ativo');
$cdm = array('Código','descricao','codigo','ativo');
$masc = array('','','','SN','SN','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_descricao ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>