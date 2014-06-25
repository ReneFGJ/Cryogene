<?
$tabela = "usuario";
$cp = array();
$nivel = '0:Inativo&1:Básico&9:Master';
array_push($cp,array('$H8','id_us','us_id',False,True,''));
array_push($cp,array('$U8','us_lastupdate','us_lastupdate',False,True,''));
array_push($cp,array('$S120','us_nome','Nome completo',False,True,''));
array_push($cp,array('$S10','us_login','Login',False,True,''));
array_push($cp,array('$P20','us_senha','Senha',False,True,''));
array_push($cp,array('$S120','us_email','e-mail',False,True,''));
array_push($cp,array('$D8','us_niver','Dt.nascimento',False,True,''));
array_push($cp,array('$O '.$nivel,'us_nivel','nível de acesso',False,True,''));
array_push($cp,array('$O 	1:SIM&0:NAO','us_ativo','ativo',False,False,''));

/// Gerado pelo sistem "base.php" versao 1.0.3
?>