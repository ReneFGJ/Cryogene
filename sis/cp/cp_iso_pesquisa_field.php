<?
$tabela = "iso_pesquisa_field";
$cp = array();

array_push($cp,array('$H4','id_pfl','id_pfl',False,True,''));
array_push($cp,array('$H8','pfl_codigo','Contrato',False,False,''));
array_push($cp,array('$O 0000001:Pesquisa de satisfa��o','pfl_tipo','Tipo',True,False,''));

array_push($cp,array('$S90','pfl_descricao','Descri��o',True,True,''));
array_push($cp,array('$T50:4','pfl_field','Campo ',True,True,''));
array_push($cp,array('$T50:4','pfl_content','Descritivo ',False,True,''));
array_push($cp,array('$T50:4','pfl_info','Informativo (i) ',False,True,''));

array_push($cp,array('$[1-30]','pfl_ordem','Ordem de visualiza��o ',True,True,''));
array_push($cp,array('$O 1:SIM&2:N�O','pfl_obrigatorio','Obrigat�rio ',True,True,''));
array_push($cp,array('$O 1:SIM&2:N�O','pfl_ativo','Ativo ',True,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>