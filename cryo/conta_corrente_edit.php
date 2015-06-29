<?
require("cab.php");

	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_contacorrente.php');
	require('include/cp2_gravar.php');
	$http_edit = 'conta_corrente_edit.php';
	$http_redirect = 'update.php?dd0=contacorrente';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>