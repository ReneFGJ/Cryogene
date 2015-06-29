<?php
require("cab.php");

require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');

require("_class/_class_fatura.php");
$fat = new fatura;
$tabela = $fat->tabela;
$cp = $fat->cp_tipos();

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
{
redirecina("fat_faturamento.php");
}
?>
