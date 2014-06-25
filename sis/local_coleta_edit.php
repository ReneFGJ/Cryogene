<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_local.php');
	require('include/cp2_gravar.php');
	$http_edit = 'local_coleta_edit.php';
	$http_redirect = 'update.php?dd0=coleta';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>