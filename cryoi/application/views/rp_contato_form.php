<?php
$chk = array('A'=>'','B'=>'','C'=>'');
$dd4=get("dd4");
if (strlen($dd4) > 0)
	{
		$chk[$dd4] = ' selected ';
	}
?>
<table width="100%" class="lt2 tabela01">
	<tr>
		<th class="lt2">Relacionamento</th>
	</tr>
	<tr>
		<td><form method="post"></td>
	</tr>
	<tr>
		<td>Nome do contato</td>
	</tr>
	<tr>
		<td>
		<input type="text" name="dd2" value="<?php echo get("dd2"); ?>" maxlength="100" style="width: 100%" class="lt2">
		</td>
	</tr>

	<tr>
		<td>Histórico do contato</td>
	</tr>
	<tr>
		<td>		<textarea name="dd1" style="width: 100%; height: 200px; font-size: 14px;"><?php echo get("dd1"); ?></textarea></td>
	</tr>
	<tr>
		<td>
		<select name="dd4">
			<option value="">:: Tipo da comuncação ::</option>
			<option value="A" <?php echo $chk['A'];?> >Informativo (somente registro)</option>
			<option value="B" <?php echo $chk['B'];?> >Informativo (cópia para os contratados)</option>
			<option value="C" <?php echo $chk['C'];?> >Retornar aos contratados</option>
		</select></td>
	</tr>
	<tr>
		<td>
		<input type="hidden" name="dd3" value="7">
		<input type="hidden" name="dd5" value="<?php echo $ctr_numero;?>">
		<input type="submit" name="acao" value="Gravar >>>">
		</form></td>
	</tr>
</table>