<?
$sql = "select * from cr_boleto";
$sql .= " where bol_contrato = '".$contrato."' ";
$sql .= " order by bol_data_vencimento desc ";
$sql .= " limit 12 ";
$brlt = db_query($sql);

$ss .= '<BR><BR>';
$ss .= '<font class=lt2><B>Movimentação Financeira</B></font>';
$ss .= '<TABLE width=100% class="lt1" >';
$ss .= '<TR bgcolor="#c0c0c0" align="center">';
$ss .= '<TH>status</TH>';
$ss .= '<TH>venc.</TH>';
$ss .= '<TH>valor</TH>';
$ss .= '<TH>nº boleto</TH>';
$ss .= '<TH>dt.paga</TH>';

while ($bline = db_read($brlt))
	{
	$ss .= '<TR>';
	$ss .= '<TD align="center">';
	$sta = '<font color=green>aberto</font>';
	$st = trim($bline['bol_status']);
	$venc = $bline['bol_data_vencimento'];
	if (($st == 'A') and ($venc < date("Ymd")))
		{
		$sta = '<font color=red>atrasado</font>';
		}
	if ($st == 'X')
		$sta = '<font color=grey>cancelado</font>';
	if ($st == 'B')
		$sta = '<font color=blue>quitado</font>';
		
	$ss .= $sta;
	$ss .= '<TD align="center">';
	$ss .= stodbr($bline['bol_data_vencimento']);
	$ss .= '<TD align="right">';
	$ss .= numberformat_br($bline['bol_valor_boleto']+$bline['bol_tx_boleto'],2);
	$ss .= '<TD align="center">';
	$ss .= $bline['bol_nosso_numero'];
	$ss .= '<TD>';
	$dta = stodbr($bline['bol_data_pago']);
	if ($dta == '//') { $dta = ''; }
	$ss .= $dta;
	}
$ss .= '</TABLE>';	
?>
