<?
require($include."sisdoc_debug.php");
if (strlen($acao) > 0)
	{
	$sql = "update proposta_contrato set ppc_status = 'A' ";
	$sql .= " where id_ppc = ".$dd[0];
	$rlt = db_query($sql);
	
	redirecina("proposta.php?dd0=".$dd[0]);
	exit;
	}
	$isql = "select * from ic_noticia where nw_ref = 'PROP_A' ";
	$rlt = db_query($isql);
	
	if ($line = db_read($rlt))
		{
		$dd[2] = mst($line['nw_descricao']);
		}

?>
<CENTER><H1>Proposta por correio</H1></CENTER>
<TABLE width="<?=$tab_max;?>">
<TR><TD>
Nome: <B><?=$nome;?></B><BR>
Cidade: <B><?=$cida;?></B><BR>
<BR>
<form action="proposta.php" method="post">
<input type="hidden" name="dd0" value="<?=$dd[0];?>">
<input type="submit" name="acao" value="reenviar por e-email">
</form>
</TD></TR>
</TABLE>