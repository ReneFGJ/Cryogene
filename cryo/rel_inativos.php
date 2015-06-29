<?
require("cab.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");

$sql = "select ctr_mae,ctr_numero,cl_nome,col_dp_data, ";
$sql .= " ctr_dt_renuncia ";
$sql .= " from contrato ";
$sql .= " left join cliente on ctr_mae = cl_codigo ";
$sql .= " left join coleta on col_contrato = ctr_numero ";
$sql .= " where ctr_status ='N' ";
// Laudo

$sql .= " order by cl_nome ";
$rlt = db_query($sql);
$s = '';
$sc = '<TR align="center" bgcolor="#c0c0c0">';
$sc .= '<TH>contrato</TH>';
$sc .= '<TH>nome da mãe</TH>';
$sc .= '<TH>dt.assintatura</TH>';
$sc .= '<TH>dt.renuncia</TH>';

$sc .= '</TR>';
while ($line = db_read($rlt))
	{
	$dt = intval('0'.$line['col_dp_data']);
	if ($dt > 19100101)
		{ $dt = stodbr($dt); } else
		{ $dt = 's.d.'; }
	$dr = intval('0'.$line['ctr_dt_renuncia']);
	if ($dr > 19100101)
		{ $dr = stodbr($dr); } else
		{ $dr = 's.d.'; }

	$s .= '<TR '.coluna().'>';
	$s .= '<TD>'.$line['ctr_numero'];
	$s .= '<TD>'.trim($line['cl_nome']);
	$s .= '<TD align="center">'.$dt;
	$s .= '<TD align="center">'.$dr;
	}

?>
<BR>
<font class="lt5">Contratos Inativos</font>
<BR>
<font class="lt0"><?=date("d/m/Y H:i");?></font>
<TABLE class="lt1" width="<?=$tab_max;?>">
<?=$sc;?>
<?=$s;?>
</TABLE>