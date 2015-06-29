<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_estado_civil.php');
	require('include/cp2_gravar.php');
	$http_edit = 'estado_civil_edit.php';
	$http_redirect = 'estado_civil.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>