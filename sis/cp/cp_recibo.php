<?
$tabela = "recibo";
$cp = array();
array_push($cp,array('$H8','id_rb','id_rb',False,True,''));
array_push($cp,array('$U','rb_data',date("Ymd"),False,True,''));
array_push($cp,array('$S100','rb_nome','Emissão para',False,True,''));
array_push($cp,array('$O P:Pagamento&R:Recebimento','rb_tipo','Tipo',False,True,''));
array_push($cp,array('$N8','rb_valor','Valor',False,True,''));

array_push($cp,array('$HV','rb_hora',date("H:i"),False,True,''));
array_push($cp,array('$S9','rb_contrato','Nº doc/contrato',False,True,''));
array_push($cp,array('$T60:5','rb_descricao','Valor',False,True,''));
array_push($cp,array('$H8','rb_numero','Numero',False,True,''));
array_push($cp,array('$HV','rb_log',$user_id,False,True,''));
array_push($cp,array('$O A:Normal&X:Cancelado&B:Pago','rb_status','Status',False,True,''));



/// Gerado pelo sistem "base.php" versao 1.0.4
?>