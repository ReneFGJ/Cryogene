<?php
require("cab.php");
require("_class/_class_cr_boleto.php");
require($include.'sisdoc_data.php');
$bol = new cr_boleto;

require($include.'_class_form.php');
$form = new form;

if (strlen($acao) == 0)
	{
		$dd[2] = '01/01/2012';
		$dd[3] = date("d/m/Y");
	}

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$A','','Boletos em aberto',False,False));
array_push($cp,array('$D8','','de',False,False));
array_push($cp,array('$D8','','até',False,False));
$tela = $form->editar($cp,'');

echo '<h1>Boletos em Aberto</h1>';

if ($form->saved > 0)
	{
		$dd1 = brtos($dd[2]);
		$dd2 = brtos($dd[3]);
		echo $bol->boletos_aberto($dd1,$dd2);
	} else {
		echo $tela;
	}

echo $hd->foot();
?>
