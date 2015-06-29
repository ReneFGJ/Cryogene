<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');
require("_class/_class_boleto.php");

$bol = new boleto;
$bol->le($dd[0]);
echo $bol->mst_detalhe();

?>