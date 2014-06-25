<?
$tabela = "conta_corrente";
$cp = array();
array_push($cp,array('$H5','id_cc','cc_codigo',False,True,''));
array_push($cp,array('$S50','cc_nome','Descriчуo',True,True,''));
array_push($cp,array('$S50','cc_cedente','Nome cedente',True,True,''));
array_push($cp,array('$H5','cc_codigo','cc_codigo',False,True,''));
array_push($cp,array('$S6','cc_banco','Banco',True,True,''));
array_push($cp,array('$S2','cc_banco_dv','Banco(dv)',False,True,''));
array_push($cp,array('$S6','cc_agencia','Agencia',True,True,''));
array_push($cp,array('$S2','cc_agencia_dv','Agencia (dv)',False,True,''));
array_push($cp,array('$S10','cc_nr_conta','Conta corrente',True,True,''));
array_push($cp,array('$S2','cc_nr_conta_dv','Conta corrente (dv)',False,True,''));
array_push($cp,array('$S15','cc_bol_contrato','Boleto contrato',False,True,''));
array_push($cp,array('$S5','cc_bol_carteira','Boleto Carteira',False,True,''));
array_push($cp,array('$N8','cc_bol_multa_atraso','Boleto Multa atraso (%)',True,True,''));
array_push($cp,array('$N8','cc_bol_correcao_mes','Boleto Correcao/mes (%)',True,True,''));
array_push($cp,array('$O N:N&S:S','cc_bol_aceite','Boleto com aceite',True,True,''));
array_push($cp,array('$S2','cc_bol_esp_doc','Esp doc.',False,True,''));
array_push($cp,array('$S15','cc_bol_convenio','Boleto convenio',False,True,''));
array_push($cp,array('$O 1:1&2:2&3:3&4:4&5:5&6:6','cc_formatacao','Boleto formatacao (uso interno)',False,True,''));
array_push($cp,array('$O R$:R$&US:US','cc_bol_especie','Boleto moeda',False,True,''));
array_push($cp,array('$O 1:SIM&0:NAO','cc_ativo','Ativo',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.4
?>