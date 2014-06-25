<? ob_start(); ?>
<title>Cryogene - Armazenamento do Sangue de Cordão Umbilical</title>
<?
global $nocab;
require('db.php');
require('cliente_security.php');
require('include/sisdoc_colunas.php');
$jid = 1;
$cliente_id = $HTTP_COOKIE_VARS['cl_user'];
$cliente_nome = $HTTP_COOKIE_VARS['cl_user_nome'];
$cliente_nivel = $HTTP_COOKIE_VARS['cl_nivel'];
$cliente_log = $HTTP_COOKIE_VARS['cl_log'];
require('index_count.php');

if ($login != 1) { security(); }
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<CENTER>
<TABLE width="<?=$tab_max?>" cellpadding="0" cellspacing="0" border="0" align="center">
<TR><TD height="8"></TD></TR>
<TR><TD colspan="10"><a href="main.php"><img src="img/logo_cryogene.jpg"  border="0"></a></TD>
</TR>
<TR><TD height="8"></TD></TR>
<TR class="lt0"><TD>&nbsp;<?=date('d-m-Y h:i')?>&nbsp;<?=$cliente_nome;?> (<?=$cliente_log;?>, <?=$cliente_nivel?>)</TD><TD colspan="5" align="right" >versão 0.0.1c&nbsp;</TD></TR>
<TR bgcolor="#c0c0c0"><TD colspan="4" height="1"></TD></TR>
</TABLE>
<?
//if ($login != 1) { require('menu_top.php'); }
?>