<?php
class faturamentos extends CI_model {
	function valor_reajustado($line) {
		$idx = $line['ctr_reajuste_indice'];
		$vlr = $line['ctr_anuidade_atual'];
		$valor = $vlr + $vlr * ($idx / 100);
		$valor = (int)($valor * 10);
		$valor = $valor / 10;
		return ($valor);
	}

	function gerar_faturas($data = 0) {
		$ano = date("Y");
		$sx = '';
		/*************** Mes selecionado - Phase II */
		$mes = round(substr($data, 4, 2));
		$sql = "select * from contrato 
		left join cobranca_forma on ctr_cobranca_tipo = fc_codigo 
		left join cliente on cl_codigo = ctr_responsavel 
		left join cidade on cl_cidade = c_codigo
		left join (select bol_contrato,sum(bol_valor_boleto) as total from cr_boleto
		where bol_data_documento >= " . $ano . "0000 and bol_status <> 'X'
		group by bol_contrato 
		) as boletos on boletos.bol_contrato = contrato.ctr_numero 
		where ctr_vencimento_dia = '$mes' 
		order by ctr_dt_assinatura,ctr_numero ";
		$rlt = $this -> db -> query($sql);
		$rlt = $rlt -> result_array();
		$sx = '<table width="100%" class="tabela00" border=1>' . cr();
		for ($r = 0; $r < count($rlt); $r++) {
			$line = $rlt[$r];
			$fld = 'ctr' . $line['ctr_numero'];
			$vlr = $this -> input -> post($fld);
			if ($vlr == '1') {
				$obj = array();

				/* Calculo do valor */
				$obj['valor_total'] = $this -> valor_reajustado($line);
				$obj['parcelas'] = $line['fc_parcela'];
				$obj['npr'] = $line['fc_parcela'];
				$obj['contrato'] = trim($line['ctr_numero']);
				$obj['vencimento'] = brtos($this -> input -> post('dd0'));
				$obj['texto'] = ($this -> input -> post('dd1'));

				$obj['conta'] = ($this -> input -> post('dd2'));
				$obj['resp_cpf'] = trim($line['cl_cpf']);
				$obj['resp_ende'] = trim($line['cl_endereco']);
				$obj['resp_cida'] = trim($line['c_cidade']);
				$obj['resp_nome'] = trim($line['cl_nome']);
				$obj['resp_cep'] = trim($line['cl_cep']);
				$obj['dsp_cobranca_cod'] = '';
				$obj['tipo'] = 'ANU';

				/* Gera Boletos */
				$parcelas = round($line['fc_parcela']);
				$valor_total = $obj['valor_total'];
				$valor = (int)($valor_total / $parcelas * 10);
				$valor = $valor / 10;
				$desconto = 0;
				if ($parcelas == 1) { $desconto = 1; }
				
				for ($rc = 1; $rc <= $parcelas; $rc++) {
					$obj['valor'] = $valor;
					$obj['documento'] = 'Aunidade ' . $rc . '/' . $obj['parcelas'];
					$ok = $this -> boletos -> inserir_boleto($obj, $desconto);
					$sx .= '<tr>
									<td>' . $obj['contrato'] . '</td>
									<td>' . $obj['resp_nome'] . '</td>
									<td align="center">' . $rc . '/' . $parcelas . '</td>
									<td align="right">' . number_format($valor, 2, ',', '.') . '
									';
					switch ($ok) {
						case 1 :
							$sx .= '<td><font color="green">Faturado!</font></td>';
							break;
						case 0 :
							$sx .= '<td><font color="red">Já faturado!</font></td>';
							break;
					}
					$sx .= '</tr>';
					$obj['vencimento'] = DateAdd('m',1,$obj['vencimento']);
				}

			}
		}
		$sx .= '</table>';
		
		/* Gerar e-mail */
		$this->boletos->preparar_email_anuidade();
		return ($sx);

	}

	function status($sta) {
		switch($sta) {
			case 'S' :
				$sta = '<font color="blue">Ativo</font>';
				break;
			case 'N' :
				$sta = '<font color="red">Inativo</font>';
				break;
			case 'F' :
				$sta = '<font color="green">Já faturado</font>';
				break;
			case 'Z' :
				$sta = '<font color="orange">Conferir</font>';
				break;
			case 'I' :
				$sta = '<font color="orange">Isento</font>';
				break;
		}
		return ($sta);
	}

	function armazenamento_faturar($data) {
		$acao = $this -> input -> post('acao');

		/*************** Mes selecionado - Phase II */
		$mes = round(substr($data, 4, 2));
		$sql = "select * from contrato ";
		$sql .= ' left join cobranca_forma on ctr_cobranca_tipo = fc_codigo ';
		$sql .= ' left join cliente on cl_codigo = ctr_responsavel ';
		$sql .= ' left join (select bol_contrato,sum(bol_valor_boleto) as total from cr_boleto ';
		$sql .= ' where bol_data_documento >= ' . date("Y") . "0000 and bol_status <> 'X'";
		$sql .= ' group by bol_contrato ';
		$sql .= ' ) as boletos on boletos.bol_contrato = contrato.ctr_numero ';
		$sql .= ' where ctr_vencimento_dia = ' . $mes;
		$sql .= ' order by ctr_dt_assinatura,ctr_numero ';
		$rlt = db_query($sql);

		$xano = '';
		$xtot = 0;
		$tot = 0;
		$it = 0;
		$xit = 0;
		$sx = '<table width="100%" class="lt1" border=1>';
		$sx .= '<tr>';
		$sx .= '<td width="100" align="center" style="background-color: #EEEEEE;" rowspan=5>Dados para gerar Anuidades';
		$sx .= '<form method="post" action="' . base_url('index.php/contas_receber/gerar_faturamento_emitir/' . $data . '/' . checkpost_link($data)) . '">';
		$sx .= '</td>';

		$sx .= form_field(array('$D8', '', 'Data de vencimento', True, True), $this -> input -> post("dd0"));
		$sx .= form_field(array('$T60:4', '', 'Informações no boleto', True, True), $this -> input -> post("dd1"));
		$sql = "select * from conta_corrente where cc_ativo = 1";
		$sx .= form_field(array('$Q cc_codigo:cc_nome:' . $sql, '', 'Banco', True, True), $this -> input -> post("dd2"));
		$sx .= form_field(array('$B8', '', 'Faturar >>>', False, True), '');
		$sx .= '</table>';

		$sx .= '<table width="100%" class="lt1" border=1>';
		$sh = '<tr class="lt0">
					<th style="background-color:#EEE; color: #000; border: 0px; " >s</th>
					<th style="background-color:#EEE; color: #000; border: 0px; " >contrato</th>
					<th style="background-color:#EEE; color: #000; border: 0px; " >Resp. fatura</th>
					<th style="background-color:#EEE; color: #000; border: 0px; " >Vlr. base</th>
					<th style="background-color:#EEE; color: #000; border: 0px; " >Status</th>
					<th style="background-color:#EEE; color: #000; border: 0px; " >% reajuste</th>
					<th style="background-color:#EEE; color: #000; border: 0px; " >Vlr. fatura</th>
					<th style="background-color:#EEE; color: #000; border: 0px; " colspan=2>Envio</th>
					</tr>' . cr();
		while ($line = db_read($rlt)) {
			$ano = substr($line['ctr_dt_assinatura'], 0, 4);
			$cobrarem = $line['ctr_data_inicio_cobranca'];

			if ($ano != $xano) {
				if ($xtot > 0) {
					$sx .= '<tr><td colspan=9 align="right"><B>Sub total (' . $xit . ') ' . number_format($xtot, 2, ',', '.') . '</td>';
					$xtot = 0;
					$xit = 0;
				}
				$sx .= '<tr><th class="lt3" colspan=9>' . $ano . '</th></tr>';
				$sx .= $sh;
				$xano = $ano;
			}
			/* Calculo do valor */
			$vlr = $this -> valor_reajustado($line);

			/* Checkpost */
			$checked = 'checked';

			/* Cores */
			$bg = '';
			if ($line['ctr_status'] == 'N') { $bg = ' bgcolor="#ffEEEE" ';
				$checked = '';
			}

			/* Status */
			$status = $line['ctr_status'];
			if ($line['total'] > 0) {
				$status = 'F';
				$bg = ' bgcolor="#EEffEE" ';
				$checked = '';
			}

			/* Cores Isento */
			if ($cobrarem > date("Ymd")) {
				if (strlen($acao) == 0) { $checked = '';
					$bg = ' bgcolor="#EEEEff" ';
					$status = 'I';
				}
			}

			/* Se ativo */
			if (($line['ctr_status'] == 'S') and (strlen($bg) == 0)) {
				$xtot = $xtot + $vlr;
				$tot = $tot + $vlr;
				$xit++;
				$it++;
			}

			$sx .= '<tr ' . $bg . '>';

			$sx .= '<td width="10" align="center">';
			if ($status != 'N') {
				$sx .= '<input type="checkbox" value="1" name="ctr' . $line['ctr_numero'] . '" ' . $checked . '>';
			} else {
				$sx .= '-';
			}

			/* Contrato */
			$link = contrato_link($line['ctr_numero']);
			$sx .= '<td align="center">' . $link . trim($line['ctr_numero']) . '/' . substr($line['ctr_dt_assinatura'], 2, 2) . '</A>' . '</td>';

			/* Nome */
			$sx .= '<td>' . cliente_link($line['ctr_responsavel']) . trim($line['ctr_responsavel_nome']) . '</A></td>';

			/* Anuidade */
			$sx .= '<td align="right">' . number_format($line['ctr_anuidade_atual'], 2, ',', '.') . '</td>' . cr();

			/* Anuidade */
			$sx .= '<td align="center">' . $this -> status($status) . '</td>' . cr();

			/* Reajuste */
			$sx .= '<td align="center">' . number_format($line['ctr_reajuste_indice'], 2, ',', '.') . '%</td>' . cr();

			/* Anuidade Reajustada */
			$sx .= '<td align="right">' . number_format($vlr, 2, ',', '.') . '</td>' . cr();

			/* fc_nome */
			$sx .= '<td>' . trim($line['fc_nome']) . '</td>';

			/* fc_correio */
			$sx .= '<td height="24">';
			if (substr($line['fc_codigo'], 0, 1) == 'B') {
				$sx .= '<img src="' . base_url('img/correios.gif') . '" height="16">';
			} else {
				$sx .= '-';
			}

			$sx .= '</td>';

			$sx .= '</tr>' . cr();
			$ln = $line;
		}

		if ($xtot > 0) {
			$sx .= '<tr><td colspan=9 align="right"><B>Sub total (' . $xit . ') ' . number_format($xtot, 2, ',', '.') . '</td>';
			$xtot = 0;
		}
		if ($tot > 0) {
			$sx .= '<tr><td colspan=9 class="lt2" align="right"><B>Total Geral (' . $it . ') ' . number_format($tot, 2, ',', '.') . '</td>';
			$xtot = 0;
		}

		$sx .= '</table>';

		$sx .= "
		<script>
			$(document).ready(function(){
  				$('.date').mask('00/00/0000');
  				$('.money').mask('000.000.000.000.000,00', {reverse: true});
			});
		</script>
		";
		return ($sx);
	}

	function cp_mes_faturamento() {
		$cp = array();
		array_push($cp, array('$H8', '', '', False, True));
		array_push($cp, array('$MES', '', 'mês de faturamento', True, True));
		return ($cp);
	}

}
?>
