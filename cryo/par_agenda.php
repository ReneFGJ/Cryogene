<? require("par_cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<? require("par_cab_2.php"); ?>
<? require("par_security.php"); ?>
<?
security();

$sql = "select * from parceiro_calendario where ct_representante = '".$user_id."' ";
$sql .= "order by cal_data ";
$rlt = db_query($sql);
echo '<Table align="center" width="'.$tab_max.'" class=lt1 bgcolor="#ffffff">';
echo '<TR><TD class="lt5" align="center" colspan="10">Relatório de eventos</TD>';
echo '<TR bgcolor="#c0c0c0" align="center" class="lt0">';
echo '<TD>data</TD>';
echo '<TD>hora</TD>';
echo '<TD>descricao</TD>';
echo '<TD>sta</TD>';
echo '<TD>tipo</TD>';
echo '<TD>tipo</TD>';
echo '</TR>';
$tot = 0;
while ($line = db_read($rlt))
	{
	$tot++;
	echo '<TR>';
	echo '<TD width="5%" align="center">';
	echo stodbr($line['cal_data']);
	echo '<TD width="5%" align="center">';
	echo $line['cal_hora'];
	echo '<TD>';
	echo $line['cal_descricao'];
	echo '<TD width="5%" align="center">';
	echo $line['cal_status'];
	echo '<TD width="5%" align="center">';
	echo $line['cal_log'];
	echo '<TD width="5%" align="center">';
	echo $line['cal_ev'];
	
	}
echo '<TR><TD></TD>';
echo '<TR><TD colspan="10"><B>Total de '.$tot.' eventos registrados</B></TD>';
echo '</TABLE>';
?></TD>
</TR>
<?
require("foot.php");
?>
