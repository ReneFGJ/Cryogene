<?
require("wb_cab.php");

	$sql = "update mailing set ml_valido = 0 ";
	$rlt = db_query($sql);
?>
ZERADOS STATUS DE TODOS OS CLIENTES