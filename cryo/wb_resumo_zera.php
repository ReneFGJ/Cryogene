<?
require("cab.php");

if (strlen($dd[1]) ==0)
	{
?>
<form action="wb_resumo_zera.php" method="post">
<input type="submit" name="dd0" value="zerar base de envio de mailing">
<input type="hidden" name="dd1" value="SIM">
<input type="hidden" name="dd2" value="mailing">
</form>

<form action="wb_resumo_zera.php" method="post">
<input type="submit" name="dd0" value="zerar base de envio de mailing (lojistas)">
<input type="hidden" name="dd1" value="SIM">
<input type="hidden" name="dd2" value="mailing_2">
</form>
<?

} else {
	$sql = "update ".$dd[2]." set ml_ativo = 1 where ml_ativo > 1 ";
	$rlt = db_query($sql);
	echo '<BR><BR><BR><BR>';
	echo '<CENTER>Mailing Reestarteado com sucesso !</CENTER>';
	echo '<BR><BR><BR><BR>';
}

require("foot.php");	?>