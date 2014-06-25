<?
$tabela = "contrato_check_list";
$cp = array();
array_push($cp,array('$H8','id_ccl','id_md',False,True,''));
array_push($cp,array('$S12','ccl_contrato','Nº Contrato',False,False,''));
array_push($cp,array('$H7','ccl_codigo','ccl_codigo',False,True,''));
array_push($cp,array('$O 1:SIM&2:NÃO','ccl_ativo','Arquivado',False,True,''));
array_push($cp,array('$H0','ccl_uploaded','Aceita upload',False,True,''));
array_push($cp,array('$T40:5','ccl_content','Comentários',False,True,''));
array_push($cp,array('$D8','ccl_data','Data envio/arquivo',False,True,''));
array_push($cp,array('$U8','lastupdate','md_dt_cadastro',False,True,''));
array_push($cp,array('$S12','ccl_site','Link http',False,True,''));
if (strlen(trim($dd[6])) < 5) { $dd[6] = '01/01/1900'; }
$dd[4] = 0;

/// Gerado pelo sistem "base.php" versao 1.0.5
?>