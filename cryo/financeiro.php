<?php
require("cab.php");
require($include.'sisdoc_menus.php');


$menu = array();

array_push($menu,array('Contas a receber','Resumo de boletos','boletos_resumo.php'));
array_push($menu,array('Contas a receber','Boletos em aberto','boletos_aberto.php')); 

array_push($menu,array('Financeiro','Aplicar reajuste anual','financeiro_reajuste_anual.php')); 

array_push($menu,array('Faturamento','Abrir Nova Fatura','fatura_abrir.php')); 

$tipo = 3;
menus($menu,$tipo);


echo $hd->foot();
?>
