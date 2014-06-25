<?php
require("cab.php");
require($include.'sisdoc_data.php');
require("_class/_class_cliente.php");
$cl = new cliente;

require("_class/_class_contrato.php");
$ct = new contrato;

require("_class/_class_cr_boleto.php");
$bol = new cr_boleto;

$cl->le($dd[0]);

echo $cl->mostra();
echo '<table width="100%">'; 

echo '<TR valign="top">';
echo '<TD width="25%" class="h13">';
echo 'Contrato(s)';

echo '<TD width="2%">&nbsp;';
echo '<TD width="73%" class="h13">';
echo 'Boletos';

echo '<TR valign="top">';
echo '<TD width="25%">';
echo $ct->mostra_contrato_cliente($cl->id);

echo '<TD width="2%">&nbsp;';
echo '<TD width="73%">';
echo $bol->mostra_boleto_resumo($ct->contratos);
echo $bol->mostra_boleto_contrato($ct->contratos);
echo '</table>';

echo $hd->foot();
?>

