<?
$cr_vlr = array();
$cp_vlr = array();
$vlr = array();
$vlr = array();
$vlr = array();
for ($k=0;$k < 35;$k++) { array_push($cr_vlr,0);array_push($cp_vlr,0); }
//$sql="CREATE TABLE contas_pagar (  id_cr serial NOT NULL,  cr_cliente char(7),  cr_valor float8,  cr_venc int8,  cr_tipo char(1),  cr_historico char(80),  cr_pedido char(10),  cr_previsao int2,  cr_parcela char(8),  cr_dt_quitacao int8,  cr_status char(1),  cr_img char(15),  cr_doc char(20),  cr_lastupdate int8,  cr_data int8,  cr_conta char(5),  cr_empresa char(3),  cr_valor_original float8,  cr_cc char(7)) ";
//$rlt = db_query($sql);

////////////////////////////////// contas a pagar
$sql = "select sum(cr_valor) as valor,cr_venc ";
$sql .= ", ct_dc ";
$sql .= " from contas_pagar ";
$sql .= "left join contas_tipo on cr_conta = ct_codigo ";
$sql .= " where cr_status <> 'X' and (cr_venc >= ".substr($dd[0],0,6)."01 and cr_venc <= ".substr($dd[0],0,6)."31) ";
$sql .= " group by cr_venc ";
$sql .= ",ct_dc";

$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$ddia = intval(substr($line['cr_venc'],6,2));
	$tpx = trim($line["ct_dc"]);
	if (strlen($tpx) == 0) { $tpx = "D"; }
//	echo '<BR>'.$line['cr_venc'].'=='. $line['valor'].'=='.$line["ct_dc"];
	if ($tpx == "C")
		{ $cr_vlr[$ddia] = $cr_vlr[$ddia] + $line['valor']; }
		else
		{ $cp_vlr[$ddia] = $cp_vlr[$ddia]+ $line['valor']; }
	}
//$sql = "select sum(cr_valor) as valor,cr_venc from contas_receber where cr_status <> 'X' and (cr_venc >= ".substr($dd[0],0,6)."01 and cr_venc <= ".substr($dd[0],0,6)."31) group by cr_venc";

/////////////////////////////////////////////////////////////q Contas a Recerbe
$sql = "select * from (";
$sql .= "select sum(cr_valor) as valor,cr_venc,ct_dc from contas_receber ";
$sql .= "left join contas_tipo on cr_conta = ct_codigo ";
$sql .= " where cr_status <> 'X' and (cr_venc >= ".substr($dd[0],0,6)."01 and cr_venc <= ".substr($dd[0],0,6)."31) ";
$sql .= " group by cr_venc,ct_dc";
$sql .= " ) as tabela ";
$sql .= "union ";
$sql .= "select sum(bol_valor_boleto+bol_tx_boleto) as valor,bol_data_vencimento as cr_venc,'C' as ct_dc from cr_boleto ";
$sql .= " where bol_status <> 'X' and ";
$sql .= "((bol_data_vencimento >= ".substr($dd[0],0,6)."01) and (bol_data_vencimento <= ".substr($dd[0],0,6)."31)) ";
$sql .= " group by cr_venc, ct_dc  ";
$sql .= " order by cr_venc ";

$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$ddia = intval(substr($line['cr_venc'],6,2));
	$tpx = trim($line["ct_dc"]);
	if (strlen($tpx) == 0) { $tpx = "C"; }
	
	if ($tpx =="C")
		{ $cr_vlr[$ddia] = $cr_vlr[$ddia] + $line['valor']; }
		else
		{ $cp_vlr[$ddia] = $cp_vlr[$ddia]+ $line['valor']; }	
	}
?>	
<TABLE width="<?=$tab_max;?>" align="center" border=1>
<TR><TD bgcolor="#c0c0c0" colspan="10"class="lt5" align="center"><?=nomemes(intval(substr($dd[0],4,2)))?>/<?=substr($dd[0],0,4)?></TD></TR>
<TR align="center" bgcolor="#000000" align="center" class="lt0">
<TD width="14%"><font color="#ffffff">Dom.</TD>
<TD width="14%"><font color="#ffffff">Seg.</TD>
<TD width="14%"><font color="#ffffff">Ter.</TD>
<TD width="14%"><font color="#ffffff">Qua.</TD>
<TD width="14%"><font color="#ffffff">Qui.</TD>
<TD width="14%"><font color="#ffffff">Sex.</TD>
<TD width="14%"><font color="#ffffff">Sab.</TD>
</TR>
<TR>
<?
$dd1=substr($dd[0],0,6).'01';
$dd2=substr($dd[0],0,6).'01';
$dd3=$date->weekday($date->stod($dd1));

$tot1=0;
$tot2=0;
for ($k = 1; $k < $dd3; $k++) { echo '<TD>&nbsp;</TD>'; }
while (substr($dd1,0,6) == substr($dd2,0,6))
	{
	$lk2 = '<A HREF="finan_receber.php?dd0='.$dd2.'">';
	$lk1 = '<A HREF="finan_pagar.php?dd0='.$dd2.'">';
	$ndia = round(substr($dd2,6,2));
	$mst_vlr = '';
	if ($vlr[$ndia] > 0) { $mst_vlr = numberformat($cr_vlr[$ndia],2); }
	if (($date->weekday($dd2) == 1) and ($ndia > 1)) { echo '<TR align="center" valign="top">'; }
	echo '<TD align="right">';
	////////////////////
	$tot1 = $tot1 + $cp_vlr[$ndia];
	$tot2 = $tot2 + $cr_vlr[$ndia];
	////////////////////
	$msk_v1 = numberformat($cp_vlr[$ndia],2); 
	if ($msk_v1 == '0.00') 
	{ $msk_v1 = '-'; } 
	else 
	{ $msk_v1 = '<font class=lt2><font color=red ><B>'.$msk_v1; }
	
	$msk_v2 = numberformat($cr_vlr[$ndia],2); 
	if ($msk_v2 == '0.00') 
	{ $msk_v2 = '-'; } 
	else 
	{ $msk_v2 = '<font class=lt2><font color=blue ><B>'.$msk_v2; }
	echo '<center><font class="lt0">'.stodbr($dd2).'</font></center><BR>';
	echo $lk1;
	echo $msk_v1;
	echo '<BR>';
	echo $lk2;
	echo $msk_v2;
	$dd2 = DateAdd('d',1,$dd2);
	}
?>
<TR><TD colspan="10" class="lt1"><B>Total a pagar <font color=blue><?=numberformat($tot1,2)?></font>
, total a receber <font color=orange ><?=numberformat($tot2,2)?>, <font color=gray > saldo do mês <?=numberformat($tot2-$tot1,2)?></font></TD></TR>
</TABLE>
