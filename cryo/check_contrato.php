<?
require("cab.php");
require('include/sisdoc_colunas.php');
$label = "Contratos duplicados";
if ($user_nivel == 9)
	{	
	$sql = "delete from contrato where ctr_status='D'";
	$rlt = db_query($sql);
	
	$http_edit = 'check_contrato.php'; 
	$sql = "select * from (";
	$sql = $sql . " select count(*) as total,ctr_numero from contrato ";
	$sql = $sql . " group by ctr_numero ) as tabela";
	$sql = $sql . " where total > 1 ";
	$rlt = db_query($sql);
	
	while ($line = db_read($rlt))
		{
		echo $line['ctr_numero'].'('.$line['total'].') ';
		}
	}
require("foot.php");	
?>