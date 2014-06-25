<?
$tabela = "ic_noticia";
$cp = array();
array_push($cp,array('$H4','id_nw','id_nw',False,True,''));
array_push($cp,array('$S120','nw_titulo','tнtulo',False,True,''));
array_push($cp,array('$U8','nw_dt_cadastro','nw_dt_cadastro',False,True,''));
array_push($cp,array('$Q s_titulo:id_s:select * from ic_secao where s_ativo>=1','nw_secao','seзгo',False,True,''));
array_push($cp,array('$S120','nw_link','link',False,True,''));
array_push($cp,array('$S120','nw_fonte','fonte',False,True,''));
array_push($cp,array('$T50:14','nw_descricao','descricao',False,True,''));
array_push($cp,array('$D8','nw_dt_de','mostrar de',False,True,''));
array_push($cp,array('$D8','nw_dt_ate','mostrar ate',False,True,''));
array_push($cp,array('$H10','nw_log','nw_log',False,True,''));
array_push($cp,array('$O 1:Sim&0:Nгo','nw_ativo','ativo',False,True,''));
array_push($cp,array('$Q thema_titulo:thema_codigo:select * from ic_evento_tema where thema_ativo=1 order by thema_titulo','nw_thema','tema',False,True,''));
array_push($cp,array('$S12','nw_ref','Referencia da Notнcia',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>