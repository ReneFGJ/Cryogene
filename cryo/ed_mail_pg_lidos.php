<?
$sql = "select * from mail_lido ";
$sql .= "inner join ".$mailing." on lido_email = ml_codigo ";
$sql .= " where lido_campanha = '".strzero($dd[0],5)."' ";
$sql .= " order by lido_data desc,lido_hora desc";
$sql .= " limit 40 ";
$rlt = db_query($sql);
$s = '';
while ($line = db_read($rlt))
	{
	$s .= '<TR>';
	$s .= '<TD align="left">'.$line['ml_email'];
	$s .= '<TD align="center">'.substr($line['lido_data'],6,2).'/'.substr($line['lido_data'],4,2);
	$s .= '<TD align="center">'.$line['lido_hora'];
	$s .= '</TR>';	
	}
?>
<TABLE width="100" class="lt0">
<?=$s;?>
</TABLE>