<?
$tabela = "pareceristas";
$cp = array();
//$dd[4] = '19000101';
array_push($cp,array('$H4','id_us','id_us',False,False,''));
array_push($cp,array('$A4','','Dados pessoais',False,True,''));
array_push($cp,array('$H8','us_cracha','Usuário do núcleo',False,True,''));
array_push($cp,array('$S120','us_nome','Nome completo',True,True,''));
array_push($cp,array('$@ ap_tit_titulo:ap_tit_titulo:select * from apoio_titulacao order by ap_tit_titulo','us_titulacao','Titulacao',True,True,''));
array_push($cp,array('$Q inst_nome:inst_codigo:select * from instituicoes order by inst_nome','us_instituicao','Instituição',True,True,''));
array_push($cp,array('$S100','us_lattes','Lattes (link)',False,True,''));
array_push($cp,array('$HV','us_niver','19000101',False,True,''));
array_push($cp,array('$H4','','Filiação',False,True,''));
array_push($cp,array('$H100','us_nome_pai','Nome pai',False,True,''));
array_push($cp,array('$H100','us_nome_mae','Nome mae',False,True,''));
array_push($cp,array('$A4','','Dados para o sistema',False,True,''));
array_push($cp,array('$S15','us_login','Login',True,True,''));
array_push($cp,array('$P100','us_senha','senha',True,True,''));
array_push($cp,array('$U8','us_lastupdate','us_lastupdate',False,True,''));
array_push($cp,array('$S100','us_lembrete','Lembrete da senha',False,True,''));
array_push($cp,array('$H4','','Documentos pessoais',False,True,''));
array_push($cp,array('$H20','us_cpf','CPF',False,True,''));
array_push($cp,array('$H20','us_rg','RG',False,True,''));
array_push($cp,array('$A4','','Formas de contato para contato',False,True,''));
array_push($cp,array('$T60:5','us_endereco','Endereço',False,True,''));
array_push($cp,array('$S15','us_fone_1','Fone ',False,True,''));
array_push($cp,array('$S15','us_fone_2','Fone (cel)',False,True,''));
array_push($cp,array('$S15','us_fone_3','Fone (rec)',False,True,''));
array_push($cp,array('$S100','us_email','e-mail',True,True,''));
array_push($cp,array('$S100','us_email_alternativo','e-mail (alternativo)',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','us_email_ativo','Enviar e-mail',False,True,''));
array_push($cp,array('$H4','','Dados trabalistas',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','us_ativo','Ativo',False,True,''));
array_push($cp,array('$U8','us_dt_admissao','Dt admissão',False,True,''));
array_push($cp,array('$U8','us_dt_demissao','Dt demissão',False,True,''));
array_push($cp,array('$H20','us_vt','Cartão de VT',False,True,''));
array_push($cp,array('$H20','us_vr','Cartão de VR',False,True,''));
array_push($cp,array('$O 1:Pareceristas','us_nivel','Tipo',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>