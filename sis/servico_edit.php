]<?
require("cab.php");

	require('include/sisdoc_colunas.php');
	require('include/sisdoc_form2.php');
	require('cp/cp_servico.php');
	require('include/cp2_gravar.php');
	$http_edit = 'servico_edit.php';
	$http_redirect = 'servico.php';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>