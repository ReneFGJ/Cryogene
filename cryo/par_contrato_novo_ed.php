<?
 require("par_cab.php"); 
	$cpn = $dd[99];
	
	if ((strlen($acao) == 0) and (strlen($dd[98])==0))
		{ 
		$dd[1] = $dd[0];
		$dd[0] = '';
		}

	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require("par_cab_2.php");
	require("include/sisdoc_data.php");	
	require('cp/cp_medico_contrato.php');
	require($include.'cp2_gravar.php');
	$http_edit = 'par_contrato_novo_ed.php?dd99='.$dd[99];
	$http_redirect = 'updatex.php?dd0=contrato_medico';
	$tit = strtolower(troca($dd[99],'_',' '));
	$tit = strtoupper(substr($tit,0,1)).substr($tit,1,strlen($tit));
	echo '<CENTER><font class=lt5>Cadastro de Contrato</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
require("foot.php");		
?>