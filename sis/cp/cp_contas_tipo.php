<?
$tabela = "contas_tipo";
$cp = array();
array_push($cp,array('$H5','id_ct','ct_codigo',False,True,''));
array_push($cp,array('$A5','','Dados sobre a conta',False,False,''));
array_push($cp,array('$H5','ct_codigo','Codigo',False,False,''));
array_push($cp,array('$S40','ct_descricao','Descricao',False,True,''));
array_push($cp,array('$U8','ct_lastupdate','ct_lastupdate',False,True,''));
array_push($cp,array('$O : &1:Contas a receber&2:Contas a pagar&3:Representante&4:CC Cliente','ct_tipo','Tipo da conta',False,True,''));
array_push($cp,array('$O : :-não aplicado&D:Debito&C:Credito','ct_dc','Debito/Credito',False,True,''));
array_push($cp,array('$O 1:Sim&0:Não','ct_ativo','Ativo',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.4
?>