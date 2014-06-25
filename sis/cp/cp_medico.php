<?
$tabela = "medico";
$cp = array();
array_push($cp,array('$H8','id_md','id_md',False,True,''));
array_push($cp,array('${','','Dados Pessoais',False,True,''));
array_push($cp,array('$S120','md_nome','Nome',False,True,''));

array_push($cp,array('$O : &M:Médico&S:Secretária','md_tipo','Tipo',False,True,''));

array_push($cp,array('$S15','md_cpf','CPF',False,True,''));
array_push($cp,array('$S15','md_rg','RG',False,True,''));
array_push($cp,array('$H7','md_codigo','Codigo',False,True,''));
array_push($cp,array('$U8','md_lastupdate','md_lastupdate',False,True,''));
array_push($cp,array('$U8','md_dt_cadastro','md_dt_cadastro',False,True,''));
array_push($cp,array('$H20','md_senha','Senha',False,True,''));
array_push($cp,array('$S0','md_nacionalidade','Nacionalidade',False,True,''));

array_push($cp,array('$H5','md_old_id','md_old_id',False,True,''));
array_push($cp,array('$O : &M:Masculino&F:Feminino','md_sexo','Sexo',False,True,''));

array_push($cp,array('$S20','md_profissao','Especialidade',False,True,''));
array_push($cp,array('$S15','md_cr','Nº CRM',False,True,''));
array_push($cp,array('$}','','Dados Pessoais',False,True,''));

array_push($cp,array('${','','Endereço',False,True,''));
array_push($cp,array('$S60','md_endereco','Endereco',False,True,''));
array_push($cp,array('$S20','md_bairro','Bairro',False,True,''));
array_push($cp,array('$S10','md_cep','CEP',False,True,''));
array_push($cp,array('$Q c_cidade:c_codigo:select * from cidade order by c_cidade','md_cidade','Cidade',False,True,''));
array_push($cp,array('$D8','md_dt_nasc','Data Nascimento',False,True,''));
array_push($cp,array('$S8','md_fone_ddd','DDD',False,True,''));
array_push($cp,array('$S15','md_fone_1','Fone (com)',False,True,''));
array_push($cp,array('$S15','md_fone_2','Fone (out)',False,True,''));
array_push($cp,array('$S15','md_fone_3','Fone (cel)',False,True,''));
array_push($cp,array('$}','','',False,True,''));

array_push($cp,array('${','','E-mail',False,True,''));
array_push($cp,array('$S100','md_email','e-mail',False,True,''));
array_push($cp,array('$S100','md_email_alt','e-mail_alternativo',False,True,''));
array_push($cp,array('$}','','',False,True,''));

array_push($cp,array('${','','Dados Bancários',False,True,''));

array_push($cp,array('$Q bc_banco:bc_cod:select * from banco order by bc_ordem, bc_banco','md_at_banco','Banco',False,True,''));
array_push($cp,array('$S4','md_at_ag','Agência',False,True,''));
array_push($cp,array('$S12','md_at_cc_ag','Conta Corrente',False,True,''));
array_push($cp,array('$O Física:Física&Juridica:Juridica','md_cpf_tipo','Tipo',False,True,''));
array_push($cp,array('$T40:5','md_at_cc_obs','Observação',False,True,''));
array_push($cp,array('$S8','md_at_ag','Agência',False,True,''));

array_push($cp,array('$S8','md_at_cc','Conta Corrente',False,True,''));
array_push($cp,array('$S40','md_at_cc_titular','Títular da conta',False,True,''));
array_push($cp,array('$}','','',False,True,''));



/// Gerado pelo sistem "base.php" versao 1.0.5
?>