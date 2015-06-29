<?
require("cab.php");

	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('include/sisdoc_data.php');	
	require('cp/cp_boleto.php');
	require('include/cp2_gravar.php');
	$http_edit = 'boleto_edit.php';
	$http_redirect = 'boleto.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>