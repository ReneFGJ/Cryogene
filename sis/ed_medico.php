<?
require("cab.php");
require($include."sisdoc_colunas.php");


$tabela = "medico";
$idcp = "md";
$label = "Cadstro de médicos";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela.'s'; 
$http_ver = 'medico_detalhe.php';
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';
$cdf = array('id_'.$idcp,$idcp.'_nome',$idcp.'_cr',$idcp.'_fone_ddd',$idcp.'_fone_1',$idcp.'_fone_2',$idcp.'_fone_3');
$cdm = array('Código','Nome','CRM','DDD','Fone','Fone','Fone');
$masc = array('','','','','','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_nome ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>