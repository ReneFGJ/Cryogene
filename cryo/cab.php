<? ob_start(); ?>
<title>Cryogene - Armazenamento do Sangue de Cord�o Umbilical</title>
<?
$LANG="pt_BR";
$include = "include/";
global $nocab;
require('db.php');
//require('security.php');
require($include.'sisdoc_security_v2.php');
require($include.'sisdoc_number.php');
$user = new usuario;
if (!($user->security())) { redirecina('login.php'); };
require($include.'sisdoc_onekey.php');
require($include.'sisdoc_debug.php');

//$sql = "insert into onekey (onekey_shortcut,onekey_descricao,onekey_http,onekey_aitvo,onekey_newwin)";
//$sql .= " values ";
//$sql .= "('email','e-mail','email.php',1,0)";
//$rlt = db_query($sql);

$jid = 1;
$user_id = $HTTP_COOKIE_VARS['nw_user'];
$user_nome = $HTTP_COOKIE_VARS['nw_user_nome'];
$user_nivel = $HTTP_COOKIE_VARS['nw_nivel'];
$user_log = $HTTP_COOKIE_VARS['nw_log'];
require('index_count.php');

if ($login != 1) { $user->security(); }
?>
<body leftmargin="0" topmargin="0" >
	<style>
	body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
	</style>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
<CENTER>
<TABLE width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	<TR><TD height="8"></TD></TR>
	<TR><TD colspan="10"><a href="main.php"><img src="img/logo_cryogene.png" height="60"  border="0"></a></TD>
		<TD align="right" valign="top"><?=$onekey_form;?></TD>
	</TR>
	<TR><TD height="8"></TD></TR>
	<TR bgcolor="#c0c0c0"><TD colspan="11" height="1"></TD></TR>
	<TR class="lt0"><TD>&nbsp;<?=date('d-m-Y h:i')?>&nbsp;<?=$user_nome;?> (<?=$user_log;?>, <?=$user_nivel?>)</TD>
		<TD colspan="10" align="right" >vers�o 0.0.1c&nbsp;</TD></TR>
</TABLE>
<?
if ($login != 1) { require('menu_top.php'); }
?>