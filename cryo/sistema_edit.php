<?
require("cab.php");

	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_sistema.php');
	require('include/cp2_gravar.php');
	$http_edit = 'sistema_edit.php';
	$http_redirect = 'sistema.php';
	?><TABLE width="<?=$tab_max?>" align="center" bgcolor=white><TR><TD>&nbsp;&nbsp;</TD><TD><?
	echo editar();
	?></TD><TD>&nbsp;&nbsp;</TD></TR></TABLE><?	
require("foot.php");		
?>