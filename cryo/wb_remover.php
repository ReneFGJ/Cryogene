<?
require("wb_cab.php");
require("include/sisdoc_email.php");
require("include/sisdoc_data.php");

if (strlen($dd[0]) > 0)
	{
	$sql = "select * from mailing where ml_email='".trim($dd[0])."'";
	$result = db_query($sql);
	if ($line = db_read($result))
		{
			$sql = "update mailing set ml_ativo = 0 where ml_email = '".trim($dd[0])."'";
			$result = db_query($sql);
			$msg = "<font color=green>O e-mail <B>".$dd[0]."</B> foi removido do <I>mailing</I> com sucesso</font>";
		} else {
			$msg = "<font color=red>O e-mail <B>".$dd[0]."</B> não foi localizado no sistema</font>";
		}
	}
?>
<CENTER>
<font face="Arial" color="#0080c0" style="font-size : 22px;">
WEB Mailing Direto
</font>
<BR><BR>
<font face="Arial" style="font-size : 12px;">
<?=$msg; ?>

