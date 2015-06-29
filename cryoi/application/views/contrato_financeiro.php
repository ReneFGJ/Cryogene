<?
// $ctr_numero
//$this->boletos->situacao_boletos_abertos($ctr_numero);
$boletos_abertos = $this->boletos->situacao_boletos_abertos($ctr_numero);
$boletos_quitados = $this->boletos->situacao_boletos_quitados($ctr_numero);
?>
<table width="100%" >
	<tr>
		<td><u>Movimentação financeira - Abertos</u></td>
	</tr>
	<tr>		
		<td>
			<?php echo $boletos_abertos;?>
		</td>
	</tr>
	<tr>
		<td><u>Movimentação financeira - Liquidados</u></td>
	</tr>
	<tr>		
		<td>
			<?php echo $boletos_quitados;?>
		</td>
	</tr>	
</table>