<TABLE width="100" cellpadding="0" cellspacing="0" class="lt0" border=1>
<TR align="center" bgcolor="#000000" align="center" class="lt0">
<TD width="14%"><font color="#ffffff">D</TD>
<TD width="14%"><font color="#ffffff">S</TD>
<TD width="14%"><font color="#ffffff">T</TD>
<TD width="14%"><font color="#ffffff">Q</TD>
<TD width="14%"><font color="#ffffff">Q</TD>
<TD width="14%"><font color="#ffffff">S</TD>
<TD width="14%"><font color="#ffffff">S</TD>
</TR>
<TR>
<?
$dd1=substr($dd[0],0,6).'01';
$dd2=substr($dd[0],0,6).'01';
$dd3=$date->weekday($dd1);


for ($k = 1; $k < $dd3; $k++) { echo '<TD>&nbsp;</TD>'; }
while (substr($dd1,0,6) == substr($dd2,0,6))
	{
	$ndia = round(substr($dd2,6,2));
	$mst_vlr = '';
	if ($vlr[$ndia] > 0) { $mst_vlr = numberformat_br($vlr[$ndia],2); }
	$link = '<A HREF="'.$pg.'?dd0='.$dd2.'" title="'.$mst_vlr.'">';
	$wd = $date->weekday($dd2);
	if (($wd == 1) and ($ndia > 1)) { echo '<TR align="center">'; }
	echo '<TD align="center">';
	echo $link;
	echo $ndia;
	$dd2 = DateAdd('d',1,$dd2);
	}
?>

</TABLE>