<?
$xsql = "select * from nitrogenio ";
$xsql .= " where nitro_tanque='".$dd[0]."' ";
$xsql .= " order by nitro_dt_emissao desc ";
$rlt = db_query($xsql);

$sc ='';
$tt0=0;
$tt1=0;
$tt2=0;
$tt3=0;
while ($line = db_read($rlt))
	{
	$sc .= '<TR>';
	$sc .= '<TD align="center">';
	$sc .= stodbr($line['nitro_dt_emissao']);

	$sc .= '<TD align="right">';
	$sc .= numberformat_br($line['nitro_dt_quant'],1);

	$sc .= '<TD align="right">';
	$sc .= numberformat_br($line['nitro_vlr_unitario'],2);
	$sc .= '<TD align="right">';
	$sc .= numberformat_br($line['nitro_vlr_total'],2);

	$sc .= '<TD align="center">';
	$sc .= strzero($line['nitro_nr_nf'],6);
	$sc .= '<TD align="center">';
	$sc .= stodbr($line['nitro_dt_emissao']);
	$sc .= '<TD align="center">';
	$sc .= '<A HREF="ed_edit.php?dd99=nitro_entrada&dd1='.$dd[0].'&dd0='.$line['id_nitro'].'"><IMG SRC="/img/icone_editar.gif" border="0"></A>';
	
	$sc .= '</TR>';
	$tt0 = $tt0 + $line['nitro_dt_quant'];
	$tt1 = $tt1 + $line['nitro_vlr_unitario'];
	$tt2 = $tt2 + $line['nitro_vlr_total'];
	$tt3 = $tt3 + 1;
	}
if ($tt3 == 0) { $tt3=100; }	
if (strlen($sc) > 0)
	{ ?>
	<TABLE width="400" class="lt1">
	<TR>
	<TD align="left" colspan="3"><NOBR><B><?=numberformat_br($tt3,2);?> cargas</TD>
	<TD align="right" colspan="3"><NOBR>Abastecido <B><?=numberformat_br($tt0,1);?>&nbsp;P<sup>3</sup></TD>
	<TR bgcolor="#c0c0c0" align="center" class="lt0">
	<TH><B>data</TH>
	<TH><B>quan.</TH>
	<TH><B>vlr.unit.</TH>
	<TH><B>vlr.total</TH>
	<TH><B>N.F.</TH>
	<TH><B>data N.F.</TH>
	</TR>
	<?=$sc; ?>
	<TR>
	<TD align="right" colspan="3"><NOBR>média P<sup>3</sup>&nbsp;<B><?=numberformat_br($tt1/$tt3,2);?></TD>
	<TD align="right" colspan="3"><NOBR>Total <B><?=numberformat_br($tt2,2);?></TD>
	</TR>
	</TABLE>
	<? } ?>