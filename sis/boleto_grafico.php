<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_grafico.php');
$label = "Boletos Bancários";

////////////////////////////// Boletos Quitados
//$sql = "update cr_boleto set bol_status='A' where bol_status isnull ";
//$rlt = db_query($sql);

$vv = array();
$vv_lastyear = array();
$vv_lastyear_1 = array();
$vv_lastyear_2 = array();
$vv_lastyear_3 = array();
for ($k = 1;$k <= 12;$k++)
	{
	$mes = nomemes_short($k);
	array_push($vv,array(0,$mes));
	array_push($vv_lastyear,array(0,$mes));
	array_push($vv_lastyear_1,array(0,$mes));
	array_push($vv_lastyear_2,array(0,$mes));
	array_push($vv_lastyear_3,array(0,$mes));
	}

$sql = "select * from cr_boleto where bol_status = 'B' order by bol_data_pago";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$valor = $line['bol_valor_pago'];
	$dt = $line['bol_data_pago'];
	$dt_ano = intval(substr($dt,0,4));
	$dt_mes = intval(substr($dt,4,2))-1;
//	echo '<BR>'.$dt_ano.'=='.$dt_mes.'=='.$valor;
	if ($dt_ano == intval(date("Y")-4))
		{ $vv_lastyear_3[$dt_mes][0] = $vv_lastyear_3[$dt_mes][0] + $valor;	}
	if ($dt_ano == intval(date("Y")-3))
		{ $vv_lastyear_2[$dt_mes][0] = $vv_lastyear_2[$dt_mes][0] + $valor;	}
	if ($dt_ano == intval(date("Y")-2))
		{ $vv_lastyear_1[$dt_mes][0] = $vv_lastyear_1[$dt_mes][0] + $valor;	}
	if ($dt_ano == intval(date("Y")-1))
		{ $vv_lastyear[$dt_mes][0] = $vv_lastyear[$dt_mes][0] + $valor;	}
	if ($dt_ano == intval(date("Y")))
		{ $vv[$dt_mes][0] = $vv[$dt_mes][0] + $valor;	}
	}
	$rsm = array();
	for ($ky=0;$ky < 12;$ky++) { array_push($rsm,''); }
	$rsm = array($rsm,$rsm,$rsm,$rsm,$rsm,$rsm);

	for ($kk=0;$kk < 5;$kk++)
		{
			for ($ky=0;$ky < 12;$ky++)
			{
			$link = '<A HREF="boleto_detalhe.php?dd1='.($ky+1).'&dd2='.(date("Y")-$kk).'&dd3=B">';
			if ($kk == 0) { $rsm[0][$ky] = nomemes_short($ky+1); }
			if ($kk == 0) { $rsm[$kk+1][$ky] =$link.numberformat_br($vv[$ky][0],2); }
			if ($kk == 1) { $rsm[$kk+1][$ky] =$link.numberformat_br($vv_lastyear[$ky][0],2); }
			if ($kk == 2) { $rsm[$kk+1][$ky] =$link.numberformat_br($vv_lastyear_1[$ky][0],2); }
			if ($kk == 3) { $rsm[$kk+1][$ky] =$link.numberformat_br($vv_lastyear_2[$ky][0],2); }
			if ($kk == 4) { $rsm[$kk+1][$ky] =$link.numberformat_br($vv_lastyear_3[$ky][0],2); }
			}
		}
	$dt_ano = date("Y");			
	$resumo = array('mês','<B>'.$dt_ano,'<B>'.($dt_ano-1),'<B>'.($dt_ano-2),'<B>'.($dt_ano-3),'<B>'.($dt_ano-4));

	echo gr_resumo($rsm,$resumo,'Resumo anual de recebimento');
	echo '<HR width="400">';
	echo gr_barras($vv,'Recebimento boletos '.(intval(date("Y"))),220);
	echo '<HR width="400">';
	echo gr_barras($vv_lastyear,'Recebimento boletos '.(intval(date("Y")-1)),220);
///////////////////////////////////////////////////////////////
require("foot.php");	
?>