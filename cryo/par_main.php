<? require("par_cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<? require("par_cab_2.php"); ?>
<? require("par_security.php"); ?>
<? require('par_cryo_calendario.php'); ?>
<?
security();
?>
<TR valign="top"><TD>Bem vindo, <B><?=$user_nome?></B>.
<BR><font class="lt0">código <?=$user_id?></font>
</TD>
<TD width="200">
<?
$dd[0] = date("Ym");
require("par_calendario.php");
?>
<BR>
<?
$dd[0] = substr(DateAdd("m",1,date("Ymd")),0,6);
require("par_calendario.php");
?>
<BR>
<?
$dd[0] = substr(DateAdd("m",2,date("Ymd")),0,6);
require("par_calendario.php");
?>
<BR>
<CENTER>Anteriores</CENTER>
<?
$dd[0] = substr(DateAdd("m",-1,date("Ymd")),0,6);
require("par_calendario.php");
?>
<BR>
<?
$dd[0] = substr(DateAdd("m",-2,date("Ymd")),0,6);
require("par_calendario.php");
?>
</TD>
</TR>
