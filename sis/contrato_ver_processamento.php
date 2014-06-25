<?
require($include.'sisdoc_windows.php');
$sql = "select * from coleta where col_contrato = '".$contrato."'";
$rlt = db_query($sql);
if (!($line = db_read($rlt)))
	{
		echo '<font color=red>Não localizado coleta</font>';
		$ed = '<A HREF="contrato_coleta.php?dd1='.$contrato.'">';
		echo '<P>';
		echo $ed.'CADASTAR COLETA</A>';
	} else {
		$id = $line['id_col'];
		$idc = $line['id_col'];
		$aborto = round("0".$line['col_pn_aborto']);
		$ig = $line['col_pn_ig'];
		$ga = $line['col_pn_ga'];
		$md = $line['col_pn_medicamento'];
		$tp = $line['col_dp_tipo'];
		$dp = $line['col_dp_data'];
		$hp = $line['col_dp_hora'];
		$rn_nome = $line['col_rn_nome'];
		$scup = $line['col_dt_nu'];
		
		$tp1 = $line['col_dt_tp_1'];
		$tp2 = $line['col_dt_tp_2'];
		$tp3 = $line['col_dt_tp_3'];
		$tp4 = $line['col_dt_tp_4'];
		$namt = $line['col_dt_nat'];

		$sofri = $line['col_rn_sf'];
		$sexo = $line['col_rn_sexo'];
		$peso = $line['col_rn_peso'];
		$rn_ig = $line['col_rn_ig'];

		$dbs = $line['col_dc_sangue'];
		$dbp = $line['col_dc_sangue'];
		
		if ($dbs == 0) { $dbs = '&nbsp;'; } else { $dbs = 'X'; }
		if ($dbp == 0) { $dbp = '&nbsp;'; } else { $dbp = 'X'; }
		
		$dba = $line['col_dc_au'];
		$dbo = $line['col_dc_obs'];
		
		if ($sexo == 'f') { $sexo = 'Feminino'; }
		if ($sexo == 'm') { $sexo = 'Masculino'; }
		
		$crm   = $line['col_rc_med'];
		$coren = $line['col_rc_enf'];
		
		$br = $line['col_dp_br'];
		$tpar = $line['col_dp_tp'];
		
		$enfermeira = $line['col_rc_enf_nome'];
		$medico = $line['col_rc_med_nome'];
		
		$sx = '<DIV align="left">';
		$sx = $sx . '<font class=lt2 ><B>'.$line['col_rn_nome'].'</B><BR>&nbsp;<BR>';
		$sx = $sx .  '<font class=lt2 ><U>Dados da Mãe</U></font><BR>';
		$sx = $sx .  '<font class=lt0 ><BR>Temperatura: ';
		$sx = $sx .  '&nbsp;<B>'.$line['col_mae_tp_1'].'</B>';
		$sx = $sx .  '<font class=lt0 ><BR>Tipo sanguíneo: ';
		$sx = $sx .  '&nbsp;<B>'.$line['col_mae_sangue'].'</B>';
		$sx = $sx .  '<font class=lt0 ><BR>Sangramento: ';
		$sx = $sx .  '&nbsp;<B>'.$line['col_mae_sangra'].'</B>';
		$sx = $sx .  '<font class=lt0 ><BR>Infecção: ';
		$sx = $sx .  '&nbsp;<B>'.$line['col_mae_infecao'].'&nbsp;'.$line['col_mae_infecao_tp'].'</B>';
		
		$sx = $sx . '<BR><BR><font class=lt0>';
		
		$sx = $sx .  '<font class=lt2 ><U>Dados do Pré-Natal</U></font><BR>';
		$sx = $sx .  '<font class=lt0 ><BR>Antecedentes: ';
		$sx = $sx .  '&nbsp;G:<B>'.$line['col_pn_g'].'</B>';
		$sx = $sx .  '&nbsp;P:<B>'.$line['col_pn_p'].'</B>';
		$sx = $sx .  '&nbsp;(PN:<B>'.$line['col_pn_pn'].'</B>';
		$sx = $sx .  '&nbsp;F:<B>'.$line['col_pn_f'].'</B>';
		$sx = $sx .  '&nbsp;C:<B>'.$line['col_pn_c'].'</B>';
		$sx = $sx .  '&nbsp;A:<B>'.$line['col_pn_a'].')</B>';
		$sx = $sx .  '</font>';
		
		$sx = $sx . '<BR><font class=lt0>';
		if ($aborto == 0) { $sx = $sx . 'Sem histórico de aborto.'; } else
			{ $sx = $sx . 'Registro de aborto de <B>'.$aborto.'</B> semanas.'; }
		$sx = $sx . '<BR>Intercorrências nas outras gestações : <B>'.$ig."</B>";
		$sx = $sx . '<BR>Gestação atual Intercorrências : <B>'.$ga."</B>";
		$sx = $sx . '<BR>Medicamentos que fez uso : <B>'.$md.'</B>';
		
		$sx = $sx .  '<BR>&nbsp;<BR><font class=lt2 ><U>Dados do Parto</U></font><BR>';
		$sx = $sx .  '<font class=lt0 ><BR>Tipo : <B>'.StrtoUpper($tp).'</B>';
		$sx = $sx .  '<BR>Data parto : <B>'.stodbr($dp).' '.$hp.'</B>';
		$sx = $sx .  '<BR>Bolsa rota : '.$br;
		$sx = $sx .  '<BR>Trabalho de parto : '.$tpar;
		$sx = $sx .  '<BR>Local de coleta : '.$lc;

		$sx = $sx .  '<BR>&nbsp;<BR><font class=lt2 ><U>Dados do RN</U></font><BR>';
		$sx = $sx .  '<font class=lt0 ><BR>Nome do RN : '.$rn_nome;
		$sx = $sx .  '<BR>Idade gestacional : '.$rn_ig.' semanas';
		$sx = $sx .  '<BR>Peso : <B>'.$peso.' g</B>';
		$sx = $sx .  '<BR>Sexo : <B>'.$sexo.'</B>';
		$sx = $sx .  '<BR>Sofrimento : '.$sofri;

		$sx = $sx .  '<BR>&nbsp;<BR><font class=lt2 ><U>Dados da coleta</U></font><BR>';
		$sx = $sx .  '<font class=lt0 ><BR>Sangue : [ '.$dbs.' ] Cordão - [ '.$dbp.' ] Placenta '.$tp;
		$sx = $sx .  '<BR>Anticoagulante utilizado : <B>'.$dba.'</B>';
		$sx = $sx .  '<BR>Observações : <B>'.$dbo.'</B>';

		$sx = $sx .  '<BR>&nbsp;<BR><font class=lt2 ><U>Dados do transporte</U></font><BR>';
		$sx = $sx .  '<font class=lt0 ><BR>Temperatura mínima: Início : <B>'.$tp1;
		$sx = $sx .  '</B>ºC , Término: <B>'.$tp2.'</B>ºC ';
		$sx = $sx .  '<BR>Temperatura máxima: Início : <B>'.$tp3;
		$sx = $sx .  '</B>ºC , Término: <B>'.$tp4.'</B>ºC ';
		$sx = $sx .  '<BR>Número de amostra materna transportada : <B>'.$namt.'</B>';
		$sx = $sx .  '<BR>Número de unidades de SCUP transportadas : <B>'.$scup.'</B>';

		$sx = $sx .  '<BR>&nbsp;<BR><font class=lt2 ><U>Responsável pela coleta</U></font><BR>';
		$sx = $sx .  '<font class=lt0 ><BR>Médico : <B>'.$crm.'</B>&nbsp;'.$medico;
		$sx = $sx .  '<BR>Enfermeira : <B>'.$coren.'</B>&nbsp;'.$enfermeira;
		
		$sx = $sx . '</DIV>';
		
		$sxr = '<TABLE width="'.$tab_max.'" align="center" border="1">';
		$sxr = $sxr . '<TR valign="top"><TD width="49%">'.$sx.'</TD>';
		$sxr = $sxr . '<TD>';
			require("contrato_checklist.php");
			require("contrato_financeiro.php");

		$sxr = $sxr . $ss;
		$szr = $sxr . '</TD></TR>';
		$sxr = $sxr . '</TABLE>';
		
		echo $sxr;
		echo '<form method="post" action="contrato_coleta.php">';
		echo '<input type="hidden" name="dd0" value="'.$idc.'">';
		echo '<input type="submit" name="botao" value="alterar dados da coleta">';
		echo '</form>';
	}
?>