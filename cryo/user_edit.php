<?
require("cab.php");
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/sisdoc_data.php');
	require('cp/cp_user.php');
	require('include/cp2_gravar.php');
	$http_edit = 'user_edit.php';
	$http_redirect = 'user.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>