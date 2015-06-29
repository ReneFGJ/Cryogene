<?
require("cliente_cab.php");
require("include/sisdoc_data.php");
require("include/sisdoc_windows.php");
$cliente_id = strzero($cliente_id,7);
?>
<TABLE cellpadding="0" cellpadding="0" border="0" width="<?=$tab_max?>" class=lt2 >
<TR align="center" valign="top">
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD width="120" bgcolor="#f0f0f0">
<? require("cliente_menu.php"); ?>
</TD>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD align="left">
Prezado(a), <B><?=trim($cliente_nome)?>,</B> em nosso sistemas estão registrados as seguintes faturas:
<BR><BR>
<?
//////////////////////////////////////////////////////////////////////////////
//$pre_where = "and (bol_status = 'A' or length(trim(bol_status))=0 or (bol_status isnull)) ";
require("cliente_fatura_boleto.php");

require("foot.php");
?>