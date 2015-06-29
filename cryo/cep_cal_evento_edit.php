<?
require("cab.php");

	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_cep_calendario_tipo.php');
	require('include/cp2_gravar.php');
	$http_edit = 'cep_cal_evento_edit.php';
	$http_redirect = 'update.php?dd3=CALEVE';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>