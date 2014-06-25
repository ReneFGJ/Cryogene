<? require("db.php"); ?>
<link rel="STYLESHEET" type="text/css" href="letras.css">
<?
require($include."sisdoc_colunas.php");
$tabela = "medico";
$idcp = "md";
$label = "";
$http_redirect = 'sel_'.$tabela.'.php';
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
