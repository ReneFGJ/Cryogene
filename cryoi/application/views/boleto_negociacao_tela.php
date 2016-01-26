<?php
if (!(isset($tit_total))) { $tit_total = 0; }
if (!(isset($jur_total))) { $jur_total = 0; }
if (!(isset($vlr_total))) { $vlr_total = 0; }
if (!(isset($des_total))) { $des_total = 0; }
if (!(isset($pag_total))) { $pag_total = 0; }

$pag_total = $jur_total + $vlr_total - $des_total;

$f = array();
$sql = "select * from taxa_negociacao where tn_ativo = 1 order by tn_desconto_juros desc";
$rlt = $this->db->query($sql);
$rlt = $rlt->result_array();

$forma = '<table width="100%" class="lt1">';
$forma .= '<tr>
			<th>s</th>
			<th>Negociação</th>
			<th>Entrada</th>
			<th>Parcelas</th>
			<th>Desconto Juros</th>
			</tr>';
			
$boletos = '';

for ($r=0;$r < count($rlt);$r++)
	{
		$line = $rlt[$r];
		
		$pg2 = ($line['tn_desconto_juros'] * $jur_total)/100;
		$pg1 = ($jur_total -  $pg2)+ $vlr_total - $des_total;
		$pg4 = $line['tn_parcelas'];
		$pg5 = $pg1 * ($line['tn_entrada']/100);
		if ($pg4 > 0)
			{
				$pg3 = ($pg1 - $pg5) / $pg4;
			} else {
				$pg3 = 0;
			}
		$checked = '';
		$dd2 = get("dd2");
		if ($dd2 == $line['id_tn']) {
			
			$checked = ' checked '; 
			$boletos = '<table width="100%" class="lt1">';
			$boletos .= '<tr>
							<th width="50%">Vencimento</th>
							<th width="50%">Valor</th>
						</tr>';
			$boletos = '</table>';
		}
		
		$forma .= '<tr>';
		$forma .= '<td><input type="radio" name="dd2" value="'.$line['id_tn'].'" '.$checked.'></td>';
		
		$forma .= '<td>'.$line['tn_descricao'].'</td>';
		$forma .= '<td align="right" width="15%">';
		$forma .= number_format($pg5,2,',','.');
		$forma .= '</td>';
		
		$forma .= '<td align="right" align="right" width="15%">';
		$forma .= $pg4.'x'.number_format($pg3,2,',','.');
		$forma .= '</td>';

		$forma .= '<td align="right" align="right" width="15%">';
		$forma .= number_format($pg2,2,',','.');
		$forma .= '</td>';
				
		$forma .= '</tr>';		
	}
$forma .= '</table>';
$forma .= '<input type="submit" value="visualizar negociação >>>">';



?>
<form method="post">
<table width="100%" class="lt1" style="border: 4px solid #000; border-radius: 5px;">
	<tr><td colspan=2 class="lt4" align="center">Negociação</td></tr>
	<tr>
		<td align="right" width="30%">Total de títulos</td>
		<td class="lt3" width="70%"><?php echo $tit_total;?></td>
	</tr>
	<tr>
		<td align="right">Valor original</td>
		<td class="lt3"><?php echo number_format($vlr_total,2,',','.');?></td>
	</tr>
	<tr>
		<td align="right">Valor juros</td>
		<td class="lt3"><?php echo number_format($jur_total,2,',','.');?></td>
	</tr>
	<tr>
		<td align="right">Valor desconto</td>
		<td class="lt3"><?php echo number_format($des_total,2,',','.');?></td>
	</tr>
	<tr>
		<td align="right">Valor a pagar</td>
		<td class="lt3"><b><?php echo number_format($pag_total,2,',','.');?></b></td>
	</tr>
	<tr>
		Forma<br>
		<td colspan=2><?php echo $forma;?></td>
	</tr>
	<tr>
		<td align="right">Boletos
		<?php echo $boletos;?>			
		</td>

	</tr>
</table>
<input type="hidden" value="7" name="dd7">
</form>
