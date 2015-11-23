	<table width="100%" align="center" class="lt2 tabela00">
		<tr valign="top">
			<td rowspan=11 width="120">
				<img src="<?php echo base_url('img/icone/cliente.png'); ?>" height="200">
			</td>
			<th class="lt5" colspan=2><b>Dados do Cliente</b></td>
		</tr>
		<tr><td class="lt0">Nome</td>
			<td class="lt0">CPF</td>
		</tr>
		<tr>
			<td class="lt3"><?php echo $cl_nome; ?></td>
			<td class="lt3"><?php echo $cl_cpf; ?></td>			
		</tr>
		
		<tr><td class="lt0">Enderço</td>
			<td class="lt0">Bairro</td>
		</tr>	
		<tr>
			<td class="lt2"><?php echo $cl_endereco; ?></td>
			<td class="lt2"><?php echo $cl_bairro; ?></td>	
		</tr>


		<tr><td class="lt0">Cidade / Pais</td>
			<td class="lt0">CEP</td>
		</tr>	
		<tr>
			<td class="lt2"><?php echo $cl_cidade.' / '.$cl_pais; ?></td>
			<td class="lt2"><?php echo $cl_cep; ?></td>	
		</tr>

		<tr><td class="lt0">Telefone(s)</td>
			<td class="lt0">e-mail</td>
		</tr>	
		<tr>
			<td class="lt2"><?php echo $cl_fone_ddd.' '.$cl_fone_1.' '.$cl_fone_2.' '.$cl_fone_3; ?></td>
			<td class="lt2"><?php echo $cl_email.' '.$cl_email_alt; ?></td>	
		</tr>
			
		<tr><td class="lt0">Profissão</td>
			<td class="lt0">Dt. nasc.</td>
		</tr>	
		<tr>
			<td class="lt2"><?php echo $cl_profissao; ?></td>
			<td class="lt2"><?php echo stodbr($cl_dt_nasc); ?></td>	
		</tr>
	</table>
	<br>
	<br>
	<br>