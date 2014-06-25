<?
$tabela = "representante";
$cp = array();
$nivel = '0:Inativo&1:Básico&9:Master';
array_push($cp,array('$H8','id_rp','rp_id',False,True,''));
array_push($cp,array('$U8','rp_lastupdate','rp_lastupdate',False,True,''));
array_push($cp,array('$S120','rp_nome','Nome completo',False,True,''));
array_push($cp,array('$S10','rp_login','Login',False,True,''));
array_push($cp,array('$P20','rp_senha','Senha',False,True,''));
array_push($cp,array('$S120','rp_email','e-mail',False,True,''));
array_push($cp,array('$D8','rp_niver','Dt.nascimento',False,True,''));
array_push($cp,array('$O '.$nivel,'rp_nivel','nível de acesso',False,True,''));
array_push($cp,array('$O 1:SIM&0:NAO','rp_ativo','ativo',False,False,''));

/// Gerado pelo sistem "base.php" versao 1.0.3
?>