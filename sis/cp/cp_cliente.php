<?
$tabela = "cliente";
$cp = array();
array_push($cp,array('$H8','id_cl','',False,True,''));
array_push($cp,array('$S120','cl_nome','Nome completo',True,True,''));
array_push($cp,array('$S15','cl_cpf','CPF',False,True,''));
array_push($cp,array('$S15','cl_rg','RG',False,True,''));
array_push($cp,array('$H7','cl_codigo','Codigo',False,True,''));
array_push($cp,array('$U8','cl_lastupdate','cl_lastupdate',False,True,''));
array_push($cp,array('$P20','cl_senha','cl_senha',False,True,''));
array_push($cp,array('$S60','cl_endereco','Endereco',False,True,''));
array_push($cp,array('$S20','cl_bairro','Bairro',False,True,''));
array_push($cp,array('$S10','cl_cep','CEP',False,True,''));
array_push($cp,array('$Q c_cidade:c_codigo:select * from cidade order by c_cidade','cl_cidade','Cidade',False,True,''));
array_push($cp,array('$H10','cl_pais','Pais',False,True,''));
array_push($cp,array('$D8','cl_dt_nasc','Dt.Nascimento',False,True,''));
array_push($cp,array('$S8','cl_fone_ddd','DDD/DDI',False,True,''));
array_push($cp,array('$S15','cl_fone_1','Telefone residencial',False,True,''));
array_push($cp,array('$S15','cl_fone_2','Telefone comercial',False,True,''));
array_push($cp,array('$S15','cl_fone_3','Celular',False,True,''));
array_push($cp,array('$S20','cl_fone_4','Fone (outros)',False,True,''));
array_push($cp,array('$S20','cl_fone_5','Fone (outros)',False,True,''));
array_push($cp,array('$S20','cl_fone_6','Fone (outros)',False,True,''));
array_push($cp,array('$S20','cl_fone_7','Fone (outros)',False,True,''));
array_push($cp,array('$S20','cl_fone_8','Fone (outros)',False,True,''));
array_push($cp,array('$S100','cl_email','e-mail',False,True,''));
array_push($cp,array('$S100','cl_email_alt','e-mail alternativo',False,True,''));
array_push($cp,array('$O  : --sexo--&F:Feminino&M:Masculino','cl_sexo','Sexo',False,True,''));
array_push($cp,array('$S30','cl_profissao','Profissão',False,True,''));
array_push($cp,array('$Q ec_descricao:ec_tipo:select * from estado_civil order by ec_descricao','cl_est_civil','Est. Civil',False,True,''));
array_push($cp,array('$S30','cl_nacionalidade','Nacionalidade ',False,True,''));
array_push($cp,array('$A','','Referência',False,True,''));
array_push($cp,array('$S120','cl_contato_nome','Nome ',False,True,''));
array_push($cp,array('$S40','cl_contato_telefone','Telefone ',False,True,''));
array_push($cp,array('$S120','cl_contato_endereco','Endereço ',False,True,''));
array_push($cp,array('$S20','cl_contato_bairro','Bairro ',False,True,''));
array_push($cp,array('$Q c_cidade:c_codigo:select * from cidade order by c_cidade','cl_contato_cidade','Cidade',False,True,''));



/// Gerado pelo sistem "base.php" versao 1.0.4
?>