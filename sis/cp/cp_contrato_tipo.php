<?
$tabela = "contrato_tipo";

$cp = array();
array_push($cp,array('$H8','id_sp','id_sa',False,True,''));
array_push($cp,array('$H10','sp_codigo','codigo',False,True,''));
array_push($cp,array('$S50','sp_descricao','T�tulo',True,True,''));
array_push($cp,array('$O 1:1&2:2&3:3&4:4&5:5&6:6&7:7','sp_ordem','Ordem de mostragem',True,True,''));
array_push($cp,array('$O CRYO:CRYO','sp_nucleo','Nucleo',True,True,''));
array_push($cp,array('$T50:4','sp_caption','Informa��es b�sicas',True,True,''));
array_push($cp,array('$T50:4','sp_content','Informa��es (i)',True,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','sp_ativo','Ativo',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.5
?>