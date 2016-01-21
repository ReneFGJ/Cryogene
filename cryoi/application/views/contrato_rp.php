<?
// $ctr_numero
$data['ctr_numero'] = $ctr_numero;
?>
<table width="100%" lass="tabela01" border=0>
	<tr valign="top">
		<th width="60%">Histórico</th>
		<th width="40%">Relacionamento</th>
	</tr>
	<tr valign="top">
		<td>
			<?php echo $this -> relacionamentos -> mostra_rp($ctr_numero); ?>
		</td>
		<td>
			<?php echo $this->load->view('rp_contato_form',$data,true); ?>
		</td>				
	</tr>
</table>