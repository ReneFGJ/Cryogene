<?php
$temperatura = '-';
$sangue = 'A+';
$sangramento = 'Normal';
$infeccao = 'Não';

$antecedentes = 'G:2 P:0 (PN:0 F:0 C:0 A:0)';
$gestacao = '';
$intecorrencia = '';
$medicamento = 'Clexane 40';

$parto_tipo = 'CESáREA ';
?>
<table border=1 width="100%">
	<tr valign="top">
		<td width="33%">

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados da Mãe</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Temperatura:</td>
		<td class="lt1"><B><?php echo $temperatura; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Tipo sanguíneo:</td>
		<td class="lt1"><B><?php echo $sangue; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Sangramento:</td>
		<td class="lt1"><B><?php echo $sangramento; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Infecção:</td>
		<td class="lt1"><B><?php echo $infeccao; ?></B></td>
	</tr>			
</table>

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados do Pré-Natal</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Antecedentes:</td>
		<td class="lt1"><B><?php echo $antecedentes; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Intercorrências nas outras gestações:</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Gestação atual Intercorrências:</td>
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
		<td align="right">Observações:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>	
</table>

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Dados do transporte</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Temperatura mínima: Início :</td>
		<td class="lt1"><B><?php echo $parto_tipo; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Temperatura máxima: Início :</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Número de amostra materna transportada:</td>
		<td class="lt1"><B><?php echo $gestacao; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Número de unidades de SCUP transportadas:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>			
	<tr class="lt0">
		<td align="right">Observações:</td>
		<td class="lt1"><B><?php echo $medicamento; ?></B></td>
	</tr>	
</table>

<table class="tabela00 lt0" width="100%">
	<tr>
		<td class="lt2" colspan=2><u>Responsável pela coleta</u></td>
	</tr>
	<tr class="lt0">
		<td align="right" width="35%">Médico:</td>
		<td class="lt1"><B><?php echo $parto_tipo; ?></B></td>
	</tr>
	<tr class="lt0">
		<td align="right">Enfermeira:</td>
		<td class="lt1"><B><?php echo $intecorrencia; ?></B></td>
	</tr>
</table>

</td></tr></table>

