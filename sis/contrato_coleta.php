<?
require('cab.php');
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_data.php');	
	require('include/sisdoc_windows.php');	
	require('include/sisdoc_form2.php');
	require('cp/cp_coleta.php');
	require('include/cp2_gravar.php');
$http_redirect = 'contrato.php';
$http_edit = 'contrato_coleta.php';
?><TABLE width="700" align="center"><TR><TD><?
echo editar();
?></TD></TR></TABLE><?
require('foot.php');
?>