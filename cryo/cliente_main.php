<?
require("cliente_cab.php");
require("include/sisdoc_data.php");
require("include/sisdoc_windows.php");
?>
<TABLE cellpadding="0" cellpadding="0" border="0" width="<?=$tab_max?>" class=lt2 >
<TR align="center" valign="top">
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD width="120" bgcolor="#f0f0f0">
<? require("cliente_menu.php"); ?>
</TD>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD align="left">
Bem vindo(a), <B><?=trim($cliente_nome)?>,</B>
<BR><BR>
<?
$cliente_id = strzero($cliente_id,7);
$sql = "select * from contrato ";
$sql .= "left join coleta on col_contrato = ctr_numero ";
$sql .=" where ctr_mae = '".$cliente_id ."' ";
$sql .= " or ctr_pai = '".$cliente_id."' ";
$sql .= " or ctr_responsavel = '".$cliente_id."' ";
$rlt = db_query($sql);

$totc = 0;
$s = '<TABLE class="lt1" width="95%" align="center" border="0" cellpadding="3" cellspacing="0">';
$s .= '<TR><TD colspan="4" class="lt5">Contratos</TD></TR>';
$s .= '<TR bgcolor="#c0c0c0" align="center">';
$s .= '<TD width="10%"><B>contrato</B></TD>';
$s .= '<TD width="10%"><B>dt.assinatura</B></TD>';
$s .= '<TD><B>nome</B></TD>';
$s .= '<TD width="10%"><B>dt.parto</B></TD>';
$s .= '<TD width="10%"><B>situação</B></TD>';
$s .= '</TR>';
while ($line = db_read($rlt))
	{
	$status = $line['ctr_status'];
	if ($status == 'Z') { $status = 'ativo'; }
	if ($status == 'S') { $status = 'ativo'; }
	if ($status == 'D') { $status = 'cancelado'; }
	if ($status == 'N') { $status = 'inativo'; }
	$data_ass = $line['ctr_dt_assinatura'];
	$nr_contrato = trim($line['ctr_numero']).'/'.substr($data_ass,2,2);	
	$s .= '<TR '.coluna().'>';
	$s .= '<TD align="center">';
	$s .= $nr_contrato;
	$s .= '<TD align="center">';
	$s .= stodbr($data_ass);
	$s .= '<TD>'.$line['col_rn_nome'].'</TD>';
	$s .= '<TD align="center">'.stodbr($line['col_dp_data']).'</TD>';
	$s .= '<TD align="center">'.$status.'</TD>';
	$totc++;
	}
$s .= '<TR><TD colspan="10"><B>total de '.$totc.' contrato(s) ativos.</B></TD></TR>';
$s .= '</TABLE>';
echo $s;

//////////////////////////////////////////////////////////////////////////////
$pre_where = "and (bol_status = 'A' or length(trim(bol_status))=0 or (bol_status isnull)) ";
require("cliente_fatura_boleto.php");

?>
</TD>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
</TR>
</TABLE>
<?
require("foot.php");
?>