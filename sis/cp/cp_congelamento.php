<?
$tabela = "contrato_congelamento";
$cp = array();

array_push($cp,array('$H4','id_cdc','id_cdc',False,True,''));
array_push($cp,array('$S12','cdc_contrato','Contrato',True,False,''));

array_push($cp,array('$A8','','DADOS DO CONGELAMENTO',False,True,''));
array_push($cp,array('$D8','cdc_data','Data',True,True,''));
array_push($cp,array('$S5','cdc_hora_i','Horário: início ',True,True,''));
array_push($cp,array('$S5','cdc_hora_f','Horário: término ',True,True,''));

array_push($cp,array('$S15','cdc_congelamento_automatico','Congelado através do congelador automático: ',True,True,''));
array_push($cp,array('$O 1:1&2:2&3:3&4:4&5:5&6:6&7:7&8:8','cdc_programa','Programa ',True,True,''));

array_push($cp,array('$A8','','Outras informações',False,True,''));
array_push($cp,array('$T60:4','cdc_obs','Observações',False,True,''));
array_push($cp,array('$Q us_nome:us_login:select * from usuario where us_ativo=1 order by us_nome','cdc_responsavel','Responsável',True,True,''));

if (strlen($dd[6])==0)
	{ $dd[6] = 'NICOOL PLUS'; }
/// Gerado pelo sistem "base.php" versao 1.0.2
?>