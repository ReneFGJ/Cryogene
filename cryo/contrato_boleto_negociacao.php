<?php
require("cab.php");
require($include.'sisdoc_data.php');
require("_class/_class_cliente.php");
$cl = new cliente;

require("_class/_class_contrato.php");
$ct = new contrato;

require("_class/_class_cr_boleto.php");
$bol = new cr_boleto;

$contratos = splitx(';',$dd[0]);
$ct->contratos = $contratos;

echo '<h1>Contratos - Faturamento</h1>';
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
	
	echo '<div class="botao_acao">Enviar recordatório por SMS</div>';
	echo '<BR>';
	echo '<div class="botao_acao">Enviar recordatório por E-mail</div>';
	
	echo '<TD width="2%">&nbsp;';
	echo '<TD width="73%">';

$xctrl;
for ($r=0;$r<count($contratos);$r++)
	{
		$ctrl = $contratos[$r];
		if ((strlen($ctrl) > 0) and ($xctrl != $ctrl))
			{
			$ctr = array($ctrl);
			$xctrl = $ctrl;
			echo $bol->mostra_boleto_resumo($ctr);
			echo $bol->mostra_boleto_contrato_aberto($ctr);
			}
	}
echo '</table>';

echo $hd->foot();
?>

