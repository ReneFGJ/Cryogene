<?
require('wb_cab.php');
require('include/sisdoc_colunas.php');
require('include/sisdoc_form2.php');
require('include/sisdoc_data.php');
require('wb_cp_mailing.php');
require('include/cp2_gravar.php');
$http_edit = 'wb_ed_mailing.php';
$http_redirect = 'wb_mailing.php';
?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
echo editar();
?></TD></TR></TABLE><?	
require("foot.php");	
