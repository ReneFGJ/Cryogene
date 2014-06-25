<?
$tabela = "proposta_contrato";
$cp = array();
array_push($cp,array('$H4','id_ppc','id_ppc',False,True,''));
array_push($cp,array('$H8','ppc_data','Data',False,True,''));
array_push($cp,array('$H5','ppc_hora','Hora',False,True,''));
array_push($cp,array('$H5','ppc_status','status',False,True,''));
array_push($cp,array('$H5','ppc_modelo','Nr.',False,True,''));
array_push($cp,array('$S100','ppc_nome','Nome para contato',True,True,''));
array_push($cp,array('$S20','ppc_cidade','Cidade',False,True,''));
array_push($cp,array('$UF','ppc_uf','Estado',False,True,''));
array_push($cp,array('$S100','ppc_email_1','e-mail (pai)',False,True,''));
array_push($cp,array('$S100','ppc_email_2','e-mail (mãe)',False,True,''));
array_push($cp,array('$S100','ppc_email_3','e-mail (alternativo)',False,True,''));
array_push($cp,array('$S100','ppc_email_4','e-mail (alternativo 2)',False,True,''));
array_push($cp,array('$S20','ppc_fone_1','Fone (res.)',False,True,''));
array_push($cp,array('$S20','ppc_fone_2','Fone (com.)',False,True,''));
array_push($cp,array('$S20','ppc_fone_3','Fone (cel.)',False,True,''));
array_push($cp,array('$S20','ppc_fone_4','Fone (outros)',False,True,''));

array_push($cp,array('$S50','ppc_hospital','Hospital',False,True,''));
array_push($cp,array('$S50','ppc_obstetra','Obstetra',False,True,''));
array_push($cp,array('$D8','ppc_previsao_nasc','Prev. Nascimento',False,True,''));

array_push($cp,array('$H8','ppc_codigo','Codigo',False,True,''));


array_push($cp,array('$T60:6','ppc_obs','Observações',False,True,''));

if (strlen($dd[1]) == 0) { $dd[1] = date("Ymd"); }
if (strlen($dd[2]) == 0) { $dd[2] = date("H:i"); }
if (strlen($dd[3]) == 0) { $dd[3] = 'A'; }
if (strlen($dd[7]) == 0) { $dd[7] = 'PR'; }
/// Gerado pelo sistem "base.php" versao 1.0.2
?>