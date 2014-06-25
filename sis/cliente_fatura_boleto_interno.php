<?
$b = '';
$sql = "select * from cr_boleto ";
$sql .= "inner join contrato on bol_contrato = ctr_numero ";
$sql .=" where (ctr_mae = '".$cliente_id ."' ";
$sql .= " or ctr_pai = '".$cliente_id."' ";
$sql .= " or ctr_responsavel = '".$cliente_id."') ";
//$sql .= " ".$pre_where;
$sql .= " order by bol_contrato, bol_data_vencimento desc ";
$rlt = db_query($sql);

$b = '<TABLE class="lt0" width="100%" align="center" border="0" cellpadding="3" cellspacing="0">';
$b .= '<TR bgcolor="#c0c0c0" align="center">';
$b .= '<TD width="10%"><B>vencimento</B></TD>';
$b .= '<TD><B>nome</B></TD>';
$b .= '<TD width="10%"><B>documento</B></TD>';
$b .= '<TD width="10%"><B>valor</B></TD>';
$b .= '<TD width="10%"><B>situação</B></TD>';
$b .= '<TD width="10%"><B>ação</B></TD>';
$b .= '<TD width="10%"><B>contrato</B></TD>';
$b .= '<TD width="10%"><B>fatura</B></TD>';
$b .= '<TD width="10%"><B>nr.boleto</B></TD>';
$b .= '</TR>';
$totb=0;
$totv=0;
$toab=0;
$toav=0;
$contratos = array();
$xcon = "X";
while ($line = db_read($rlt))
	{
	$con = trim($line['bol_contrato']);
	if ($xcon != $con)
		{
			array_push($contratos,$con);
			$xcon = $con;
		}
	$boln = $line['bol_nosso_numero'];
	$link = '';
	$vlr_tx = $line['bol_tx_boleto'];
	$vlr_bl = $line['bol_valor_boleto'];
	$vlr = $vlr_tx + $vlr_bl;
	$sta = trim($line['bol_status']);
	$stx = trim($line['bol_status']);
	$font = '';
	if ($sta == 'X') { $sta = "cancelado"; }
	if ($sta == 'A') { $sta = "aberto"; $totv=$totv+$vlr; $totb++;  }
	if ($sta == 'B') { $sta = "quitado"; }
	if (strlen($sta) == 0)  { $sta = "aberto"; $totv=$totv+$vlr; $totb++; }
	if (($stx =='A') or (strlen($stx) == 0))
		{
			$font = '<font color="green">';
			$link = '<A HREF="#" onclick="newwin2('."'http://www.cryogene.inf.br/bb.php?dd0=";
			$link .= $line['id_bol']."',500,300);".'">imprimir</A>';
			//http://www.cryogene.inf.br/bb.php?dd0=126
		    if (intval($line['bol_data_vencimento']) < intval(date("Ymd")))
			{
			$font = '<font color="red">';
			$toav=$toav+$line['bol_valor_boleto']; $toab++;		
			}
		}
	$b .= '<TR '.coluna().'>';
	$b .= '<TD align="center">';
	$b .= $font.stodbr($line['bol_data_vencimento']);
	$b .= '<TD align="left">';
	$b .= $font.$line['bol_sacado'];
//	$b .= '<TD align="center">';
//	$b .= $font.$line['bol_nosso_numero'];
	$b .= '<TD align="center"><NOBR>';
	$b .= $font.$line['bol_numero_documento'];
	$b .= '<TD align="right">';
	$b .= $font.numberformat_br($vlr,2);
	$b .= '<TD align="center">';
	$b .= $font.$sta;
	$b .= '<TD>'.$link.'</TD>';
	$b .= '<TD align="center"><NOBR>';
	$b .= $font.$line['bol_contrato'];
	$b .= '<TD align="center"><NOBR>';
	$b .= $font.$line['bol_fatura'];
	$b .= '<TD align="center"><NOBR>';
	$link = '<A HREF="http://www.cryogene.inf.br/boleto_edit.php?dd0='.$line['id_bol'].'" target="newxy">';
	$b .= $link;
	$b .= $boln;
	$b .= '</a>';
		
	}
$b .= '<TR><TD colspan="10"><B>total de '.$totb.' R$ '.numberformat_br($totv,2).' em aberto</B>';
if ($toav > 0)
	{
	$b .= ', sendo que '.$toab.' R$ '.numberformat_br($toav,2).' estão atrasadas.';
	}

$b .= '</TABLE>';
echo $b;
?>