<?
$tabela = "contrato_processamento";
$cp = array();
$bl = ' : ';
$bl .= '&500ml:500ml';
$bl .= '&250ml:250ml';
$bl .= '&25ml:25ml';
array_push($cp,array('$H4','id_cpp','id_cpp',False,True,''));
array_push($cp,array('$S12','cpp_contrato','Contrato',True,True,''));
array_push($cp,array('$O '.$bl,'cpp_bolsa','Tipo da bolsa',True,True,''));

array_push($cp,array('$A8','','DADOS DA REDUÇÃO DE VOLUME',False,True,''));
array_push($cp,array('$D8','cpp_data','Data',True,True,''));
array_push($cp,array('$S5','cpp_hora_i','Horário: início ',True,True,''));
array_push($cp,array('$S5','cpp_hora_f','Horário: término ',True,True,''));

array_push($cp,array('$A8','','Volume a ser processado',False,True,''));
array_push($cp,array('$N8','cpp_vs_pb_g','Peso bruto (g)',True,True,''));
array_push($cp,array('$N8','cpp_vs_pl_g','Peso liquido da bolsa (g)',True,True,''));
array_push($cp,array('$N8','cpp_vs_cl_scup','Volume de SCUP',True,True,''));

array_push($cp,array('$A8','','Volume a ser processador',False,True,''));
array_push($cp,array('$N8','cpp_vp_anti','Anticoagulante (ml)',True,True,''));
array_push($cp,array('$N8','cpp_vp_vl_proc','Volume processado (ml)',True,True,''));

array_push($cp,array('$A8','','Pré-processamento',False,True,''));
array_push($cp,array('$N8','cpp_vp_vl_expansor','Vol. expansor plasmático',True,True,''));
array_push($cp,array('$I8','cpp_vp_leucocitos','Nº leucócitos',True,True,''));
array_push($cp,array('$N8','cpp_vp_celulidade_ini','Celularidade inicial (x10<sup>8</sup>)',True,True,''));

array_push($cp,array('$A8','','1. Centrifugação (WBC+Plasma)',False,True,''));
array_push($cp,array('$N8','cpp_c1_scup','Volume WBC+Plasma',True,True,''));
array_push($cp,array('$I8','cpp_c1_leucocitos','Nº leucócitos',True,True,''));
array_push($cp,array('$N8','cpp_c1_celulidade_fim','Celularidade final (x10<sup>8</sup>)',True,True,''));

array_push($cp,array('$A8','','1. Centrifugação Hc (resíduo)',False,True,''));
array_push($cp,array('$N8','cpp_c2_scup','Volume Hc',True,True,''));
array_push($cp,array('$I8','cpp_c2_leucocitos','Nº leucócitos',True,True,''));
array_push($cp,array('$N8','cpp_c2_celulidade_fim','Celularidade final (x10<sup>8</sup>)',True,True,''));

array_push($cp,array('$A8','','Pós-processamento',False,True,''));
array_push($cp,array('$N8','cpp_vpos_scup','Volume SCUP final',True,True,''));
array_push($cp,array('$I8','cpp_vpos_leucocitos','Nº leucócitos',True,True,''));
array_push($cp,array('$N8','cpp_vpos_celulidade_fim','Celularidade final (x10<sup>8</sup>)',True,True,''));
array_push($cp,array('$N8','cpp_vpos_rendimento','Rendimento (%)',True,True,''));

array_push($cp,array('$A8','','Outras informações',False,True,''));
array_push($cp,array('$T60:4','cpp_obs','Observações',False,True,''));
array_push($cp,array('$Q us_nome:us_login:select * from usuario where us_ativo=1 order by us_nome','cpp_responsavel','Responsável',True,True,''));


array_push($cp,array('$A8','','Dados do processamento',False,True,''));
array_push($cp,array('$D8','cpp_dp_data','Data',True,True,''));
array_push($cp,array('$S5','cpp_dp_hora_ini','Horário: início ',True,True,''));
array_push($cp,array('$S5','cpp_dp_hora_fim','Horário: término ',True,True,''));
array_push($cp,array('$N8','cpp_vl_congelado','Volume de congelamento (ml)',True,True,''));

array_push($cp,array('$N8','cpp_vl_sol_dmso','DMSO',True,True,''));
array_push($cp,array('$N8','cpp_vl_sol_dextran','Dextran',True,True,''));
array_push($cp,array('$HV','cpp_vl_sol_hepa','0',False,True,''));

array_push($cp,array('$HV','cpp_vl_amostra_final','0',False,True,''));

array_push($cp,array('$N8','cpp_vl_controles','Controles (ml)',True,True,''));

array_push($cp,array('$HV','cpp_vl_final','0',False,True,''));
array_push($cp,array('$T60:4','cpp_vl_obs','Observações',False,True,''));
array_push($cp,array('$Q us_nome:us_login:select * from usuario where us_ativo=1 order by us_nome','cpp_vl_resposnsavel','Responsável',True,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.2
if (strlen($dd[9])==0) { $dd[9] = '84.04'; }

if ($dd[2] == '250ml')
	{
	$dd[41] = '1.00';
	} else {
	$dd[41] = '0.00';
	}
//if (strlen($dd[34]) == 0)
	{
	$soma = $dd[38]+$dd[39]+$dd[40]+$dd[41];
	$soma = number_format($soma,2);
	$dd[48] = $soma;
	}
	
//if (strlen($dd[36]) == 0)
	{
	$soma = $dd[42]-$dd[43];
	$soma = number_format($soma,2);
	$dd[44] = $soma;
	}	
?>