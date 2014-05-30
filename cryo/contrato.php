<?php
require("cab.php");
require($include.'sisdoc_menus.php');


$menu = array();

array_push($menu,array('Emitir contrato','Contrato de teste','documento_contrato.php'));

$tipo = 3;
menus($menu,$tipo);


echo $hd->foot();
?>
