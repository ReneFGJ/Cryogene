<?php
require("cab.php");
require($include.'sisdoc_data.php');
require("_class/_class_cliente.php");
$cl = new cliente;

require("_class/_class_contrato.php");
$ct = new contrato;

require("_class/_class_cr_boleto.php");
$bol = new cr_boleto;

require("_class/_class_faturamento.php");
$fat = new faturamento;

$contratos = splitx(';',$dd[0]);
$ct->contratos = $contratos;

echo '<h1>Contratos - Detalhamento</h1>';

$ct->le($contratos[0]);
$fat->gera_faturamento_pelo_boleto($contratos[0]);
echo $ct->mostra();

echo '<table width="100%">';
	echo '<TR valign="top">';
 	echo '<TD width="25%" class="h13">';
	echo 'Contrato(s)';
	echo '<TD width="2%">&nbsp;';
	echo '<TD width="73%" class="h13">';
	echo 'Boletos';
	echo '<TR valign="top">';
	echo '<TD width="25%">';
	echo $ct->mostra_contrato($contratos);
	echo $fat->mostra_fatura_historico($contratos[0]);
	echo '<TD width="2%">&nbsp;';
	echo '<TD width="73%">';

for ($r=0;$r<count($contratos);$r++)
	{
		$ctrl = $contratos[$r];
		if (strlen($ctrl) > 0)
			{
			$ctr = array($ctrl);

			echo $bol->mostra_boleto_resumo($ctr);
			echo $bol->mostra_boleto_contrato($ctr);
			}
	}
echo '</table>';

echo $hd->foot();
?>

