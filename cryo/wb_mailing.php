<?
require("wb_cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
//$debug = true;
$tabela = "mail";
$idcp = "m";
$label = "Cadastro de mailing";
$http_edit = 'wb_ed_mailing.php'; 
$http_ver = 'wb_enviar_email.php'; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';
$cdf = array('id_'.$idcp,$idcp.'_descricao',$idcp.'_data');
$cdm = array('Código','descricao','codigo','ativo');
$masc = array('','','D','','N','N','SN','SN','SN');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
//$order  = $idcp."_nome ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>