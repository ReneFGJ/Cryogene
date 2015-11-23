<?php
$linkc = '<a href="'.base_url('index.php/contrato/view/'.$ctr_numero.'/'.checkpost_link($ctr_numero)).'">';
$nome_rn = 'sem nome registrado'; 
switch ($ctr_status)
	{
	case 'N': $ctr_status = '<font color="red">Inativo</font>';
	break;
	case 'S': $ctr_status = '<font color="green">Ativo</font>';
	break;
	}
?>
<tr class="lt0">
	<td rowspan="4" width="80">
		<img src="<?php echo base_url('img/icone/contrato.png');?>" height="60">
	</td>	
	<td width="80">
		Contrato
	</td>
	<td colspan=2 width="70%">
		Nome do RN
	</td>	
	<td width="25%">
		situação
	</td>
</tr>

<tr class="lt3" valign="top">

	<td>
		<b><?php echo $linkc . $ctr_numero.'/'.substr($ctr_dt_assinatura,2,2);?></a></b>
	</td>
	<td colspan=2>
		<b><?php echo $linkc . $nome_rn;?></a></b> (<?php echo stodbr($ctr_data_coleta);?>)
	</td>
	<td>
		<b><?php echo $ctr_status; ?></b>
	</td>		
</tr>

<tr class="lt0" valign="top">
	<td>Data assinatura</td>
	<td>
		Nome da Mãe
	</td>
	<td>
		Nome do Pai
	</td>
	<td>
		Resp. Financeiro
	</td>	
</tr>

<tr class="lt2" valign="top">

	<td>
		<?php echo stodbr($ctr_dt_assinatura);?>
	</td>
	<td>
		<?php echo $mae_nome;?>
	</td>
	<td>
		<?php echo $pai_nome;?>
	</td>		
	<td>
		<?php echo $resp_nome;?>
	</td>		
</tr>
<tr><td colspan=5>&nbsp;<br>&nbsp;</td></tr>