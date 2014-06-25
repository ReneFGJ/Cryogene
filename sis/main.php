<?
require('cab.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');
require('cryo_calendario.php');

?>
<TABLE border="0" width="<?=$tab_max?>">
<TR valign="top">
<TD width="*"><? require("main_relacionamento.php"); ?>

<? require("main_icones.php"); ?>
</TD>
<TD width="10">&nbsp;</TD>
<TD align="right" width="300" align="center"><CENTER>
<font class=lt5>Agenda</font></CENTER>
<?
$dd[0] = date("Ym");
require("main_calendario.php");
?>
<BR>
<?
$dd[0] = substr(DateAdd("m",1,date("Ymd")),0,6);
require("main_calendario.php");
?>
<BR>
<?
$dd[0] = substr(DateAdd("m",2,date("Ymd")),0,6);
require("main_calendario.php");
?>
</TD>
</TR>
</TABLE>
<?
require('foot.php');
?>