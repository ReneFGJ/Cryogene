<?php
class boletos extends CI_Model {
	
	function negociacao_row($obj) {
		$obj -> fd = array('id_tn', 'tn_descricao', 'tn_entrada', 'tn_avista', 'tn_parcelas', 'tn_desconto_juros');
		$obj -> lb = array('ID', 'Descrição', 'Entrada', 'Avista', 'Parcelas','Desc. nos Juros');
		$obj -> mk = array('', 'L', 'C', 'C', 'C', 'C','C','C');
		return ($obj);
	}

	/* Dados de edição*/
	function negociacao_cp() {
		$cp = array();
		array_push($cp, array('$H', 'id_tn', '', False, True));
		array_push($cp, array('$S100', 'tn_descricao', 'Nome de citação', True, True));
		
		array_push($cp, array('$O 1:SIM&0:NÃO', 'tn_avista', 'Com entrada', True, True));
		array_push($cp, array('$[0-100]', 'tn_entrada', 'Percentual da entrada', True, True));
		array_push($cp, array('$[0-36]', 'tn_parcelas', 'Parcelas a prazo', True, True));
		array_push($cp, array('$[0-100]', 'tn_desconto_juros', 'Percentual ddesconto nos juros', True, True));
		array_push($cp, array('$O 1:SIM&0:NÃO', 'tn_ativo', 'Ativo', True, True));
		/* Botao */
		array_push($cp, array('$B8', '', 'Gravar >>>', False, True));
		return ($cp);
	}	
	
	function geraTimestamp($data) {
			$partes = array();
			$data = sonumero($data);
			$partes[0] = substr($data,6,2);
			$partes[1] = substr($data,4,2);
			$partes[2] = substr($data,0,4);
			return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
		}
	
	function correcao_boletos($venc,$valor)
		{
			$tx_juros = 2.2;
			$tx_juros = (($tx_juros)/100);
			$time_final = $this->geraTimestamp(date("Ymd"));
			$time_inicial = $this->geraTimestamp($venc);
			$diferenca = $time_final - $time_inicial;
			
			$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
			
			$juros = $valor + $tx_juros / 30 * $valor;
			for ($r=1; $r <= $dias; $r++)
				{
					$juros = $juros + ($tx_juros / 30 * $valor);
				}
			return(array($dias,$juros));
		}
	
	function boletos_atrasados()
		{
			$sql = "select * from (
						select bol_contrato, count(*) as boletos, sum(bol_valor_boleto) AS valor
						FROM cr_boleto 
						WHERE bol_status ='A' 
							AND bol_data_vencimento < ".date("Ymd")."
						GROUP BY bol_contrato
						) as tabela
					INNER JOIN contrato on bol_contrato = ctr_numero
					INNER JOIN cliente on ctr_responsavel = cl_codigo
					LEFT JOIN (select crl_contrato, max(crl_data) as contato from cliente_relacionamento group by crl_contrato ) as contato on crl_contrato = ctr_numero
					ORDER BY valor DESC
					
					";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$tot1=0;
			$tot2=0;
			$tot3=0;
			$sx = '<table width="100%" class="tabela00 lt2">';
			$sx .= '<tr>
						<th>contrato</th>
						<th>responsável financeiro</th>
						<th>ativo em</th>
						<th>valor aberto</th>
						<th>último contato</th>						
					</tr>';
			for ($r=0;$r < count($rlt);$r++)
				{
					$line = $rlt[$r];
					
					/* Link */
					$link = base_url('index.php/contrato/view/'.$line['bol_contrato'].'/'.checkpost_link($line['bol_contrato']));
					
					$sx .= '<tr>';
					$sx .= '<td align="center" width="80">';
					$sx .= '<a href="'.$link.'" class="lt1 link" target="_new">';
					$sx .= $line['bol_contrato'];
					$sx .= '</td>';	
					
					$sx .= '<td>';
					$sx .= $line['ctr_responsavel_nome'];
					$sx .= '</td>';
					
					$sx .= '<td align="center">';
					$sx .= stodbr($line['ctr_dt_assinatura']);
					$sx .= '</td>';
					
					$sx .= '<td align="right">';
					$sx .= '('.$line['boletos'].') ';
					$sx .= number_format($line['valor'],2,',','.');
					$sx .= '</td>';						
					
					$sx .= '<td align="center">';
					$sx .= stodbr($line['contato']);
					$sx .= '</td>';
					
					
					$tot1 = $tot1 + $line['valor'];
					$tot2 = $tot2 + $line['boletos'];
					$tot3++;
				}
			$sx .= '</table>';
				
			$sz = '';
			$sa = '<table width="100%" class="tabela00">';
			$sa .= '<tr>
						<th>clientes</th>
						<th>boletos</th>
						<th>valor total</th>
					</tr>';	
			$sa .= '<tr align="center" class="lt5">
						<td '.$sz.'>'.$tot3.'</td>
						<td '.$sz.'>'.$tot2.'</td>
						<td>'.number_format($tot1,2,',','.').'</td>
					</tr>';
			$sa .= '</table>';
			
			return($sa.$sx);
		}

	function preparar_email_anuidade($venc = 0) {
		$sql = "select * from ic_noticia 
				where nw_ref = 'BOL_EMAIL" . date("y") . "'";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		$line = $rlt[0];
		$msg = ($line['nw_descricao']);
		$msg = mst($msg);

		$sql = "select distinct bol_contrato, bol_data_vencimento, col_rn_nome, ctr_data_coleta, bol_valor_boleto from cr_boleto";
		//$sql .= " or (bol_data_vencimento = 'venc' and bol_valor_boleto > 1 ";
		$sql .= " inner join contrato on bol_contrato = ctr_numero ";
		$sql .= " inner join cliente on ctr_responsavel = cl_codigo 
					left join coleta on col_contrato = bol_contrato ";
		$sql .= "  where (bol_auto='S' and bol_status='A')
						and bol_especie = 'REA' 
						and bol_data_processamento > 20150115 ";
		$sql .= " order by bol_contrato, bol_data_vencimento ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		/* Gera os e-mail */
		$xcont = '';
		$parc = '';
		$fim = 0;
		$valor = 0;
		$vencimento = '';
		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$contrato = $line['bol_contrato'];
			$vencimento = $line['bol_data_vencimento'];
			$rn_nome = trim($line['col_rn_nome']);

			$parcelas = '<table class="tabela01" width="100%">
								<tr><th>vencimento</th>
								<th>ação</th>
								<th>valor</th>
								<th>histórico</th>
								<th>nº boleto</th>
								<th>nº contrato</th>
								</tr>';
			$sql = "select * from cr_boleto 
						where (bol_auto='S' and bol_status='A') and bol_especie = 'REA'
							and bol_contrato = '$contrato' ";
			$rrr = $this->db->query($sql);
			$rrr = $rrr->result_array();
			$valor = 0;
			for ($t=0;$t < count($rrr);$t++)
				{
					$ln = $rrr[$t];
					$valor = $valor + $ln['bol_valor_boleto'] - $ln['bol_tx_boleto'];
					$parcelas .= $this->mostra_boleto($ln);
				}
			$parcelas .= '</table>';
			
			$texto = $msg;
			echo '<BR>'.$contrato.' ';
			$texto = troca($texto, '$RN', $rn_nome);
			$texto = troca($texto, '$DT_NASC', stodbr($line['ctr_data_coleta']));
			$texto = troca($texto, '$contrato', $contrato);
			$texto = troca($texto, '$valor', number_format($valor, 2, ',', '.'));
			$texto = troca($texto, '$boleto', $parcelas);
			$texto = troca($texto, '$dia_vencimento', substr($vencimento, 6, 2));
			$texto = troca($texto, '$mes_vencimento', meses(substr($vencimento, 4, 2)));
			$texto = troca($texto, '$ano_vencimento', substr($vencimento, 0, 4));
			$valor = 0;
			
			$this -> salve_envio_comunicacao($contrato, 'Anuidade - ' . date("Y"), $texto, 'ANU');
		}
		return (1);
	}

	function salve_envio_comunicacao($contrato, $subject, $texto, $tipo) {
		$data = date("Ymd");
		$hora = date("H:i:s");
		$sql = "select * from contrato_message where rp_contrato = '$contrato' and rp_data = $data and rp_tipo = '$tipo' ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		if (count($rlt) == 0) {
			$sql = "insert into contrato_message
					(
					rp_contrato, rp_status, rp_data,
					rp_hora, rp_texto, rp_envio_data,
					rp_envio_hora, rp_tipo, rp_subject
					) values (
					'$contrato','@','$data',
					'$hora','$texto','19000101',
					'','$tipo', '$subject'
					)
			";
			$this -> db -> query($sql);
		}
	}

	function mostra_boleto($line) {
		$link = '<A HREF="http://www.cryogene.inf.br/bb.php?dd0=' . $line['id_bol'] . '" target="_new">';
		$sx = '<tr>';
		$sx .= '<td align="center">';
		$sx .= stodbr($line['bol_data_vencimento']);
		$sx .= '</td>';
		$sx .= '<td align="center">';
		$sx .= $link . 'Imprimir boleto</A>';
		$sx .= '</td>';
		$sx .= '<td align="right">' . number_format($line['bol_valor_boleto'] + $line['bol_tx_boleto'], 2, ',', '.') . '</td>';
		$sx .= '<td align="center">' . $line['bol_numero_documento'] . '</td>';
		$sx .= '<td align="center">' . $line['bol_nosso_numero'] . '</td>';
		$sx .= '<td align="center">' . $line['bol_contrato'] . '</td>';
		$sx .= '</tr>';
		return ($sx);
	}

	function inserir_boleto($obj,$desconto=1) {
		$contrato = $obj['contrato'];
		$venc = $obj['vencimento'];
		$venc2 = 19000101;
		if ($desconto==1)
			{
				$venc2 = $venc;
			}
		$data = date("Ymd");
		$valor = $obj['valor'];
		$taxa = 0;
		/* Taxa do boleto */
		$doc = $obj['documento'];
		$cpf = $obj['resp_cpf'];
		$sacado = $obj['resp_nome'];
		$endereco = $obj['resp_ende'];
		$cidade = $obj['resp_cida'];
		$conta = $obj['conta'];
		$texto = $obj['texto'];
		$tipo = 'E';

		if (round($valor) <= 10) {
			return (0);
		}

		$sql = "select * from cr_boleto where bol_contrato = '$contrato' and bol_data_vencimento = '$venc' and bol_numero_documento = '$doc' ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		if (count($rlt) > 0) {
			return (0);
		}

		$xsql = "INSERT INTO cr_boleto(
				bol_contrato, bol_status, bol_data_vencimento, 
				bol_data_documento, bol_data_processamento, bol_valor_boleto, 
				bol_tx_boleto, bol_aceite, bol_especie, 
				
				bol_especie_doc, bol_nosso_numero, bol_numero_documento, 
				bol_cpf_cnpj, bol_endereco, bol_cidade, 
				bol_endereco1, bol_endereco2, bol_conta, 
				
				bol_obs, bol_valor_pago, bol_data_pago, 
				bol_sacado_2, bol_sacado, bol_lido, 
				bol_lido_data, bol_auto, bol_tipo, 
				
				bol_data_vencimento_2, bol_fatura, bol_juros, 
				bol_autonegociacao, bol_autonegociacao_data, 
				bol_autonegociacao_qta, bol_data_vencimento_original
				) VALUES (
				'$contrato','A',$venc,
				$data,$data,$valor,
				$taxa,'S','REA',
				
				'AUTOF','','$doc',				
				'$cpf','$endereco','$cidade',
				'','','$conta',
				
				'$texto',0,19000101,				
				'','$sacado','N',
				19000101,'S','$tipo',
				
				$venc2,'',0,				
				0,$venc2,
				0,$venc2
				)";
		$this -> db -> query($xsql);

		$usql = "update cr_boleto set bol_nosso_numero = lpad(id_bol,8,'0') where bol_nosso_numero = ''";
		$this -> db -> query($usql);
		return (1);
	}

	function status($sta) {
		switch($sta) {
			case 'A' :
				$sta = '<font color="blue">Aberto</font>';
				break;
			case 'B' :
				$sta = '<font color="green">Liquidado</font>';
				break;
			case 'C' :
				$sta = '<font color="red">Atraso</font>';
				break;
			case 'X' :
				$sta = '<font color="orange">Cancelado</font>';
				break;
		}
		return ($sta);
	}

	function situacao_boletos_abertos($contrato) {
		$sql = "select * from cr_boleto where bol_contrato = '$contrato' and bol_status ='A' ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		$sx = '<table width="100%"class="lt1">';
		$tot = 0;
		$to = 0;
		$sx .= '<tr>
					<th width="80">vencimento</th>
					<th width="80">status</th>
					<th width="80">nosso nr.</th>
					<th width="80">dt.pagamento</th>
					<th width="80">situação</th>
					<th width="80">valor a pagar</th>
					<th width="50">taxas</th>
					<th width="80">total pago</th>
					<th width="120">documento</th>
					<th width="*">descrição</th>
					<th width="20">ver</th>
					</tr>';

		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$bgcolor = ' bgcolor="#D0FFD0" ';
			$status = $line['bol_status'];
			$id_bol = $line['id_bol'];

			if ($line['bol_data_vencimento'] < date("Ymd")) {
				$bgcolor = ' bgcolor="#FFD0D0" ';
				$status = 'C';
			}
			$dtv = $line['bol_data_vencimento_original'];
			$vc_status = 'não alterado';
			$sx .= '<tr ' . $bgcolor . '>';
			$sx .= '<td><nobr>' . stodbr($line['bol_data_vencimento']) . '</td>';
			$sx .= '<td><nobr>' . $this -> status($status) . '</td>';

			$sx .= '<td align="center"><nobr>' . $line['bol_nosso_numero'] . '</td>';

			$sx .= '<td><nobr>' . stodbr($line['bol_data_pago']) . '</td>';
			$sx .= '<td><nobr>' . $vc_status . '</td>';

			$sx .= '<td align="right"><nobr>' . number_format($line['bol_valor_boleto'], 2, ',', '.') . '</td>';
			$sx .= '<td align="right"><nobr>' . number_format($line['bol_tx_boleto'], 2, ',', '.') . '</td>';
			$sx .= '<td align="right"><nobr><B>' . number_format($line['bol_valor_pago'], 2, ',', '.') . '</B></td>';

			$sx .= '<td colspan=1><nobr>' . $line['bol_numero_documento'] . '</td>';
			$sx .= '<td colspan=1>' . $line['bol_obs'] . '</td>';

			$sx .= '<td style="width:20px;"><nobr>' . boleto_link($id_bol) . 'ver' . '</A>' . '</td>';

			$tot = $tot + $line['bol_valor_boleto'] + $line['bol_tx_boleto'];
			$to++;
		}
		if ($to == 0) {
			$sx = '<table width="100%"class="lt1">';
			$sx .= '<tr><td colspan=5><font color="orange">Sem boletos abertos</font></td></tr>';
		}
		$sx .= '</table>';
		return ($sx);
	}

	function situacao_boletos_quitados($contrato) {
		$sql = "select * from cr_boleto where bol_contrato = '$contrato' and bol_status ='B' ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();

		$sx = '<table width="100%"class="lt1">';

		$sx .= '<tr>
					<th width="80">vencimento</th>
					<th width="80">status</th>
					<th width="80">nosso nr.</th>
					<th width="80">dt.pagamento</th>
					<th width="80">situação</th>
					<th width="80">valor a pagar</th>
					<th width="50">taxas</th>
					<th width="80">total pago</th>
					<th width="120">documento</th>
					<th width="*">descrição</th>
					<th width="20">ver</th>
					</tr>';

		for ($r = 0; $r < count($rlt); $r++) {$line = $rlt[$r];
			$dtv = $line['bol_data_vencimento_original'];
			$vc_status = 'não alterado';
			$sx .= '<tr>';
			$sx .= '<td><nobr>' . stodbr($line['bol_data_vencimento']) . '</td>';
			$sx .= '<td><nobr>' . $this -> status($line['bol_status']) . '</td>';

			$sx .= '<td align="center"><nobr>' . $line['bol_nosso_numero'] . '</td>';

			$sx .= '<td><nobr>' . stodbr($line['bol_data_pago']) . '</td>';
			$sx .= '<td><nobr>' . $vc_status . '</td>';

			$sx .= '<td align="right"><nobr>' . number_format($line['bol_valor_boleto'], 2, ',', '.') . '</td>';
			$sx .= '<td align="right"><nobr>' . number_format($line['bol_tx_boleto'], 2, ',', '.') . '</td>';
			$sx .= '<td align="right"><nobr><B>' . number_format($line['bol_valor_pago'], 2, ',', '.') . '</B></td>';

			$sx .= '<td colspan=1><nobr>' . $line['bol_numero_documento'] . '</td>';
			$sx .= '<td colspan=1>' . $line['bol_obs'] . '</td>';
			$sx .= '<td colspan=1 align="center">-</td>';
			$line = $rlt[$r];
		}
		$sx .= '</table>';
		return ($sx);
	}

	function boleto_razao($anoi = 0, $anof = 2999, $granularidade = 'M', $situacao = '') {
		if ($anoi < 2010) { $anoi = 2010;
		}
		if ($anof == 0) { $anof = date("Y");
		}
		$data1 = $anoi . '0101';
		$data2 = $anof . '9999';
		$ano1 = round(substr($data1, 0, 4));
		$ano2 = round(substr($data2, 0, 4));

		/* parametros adicionais */
		$wh2 = '';
		if (strlen($situacao) > 0) { $wh2 = " and (bol_status = '$situacao' )";
		}

		switch ($granularidade) {
			case 'Y' :
				$rz = 10000;
				break;
			case 'M' :
				$rz = 100;
				break;
			case 'D' :
				$rz = 1;
				break;
			default :
				$rz = 10000;
				break;
		}
		$sql = "SELECT sum(bol_valor_boleto) as valor, bol_data_vencimento , bol_status,
								count(*) as total
								FROM cr_boleto
								WHERE (bol_data_documento >= $data1 and bol_data_documento <= $data2)
								$wh2
								GROUP BY bol_data_vencimento, bol_status
						";
		$rlt = db_query($sql);
		$rst = array();
		while ($line = db_read($rlt)) {
			$id = (int)($line['bol_data_vencimento'] / $rz);
			$sta = $line['bol_status'];
			$vlr = $line['valor'];
			$qta = $line['total'];

			$key = $id . $sta;
			if (!isset($rst[$key])) {
				$rst[$key] = $vlr;
			} else {
				$rst[$key] = $rst[$key] + $vlr;
			}
		}

		$sx = '<table width="100%">';
		$sx .= '<tr>';
		$sx .= '<th>Ano</th>';
		$mes = array('Jan.', 'Fev.', 'Mar.', 'Abr.', 'Maio', 'Jun.', 'Jul.', 'Ago.', 'Set.', 'Out.', 'Nov.', 'Dez');
		for ($r = 0; $r < count($mes); $r++) {
			$sx .= '<th width="7%">' . $mes[$r] . '</th>' . cr();
		}
		$sx .= '<th width="8%">total</th>' . cr();
		$sx .= '</tr>';
		$sx .= '<tr>';
		$sx .= '</tr>';

		for ($r = $ano1; $r <= $ano2; $r++) {
			$sx .= '<tr><th>' . $r . '</th>';
			$tot = 0;
			for ($m = 1; $m <= 12; $m++) {
				$vlr = 0;
				$saldo = 0;
				$keyA = strzero($r, 4) . strzero($m, 2) . 'A';
				$keyB = strzero($r, 4) . strzero($m, 2) . 'B';
				if (isset($rst[$keyA])) { $saldo = $saldo + $rst[$keyA];
				}
				if (isset($rst[$keyB])) { $saldo = $saldo + $rst[$keyB];
				}
				$tot = $tot + $saldo;

				$sx .= '<td class="border1" align="right">';
				if ($saldo > 0) {
					$sx .= number_format($saldo, 2, ',', '.');
				} else {
					$sx .= '-';
				}
				$sx .= '</td>';
			}
			$sx .= '<td class="border1" align="right">';
			$sx .= '<B>' . number_format($tot, 2, ',', '.') . '</b>';
			$sx .= '</td>';

			$sx .= '</tr>';
		}
		$sx .= '</table>';
		return ($sx);
	}

}
