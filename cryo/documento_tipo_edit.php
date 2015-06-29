<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_documento_tipo.php');
	require('include/cp2_gravar.php');
	$http_edit = 'documento_tipo_edit.php';
	$http_redirect = 'documento_tipo.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>