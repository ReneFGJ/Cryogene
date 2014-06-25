<?
require("cab.php");
require($include."sisdoc_colunas.php");
?>
<font class="lt5">Pesquisa de Satisfação</font>
<?
	$sql = "select pfl_codigo,pfl_ordem, pfl_descricao, pes_dados, count(*) as c from iso_pesquisa_field ";
	$sql .= " left join iso_pesquisa on pes_codigo = pfl_codigo ";

	$sql .= " left join contrato on pes_contrato = ctr_numero ";
	$sql .= " left join coleta on ctr_numero = col_contrato ";

	$sql .= " where pes_ativo=1 ";

	if (strlen($dd[0]) > 0)
	{
	$sql .= " and (col_dp_data >= ".$dd[0]."0000 and col_dp_data <= ".$dd[0]."9999) ";
	}
	$sql .= " and (col_dp_data >= 20070000)";

	$sql .= " group by pfl_ordem, pfl_descricao, pfl_codigo, pes_dados ";
	$sql .= " order by pfl_ordem ";
	$rlt = db_query($sql);
	echo '<TABLE width="'.$tab_max.'" class="lt1">';
	echo '<TR><TH>Item avaliado';
	echo '<TH width="10%">Ótimo';
	echo '<TH width="10%">Bom';
	echo '<TH width="10%">Regular';
	echo '<TH width="10%">Ruim';
	echo '<TH width="10%">Péssimo';

	$ca = array(0,0,0,0,0,0,0);
	$cx = "X";
	$mst = 0;
	$tot = 0;
	while ($line = db_read($rlt))
		{
		$cod = $line['pfl_codigo'];
		$total = $line['c'];
		if ($cx != $cod)
			{ 
			$to = $ca[0]+$ca[1]+$ca[2]+$ca[3]+$ca[4];
			if ($to > $tot) { $tot = $to; }
			if ($to > 0)
				{
				echo '<TR '.coluna().'><TD>';
				echo $desc;
				$cc = array('','','','','');
				for ($p=0;$p < 5;$p++)
					{
					if ($to > 0)
						{ $cc[$p] = numberformat_br((intval($ca[$p]/$to *1000)/10),1).'%'; }
					echo '<TD align="center"><NOBR>'.$cc[$p].' ('.$ca[$p].')';
					}
				}
			$ca = array(0,0,0,0,0,0,0);
			
			$cx = $cod;
			}
		$op = intval("0".trim($line['pes_dados']))-1;
		$ca[$op] = $total;
		$desc = $line['pfl_descricao'];
		}
////////////////////////////////////////////////////////////
			$to = $ca[0]+$ca[1]+$ca[2]+$ca[3]+$ca[4];
			echo '<TR '.coluna().'><TD>';
			echo $desc;
			$cc = array('','','','','');
			for ($p=0;$p < 5;$p++)
				{
				if ($to > 0)
					{ $cc[$p] = numberformat_br((intval($ca[$p]/$to *1000)/10),1).'%'; }
				echo '<TD align="center">'.$cc[$p].' ('.$ca[$p].')';
				}
		echo '</TABLE>';

		echo 'Total de '.$tot.' avaliações';
		$s = '<BR><BR>Delimitação ';
		for ($r=2007;$r <= date("Y");$r++)
			{
			$link = 'iso_rel_pesquisa_1.php?dd0='.$r;
			$s .= '<A HREF="'.$link.'">'.$r."</A> ";
			}
		echo $s;
?>

<? require("foot.php");?>