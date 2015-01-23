<?php
class cr_boleto
	{
	var $tabela = "cr_boleto";
	
	function resumo()
		{
			$sql = "select bol_status, sum(bol_valor_boleto + bol_tx_boleto) as bol_valor,
					round(bol_data_vencimento/100) as bol_mes
					from ".$this->tabela."
					where bol_status <> 'X'
					group by bol_status, bol_mes
					order by bol_mes
				";
			$rlt = db_query($sql);
			$bol = array();
			$xmes = '';
			while ($line = db_read($rlt))
				{
					$mes = $line['bol_mes'];
					$sta = $line['bol_status'];
					$vlr = $line['bol_valor'];
					if ($xmes != $mes)
						{
						$xmes = $mes;
						array_push($bol,array($mes,0,0));
						}
					$id = (count($bol)-1);
					if ($sta == 'A')
						{ $bol[$id][1] = $bol[$id][1] + $vlr; }
					if ($sta == 'B')
						{ $bol[$id][2] = $bol[$id][2] + $vlr; }
				}
			for ($r=0;$r < count($bol);$r++)
				{
					$sr .= ', '.chr(13).chr(10);
					$sr .= "['".$bol[$r][0]."',".round($bol[$r][1]).",".round($bol[$r][2])."]";
				}
			$sx = 
			'
		    <script type="text/javascript" src="//www.google.com/jsapi"></script>
    		<script type="text/javascript">
      			google.load(\'visualization\', \'1\', {packages: [\'corechart\']});
    		</script>
    		<script type="text/javascript">
      			function drawVisualization() {
        		// Some raw data (not necessarily accurate)
        		var data = google.visualization.arrayToDataTable([
          			[\'Month\',   \'Quitados\', \'Abertos\']'.$sr.'
        			]);
      
  		      // Create and draw the visualization.
		        var ac = new google.visualization.AreaChart(document.getElementById(\'visualization\'));
		        ac.draw(data, {
          		title : \'Contas a Receber - Boletos\',
          		isStacked: true,
          		width: 1024,
          		height: 400,
          		vAxis: {title: "R$"},
          		hAxis: {title: "Mês"}
        		});
      		}
            google.setOnLoadCallback(drawVisualization);
    		</script>
    		<div id="visualization" style="width: 600px; height: 400px;"></div>
  			';				
			return($sx);
		}

	function boletos_aberto($dd1,$dd2)
		{
			$sql = "select * from ".$this->tabela." 
					where 1=1			
			";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					print_r($line);
					exit;
				}
		}
		
	function mostra_boleto_cliente($cliente)
		{
			
		}
	function mostra_boleto_resumo($contratos=array())
		{
			if (count($contratos)==0) { return(""); }
			$sql = "select sum(bol_valor_boleto + bol_tx_boleto) as valor, 
					bol_status, bol_contrato
					from ".$this->tabela." 
					where ";
			for ($r=0;$r < count($contratos);$r++)
				{
					if ($r > 0) { $sql .= " or "; }
					$sql .= " (bol_contrato = '".trim($contratos[$r])."' )";
				}
			$sql .= " group by bol_status, bol_contrato ";
			$sql .= " order by bol_status ";
			$rlt = db_query($sql);
			
			$vlrs = array(0,0,0,0,0,0);
			$cores = array('','','','','');
			$link = array('','','','','');
			
			while ($line = db_read($rlt))
				{
					$contrato .= trim($line['bol_contrato']).';';
					$status = trim($line['bol_status']);
					$valor = $line['valor'];
					
					switch ($status) {
						case 'A':
							$vlrs[0] = $vlrs[0] + $valor;
							break;
						case 'B':
							$vlrs[1] = $vlrs[1] + $valor;
							break;													
						case 'C':
							$vlrs[2] = $vlrs[2] + $valor;
							break;													
						case 'X':
							$vlrs[2] = $vlrs[2] + $valor;
							break;													
						default:
							$vlrs[4] = $vlrs[4] + $valor;							
							break;
						}
					}
					/* define cores */
					if ($vlrs[0] > 0) 
						{
							$cores[0] = ' bgcolor="#FFAEAE" ';
							$link[0] = '<A HREF="contrato_boleto_negociacao.php?dd0='.$contrato.'&dd90='.checkpost($contrato).'" class="link">';
						}
					if ($vlrs[1] > 0) { $cores[1] = ' bgcolor="#AEFFAE" ';}
					if ($vlrs[2] > 0) { $cores[2] = ' bgcolor="#e8e8e8" ';}
					$sx = '<table width="100%">';
					$sx .= '<TR class="tabela00">
								<th width="25%">Abertos</th>
								<th width="25%">Pagos
								<th width="25%">Cancelados
								<th width="25%">Outros';
					$sx .= '<tr>
							<td align="center" '.$cores[0].'>'.$link[0].fmt($vlrs[0],2).'</A></td>
							<td align="center" '.$cores[1].'>'.fmt($vlrs[1],2).'</td>
							<td align="center" '.$cores[2].'>'.fmt($vlrs[2],2).'</td>
							<td align="center" '.$cores[4].'>'.fmt($vlrs[4],2).'</td>
							';
					$sx .= '</table>';
					return($sx);
		}
	function mostra_boleto_contrato_aberto($contratos=array())
		{
			if (count($contratos)==0) { return(""); }
			$sql = "select * from ".$this->tabela." 
					where ";
			for ($r=0;$r < count($contratos);$r++)
				{
					if ($r > 0) { $sql .= " or "; }
					$sql .= " (bol_contrato = '".$contratos[$r]."' )";
				}
			$sql .= " and bol_status = 'A' ";
			$sql .= " order by bol_contrato, bol_status, bol_data_vencimento desc ";
			$rlt = db_query($sql);
			$vlr = 0;
			$vlr2= 0;
			$jur = 0;
			$sx = '<table width="100%" class="tabela00">';
			$sx .= '<TR><TH>
						<TH>Vencimento
						<TH>Boleto
						<TH>Vlr. Original
						<TH>Juros
						<TH>Vlr. com Juros
						<TH>Dias de atraso';
			while ($line = db_read($rlt))
				{
					$valor = $line['bol_valor_boleto'] + $line['bol_valor_taxa'];
					$venc = $line['bol_data_vencimento'];
					$dias = DiffDataDias($venc,date("Ymd"));
					if ($dias < 0) { $dias = 0; }
					$bjuros = 0.02 / 30;
					$juros = $dias * $bjuros * $valor;
					$sx .= '<TR>';
					$sx .= '<TD width="10">';
					$sx .= '<input type="checkbox">';
					$sx .= '<TD>';
					$sx .= stodbr($venc);
					$sx .= '<TD>';
					$sx .= $line['bol_nosso_numero'];
					$sx .= '<TD align="right">';
					$sx .= fmt($valor,2);
					$sx .= '<TD align="right">';
					$sx .= fmt($juros,2);
					$sx .= '<TD align="right">';
					$sx .= '<B>'.fmt($juros+$valor,2).'</B>';
					$sx .= '<TD align="right">';
					$sx .= $dias. ' dias';
					
					$vlr = $vlr + $valor;
					$vlr2 = $vlr2 + $valor+$juros;
					$jur = $jur + $juros;
				}
			$sx .= '<TR bgcolor="#EFEFEF" class="lt2">';
			$sx .= '<TD align="right" colspan=3>Totais';
			$sx .= '<TD align="right">'.fmt($vlr,2);
			$sx .= '<TD align="right">'.fmt($jur,2);
			$sx .= '<TD align="right"><B>'.fmt($vlr2,2).'</B>';
			$sx .= '<TD>&nbsp;';
			$sx .= '</table>';
			echo 'Valor em aberto: <B>'.fmt($vlr,2).'</B>, com juros <B>'.fmt($vlr2,2).'</B>';
			return($sx);
		}
	function mostra_boleto_contrato($contratos=array())
		{
			if (count($contratos)==0) { return(""); }
			$sql = "select * from ".$this->tabela." 
					where ";
			for ($r=0;$r < count($contratos);$r++)
				{
					if ($r > 0) { $sql .= " or "; }
					$sql .= " (bol_contrato = '".$contratos[$r]."' )";
				}
			$sql .= " order by bol_status, bol_data_vencimento desc ";
			$rlt = db_query($sql);
			$sx = '<table class="tabela00" width="100%">';
			$sx .= '<TR>
					<TH width="60">Contrato
					<TH>Número';
			$sx .= '<TH>Descrição
					<TH>Vlr+taxa
					<TH>Vlr.Pago
					<th>Venc.
					<TH>Dt.Liqui.										
					<TH width="80">Posição';
			while ($line = db_read($rlt))
				{
					$status = $line['bol_status'];
					$valor = $line['bol_valor_boleto'];
					$taxa = $line['bol_tx_boleto'];
					$nosso = $line['bol_nosso_numero'];
					$paga = $line['bol_data_pago'];
					$paga_vlr = $line['bol_valor_pago'];
					$sacado = trim($line['bol_sacado']);
					$tipo = $line['bol_tipo'];
					$vencimento = $line['bol_data_vencimento'];
					
					$cor = $this->cor_status($status,$vencimento);
					
					$link = '<A HREF="contrato_ver.php?dd0='.trim($line['bol_contrato']).'&dd90='.checkpost(trim($line['bol_contrato'])).'" class="link">';
					
					$sx .= '<TR>';
					$sx .= '<TD align="center">';
					$sx .= $link;
					$sx .= $line['bol_contrato'];
					$sx .= '</A>';					
					$sx .= '<TD align="center">';
					$sx .= trim($line['bol_nosso_numero']);
					$sx .= '<TD align="center">';
					$sx .= trim($line['bol_fatura']);
					$sx .= '<TD>';
					$sx .= trim($line['bol_obs']);
					$sx .= '<TD align="right">';
					$sx .= fmt($valor+$taxa,2);
					$sx .= '<TD align="right">';
					$sx .= fmt($paga_vlr,2);
					$sx .= '<TD align="center">';
					$sx .= stodbr($line['bol_data_vencimento']);
					$sx .= '<TD align="center">';
					$sx .= stodbr($paga);
					$sx .= '<TD align="center"><NOBR>'.$cor;
					$sx .= $this->mostra_status($line);
					$sx .= '</nobr>';					
				}
			$sx .= '</table>';
			return($sx);
		}
	function mostra_status($line)
		{
			$status = $line['bol_status'];
			$venc = $line['bol_data_vencimento'];
			$pago = $line['bol_data_pago'];
			
			$des = '?????';
			if ($status=='B') 
				{
					$des = 'Quitado'; 
					if ($venc == $pago) { $des = 'Pg. em dia'; }
					if ($venc > $pago) { $des = 'Pg. antecipado'; }
					if ($venc < $pago) { $des = 'Pg. atrasado'; }					
				}
			if ($status=='X') 
				{ $des = 'Cancelado'; }
				
			if ($status=='A') 
				{
					if ($venc < date("Ymd"))
					{
						$des = 'Atrasado';
					} else {
						$des = 'Aberto';						
					} 
				}
			return($des);

		}
	function cor_status($status,$vencimento=0,$pagamento=0)
		{
			$cor = '<font>';
			if ($status=='B') { $cor = '<font color="blue">'; }
			if ($status=='X') { $cor = '<font color="grey">'; }
			if ($status=='A') 
				{
					if ($venc < date("Ymd"))
					{
						$cor = '<font color="red">';
					} else {
						$cor = '<font color="green">';						
					} 
				}
			return($cor);
		}
	}
?>
