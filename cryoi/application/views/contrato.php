<?php
$rn_nome = $col_rn_nome;
$color_st = '#EEEEEE';
if ($ctr_status == 'N') 
	{
		$color_st = '#FFCCCC';
	}
$color_bol = '';	

if ($boleto_atrasado > 0)
	{
		$color_bol = ' bgcolor="#FFCCCC" ';
	} else {
		if ($boleto_aberto > 0)
		{
			$color_bol = ' bgcolor="#CCFFCC" ';
		}
	}
if ($boleto_aberto > 0)
	{
		$boleto_aberto = 'R$ '.number_format($boleto_aberto,2,',','.');
	} else {
		$boleto_aberto = '&nbsp';
	}	
?>
<table class="lt1" width="100%">
	<tr>
		<td>
			<table class="lt2" width="100%">
				<tr valign="top">
					<td bgcolor="<?php echo $color_st; ?>" width="100" rowspan="10">
						<font class="lt0">Contrato</font>
						<BR><h1><?php echo $ctr_numero; ?></h1>
							<font class="lt0">Assintatura</font><BR>
							<font class="lt1"><?php echo stodbr($ctr_dt_assinatura); ?></font>						
					</td>
					<td valign="top" width="500"><img src="<?php echo base_url('img/icon_father.png'); ?>" height="22" title="nome do pai">
						<?php echo cliente_link($ctr_pai) . $pai_nome; ?></a>
					</td>
					
					<td>
						<img src="<?php echo base_url('img/icon_baby.png'); ?>" height="22" title="nome do bebê">
						<?php echo cliente_link($ctr_mae) . $rn_nome; ?></a>
					</td>
					
					<td valign="top" width="200">Situação
						<?php echo $situacao; ?></a>
					</td>
				</tr>
				<tr valign="top">
					<td valign="top"><img src="<?php echo base_url('img/icon_mother.jpg'); ?>" height="22" title="nome do mãe">
						<?php echo cliente_link($ctr_mae) . $mae_nome; ?></a>
					</td>
					<td></td>
					<td rowspan=2 <?php echo $color_bol; ?>><font class="lt0">Boletos abertos / atrasados:</font>
						<nobr><br><font class="lt4"><?php echo $boleto_aberto; ?></font></nobr></td>
					
				</tr>
				<tr valign="top">
					<td valign="top"><img src="<?php echo base_url('img/icon_cash.png'); ?>" height="22" title="nome do responsavel da fatura">
						<?php echo cliente_link($ctr_responsavel) . $responsavel_nome; ?></a>
					</td>
				</tr>				
			</table>
		</td>
	</tr>
</table>
