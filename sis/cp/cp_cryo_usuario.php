<?
$tabela = "cryo_user";
$cp = array();
$ec = "SOL:Solteiro(a)&CAS:Casado(a)&SEP:Separado?&VIV:Viúva";
array_push($cp,array('$H4','id_user','id_user',False,True,''));
array_push($cp,array('$H50','user_senha','user_senha',False,True,''));
array_push($cp,array('$H7','user_codigo','user_codigo',False,True,''));
array_push($cp,array('$S100','user_nome','Nome completo',True,True,''));
array_push($cp,array('$S20','user_cpf','C.P.F.',False,True,''));
array_push($cp,array('$S20','user_rg','R.G.',False,True,''));
array_push($cp,array('$D8','user_nascimento','Nascimento',False,True,''));
array_push($cp,array('$S20','user_nacionalidade','Nascionalidade',False,True,''));
array_push($cp,array('$O '.$ec,'user_est_civil','Estado civil',False,True,''));
array_push($cp,array('$S100','user_endereco','Endereço residencial',False,True,''));
array_push($cp,array('$S30','user_bairro','Bairro',False,True,''));
array_push($cp,array('$S30','user_cidade','Cidade',False,True,''));
array_push($cp,array('$S2','user_estado','Estado',False,True,''));
array_push($cp,array('$S20','user_pais','Pais',False,True,''));
array_push($cp,array('$S10','user_cep','CEP',False,True,''));
array_push($cp,array('$S4','user_ddd','DD',False,True,''));
array_push($cp,array('$S20','user_telefone_1','Telefone residêncial',False,True,''));
array_push($cp,array('$S20','user_telefone_2','Telefone celular',False,True,''));
array_push($cp,array('$S20','user_telefone_3','Telefone recado',False,True,''));
array_push($cp,array('$U8','user_dt_cada','user_dt_cada',False,True,''));
array_push($cp,array('$U8','user_update','user_update',False,True,''));
array_push($cp,array('$S7','user_mae','Nome mãe',False,True,''));
array_push($cp,array('$S7','user_pai','Nome pai',False,True,''));
array_push($cp,array('$O 1:1&2:2&3:3&4:4&9:9','user_nivel','Nível',False,True,''));
array_push($cp,array('$S20','','Senha para login',False,True,''));
array_push($cp,array('$S20','user_login','Login ',True,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.4
?>