<?
$tabela = "local_coleta";
$cp = array();
array_push($cp,array('$H8','id_lc','lc_local',False,True,''));
array_push($cp,array('$S120','lc_local','Local',True,True,''));
array_push($cp,array('$S120','lc_endereco','Endereco',False,True,''));
array_push($cp,array('$S20','lc_bairro','Bairro',False,True,''));
array_push($cp,array('$Q c_cidade:c_codigo:select * from cidade order by c_cidade','lc_cidade','Cidade',False,True,''));
array_push($cp,array('$S15','lc_fone_1','Fone',False,True,''));
array_push($cp,array('$S15','lc_fone_2','Fone 2',False,True,''));
array_push($cp,array('$H15','lc_codigo','lc_codigo',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.4
?>