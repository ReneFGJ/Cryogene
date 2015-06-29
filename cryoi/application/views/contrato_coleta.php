<?php
$temperatura = '-';
$sangue = 'A+';
$sangramento = 'Normal';
$infeccao = 'N�o';

$antecedentes = 'G:2 P:0 (PN:0 F:0 C:0 A:0)';
$gestacao = '';
$intecorrencia = '';
$medicamento = 'Clexane 40';

$parto_tipo = 'CES�REA ';
?>
<table border=1 width="100%">
	<tr valign="top">
		<td width="33%">

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados da M�e</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Temperatura:</td>
		<td class="lt1"><B><?php echo $temperatura; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Tipo sangu�neo:</td>
		<td class="lt1"><B><?php echo $sangue; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Sangramento:</td>
		<td class="lt1"><B><?php echo $sangramento; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Infec��o:</td>
		<td class="lt1"><B><?php echo $infeccao; ?></B></td>
	</tr>			
</table>

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados do Pr�-Natal</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Antecedentes:</td>
		<td class="lt1"><B><?php echo $antecedentes; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Intercorr�ncias nas outras gesta��es:</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Gesta��o atual Intercorr�ncias:</td>
		<td class="lt1"><B><?php echo $gestacao; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Medicamentos que fez uso:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
</table>
</td><td width="33%">
<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados do Parto</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Tipo:</td>
		<td class="lt1"><B><?php echo $parto_tipo; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Data parto:</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Bolsa rota:</td>
		<td class="lt1"><B><?php echo $gestacao; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Trabalho de parto:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
	<tr class="lt0">
		<td align="right">Trabalho de parto:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>	
	<tr class="lt0">
		<td align="right">Local de coleta:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
</table>

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados do RN</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Nome do RN:</td>
		<td class="lt1"><B><?php echo $parto_tipo; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right"Idade gestacional:</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Bolsa rota:</td>
		<td class="lt1"><B><?php echo $gestacao; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Peso:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
	<tr class="lt0">
		<td align="right">Genero:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>	
	<tr class="lt0">
		<td align="right">Sofrimento:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
</table>
</td><td width="33%">
<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados da coleta</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Nome do RN:</td>
		<td class="lt1"><B><?php echo $parto_tipo; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Idade gestacional:</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Sangue:</td>
		<td class="lt1"><B><?php echo $gestacao; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Anticoagulante utilizado:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
	<tr class="lt0">
		<td align="right">Observa��es:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>	
</table>

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados do transporte</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Temperatura m�nima: In�cio :</td>
		<td class="lt1"><B><?php echo $parto_tipo; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Temperatura m�xima: In�cio :</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">N�mero de amostra materna transportada:</td>
		<td class="lt1"><B><?php echo $gestacao; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">N�mero de unidades de SCUP transportadas:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
	<tr class="lt0">
		<td align="right">Observa��es:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>	
</table>

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Respons�vel pela coleta</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">M�dico:</td>
		<td class="lt1"><B><?php echo $parto_tipo; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Enfermeira:</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
</table>

</td></tr></table>

