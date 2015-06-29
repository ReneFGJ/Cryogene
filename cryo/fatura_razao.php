<?
require("cab.php");
require("_class/_class_fatura.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');
$fat = new fatura;

echo $fat->fatura();

require("foot.php");	
?>