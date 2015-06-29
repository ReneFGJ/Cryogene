<?
require("cab.php");
require($include."sisdoc_colunas.php");

$tabela = "contrato_field";
$idcp = "sub";
$label = "Cadastro de campos de manuscritos";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';
$cdf = array('id_sub','sub_descricao','sub_pdf_title','sub_pdf_align','sub_pdf_font_size','sub_pdf_space','sub_codigo','sub_pos','sub_ordem','sub_ativo');
$cdm = array('Código','Campo','Título do PDF','Align','font','esp.','codigo','pos.','ordem','ativo');
$masc = array('','','','','','','SN');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_pos,sub_ordem";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>