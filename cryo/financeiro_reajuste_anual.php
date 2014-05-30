<?php
require("cab.php");
require($include.'_class_form.php');
$form = new form;

echo '<h1>Aplicar reajuste anual</h1>';


$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$N8','','Valor do IGP',True,True));
array_push($cp,array('$O : &S:SIM','','Confirma ?',True,True));

$tela = $form->editar($cp,'');
if ($form->saved > 0)
	{
		$sql = "update contrato set ctr_reajuste_indice = ".$dd[1].""; /* 2014 */
		$rlt = db_query($sql);
		echo '<font color="green">Reajuste aplicado com sucesso!</font>';		
	} else {
		echo $tela;
	}
	


echo $hd->foot();
?>
