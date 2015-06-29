<?php
$login = 1;
require("cab.php");
require($include.'sisdoc_data.php');
require($include.'_class_form.php');
$form = new form;

echo '<h1>Atualização / Reimpressão de Boleto</h1>';
$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$S20','','Informe o CPF',True,True));
array_push($cp,array('$D8','','Data nascimento',True,True));
array_push($cp,array('$B8','','Buscar >>>',False,True));

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		require("_class/_class_cr_boleto.php");
		$bol = new cr_boleto;
		
		require("_class/_class_cliente.php");
		$cli = new cliente;
		
		$tela02 = $bol->boletos_aberto_cpf_cliente($dd[1]);
		
		$cli->le($bol->cliente);
		$tela01 = $cli->mostra();
		echo $tela01;
		echo $tela02;
		
	} else {
		echo $tela;
	}

?>
