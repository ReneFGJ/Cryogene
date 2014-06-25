<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_windows.php");

$tabela = "recibo";
$idcp = "rb";
$label = "Emissão de recibos";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 

$http_ver = 'javascript:newxy2(\'recibo_ver.php'; 
$http_ver_para = '\',750,500);" '; 

$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';
$cdf = array('id_'.$idcp,$idcp.'_numero',$idcp.'_nome',$idcp.'_data',$idcp.'_valor',$idcp.'_tipo');
$cdm = array('Código','Numero','Nome','Data','valor','tipo');
$masc = array('','','','D','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_data desc";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>