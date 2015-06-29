<?
$debug = true;
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');
global $saved;
//$debug = true;
$sql = "update produto_lote set pl_ativo = ".$dd[1]." where id_pl = ".$dd[2];
echo $sql;
$rlt = db_query($sql);
redirecina("produto_lote.php?dd0=".$dd[0]);
require("foot.php");	
?>