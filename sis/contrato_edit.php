<?
require('cab.php');
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_data.php');	
	require('include/sisdoc_form2.php');
	require('cp/cp_contrato.php');
	require('include/cp2_gravar.php');
$http_redirect = 'update.php?dd0=contrato';
$http_edit = 'contrato_edit.php';
?><TABLE width="700" align="center"><TR><TD><?
echo editar();
?></TD></TR></TABLE><?
require('foot.php');
?>