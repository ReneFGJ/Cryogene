<?
require("cab.php");
require($include."sisdoc_colunas.php");

$tabela = "submit_manuscrito_tipo";
$idcp = "ap_tit";
$label = "Cadastro de tipos de manuscritos";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'_iso.php';
$cdf = array('id_sp','sp_descricao','sp_codigo','sp_ativo');
$cdm = array('Código','descricao','codigo','ativo');
$masc = array('','','','SN');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
//$order  = $idcp."_titulo";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>