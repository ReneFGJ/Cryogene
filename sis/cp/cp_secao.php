<?
$tabela = "ic_secao";
$cp = array();
$opx="";
for ($tt=1;$tt<99;$tt++) {$opx = $opx . '&'.$tt.':'.$tt.'� posi��o'; }
array_push($cp,array('$H4','id_s','id_s',False,True,''));
array_push($cp,array('$S120','s_titulo','nome se��o',False,True,''));
array_push($cp,array('$O 0:Invisivel'.$opx,'s_ativo','Posi��o',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>