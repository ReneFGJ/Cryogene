<?
require("cab.php");

$sql = "select cr_conta, sum(cr_valor) as total,substr(cr_venc,1,6) as mes from contas_pagar ";
$sql .= " where cr_venc <= ".date("Ym").'99';
$sql .= " group by cr_conta, mes ";
$sql .= " order by mes desc ";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	echo '<BR>';
	echo $line['mes'];
	echo '='.$line['cr_conta'];
	echo '='.$line['total'];
	}
?>
</TABLE></FORM>
<? require("foot.php");	?>