<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
//require('include/_class_form.php');

echo 'ola';
//@ini_set('unserialize_callback_func', 'spl_autoload_call');
ini_set('display_errors', 0);
ini_set('error_reporting', 255);
$label = "Emitir Faturamento para Clientes";

require("_class/_class_fatura.php");
$fat = new fatura;

/* Valida Contrato */
$cp = $fat->cp();

$tela = $form->editar($cp,'');

echo $tela;



require("foot.php");
?>	