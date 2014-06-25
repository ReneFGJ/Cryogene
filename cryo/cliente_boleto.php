<?php
require("cab.php");
require($include.'sisdoc_data.php');

require("_class/_class_cliente.php");
$cl = new cliente;

require("_class/_class_contrato.php");
$ct = new contrato;

require("_class/_class_cr_boleto.php");
$bol = new cr_boleto;

if (strlen($dd[1]) == 0)
	{ redirecina('index.php'); }
	
echo '<h1>Emissão de boleto avulso</h1>';

echo '<font class="lt2">';
if (strlen($dd[2]) == 0)
	{
		$cliente = $dd[1];
		echo $ct->selecionar_contrato($cliente);
	} else {
		$cp = $bol->cp();
		$tabela = $bol->tabela;
		require($include.'_class_form.php');
		$form = new form;
		$tela = $form->editar($cp,'');
		
		if ($form->saved > 0)
			{
				// Verifica se não existe este boleto //
				$tela = $form->editar($cp,$tabela);
				$bol->atualiza_nosso_numero($dd[1],$dd[2]);
				redirecina('boleto_mostar_resumo.php?dd0='.$bol->id);
			}
			
		echo $tela;
	}

echo $hd->foot();
?>