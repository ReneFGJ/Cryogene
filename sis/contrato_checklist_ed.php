<?
require("db.php");
require("include/sisdoc_data.php");
if (strlen($dd[10]) > 0)
	{
	$http=$dd[10].'?dd0='.$dd[0].'&dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.$dd[3].'&dd4='.$dd[4].'&dd5='.$dd[5].'&dd98='.$dd[1].'&dd97='.$dd[2].'&now='.date("mHihs");
	redirecina($http);
	}
?>
<head>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>
<?
global $acao,$dd,$cp,$saved,$http_redirect,$tabela,$http_edit,$http_edit_para;
$include = "include/";
	$cpn = $dd[99];
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require('cp/cp_'.$cpn.'.php');
	require($include.'cp2_gravar.php');
	$http_edit = 'contrato_checklist_ed.php?dd99='.$dd[99];
	$http_redirect = 'close.php';
	
	$pagina_form = $http_edit;
	$tit = strtolower(troca($dd[99],'_',' '));
	$tit = strtoupper(substr($tit,0,1)).substr($tit,1,strlen($tit));
	echo '<CENTER><font class=lt5>Cadastro de '.$tit.'</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	echo $sql;
	?></TD></TR></TABLE>
	<?=$sql;?>
