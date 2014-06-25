<?
$tabela = "cr_boleto";
$cp = array();
array_push($cp,array('$H8','id_bol','id_bol',False,True,''));
array_push($cp,array('$O  : &A:Aberto&B:Quitado&X:Cancelado&S:Suspenso','bol_status','status',False,True,''));
array_push($cp,array('$S12','bol_fatura','Fatura',False,True,''));

array_push($cp,array('$D8','bol_data_vencimento','Data vencimento',False,True,''));
array_push($cp,array('$D8','bol_data_vencimento_2','Desconto até o vencimento (só anuidade)',False,True,''));
array_push($cp,array('$D8','bol_data_documento','bol_data_documento',False,True,''));
array_push($cp,array('$D8','bol_data_processamento','bol_data_processamento',False,True,''));
array_push($cp,array('$N8','bol_valor_boleto','Valor do boleto',False,True,''));
array_push($cp,array('$N8','bol_tx_boleto','Taxa do boleto',False,True,''));
array_push($cp,array('$T40:10','bol_obs','Obs boleto',False,True,''));
array_push($cp,array('$H1','bol_aceite','bol_aceite',False,True,''));
array_push($cp,array('$H3','bol_especie','bol_especie',False,True,''));
array_push($cp,array('$H5','bol_especie_doc','bol_especie_doc',False,True,''));
array_push($cp,array('$H15','bol_nosso_numero','bol_nosso_numero',False,True,''));
array_push($cp,array('$S14','bol_numero_documento','bol_numero_documento',False,True,''));
array_push($cp,array('$H16','bol_cpf_cnpj','bol_cpf_cnpj',False,True,''));
array_push($cp,array('$H80','bol_endereco','bol_endereco',False,True,''));
array_push($cp,array('$H20','bol_cidade','bol_cidade',False,True,''));
array_push($cp,array('$H40','bol_sacado','bol_sacado',False,True,''));
array_push($cp,array('$H60','bol_endereco1','bol_endereco1',False,True,''));
array_push($cp,array('$H60','bol_endereco2','bol_endereco2',False,True,''));
array_push($cp,array('$Q cc_nome:cc_codigo:select * from conta_corrente where cc_ativo=1 order by cc_nome','bol_conta','bol_conta',False,True,''));

if (strlen($dd[1]) == 0) { $dd[1]="A"; }
if (strlen($dd[3]) == 0) { $dd[3]="01/01/1900"; }

/// Gerado pelo sistem "base.php" versao 1.0.4
?>