<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');
$label = "Boletos Bancários";
//
//$sql = "update cr_boleto set bol_status='A'";
//$rlt = db_query($sql);
echo '<font class=lt5>Quitar boleto bancário</font>';
echo '<HR width="'.$tab_max.'">';
if ($user_nivel == 9)
	{
	$sql = "select * from cr_boleto ";
	$sql = $sql . " where bol_status='A' or bol_status='' or bol_status=' '  ";
	$sql = $sql . " order by bol_nosso_numero";
	$rlt = db_query($sql);
	echo '<TABLE width="'.$tab_max.'" class="lt1">';
	echo '<TR bgcolor="#c0c0c0" align="center">';
	echo '<TD><B>venc';
	echo '<TD><B>nosso número';
	echo '<TD><B>valor';
	echo '<TD><B>st';
	echo '<TD><B>sacado';
	echo '<TD><B>documento';
	echo '<TD><B>ação';
	$tot = 0;
	$vlr = 0;
	while ($line = db_read($rlt))
		{
		$link1 = '<A href="#" onclick=newxy('."'boleto_baixa_pop.php?dd0=".$line['id_bol']."',400,200); >[baixar]</A>";
		echo '<TR '.coluna().'>';
		echo '<TD>'.stodbr($line['bol_data_vencimento']);
		echo '<TD>'.$line['bol_nosso_numero'];
		echo '<TD align="right">'.numberformat_br($line['bol_valor_boleto'],2);
		echo '<TD>'.$line['bol_status'];
		echo '<TD>'.$line['bol_sacado'];
		echo '<TD>'.$line['bol_numero_documento'];
		echo '<TD align="center">'.$link1;
//		echo '<TD align="center">'.$link2;
		$vlr = $vlr + $line['bol_valor_boleto'];
		$tot++;
		}
	echo '<TR><TD colspan="10">Total ('.$tot.") R$ ".numberformat_br($vlr,2)."</TD></TR>";
	echo '</TABLE>';
	}
require("foot.php");	
?>