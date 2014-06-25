<?
$abo = '';
for ($r=1;$r < 42;$r++) { $abo = $abo . '&'.$r.':'.$r; }
$abo .= '&99:Não informado';
$tabela = "coleta";
$cp = array();

array_push($cp,array('$H8','id_col','cool',True,False,''));
if (strlen(trim($dd[0])) == 0) {
	array_push($cp,array('$H12','col_contrato','col_contrato',True,True,'')); } else {
	array_push($cp,array('$H12','col_contrato','col_contrato',False,True,'')); }

array_push($cp,array('$A8','','Dados do Contrato '.$dd[1],False,True,''));
	
array_push($cp,array('$Q cl_nome:cl_codigo:select * from cliente where cl_sexo='.chr(39).'F'.chr(39).' order by cl_nome','col_mae','col_mae',False,True,''));
array_push($cp,array('$Q cl_nome:cl_codigo:select * from cliente where cl_sexo='.chr(39).'M'.chr(39).' order by cl_nome','col_pai','col_pai',False,True,''));
array_push($cp,array('$A8','','Dados da Mãe',False,True,''));
array_push($cp,array('$N5','col_mae_tp_1','Temperatura:',True,True,''));
array_push($cp,array('$O : &O+:O+&O-:O-&A+:A+&A-:A-&B+:B+&B-:B-&AB+:AB+&AB-:AB-','col_mae_sangue','Tipo sanguíneo',False,True,''));
array_push($cp,array('$O : &Normal:normal&Anormal:anormal','col_mae_sangra','Sangramento',False,True,''));
array_push($cp,array('$O : &Não:nao&Sim:sim','col_mae_infecao','Infecção',False,True,''));
array_push($cp,array('$S35','col_mae_infecao_tp','tipo de infecção:',False,True,''));
array_push($cp,array('$A8','','Dados do Pre-Natal',False,True,''));
array_push($cp,array('$I2','col_pn_g','Antecedentes (G)',True,True,''));
array_push($cp,array('$I2','col_pn_p','Antecedentes (P)',True,True,''));
array_push($cp,array('$I2','col_pn_pn','Antecedentes (PN)',True,True,''));
array_push($cp,array('$I2','col_pn_f','Antecedentes (F)',True,True,''));
array_push($cp,array('$I2','col_pn_c','Antecedentes (C)',True,True,''));
array_push($cp,array('$I2','col_pn_a','Antecedentes (A)',True,True,''));
array_push($cp,array('$O 0:NÃO'.$abo,'col_pn_aborto','Se teve aborto, de quantas semanas:',False,True,''));
array_push($cp,array('$S50','col_pn_ig','Intercorrências nas outras gestações',False,True,''));
array_push($cp,array('$S50','col_pn_ga','GESTAÇÃO ATUAL: Intercorrências',False,True,''));
array_push($cp,array('$S50','col_pn_medicamento','Medicamentos que fez uso',False,True,''));
//array_push($cp,array('$S50','col_pn_gi','GESTAÇÃO ATUAL: Intercorrências',False,True,''));
array_push($cp,array('$O 0:NÃO&1:SIM','col_pn_infecacao','Processos infecciosos ',False,True,''));
array_push($cp,array('$S35','col_pn_infecacao_tp','Tipo de infecção:',False,True,''));

array_push($cp,array('$A8','','Dados do Parto',False,True,''));
array_push($cp,array('$O Cesárea:Cesárea&Normal:Normal','col_dp_tipo','Tipo:',False,True,''));
array_push($cp,array('$D8','col_dp_data','Data',False,True,''));
array_push($cp,array('$S5','col_dp_hora','Horário (HH:MM)',False,True,''));
array_push($cp,array('$O 0:NÃO&1:SIM','col_dp_br','Bolsa rota',False,True,''));
array_push($cp,array('$S25','col_dp_br_horas','Bolsa rota (HH:MM)',False,True,''));
array_push($cp,array('$O : &sem anormalidade:sem anormalidade&com anormalidade:com anormalidade&precoce:[precoce]','col_dp_tp','Trabalho de parto',False,True,''));
array_push($cp,array('$S60','col_dp_tp_obs','Descrever anormalidade',False,True,''));
array_push($cp,array('$Q lc_local:lc_codigo:select * from local_coleta order by lc_local','col_dp_local','Local de coleta',False,True,''));
array_push($cp,array('$S7','col_dp_med','Obstetra (CRM)',False,True,''));
//// Medico
$link = '<A HREF="#med" onclick="newxy2('.chr(39).'sel_medico.php'.chr(39).',600,300);">';
array_push($cp,array('$S60','col_dp_med_nome',$link.'Nome do Obstetra',False,True,''));

array_push($cp,array('$A8','','Dados do Parto',False,True,''));
array_push($cp,array('$S100','col_rn_nome','Nome do RN',False,True,''));
array_push($cp,array('$O 0:0'.$abo,'col_rn_ig','Idade gestacional (semanas)',True,True,''));
array_push($cp,array('$O 0:0&1:1&2:2&3:3&4:4&5:5&6:6','col_rn_ig_dia','Idade gestacional (dias)',True,True,''));
array_push($cp,array('$N8','col_rn_peso','Peso (g)',True,True,''));
array_push($cp,array('$O : &M:Masculino&F:Feminino','col_rn_sexo','Sexo',False,True,''));
array_push($cp,array('$O 0:NÃO&1:SIM','col_rn_sf','Sofrimento fetal',False,True,''));

array_push($cp,array('$A8','','Dados da Coleta',False,True,''));
array_push($cp,array('$O 0:NÃO&1:SIM','col_dc_sangue','Sangue Cordão',False,True,''));
array_push($cp,array('$O 0:NÃO&1:SIM','col_dc_placenta','Sangue Placenta',False,True,''));
array_push($cp,array('$S30','col_dc_au','Anticoagulante utilizado',False,True,''));
array_push($cp,array('$T50:3','col_dc_obs','Observações',False,True,''));

array_push($cp,array('$A8','','Dados do Transporte',False,True,''));
array_push($cp,array('$N5','col_dt_tp_1','Temperatura mínima: Início (ºC)',True,True,''));
array_push($cp,array('$N5','col_dt_tp_2','Término',True,True,''));
array_push($cp,array('$N5','col_dt_tp_3','Temperatura máxima: Início (ºC)',True,True,''));
array_push($cp,array('$N5','col_dt_tp_4','Término',True,True,''));
array_push($cp,array('$O 0:-&1:1&2:2&3:3&4:4&5:5&6:6&7:7&8:8&9:9','col_dt_nat','Número de amostra materna transportada',False,True,''));
array_push($cp,array('$O 0:-&1:1&2:2&3:3&4:4&5:5&6:6&7:7&8:8&9:9','col_dt_nu','Número de unidades de SCUP transportadas',False,True,''));

array_push($cp,array('$A8','','Responsável pela coleta',False,True,''));
array_push($cp,array('$S7','col_rc_med','Médico (CRM)',False,True,''));
array_push($cp,array('$S60','col_rc_med_nome','Nome do Médico',False,True,''));
array_push($cp,array('$S7','col_rc_enf','Enfermeira (COREN)',False,True,''));
array_push($cp,array('$S60','col_rc_enf_nome','Nome da Enfermeira',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.4
?>