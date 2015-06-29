<CENTER>ARMAZENAMENTO</CENTER>
<?
$sql = "select * from nitro_armazenagem ";
$sql .= " inner join contrato on na_contrato = ctr_numero ";
$sql .= " inner join cliente on ctr_mae = cl_codigo ";
$sql .= " where na_tanque = '".$dd[0]."'";
$sql .= " order by na_local_1 ";
$rlt = db_query($sql);
$s .= '';
while ($line = db_read($rlt))
	{
	$link = '<A HREF="http://www.cryogene.inf.br/contrato_ver.php?dd0='.$line['id_ctr'].'" target="contrato">';
	$s .= '<TR>';
	$s .= '<TD width="10%"><NOBR>';
	$s .= $line['na_barcod'];
	$s .= '<TD width="10%"><NOBR>';
	$s .= stodbr($line['na_data_quarentena']);
	$s .= '<TD>';
	$s .= $line['cl_nome'];
	$s .= '<TD width="10%">';
	$s .= $link;
	$s .= $line['na_contrato'];
	$s .= '<TD width="10%"><NOBR>';
	$s .= $line['na_local_1'];
	$s .= '</TR>';
	}
?>
<TABLE class="lt1" width="600">
<TR>
<TH>cod.barra</TH>
<TH>data</TH>
<TH>mae</TH>
<TH>contrato</TH>
<TH>local</TH>
</TR>
<?=$s;?>
</TABLE>	
