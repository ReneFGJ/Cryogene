<?
$nucleo = "cep";
require('db.php');
require('include/sisdoc_debug.php');
	require('include/sisdoc_colunas.php');
	require('include/sisdoc_data.php');	
	require('include/sisdoc_form2.php');
	require('cp/cp_'.$nucleo.'_calendario_novo.php');
	require('include/cp2_gravar.php');
?>
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<?
	$http_edit = 'cryo_calendario_novo.php';
	$http_redirect = 'close.php';
	?>
	<Font class="lt5">Data: <?=$dd[1]?></FONT>
	<TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?
	
	if ($saved > 0)
		{
			require("close.php");
		}	