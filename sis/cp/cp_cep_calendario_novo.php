<?
//$sql = "ALTER TABLE cep_calendario
//   ADD COLUMN cal_obs text;
//";
//$rlt = db_query($sql);
$tabela = "cep_calendario";
$cp = array();
$opx="";
array_push($cp,array('$H4','id_cal','id_s',False,True,''));
array_push($cp,array('$D8','cal_data','Data',False,True,''));
array_push($cp,array('$S5','cal_hora','hora (HH:MM)',False,True,''));
array_push($cp,array('$S58','cal_descricao','Descriчуo',True,True,''));
array_push($cp,array('$O A:Ativo&X:Cancelado','cal_status','status',False,True,''));
array_push($cp,array('$H58','cal_log','log',False,True,''));
array_push($cp,array('$Q ct_descricao:ct_ev:select * from cep_calendario_tipo where ct_ativo=1 order by ct_descricao','cal_ev','Tipo evento',False,True,''));
array_push($cp,array('$T40:5','cal_obs','Obs:',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.2
?>