<?
require("cab.php");
require($include."sisdoc_data.php");
$sql = "select * from nitrogenio_tanque where tq_codigo = '".$dd[0]."'";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$tq_nome = $line['tq_descricao'];
	$tq_cod  = $line['tq_codigo'];
	$tq_tipo  = $line['tq_tipo'];
	}
?>
<TABLE width="<?=$tab_max;?>" align="center">
<TR valign="top"><TD><?=$tq_nome;?>
<? if (strlen($tq_tipo == 1)) { ?>
<? require("nitrogenio_tanque_detalhe_locacao.php"); ?>
<? } ?>
</TD>
<? if (strlen($tq_tipo == 0)) { ?>
<TD width="400">
<A HREF="ed_edit.php?dd99=nitro_entrada&dd1=<?=$dd[0];?>" class=lt1 >.: novo abastecimento :.</A>
<? require("nitrogenio_tanque_detalhe_entrada.php"); ?>
</TD>
<? } ?>
</TR>

</TABLE>