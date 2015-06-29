<?
require("cab.php");

	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_produto_marca.php');
	require('include/cp2_gravar.php');
	$http_edit = 'produto_marca_edit.php';
	$http_redirect = 'update.php?dd0=marca';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>