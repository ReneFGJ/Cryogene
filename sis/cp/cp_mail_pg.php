<?
$tabela = "mail_pg";
$cp = array();
array_push($cp,array('$H8','id_mpg','id_m',False,True,''));
array_push($cp,array('$S60','mpg_descricao','Titulo',True,True,''));
array_push($cp,array('$T60:15','mpg_content','fc_codigo',True,True,''));
array_push($cp,array('$D8','mpg_data','Data',True,True,''));
array_push($cp,array('$Q mail_nome:mail_codigo:select * from mail order by mail_nome','mpg_mailing','Tipo da lista',True,True,''));
array_push($cp,array('$H8','mpg_codigo','Nº enviado',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.5
?>