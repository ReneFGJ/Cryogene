<?php
require("cab.php");
require("_class/_class_cr_boleto.php");
$bol = new cr_boleto;

echo '<h1>Boletos - Resumo</h1>';

echo $bol->resumo();

echo $hd->foot();
?>
