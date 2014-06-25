<? require("cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<?
security();
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require($include.'cp2_gravar.php');
	
echo '<font class="lt5">Relatório de visitas</font>';
if ((strlen($dd[1]) == 0) or (strlen($dd[2]) == 0))
	{
	$tabela = "";
	$cp = array();
	array_push($cp,array('$H8','','id_md',False,True,''));
	array_push($cp,array('$D8','','Visista de ',False,True,''));
	array_push($cp,array('$D7','','Até',False,True,''));
	array_push($cp,array('$Q us_nome:us_cracha:select * from parceiros order by us_nome','','Parceiro',False,True,''));
	if (strlen($dd[1])==0) { $dd[1] = '01'.date("/m/Y"); }
	if (strlen($dd[2])==0) { $dd[2] = date("d/m/Y"); }
	editar();
	} else
	{
echo '<BR><font class="lt2">de '.$dd[1].' até '.$dd[2].'</font>';
echo '<BR>'.$dd[3];
$sql = "select * from parceiro_calendario ";
$sql .= "where cal_data >= ".brtos($dd[1]).' ';
$sql .= " and cal_data <= ".brtos($dd[2]).' ';
$sql .= " and ct_representante = '".$dd[3]."' ";
$sql .= "order by cal_data desc ";
$rlt = db_query($sql);
echo '<Table align="center" width="'.$tab_max.'" class=lt1>';
echo '<TR bgcolor="#c0c0c0" align="center" class="lt0">';
echo '<TD>data</TD>';
echo '<TD>hora</TD>';
echo '<TD>descricao</TD>';
echo '<TD>sta</TD>';
echo '<TD>tipo</TD>';
echo '<TD>tipo</TD>';
echo '</TR>';
while ($line = db_read($rlt))
	{
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
echo '</TABLE>';
?>
</TD>
</TR>
<? } 
require("foot.php");
?>
