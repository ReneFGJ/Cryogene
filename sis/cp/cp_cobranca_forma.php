<?
$tabela = "cobranca_forma";
$cp = array();
array_push($cp,array('$H8','id_fc','id_fc',False,True,''));
array_push($cp,array('$S30','fc_nome','Descricao',True,True,''));
array_push($cp,array('$S2','fc_codigo','fc_codigo',False,False,''));
array_push($cp,array('$I2','fc_parcela','n� parcela(s)',True,True,''));
array_push($cp,array('$O 1:Sim&0:N�o','fc_ativo','Ativo',True,True,''));
array_push($cp,array('$O 1:Boleto bancario&2:Cart�o de Cr�dito&3:Caretira&4:Cheque','fc_tipo','Tipo',True,True,''));
array_push($cp,array('$[1-99]','fc_ordem','Ordem de visualiza��o',True,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.5
?>