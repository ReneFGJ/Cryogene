<?
$tabela = "contrato";

if (($user_nivel) >=9) { $opad = "&D:Deletar"; }
$cp = array();
array_push($cp,array('$H8','id_ctr','codigo',False,True,''));
array_push($cp,array('$S12','ctr_numero','Numero contrato',False,False,''));
array_push($cp,array('$O : &S:Sim&N:Não&Z:Conferir'.$opad,'ctr_status','Ativo',False,True,''));
array_push($cp,array('$Q cl_nome:cl_codigo:select * from cliente where cl_sexo='.chr(39).'F'.chr(39).' order by cl_nome','ctr_mae','Nome da mãe',False,True,''));
array_push($cp,array('$Q cl_nome:cl_codigo:select * from cliente where cl_sexo='.chr(39).'M'.chr(39).' order by cl_nome','ctr_pai','Nome do pai',False,True,''));
array_push($cp,array('$Q cl_nome:cl_codigo:select * from cliente order by cl_nome','ctr_responsavel','Cobrança para',False,True,''));
array_push($cp,array('$HV','ctr_responsavel_nome','',False,True,''));
array_push($cp,array('$H8','ctr_cobranca','ctr_cobranca',False,True,''));
array_push($cp,array('$I2','ctr_vencimento_dia','Mes vencimento',True,True,''));
array_push($cp,array('$N8','ctr_anuidade','Valor anuidade contratual',True,True,''));
array_push($cp,array('$N8','ctr_vlr_contrato','Valor contratual',True,True,''));
array_push($cp,array('$N8','ctr_anuidade_atual','Valor anuidade atual',True,True,''));
array_push($cp,array('$D8','ctr_dt_assinatura','Data assinatura',False,True,''));
array_push($cp,array('$D8','ctr_data_coleta','Data de coleta',True,True,''));
array_push($cp,array('$D8','ctr_data_inicio_cobranca','Início da cobrança armaz.',True,True,''));
array_push($cp,array('$D8','ctr_dt_renuncia','Data renuncia',False,True,''));
array_push($cp,array('$Q ser_nome:ser_codigo:select * from servicos where ser_tp = 0','ctr_tipo_1','Tipo serviço',False,True,''));
array_push($cp,array('$Q ser_nome:ser_codigo:select * from servicos where ser_tp = 0','ctr_tipo_2','Tipo serviço',False,True,''));
array_push($cp,array('$Q ser_nome:ser_codigo:select * from servicos where ser_tp = 0','ctr_tipo_3','Tipo serviço',False,True,''));
array_push($cp,array('$Q ser_nome:ser_codigo:select * from servicos where ser_tp = 1','ctr_tipo_4','Promoção',False,True,''));
array_push($cp,array('$Q fc_nome:fc_codigo:select * from cobranca_forma order by fc_ordem','ctr_cobranca_tipo','Tipo cobrança Anuidade',False,True,''));
array_push($cp,array('$T50:7','ctr_obs','Observação',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.4
?>