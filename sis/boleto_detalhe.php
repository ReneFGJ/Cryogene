<?
require("cab.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");

$sql = "select * from cr_boleto ";
//$sql .= " inner join contrato on bol_contrato = ctr_numero ";
$sql .= " ";
if ($dd[3] != '*')
	{ $sql .= " where bol_status = '".$dd[3]."' "; } else 
	{ 
	$sql .= " where (bol_status='A' or bol_status = 'B') and (";
	$sql .= " (bol_data_pago >= ".$dd[2].strzero($dd[1],2).'01 and bol_data_pago <= '.$dd[2].strzero($dd[1],2).'31 and bol_status = '.chr(39).'B'.chr(39).')';
	$sql .= " or (bol_data_vencimento >= ".$dd[2].strzero($dd[1],2).'01 and bol_data_vencimento <= '.$dd[2].strzero($dd[1],2).'31  and bol_status = '.chr(39).'A'.chr(39).')';
	$sql .= " ) ";
	}
if ($dd[3] == 'B')
	{
	$sql .= " and (bol_data_pago >= ".$dd[2].strzero($dd[1],2).'01 and bol_data_pago <= '.$dd[2].strzero($dd[1],2).'31 )';
	}
if ($dd[3] == 'A')
	{
	$sql .= " and (bol_data_vencimento >= ".$dd[2].strzero($dd[1],2).'01 and bol_data_vencimento <= '.$dd[2].strzero($dd[1],2).'31 )';
	}
$sql .= " order by bol_data_vencimento, bol_status, bol_sacado ";
$rlt = db_query($sql);

echo '<TABLE width="'.$tab_max.'" class="lt1">';
echo '<TR><TH>Valor';
echo '<TH>pagamento';
echo '<TH>vencimento';
echo '<TH>nosso número';
echo '<TH>doc';
echo '<TH>sacado';
echo '<TH>sta';
$total = 0;
$toa = 0;
$bol_a = 0;
$bol_b = 0;
$bol_c = 0;
$bol_d = 0;
$valor_a = 0;
$valor_b = 0;
$valor_c = 0;
$valor_d = 0;
while ($line = db_read($rlt))
	{
	$toa++;
	$sta = $line['bol_status'];
	if ($sta == 'B')
		{
		$valor = $line['bol_valor_pago'];
		$valor_b = $valor_b + $line['bol_valor_pago'];
		$bol_b++;
		}
	if ($sta == 'A')
		{
		$valor = $line['bol_valor_boleto'];
		$valor_a = $valor_a + $line['bol_valor_boleto'];
		$bol_a++;
		}
	/////////// vencido
	if (($sta == 'A') and ($line['bol_data_vencimento'] < date("Ymd")))
		{
		$valor_c = $valor_c + $line['bol_valor_boleto'];
		$bol_c++;
		}
	/////////// vencendo
	if (($sta == 'A') and ($line['bol_data_vencimento'] >= date("Ymd")))
		{
		$valor_d = $valor_d + $line['bol_valor_boleto'];
		$bol_d++;
		}
		
	echo '<TR '.coluna().'>';
	echo '<TD align="right"><B>'.numberformat_br($valor,2);
	echo '<TD align="center">'.stodbr($line['bol_data_pago']);
	echo '<TD align="center">'.stodbr($line['bol_data_vencimento']);
	echo '<TD align="center">'.$line['bol_nosso_numero'];
	echo '<TD>'.$line['bol_numero_documento'].'</TD>';
	echo '<TD align="left">'.$line['bol_sacado'];
	echo '<TD align="center">'.$line['bol_status'];
//	print_r($line);
	$total = $total + $valor;
	}
echo '<TR align="right"><TD colspan="3"><B>ABERTOS</B></TD>';
echo '<TD colspan="3"><B>RESUMO</B></TD>';
echo '<TR><TD colspan="3" align="right">Total de abertos <B>'.$bol_a.'</B> somando <B>'.numberformat_br($valor_a,2);
echo '<TD colspan="3" align="right">Total de <B>'.$toa.'</B> somando <B>'.numberformat_br($total,2);

echo '<TR><TD colspan="3" align="right">Total de vencido <B>'.$bol_c.'</B> somando <B>'.numberformat_br($valor_c,2);
echo '<TD colspan="3" align="right">Total de quitado <B>'.$bol_b.'</B> somando <B>'.numberformat_br($valor_b,2);
echo '<TR><TD colspan="3" align="right">Total de vincendo <B>'.$bol_d.'</B> somando <B>'.numberformat_br($valor_d,2);
echo '<TD colspan="3" align="right">Total de abertos <B>'.$bol_a.'</B> somando <B>'.numberformat_br($valor_a,2);
	
echo '</TABLE>';


 require("foot.php");	?>