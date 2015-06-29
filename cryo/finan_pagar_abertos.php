<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','id_p',False,True,''));
array_push($cp,array('$H4','','id_p',False,True,''));
array_push($cp,array('$D8','','Abertos de ',True,True,''));
array_push($cp,array('$D8','','até ',True,True,''));
array_push($cp,array('$O A:Abertos&B:Quitados&X:Cancelados& :Todos','','Tipos ',False,True,''));
if (strlen($dd[2]) == 0) { $dd[2] = "01/01/2008"; }
if (strlen($dd[3]) == 0) { $dd[3] = date("d/m/Y"); }
$http_edit = "finan_pagar_abertos.php";
$tit = "Todos";
if ($dd[4] == "A") { $tit = "Abertos"; }
if ($dd[4] == "B") { $tit = "Quitados"; }
if ($dd[4] == "X") { $tit = "Cancelados"; }

echo '<TABLE width="'.$tab_max.'">';
echo '<TR><TD class="lt5" align="center" colspan="10">Contas em '.$tit.' (Pagar)';
echo '<TR><TD>';
$saved = cp2_gravar();
if ($saved > 0)
	{
	////////////////////////////////////////
	$sql = "select * from contas_pagar where  cr_venc >= ".brtos($dd[2]). ' and cr_venc <= '.brtos($dd[3]);
	if (strlen($dd[4]) > 0)
		{ $sql .= " and cr_status = '".$dd[4]."' "; }
	$rlt = db_query($sql);
	$saldo = 0;
	$ss = '';
	$pg_edit = 'finan_pagar_edit.php';
	$pg_cr_close = 'finan_pagar_fechar.php';
	while ($line = db_read($rlt))
		{
		$sta = trim($line['cr_status']);
		$cor = coluna();
		$linkc = '';
		$link = '';
	
		if (trim($line['cr_previsao']) == '1') { $cor = 'bgcolor="#ffdfbf"'; }
		if ($sta == 'A')
			{
			$link='<A HREF="#" onclick="newwin('.chr(39).$pg_edit."?dd0=".$line['id_cr']."');".'">';
			$linkc='<A HREF="#" onclick="newwin('.chr(39).$pg_cr_close."?dd0=".$line['id_cr']."');".'">'; 
			}
		$ss = $ss .'<TR '.$cor.' class="lt1">';
		$ss = $ss .'<TD align="right"><B>'.$link.numberformat_br($line['cr_valor'],2).'</TD>';
		$ss = $ss .'<TD align="center">&nbsp;'.$link.stodbr($line['cr_venc']);
		$ss = $ss .'<TD>&nbsp;'.$link.$line['cr_historico'];
		$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_pedido'];
		$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_parcela'];
		$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_doc'];
		$ss = $ss .'<TD align="center">&nbsp;'.$linkc.$line['cr_status'];
		$ss = $ss .'</TR>';
		$saldo = $saldo + $line['cr_valor'];
		}
//	require("finan_cab.php");
//	?>
	<TABLE cellpadding="2" cellspacing="0" border="1" width="<?=$tab_max?>">
	<TR bgcolor="#c0c0c0" align="center" class="lt0">
	<TD width="15%"><B>valor</B></TD>
	<TD width="15%"><B>vencimento</B></TD>
	<TD><B>histórico / tipo</B></TD>
	<TD width="10%"><B>pedido</B></TD>
	<TD width="10%"><B>parcela</B></TD>
	<TD width="10%"><B>documento</B></TD>
	<TD width="2%"><B>st</TD>
	</TR>
	<?=$ss?>
	<TR><TD colspan="10" align="right">Total <B><?=numberformat_br($saldo,2);?></B></TD></TR>		
	</TABLE> <?
	} else { 
		editar(); //////////////// pede informações de data para relatorio 
	}
	echo '</TABLE>';	
require("foot.php");

