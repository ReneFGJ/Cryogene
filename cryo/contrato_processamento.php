<?
require('cab.php');
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_data.php');	
	require('include/sisdoc_windows.php');	
	require('include/sisdoc_form2.php');
	require('include/sisdoc_debug.php');
	require('cp/cp_processamento.php');
	require('include/cp2_gravar.php');
$http_redirect = 'contrato.php';
$http_edit = 'contrato_processamento.php';
?><TABLE width="700" align="center"><TR><TD><?
echo editar();
?></TD></TR></TABLE><?
require('foot.php');
?>