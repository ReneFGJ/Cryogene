<?
require("cab.php");
require($include."sisdoc_colunas.php");


$tabela = "nitrogenio_tanque";
$idcp = "tq";
$label = "Cadastro de Tanques";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela.''; 
$http_ver = 'nitrogenio_tanque_detalhe.php';
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';
$cdf = array('tq_codigo',$idcp.'_descricao',$idcp.'_codigo',$idcp.'_ativo');
$cdm = array('Código','Tanque','Codigo','Ativo');
$masc = array('','','','SN','','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_descricao ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>