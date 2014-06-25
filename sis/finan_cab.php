<script language="JavaScript">
 function newwin(url) {  window.open(url,'newwin','scrollbars=yes,resizable=no,width=650,height=360,top=10,left=10');
          }
</script>
<?
$nome_mes = intval(substr($dd[0],4,2));
if ($saldo > 0) { $saldo = numberformat_br($saldo,2); }
?>
<TABLE cellpadding="2" cellspacing="0" border="1" width="<?=$tab_max?>">
<TR valign="top" bgcolor="#e2e2e2">
<TD align="center" width="100">
<font class=lt1><B><?=stodbr($dd[0]);?></B></font><BR>
<font class=lt2><B><?=nomemes($nome_mes);?></B></font><BR>
<font class=lt2><B><?=nomedia(weekday(xstod($dd[0])));?></B></font>
<TD align="center"><font class=lt4><?=$titulo_cab?></font><P>
<font class="lt5"><?=$saldo?></P></font></TD>
<TD>
<? 
require('cab_navega_dia.php') ;
?>
</TD>
<TD width="105" align="center" class="lt1">
<? require('cab_calendario.php'); ?>
</TR>