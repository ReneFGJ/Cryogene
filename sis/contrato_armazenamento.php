<?
require('db.php');
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_data.php');	
	require('include/sisdoc_form2.php');
	require('cp/cp_armazenamento.php');
	require('include/cp2_gravar.php');
$http_redirect = 'close.php';
$http_edit = 'contrato_armazenamento.php';
?><TABLE width="700" align="center"><TR><TD><?
echo editar();
?></TD></TR></TABLE><?
?>