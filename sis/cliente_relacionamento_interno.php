<font class="lt5">Relacionamento</font>
<?
$ctr = '';
$xsql = '';
for ($k=0;$k<count($contratos);$k++)
	{
	if ($k > 0) { $ctr .= '*'; $xsql .= ' or ';}
	$ctr .= $contratos[$k].':'.$contratos[$k];
	$xsql .= "crl_contrato = '".trim($contratos[$k])."' ";
	}

$sql = "select * from cliente_relacionamento ";
$sql .= "where ";
$sql .= "(crl_cliente = '".$cod."' )";
if (strlen($xsql) > 0)
	{ $sql .= ' or ( '.$xsql.') '; }
$sql .= " order by crl_data desc, crl_hora desc ";
$rlt = db_query($sql);
$s = '';
while ($line = db_read($rlt))
	{
	$s .= '<TR><TD>';
	$s .= '<fieldset><legend>';
	$s .= stodbr($line['crl_data']).' '.$line['crl_hora'];
	$s .= '</legend>';
	$s .= '<TABLE width="100%" border="0">';
	$s .= '<TR class="lt0"><TD align="right"><B>';
	$s .= $line['crl_log'];
	$s .= '</TD></TR>';
	//////////////////////////
	$s .= '<TR class="lt0"><TD>contato: <B>';
	$s .= trim($line['crl_contato']).'</B></TD></TR>';
//////////////////////////
	$s .= '<TR><TD class="lt1">'.mst($line['crl_content']).'</TD></TR>';
	$s .= '</TABLE>';
	$s .= '</fieldset>';
	$s .= '</TD></TR>';
	}

?>
<TABLE class="lt1" width="200" border=0>
<TR><TD><A HREF="#" onclick="newxy('cliente_relacionamento_popup.php?dd50=<?=$ctr;?>&dd51=<?=$cod;?>',500,300);">[+]</A></TD></TR>
<?=$s; ?>


</TABLE>