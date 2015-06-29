<?
require("cliente_cab.php");
require("include/sisdoc_data.php");
require("include/sisdoc_windows.php");
require("include/sisdoc_email.php");
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');
?>
<TABLE cellpadding="0" cellpadding="0" border="0" width="<?=$tab_max?>" class=lt2 >
<TR align="center" valign="top">
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD width="120" bgcolor="#f0f0f0">
<? require("cliente_menu.php"); ?>
</TD>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD align="left">
<BR><BR><Center>
<font color="green">
Mensagem enviada com sucesso, em breve retornaremos.
</font>
</CENTER>
</TD></TR></TABLE>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
</TR>	
<IFRAME width="300" height="200" src="cliente_relacionamento_enviar.php">

</IFRAME>
<?

require("foot.php");
?>