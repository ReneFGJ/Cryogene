<?
$tabela = "mailing_cryo";
$cp = array();
array_push($cp,array('$H8','id_ml','id_mail',False,True,''));
array_push($cp,array('$S60','ml_nome','Nome da lista',False,True,''));
array_push($cp,array('$S100','ml_email','e-mail',True,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','ml_ativo','Ativo',True,True,''));
array_push($cp,array('$H8','ml_codigo','N� enviado',False,True,''));
array_push($cp,array('$O 00001:Mailing&00002:Cliente&00003:M�dicos','ml_tipo','Tipo',True,True,''));

?>