<?
require("cab.php");

	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_cobranca_forma.php');
	require('include/cp2_gravar.php');
	$http_edit = 'cobranca_forma_edit.php';
	$http_redirect = 'update.php?dd0=cobranca';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>