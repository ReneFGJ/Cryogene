<?
require("wb_cab.php");
require("include/sisdoc_email.php");
require("include/sisdoc_data.php");

$sql = "select * from mailing";
$rlt = db_query($sql);
$sql = '';
while ($line = db_read($rlt))
	{
	$id = $line['id_ml'];
	$e1 = $line['ml_email'];
	$at = $line['ml_ativo'];
	$sql .= "insert into mailing (ml_email,ml_ativo,ml_tipo,ml_update,ml_cadastrado) ";
	$sql .= "values ('".$e1."','".$at."','00001','19000101','19000101'); ".chr(13);
	}
echo $sql;	
?>
!-- FIM