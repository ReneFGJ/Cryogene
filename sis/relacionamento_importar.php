<?
$vars = array_merge($_GET, $_POST);
if (strlen(trim($vars['acao'])) > 0)
	{
	require("db.php");
	require("ic_include.php");
	ic_contato_import('http://www.cryogene.com.br/contato_export.php');
	} else {
	?><form method="post" action="relacionamento_importar.php">
	<CENTER><input type="submit" name="acao" value="importar"></CENTER>
	</form>
	<? }
?>