<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Importação de Dados do Sistema Antigo";

if (strlen($dd[1]) > 0)
	{
	$dd[1] = '   '.$dd[1];
	if (strpos($dd[1],'MÃE - ') > 0) { require("importar_1.php"); }
	if (strpos($dd[1],'PARTOS - ') > 0) { require("importar_2.php"); }
	if (strpos($dd[1],'COLETAS - ') > 0) { require("importar_3.php"); }
	}
?>
<TABLE width="<?=$tab_max?>" align=center>
<TR><TD><form method="post" action="importar.php"></TD></TR>
<TR><TD><textarea cols="60" rows="10" name="dd1"></textarea></TD></TR>
<TR><TD><input type="submit" name="acao" value="importar dados"></TD></TR>
<TR><TD></form></TD></TR>
</TABLE>
<?
require("foot.php");	

function extrair($x1,$x2)
	{
	$xx = '';
	$xp = strpos($x1,$x2);
	if ($xp > 0)
		{
		$xx = substr($x1,$xp+strlen($x2)+1,120);
		$xx = trim(substr($xx,0,strpos($xx,chr(13))));
		}
	return($xx);
	}
?>