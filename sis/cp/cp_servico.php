<?
$tabela = "servicos";
$cp = array();
array_push($cp,array('$H8','id_ser','Nome do servi�o',False,True,''));
array_push($cp,array('$S4','ser_codigo','C�digo (interno)',True,True,''));
array_push($cp,array('$S120','ser_nome','ser_nome',True,True,''));
array_push($cp,array('$T70:7','ser_descricao','Descricao',False,True,''));
array_push($cp,array('$N8','ser_valor','Valor do servi�o',True,True,''));
array_push($cp,array('$U8','set_update','set_update',False,True,''));
array_push($cp,array('$O 0:Servi�o prestado&1:Desconto promocional','ser_tp','tipo',True,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.4
?>