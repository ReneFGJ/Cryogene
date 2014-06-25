<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');

$sql = "select * from mail_pg where id_mpg = 0".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$titulo = $line['mpg_descricao'];
	$content = $line['mpg_content'];
	$data    = $line['mpg_data'];
	$enviado = $line['mpg_enviado'];
	$lido    = $line['mpg_lido'];
	$mailing = $line['mpg_mailing'];
	}
	
if (strlen($mailing) > 0)
	{
	$ml = intval($mailing);
	if ($ml > 1)
		{
		$mailing = "mailing_".$ml;
		} else {
		$mailing = "mailing";;
		}
	}
?>
<TABLE width="<?=$tab_max;?>" align="center" border=2>
<TR valign="top"><TD width="550">
<?=$content;?>
</TD>
<TD>
<CENTER>
<font class="lt5">
<?=$titulo;?>
</CENTER>
</font>
<?
$ddd[0] = intval('0'.$enviado);
$ddd[1] = intval('0'.$lido);



?>
<TABLE width="100%" border="0" cellpadding="1" class="lt1">
<TR><TD colspan="2">Enviado em <B><?=stodbr($data);?></B>
<TR><TD align="right"><B><?=$ddd[0];?></TD><TD>Enviados</TD></TR>
<TR><TD align="right"><B><?=$ddd[1];?></TD><TD>Lidos</TD></TR>
</TABLE>
<CENTER>
<HR>
<a href="enviar.php?dd0=<?=$dd[0];?>&dd10=<?=$mailing;?>" target="_new">ENVIAR</a>
<HR>
<?
require("ed_mail_pg_lidos.php");
?>
</TD>
</TR>
</TABLE>