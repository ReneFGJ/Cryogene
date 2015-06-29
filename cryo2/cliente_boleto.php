<?php
require ("cab.php");
require ($include . 'sisdoc_data.php');
require ($include . 'sisdoc_debug.php');

require ("_class/_class_cliente.php");
$cl = new cliente;

require ("_class/_class_contrato.php");
$ct = new contrato;

require ("_class/_class_cr_boleto.php");
$bol = new cr_boleto;

if (strlen($dd[1]) == 0) { redirecina('index.php');
}

echo '<h1>Emissão de boleto avulso</h1>';

echo '<font class="lt2">';
if (strlen($dd[2]) == 0) {
	$cliente = $dd[1];
	echo $ct -> selecionar_contrato($cliente);
} else {
	$cp = $bol -> cp();
	$tabela = $bol -> tabela;
	require ($include . '_class_form.php');
	$form = new form;
	$tela = $form -> editar($cp, '');

	if ($form -> saved > 0) {
		echo '<h1>Processando</h1>';
		// Verifica se não existe este boleto //
		$parcelas = round($dd[25]);
		$valor = round($dd[6] * 100) / 100;
		$vlrp = round($valor / $parcelas * 100) / 100;
		$doc = $dd[11];
		$desc = $dd[20];
		$venc = $dd[3];
		echo 'Parcelas:' . $parcelas . '<hr>';
		for ($r = 1; $r <= $parcelas; $r++) {
			$dd[6] = $vlrp;
			$dd[3] = $bol -> busca_proximo_vencimento($venc, $r);
			if ($parcelas > 1) {
				$dd[11] = $doc . ' - ' . $r . '/' . $parcelas;
			}
			$dd[20] = $desc . ' - ' . $r . '/' . $parcelas;
			echo '<BR>Vencimento ' . $dd[3] . ' Valor R$ ' . number_format($dd[6], 2, ',', '.') . ' - ' . $dd[11];
			
			$ok = $bol -> insere_boleto($cp, $tabela); 
			if ($ok == 1) {
				echo ' - <font color="green">criado</font>';
			} else {
				echo ' - <font color="red">falha ('.$form-> saved.')</font>';
			}
		}
		$bol -> atualiza_nosso_numero($dd[1], $dd[2]);
		echo '<HR>Boletos gerados com sucesso!';
		//redirecina('boleto_mostar_resumo.php?dd0='.$bol->id);
		exit ;
	}

	echo $tela;
}

echo $hd -> foot();
?>