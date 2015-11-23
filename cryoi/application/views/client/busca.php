<form method="get">
	<center>
	<table width="800" align="center" class="lt2 tabela00">
		<tr valign="top">
			<td rowspan=5>
				<img src="<?php echo base_url('img/icone/cliente.png');?>" height="200">
			</td>
			<td><h1><b>Busca cliente</b></h1></td>
		</tr>
		<tr>
			<td>Informe o nome do cliente<br>
				<input type="text" class="lt4" name="dd1" size="80"></td>
		</tr>
		
		<tr>
			<td>ou seu CPF<br>
				<input type="text" class="lt4" name="dd2" id="dd2" size="15"></td>
		</tr>		
		<tr>
			<td><input type="submit" value="busca" class="lt4" name="acao" id="acao" size="15"></td>
		</tr>	
	</table>
	</center>
</form>
<script>
	$("#dd2").mask('999.999.999-99');
</script>