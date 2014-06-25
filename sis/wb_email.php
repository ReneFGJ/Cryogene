<?
require("wb_cab.php");
require("include/sisdoc_email.php");
require("include/sisdoc_data.php");

if (strlen($dd[0]) > 0)
	{
	$xmail = checaemail($dd[0]);
	if ($xmail == true)	
	{
	$sql = "select * from mailing where ml_email='".trim($dd[0])."'";
	$result = db_query($sql);
	if ($line = db_read($result))
		{
			$sql = "update mailing set ml_ativo = 1 where ml_email = '".trim($dd[0])."'";
			$result = db_query($sql);
			$msg = "<font color=green>O e-mail <B>".$dd[0]."</B> foi ativado do <I>mailing</I> com sucesso</font>";
		} else {
			$sql = "insert mailing (ml_ativo,ml_email) values (1,'".trim($dd[0])."')";
			$result = db_query($sql);
			$msg = "<font color=green>O e-mail <B>".$dd[0]."</B> foi cadastrrado com sucesso no <I>mailing</I> com sucesso</font>";
		}
	} else {
		$msg = "e-mail Incorreto";
	}
	?>
	<CENTER>
	<font face="Arial" color="#0080c0" style="font-size : 22px;">
	WEB Mailing Direto
	</font>
	<BR><BR>
	<font face="Arial" style="font-size : 12px;">
	<?=$msg; ?>
	<?
	} else {
	?>
	<form method="post">
	Cadastre seu e-mail e receba nossas novidades<BR><BR>
	<input type="text" name="dd0">
	<BR><input type="submit" name="acao" value="cadastrar">
	</form>
	<?
	}
?>
