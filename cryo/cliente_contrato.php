<font class="lt5">Contratos</font>
<?
$sql = "select * from contrato ";
$sql .= "left join coleta on ctr_numero = col_contrato ";
$sql .= "where ctr_mae='".$cod."' or ctr_pai = '".$cod."' or ctr_responsavel='".$cod."' ";
$sql .= "order by ctr_status ";
$rlt = db_query($sql);
$contratos = array();
$s = '';
$xsql = "";
while ($line = db_read($rlt))
	{
	///// excluir contratos
	if ($line['id_col'] != 682)
		{
		if (strlen($xsql) > 0)
			{ $xsql .= " or "; }
		$xsql .= "(id_col = ".$line['id_col']." ) ";
		}
	
	$link = '<A HREF="contrato_ver.php?dd0='.$line['id_ctr'].'">';
	array_push($contratos,$line['ctr_numero']);
	$s .= '<TR '.coluna().'>';
	$s .= '<TD>'.$link.$line['ctr_numero'].'</A>';
	$s .= '<TD>'.substr(stodbr($line['ctr_dt_assinatura']),3,8);
	$s .= '<TD>'.$line['col_rn_nome'];
	$s .= '<TD>'.stodbr($line['col_dp_data']);
	$s .= '<TD>'.$line['ctr_status'];
	$s .= '</TR>';
	}

//$xsql = "update coleta set col_contrato = 'X' where ".$xsql;
//$rlt = db_query($xsql);

echo '<TABLE class="lt1" width="100%">';
echo '<TR bgcolor="#c0c0c0" align="center">';
echo '<TH>contrato</TH>';
echo '<TH>dt.ass';
echo '<TH>Nome filho(a)</TH>';
echo '<TH>Nasc</TH>';
echo '<TH>s</TH>';
echo $s;
echo '</TABLE>';
?>