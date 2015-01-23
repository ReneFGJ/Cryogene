<?php
require("cab.php");

require($include.'_class_form.php');
$form = new form;

require("_class/_class_fatura.php");

$fat = new fatura;
$fat->updatex();

$tabela = $fat->tabela;

$cp = $fat->cp();
$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		$fat->updatex();
		redirecina('index.php');
	} else {
		echo $tela;
	}

echo $hd->foot();
?>
