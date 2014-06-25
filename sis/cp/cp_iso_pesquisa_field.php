<?
$tabela = "iso_pesquisa_field";
$cp = array();

array_push($cp,array('$H4','id_pfl','id_pfl',False,True,''));
array_push($cp,array('$H8','pfl_codigo','Contrato',False,False,''));
array_push($cp,array('$O 0000001:Pesquisa de satisfaзгo','pfl_tipo','Tipo',True,False,''));

array_push($cp,array('$S90','pfl_descricao','Descriзгo',True,True,''));
array_push($cp,array('$T50:4','pfl_field','Campo ',True,True,''));
array_push($cp,array('$T50:4','pfl_content','Descritivo ',False,True,''));
array_push($cp,array('$T50:4','pfl_info','Informativo (i) ',False,True,''));

array_push($cp,array('$[1-30]','pfl_ordem','Ordem de visualizaзгo ',True,True,''));
array_push($cp,array('$O 1:SIM&2:NГO','pfl_obrigatorio','Obrigatуrio ',True,True,''));
array_push($cp,array('$O 1:SIM&2:NГO','pfl_ativo','Ativo ',True,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>