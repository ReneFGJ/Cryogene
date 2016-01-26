<?php
$nego = $this -> load -> view('boleto_negociacao_tela', Null, true);
$sql = "select * 
			from cr_boleto 
			WHERE bol_contrato = '$ctr_numero' 
				AND bol_status = 'A' 
			ORDER BY bol_data_vencimento desc";
$rlt = $this -> db -> query($sql);
$rlt = $rlt -> result_array($rlt);

$sx = '<table width="100%" class="tabela00 lt2">';
$sx .= '<tr>
			<th width="2%">C</th>
			<th width="7%">Vencimento</th>
			<th width="7%">Situação</th>
			<th width="7%">Valor Original</th>
			<th width="5%">Dias atraso</th>
			<th width="7%">Juros e Multa</th>
			<th width="7%">Valor corrigido</th>
			<th width="7%">Nosso número</th>
			<th width="15%">Descricao</th>
			<th width="31%">Negociação</th>
			
   		</tr>
		';
for ($r = 0; $r < count($rlt); $r++) {
	$line = $rlt[$r];
	
	$valor = $line['bol_valor_boleto'];
	$status = '<font color="green">Aberto</a>';
	$dias = 0;
	$juros = 0;
	$corrigido = 0;
	if ($line['bol_data_vencimento'] < date("Ymd")) {
		$status = '<font color="red">Atrasado</a>';
		/* Juros */
		$vlra = $this->boletos->correcao_boletos($line['bol_data_vencimento'],$line['bol_valor_boleto']);
		$juros = $vlra[1];
		$dias = $vlra[0];
	}
	$corrigido = $juros + $valor;
	/* Checkbox */
	$onclick = ' onclick="marked('.$line['id_bol'].',this)" ';
	$checkbox = '<input type="checkbox" name="ddc' . $r . '" value="1" '.$onclick.'>';
	$sx .= '<tr valign="top">';
	$sx .= '<td align="center">' . $checkbox . '</td>';
	$sx .= '<td align="center">' . stodbr($line['bol_data_vencimento']) . '</td>';
	$sx .= '<td align="center">' . $status . '</td>';
	$sx .= '<td align="right">' . number_format($line['bol_valor_boleto'], 2, ',', ',') . '</td>';
	$sx .= '<td align="center">' . $dias . '</td>';
	$sx .= '<td align="right">' . number_format($juros, 2, ',', ',') . '</td>';
	$sx .= '<td align="right">' . number_format($corrigido, 2, ',', ',') . '</td>';
	$sx .= '<td align="center">' . $line['bol_nosso_numero'] . '</td>';
	$sx .= '<td>' . $line['bol_numero_documento'] . '</td>';
	if ($r == 0) {
		$sx .= '<td rowspan="' . (count($rlt) + 1) . '"><div id="nego">' . $nego . '</div></td>';
	}
}
$sx .= '<tr><td style="min-height: 400px;" colspan=9>Título abertos ' . count($rlt) . '</td></tr>';
$sx .= '</table>';
echo $sx;

$js = 'function marked($id,$ob)
			{
				$ck = $ob.checked;
				$url = "' . base_url('index.php/contrato/boleto_set/').'/" + $id + "/" + $ck;
				$.ajax({
  					method: "POST",
  					url: $url,
  					data: { ctrl: "'.$ctr_numero.'", type: "BOL" }
					})
  					.done(function( data ) {
    						$("#nego").html(data);
  					});
			}
			' . cr();
echo '<script>'.cr();
echo $js;
echo '</script>'.cr();
?>
