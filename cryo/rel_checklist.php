<?
require("cab.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");

$sql = "select ctr_mae,ctr_numero,cl_nome,col_dp_data, ";
$sql .= " chk1.ccl_ativo as d1,chk1.ccl_data as dt1, ";
$sql .= " chk2.ccl_ativo as d2,chk2.ccl_data as dt2 ";
$sql .= " from contrato ";
$sql .= " left join cliente on ctr_mae = cl_codigo ";
$sql .= " left join coleta on col_contrato = ctr_numero ";
// Laudo
$sql .= " left join contrato_check_list as chk1 on chk1.ccl_contrato = ctr_numero and chk1.ccl_codigo = '00005' ";
// Exames
$sql .= " left join contrato_check_list as chk2 on chk2.ccl_contrato = ctr_numero and chk2.ccl_codigo = '00006' ";
//$sql .= " limit 20 ";

$sql .= " order by cl_nome ";
$rlt = db_query($sql);
$s = '';
$sc = '<TR align="center" bgcolor="#c0c0c0">';
$sc .= '<TH>contrato</TH>';
$sc .= '<TH>nome da mãe</TH>';
$sc .= '<TH>dt.coleta</TH>';
$sc .= '<TH colspan="2">exames lab.</TH>';
$sc .= '<TH colspan="2">laudo</TH>';

$sc .= '</TR>';
while ($line = db_read($rlt))
	{
	$dt1 = $line['dt1'];
	$dt1a = trim($line['d1']);
	$dtm1 = '<font color="red">não ok</font>';
	$dtm2 = '-';
	if ($dt1a == '1')
		{ $dtm1 = '<font color="green">ok'; $dtm2 = stodbr($dt1); }
		
	$dt1 = $line['dt2'];
	$dt1a = trim($line['d2']);
	$dte1 = '<font color="red">não ok</font>';
	$dte2 = '-';
	if ($dt1a == '1')
		{ $dte1 = '<font color="green">ok'; $dte2 = stodbr($dt1); }


	$dt = intval('0'.$line['col_dp_data']);
	if ($dt > 19100101)
		{ $dt = stodbr($dt); } else
		{ $dt = 's.d.'; }
	$s .= '<TR '.coluna().'>';
	$s .= '<TD>'.$line['ctr_numero'];
	$s .= '<TD>'.trim($line['cl_nome']);
	$s .= '<TD align="center">'.$dt;
	$s .= '<TD align="center">'.$dte1;
	$s .= '<TD align="center">'.$dte2;
	$s .= '<TD align="center">'.$dtm1;
	$s .= '<TD align="center">'.$dtm2;
	}

?>
<BR>
<font class="lt5">Checklist de documents</font>
<BR>
<font class="lt0"><?=date("d/m/Y H:i");?></font>
<TABLE class="lt1" width="<?=$tab_max;?>">
<?=$sc;?>
<?=$s;?>
</TABLE>