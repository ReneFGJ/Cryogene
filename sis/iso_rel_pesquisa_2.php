<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
?>
<font class="lt5">Pesquisa de Satisfação (lista das respostas)</font>
<?

	$av = array("ótimo","bom","regular","ruim","péssimo");
	
	$sql = "select * from iso_pesquisa_field ";
	$sql .= " left join iso_pesquisa on pes_codigo = pfl_codigo ";
	$sql .= " left join contrato on pes_contrato = ctr_numero ";
	$sql .= " left join coleta on ctr_numero = col_contrato ";

	$sql .= " where pes_ativo=1 ";
	$sql .= " and (col_dp_data >= 20070000)";
	if (strlen($dd[0]) > 0)
	{
	$sql .= " and (col_dp_data >= ".$dd[0]."0000 and col_dp_data <= ".$dd[0]."9999) ";
	}

	$sql .= " order by pes_contrato ";
	$rlt = db_query($sql);

	echo '<TABLE width="'.$tab_max.'" class="lt1">';
	echo '<TR><TH>Item avaliado';
	echo '<TH width="10%">valor';

	$ca = array(0,0,0,0,0,0,0);
	$cx = "X";
	$mst = 0;
	$to = 0;
	while ($line = db_read($rlt))
		{
		$avi = intval('0'.$line['pes_dados'])-1;
		$ctr = $line['pes_contrato'];
		if ($cx != $ctr)
			{ echo '<TR class="lt3"><TD><HR><font class=lt0>Data parto('.stodbr($line['col_dp_data']).')</font><TD><B>'.$ctr.'<TD><HR>'; $cx = $ctr; $to++; }
		echo '<TR '.coluna().'><TD>';
		echo $line['pfl_descricao'];
		echo '<TD align="center">';
		echo $av[$avi];
		echo '<TD>';
		}
		echo '</TABLE>';
		echo 'Total de '.$to.' avaliações';

		$s = '<BR><BR>Delimitação ';
		for ($r=2007;$r <= date("Y");$r++)
			{
			$link = 'iso_rel_pesquisa_2.php?dd0='.$r;
			$s .= '<A HREF="'.$link.'">'.$r."</A> ";
			}
		echo $s;


?>

<? require("foot.php");?>