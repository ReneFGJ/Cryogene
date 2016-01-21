<table width="100%" class="tabela00">
<tr><td width="20%"></td><td width="80%"></td></tr>
<tr>
	<td align="right">Contrato número</td>
	<td class="lt3"><B><?php echo $ctr_numero;?></B></td>
</tr>

<!--- Filiação --->
<tr>
	<td class="lt2" align="right"><B>Sobre os pais</B></td>
	<td><hr size="1"></td>
</tr>

<tr>
	<td align="right">Nome do pai</td>
	<td class="lt2"><?php echo $pai_nome;?></td>
</tr>
<tr>
	<td align="right">Nome mãe</td>
	<td class="lt2"><?php echo $mae_nome;?></td>
</tr>



<!--- Situação --->
<tr>
	<td class="lt2" align="right"><B>Dados do contrato</B></td>
	<td><hr size="1"></td>
</tr>

<tr>
	<td align="right">Data do nascimento do bebê</td>
	<td class="lt1"><?php echo stodbr($ctr_parto_data);?></td>
</tr>
<tr>
	<td align="right">Situação</td>
	<td class="lt2"><font color="green"><B>Ativo</B></font></td>
</tr>

<!--- Situação --->
<tr>
	<td class="lt2" align="right"><B>Valores financieros</B></td>
	<td><hr size="1"></td>
</tr>
<tr>
	<td align="right">Valor armazenamento<BR>(atual)</td>
	<td class="lt2"><b>R$ <?php echo number_format($ctr_anuidade_atual,2,',','.');?></b></td>
</tr>
</table>