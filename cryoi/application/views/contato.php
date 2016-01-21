<table width="100%" class="lt1">
	<tr>
		<td colspan=4 class="lt4">Tipo: <?php echo $tipo;?></td>
	</tr>
	<tr>
		<td width="20%" align="right">Nome </td>
		<td colspan=3 class="lt3"><?php echo $cl_nome;?></td>
	</tr>
	
	<tr>
		<td width="10%" align="right">CPF:</td>
		<td width="40%"><?php echo $cl_cpf;?></td>
		<td width="10%" align="right">RG:</td>
		<td width="40%"><?php echo $cl_rg;?></td>
	</tr>

	<tr>
		<td width="20%" align="right">Dt. Nascimento:</td>
		<td><?php echo stodbr($cl_dt_nasc);?></td>
		<td width="20%" align="right">Profissão:</td>
		<td><?php echo $cl_profissao;?></td>
		
	</tr>

	<tr>
		<td width="20%" align="right">Endereço:</td>
		<td colspan=3><?php echo $cl_endereco;?>, <?php echo $cl_bairro;?>, CEP <?php echo $cl_cep;?></td>
	</tr>

	<tr>
		<td width="20%" align="right">Telefones:</td>
		<td colspan=3>(<?php echo $cl_fone_ddd;?>) <?php echo $cl_fone_1;?> <?php echo $cl_fone_2;?> <?php echo $cl_fone_3;?></td>
	</tr>
	
	<tr>
		<td width="20%" align="right">e-mail:</td>
		<td><?php echo $cl_email;?>
		<br><?php echo $cl_email_alt;?>
		</td>
	</tr>
</table>