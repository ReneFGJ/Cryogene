<? require("par_cab.php"); ?>
<? require("par_security.php"); ?>
<?
$erro=login();
?>
<TR><TD colspan="3"><DIV><FONT class="lt6"><CENTER>Parceiros Cryogene</CENTER></FONT></DIV></TD></TR>
<TR class="lt2"><TD>&nbsp;</TD></TR>
<TR valign="top"><TD valign="middle" bgcolor="#ffffff" width="<?=($tabmax - 320);?>" >
<BR><CENTER>
<img src="img/logo_cryo.png" width="187" height="100" alt="" border="0">
<TD width="20">&nbsp;</TD>
<TD width="300">
<DIV style="width:300"><CENTER>
  <font class="lt2">
  Acesse sua conta
  </font>
  <TABLE class="lt1" align="center" width="250">
  <TR><TD><form method="post" action="parceiro.php"></TD></TR>
  <TR>
  <TD align="right">e-mail:&nbsp;</TD>
  <TD><input type="text" name="dd1" value="<?=$dd[1]?>" size="20" maxlength="50"></TD></TR>
  <TR>
  <TD align="right">senha:&nbsp;</TD>
  <TD><input type="password" name="dd2" value="<?=$dd[2]?>" size="20" maxlength="50"></TD></TR>
  </TR>
  <TR><TD align="right"><input type="checkbox" name="dd3" value="1"></TD>
  <TD class="lt1">Salvar as minhas informações neste computador</TD></TR>
  <TR>
  <TD>&nbsp;</TD>
  <TD><input type="submit" name="acao" value="Acessar"></TD>
  </TR>
  <TR><TD></form></TD></TR>
  <TR><TD colspan="2">&nbsp;<font color="red"><?=$erro?></font>&nbsp;</TD></TR>
  </TABLE>
</DIV>
</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD colspan="3"><DIV><CENTER><BR>
<font class=lt1>Este é o site de relacionamento da Cryogene com seus parceiros, 
<BR>caso estaja com problemas de acesso, 
<BR>entre em contato pelo e-mail cryogene@cryogene.inf.br.<BR>&nbsp;</font></DIV></TD></TR>
</TABLE>	