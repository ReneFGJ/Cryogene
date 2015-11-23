<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<center>
	<form method="post" action="<?php echo base_url('index.php/'); ?>">
		<table width="600" align="center" class="tabela01" style="padding: 20px;">
			<tr>
				<td class="lt5" colspan="4" style="border: 1px solid #33333;">Atendimento ao Cliente Cryogene</td>
			</tr>
			<tr>
				<td> Informe o CPF do responsável do contrato
				<br>
				<input type="text" id="dd1" name="dd1" size="15" placeholder="CPF" class="lt4">
				</td>
			</tr>

			<tr>
				<td> Data de nascimento do Bebê
				<br>
				<input type="text" id="dd2" name="dd2" size="15" placeholder="Nascimento" class="lt4">
				</td>

				<td rowspan=4><img src="<?php echo base_url('img/icone/cliente_area.png'); ?>" border=1 width="200"></td>
			</tr>

			<tr>
				<td>
				<input type="submit" id="acao" name="acao" size="15" value='acessar >>' class="lt4">
				</td>
			</tr>
		</table>
	</form>
	<script>
		$("#dd1").mask("999.999.999-99");
		$("#dd2").mask("99/99/9999");
	</script>
<div style="float: right; bottom: 0px; padding: 10px;">
<a href="<?php echo base_url('index.php/main/login');?>" class="link lt1">tt</a>
</div> 