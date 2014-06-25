<?
require("db.php");
$hora = intval(date("H"));
?>
<META HTTP-EQUIV="Refresh" CONTENT="1800;URL=enviar.php?dd0=<?=$dd[0].'&dd1='.$dd[1].'&dd10='.$dd[10];?>">
<?
if ($hora < 5) { $frame = 4; }
if (($hora >= 5) and ($hora < 8)) { $frame = 2; }
if (($hora >= 8) and ($hora < 22)) { $frame = 2; }
if (($hora >= 22) and ($hora < 25)) { $frame = 3; }
?>
<TABLE>
<TR>
<?
for ($k=1;$k <= $frame;$k++)
	{
	?>
	<td>
	[<?=$dd[0]; ?>]
	<BR>
	<IFRAME src="enviar_email.php?dd0=<?=$dd[0];?>&dd1=<?=$ddx;?>&dd10=<?=$dd[10];?>">
	</IFRAME>
	<?
	}
?>
</TABLE>