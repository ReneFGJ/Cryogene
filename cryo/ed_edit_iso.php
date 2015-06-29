<?
require("cab.php");
	$cpn = $dd[99];
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require($include."sisdoc_data.php");	
	require('cp/cp_'.$cpn.'.php');
	require($include.'cp2_gravar.php');
	$http_edit = 'ed_edit.php?dd99='.$dd[99];
	$http_redirect = 'updatex_iso.php?dd0='.$dd[99];
	$tit = strtolower(troca($dd[99],'_',' '));
	$tit = strtoupper(substr($tit,0,1)).substr($tit,1,strlen($tit));
	echo '<CENTER><font class=lt5>Cadastro de '.$tit.'</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>