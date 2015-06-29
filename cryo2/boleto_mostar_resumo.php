<?php
require("cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');

require("_class/_class_cliente.php");
$cl = new cliente;

require("_class/_class_contrato.php");
$ct = new contrato;

require("_class/_class_cr_boleto.php");
$bol = new cr_boleto;
	
echo '<h1>Visualizar boleto</h1>';
$bol->le($dd[0]);
echo $bol->mostra_boleto();

echo $hd->foot();
?>