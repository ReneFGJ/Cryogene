<?
$tabela = "iso_documento";
$cp = array();
array_push($cp,array('$H8','id_iso_doc','id_md',False,True,''));
array_push($cp,array('$H7','iso_doc_codigo','Cod.Interno',False,True,''));
array_push($cp,array('$S20','iso_doc_nrdoc','Cуdigo do documento',False,True,''));
array_push($cp,array('$S150','iso_doc_descricao','Tнtulo',True,True,''));
array_push($cp,array('$T70:5','iso_doc_content','Nome do processo',False,True,''));
array_push($cp,array('$S150','iso_doc_versao','Revisгo do documento',False,True,''));
array_push($cp,array('$Q iso_tdoc_descricao:iso_tdoc_cod:select * from iso_tipo_documento where iso_tdoc_ativo = 1','iso_doc_tipo','Hierarquia',True,True,''));
array_push($cp,array('$O 1:1&2:2&3:3','iso_doc_ordem','Ordem de visualizaзгo',True,True,''));
array_push($cp,array('$O 1:SIM&2:NГO','iso_doc_ativo','Ativo',True,True,''));
array_push($cp,array('$U8','iso_doc_lastupdate','Update',True,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.5
?>