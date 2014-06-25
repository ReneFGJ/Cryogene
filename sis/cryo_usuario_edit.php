<?
require("extranet_cab.php"); 
require("security.php"); 

require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/cp2_gravar.php');
require('include/sisdoc_form2.php');
require("include/cp/cp_cryo_usuario.php");
$http_redirect = 'cryo_update.php?dd0=user';
$http_edit = 'cryo_usuario_edit.php';
?><TABLE width="704" align="center"><TR><TD><?
echo editar();
?></TD></TR></TABLE><?
require('foot.php');
