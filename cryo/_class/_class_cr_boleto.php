<?php
class cr_boleto
	{
	var $tabela = "cr_boleto";
	
	var $sacado;
	var $sacado_nome;
	
	function boletos_aberto_cpf_cliente($cpf)
		{
			$cpf = strzero(sonumero($cpf),11);
			$cpf = substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
			$sql = "select * from ".$this->tabela." 
					inner join contrato on bol_contrato = ctr_numero
					where bol_status = 'A'	
					and bol_cpf_cnpj = '$cpf'
					order by bol_data_vencimento desc 
			";
			$rlt = db_query($sql);
			$it = 0;
			$to = 0;
			$sx = '<table class="tabela00">';
			$sx .= '<TR>
						<TH width="10%">Contrato
						<TH width="10%">Vencimento
						<TH width="10%">Valor
						<TH width="10%">Valor atualizado
						<TH width="10%">Boleto N.
						<TH width="20%">Situação
						<TH width="20%">Descrição				
						<TH width="30%">Ação
			';
			while ($line = db_read($rlt))
				{
					$this->cliente = $line['ctr_responsavel'];
					$contrato = $line['bol_contrato'];
					$it++;
					$to = $to + $line['bol_valor_boleto'];
					$sx .= $this->mostra_boleto_line_cliente($line,$link);
				}			
			$sx .= '<TR><TD colspan=8><I>Total em aberto ('.$it.') '.fmt($to,2);
			$sx .= '</table>';
			
			if ($it > 0)
				{
				$sa .= '<table class="tabela01" width="100%">';
				$sa .= '<TR><th align="center">total de boletos em aberto';
				$sa .= '    <th align="center">valor total em aberto';
			
				$sa .= '<TR>
						<TD class="lt5" align="center">'.$it.'
						<TD class="lt5" align="center">'.fmt($to,2).'
				';
				$sa .= '</table>';
				} else {
					$sa .= 'Nenhum título encontrado neste período';
				}			
			$sa .= '</table>';
			return($sa.$sx);
		}


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
					inner join contrato on bol_contrato = ctr_numero
					where bol_status = 'A'	
					and bol_data_vencimento >= ".$dd1." and bol_data_vencimento <= ".$dd2."
					order by bol_data_vencimento desc 
			";
			$rlt = db_query($sql);
			$it = 0;
			$to = 0;
			$sx = '<table class="tabela00">';
			$sx .= '<TR>
						<TH width="5%">Contrato
						<TH width="5%">Vencimento
						<TH width="10%">Valor
						<TH width="5%">Boleto N.
						<TH width="25%">Descrição
						<TH width="50%">Sacado
			';
			while ($line = db_read($rlt))
				{
					$contrato = $line['bol_contrato'];
					$link = '<A HREF="contrato_boleto_negociacao.php?dd0='.$contrato.'&dd90='.checkpost($contrato).'" class="link">';
					$it++;
					$to = $to + $line['bol_valor_boleto'];
					$sx .= $this->mostra_boleto_line($line,$link);
				}			
			$sx .= '<TR><TD colspan=8><I>Total em aberto ('.$it.') '.fmt($to,2);
			$sx .= '</table>';
			
			if ($it > 0)
				{
				$sa .= '<table class="tabela01" width="100%">';
				$sa .= '<TR><th align="center">total de boletos em aberto';
				$sa .= '    <th align="center">valor total em aberto';
				$sa .= '    <th align="center">média dos títulos';
			
				$sa .= '<TR>
						<TD class="lt5" align="center">'.$it.'
						<TD class="lt5" align="center">'.fmt($to,2).'
						<TD class="lt5" align="center">'.fmt($to/$it,2).'
				';
				$sa .= '</table>';
				} else {
					$sa .= 'Nenhum título encontrado neste período';
				}			
			$sa .= '</table>';
			return($sa.$sx);
		}
	function link_do_boleto($line)
		{
			$link = 'http://www.cryogene.inf.br/bb.php?dd0='.$line['id_bol'];
			$sx = '<a href="#" onclick="newxy2(\''.$link.'\',800,600);" class="link">';
			return($sx);
		}

	function valor_atualizado($vlr,$venc)
		{
			if ($venc >= date("Ymd"))
				{ $vlr = $vlr; }
			else {
				/* regras de vencimento */
				$dias = DiffDataDias($venc,date("Ymd"));
				if ($dias <= 5)
					{
						$vlr = $vlr;
					}
				else 
					{
						$vlrn = $vlr + $vlr * 0.02 + $vlr * $dias * (0.02/30);
						$vlr = $vlrn;
					}
 
			}			
			return($vlr); 
		}
	function mostra_boleto_line_cliente($line,$link='')
		{
			$this->sacado = trim($line['ctr_responsavel']);
			
			$sx = '<TR class="lt3">';
			$sx .= '<TD>';
			$sx .= $link;
			$venc = $line['bol_data_vencimento'];
			$venc_s = '<font color="blue">A vencer</font>';
			$ataso = 0;
			if ($venc < date("Ymd"))
				{
					$venc_s = '<font color="red">Vencido</font>';
					$atraso = 1;
				}
			
			$sx .= $line['bol_contrato'];
			if (strlen($link) > 0) { $sx .= '</A>'; }
			
			$sx .= '<TD>';
			$sx .= stodbr($line['bol_data_vencimento']);
			$sx .= '<TD align="right">';
			$sx .= 'R$ '.fmt($line['bol_valor_boleto'],2).'';

			$sx .= '<TD align="right">';
			$vlr_atualizado = $this->valor_atualizado($line['bol_valor_boleto'],$line['bol_data_vencimento']);
			if ($vlr_atualizado > 0)
				{
					$sx .= '<B>R$ '.fmt($vlr_atualizado,2).'</B>';
				} else {
					$sx .= '&nbsp;';			
				}

			$sx .= '<TD>';
			$sx .= $this->link_do_boleto($line);
			$sx .= $line['bol_nosso_numero'];
			$sx .= '</A>';
			
			$sx .= '<TD>';
			$sx .= $venc_s;

			$sx .= '<TD>';
			$sx .= $line['bol_numero_documento'];
			$sx .= '<TD>';

			$sx .= '<input type="button" value="impressão 2º via do boleto" onclick="newxy2(\'\',800,600);">';
			$sx .= '</A>';
			return($sx);
		}

	function mostra_boleto_line($line,$link='')
		{
			$sx = '<TR>';
			$sx .= '<TD>';
			$sx .= $link;
			
			$sx .= $line['bol_contrato'];
			if (strlen($link) > 0) { $sx .= '</A>'; }
			
			$sx .= '<TD>';
			$sx .= stodbr($line['bol_data_vencimento']);
			$sx .= '<TD align="right">';
			$sx .= fmt($line['bol_valor_boleto'],2);
			$sx .= '<TD>';
			$sx .= $this->link_do_boleto($line);
			$sx .= $line['bol_nosso_numero'];
			$sx .= '</A>';
			
			$sx .= '<TD>';
			$sx .= $line['bol_numero_documento'];
			$sx .= '<TD>';
			$cliente = trim($line['ctr_responsavel']);
			$linkc = '<A HREF="cliente_ver.php?dd0='.$cliente.'&dd90='.checkpost($cliente).'" class="link">';
			$sx .= $linkc.$line['bol_sacado'];
			$sx .= '</A>';
			return($sx);
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
					$sx .= fmt_data($paga);
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
						$des = 'Vencido';
					} else {
						$des = 'A vencer';						
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
