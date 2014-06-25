<?
require("cab.php");
require($include.'cp2_gravar.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
$label = "Boletos Bancários - Razão ".$dd[1].' - '.$dd[2];
echo '<font class=lt5><center>'.$label.'</center></font>';
echo '<BR>';
if ((strlen($dd[1]) == 0) or (strlen($dd[2]) == 0))
	{
		if (strlen($dd[1]) ==0) { $dd[1]=date("d/m/Y"); }
		if (strlen($dd[2]) ==0) { $dd[2]=date("d/m/Y"); }
		$tabela = "";
		$cp = array();
		array_push($cp,array('$H1','','',False,True,''));
		array_push($cp,array('$D8','','Vencimento de',False,True,''));
		array_push($cp,array('$D8','','até',False,True,''));
		array_push($cp,array('$Q cc_nome:cc_codigo:select * from conta_corrente order by cc_ativo desc, cc_nome','','Conta',False,True,''));
		array_push($cp,array('$C1','','Todas as contas',False,True,''));
		editar();
	} else {
	
	$dd1 = brtos($dd[1]);
	$dd2 = brtos($dd[2]);
	
	$sql = "select * from cr_boleto 
			inner join conta_corrente on bol_conta = cc_codigo
			where bol_data_vencimento >= $dd1 and bol_data_vencimento <= $dd2
	";
	if (strlen($dd[4]) == 0)
		{ $sql .= " and bol_conta = '".$dd[3]."' "; }
	$rlt = db_query($sql);
	$ss = '';
	$xx = "X";
	$tot = 0;
	$sub = 0;
	$tot = 0;
	$totv = 0;
	while ($line = db_read($rlt))
		{
			$cc = $line['bol_conta'];
			$status = $line['bol_status'];
			if ($status == 'A') { $status = 'Aberto'; }
			if ($status == 'B') { $status = 'Pago'; }
			if ($status == 'S') { $status = 'Suspenso'; }
			if ($status == 'X') { $status = 'Cancelado'; }
			$valor = $line['bol_valor_boleto'];
			$ss .= '<TR '.coluna().'>';
			$ss .= '<TD align="center">'.stodbr($line['bol_data_vencimento']);
			$ss .= '<TD align="center">'.stodbr($line['bol_data_processamento']);
			$ss .= '<TD>'.$line['bol_sacado'];
			$ss .= '<TD>'.$status;
			$ss .= '<TD>'.$line['cc_nome'];
			$ss .= '<td align="right">'.number_format($valor,2,',','.');
			$ss .= '<TD>'.$line['bol_obs'];
			$totv = $totv + $valor;
			$tot++;
		}
		$ss .= '<TR><TD colspan=4><B>Total de '.$tot.' boletos emitidos, com total de '.number_format($totv,2,',','.');
		?>
		<TABLE width="<?=$tab_max?>" class="lt1">
			<TR bggcolor="#C0C0C0"><TH>Vencimento</TH><TH>Emissão</TH><TH>Sacado</TH><TH>Status</TH><TH>Valor</TH></TR>
		<?=$ss; ?>
		</TABLE>
		<?
	
	}
require("foot.php");
?>
