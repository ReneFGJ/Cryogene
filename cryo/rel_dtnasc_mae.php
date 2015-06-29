<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");

$sql = "select * from contrato ";
$sql .= " left join cliente on ctr_mae = cl_codigo ";
$sql .= " left join coleta on col_contrato = ctr_numero ";
$sql .= " order by col_dp_data ";
$sql .= " ";

$rlt = db_query($sql);

$s = '';
$tot = 0;
$xx="0000";
while ($line = db_read($rlt))
	{
	$tot++;
	$xy = substr($line['col_dp_data'],0,6);
	if ($xx != $xy)
		{ $s .= '<TR><TD colspan="lt3"><B>'.substr($xy,4,2).'/'.substr($xy,0,4); }
	$xx = $xy;
	$s .= '<TR '.coluna().'>';
	$s .= '<TD align="center">';
	$s .= stodbr($line['col_dp_data']);
	$s .= '<TD>';
	$s .= $line['cl_nome'];
	$s .= '<TD align="center">';
	$s .= $line['ctr_numero'];
	}
?>
<font class="lt5">Relatório Dt.Nasc / Mãe / Contrato</FONT>
<TABLE class="lt1" width="<?=$tab_max;?>" align="center">
<TR>
<TH>Nome da mãe
<TH>contrato
<?=$s;?>
<TR><TD colspan="10" align="right">Total de <?=$tot;?> RN registrados.
</TABLE>
<?
require("foot.php");
?>