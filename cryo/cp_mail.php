<?
$tabela = "mail";
$cp = array();
array_push($cp,array('$H8','id_mail','id_mail',False,True,''));
array_push($cp,array('$S30','mail_nome','Nome da lista',True,True,''));
array_push($cp,array('$T60:15','mail_descricao','Descri��o',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','mail_ativo','Ativo',True,True,''));
array_push($cp,array('$S30','mail_table','Tabela',True,True,''));
array_push($cp,array('$H8','mail_codigo','N� enviado',False,True,''));

?>