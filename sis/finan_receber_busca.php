<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$titulo_cab = "Contas a Receber";
$pg = 'finan_receber.php';
$pg_edit = 'finan_receber_edit.php';
$pagina_form = 'finan_receber.php';
$pg_search = 'finan_receber_busca.php';
$pg_pedido = 'pedido_vd_mostra.php';
$vlr = array();
for ($k=0;$k < 35;$k++) { array_push($vlr,0); }

if (strlen($dd[0]) ==0) { $dd[0] = date('Ymd'); }

if (strlen($acao) == 0)
	{
		echo '<P><TABLE width="700" border="1">';
		echo '<TR><TD class="lt5"><CENTER>Busca no '.$titulo_cab.'</CENTER></TD></TR>';
		echo '<TR><TD align="center">';
		require("finan_busca.php");
		echo '</TABLE>';
	} else {
		$sql = "select * from contas_receber ";
		$wh = array();
		$dd[7] = sonumero($dd[7]);
		$dd[8] = sonumero($dd[8]);
		if (strlen($dd[1])==10) { array_push($wh,'cr_venc >= '.brtos($dd[1])); }
		if (strlen($dd[2])==10) { array_push($wh,'cr_venc <= '.brtos($dd[2])); }
		if (strlen($dd[3]) > 0 ) { array_push($wh,"upper((cr_historico)) like '%".UpperCaseSQL($dd[3]). "%'"); }
		if (strlen($dd[4]) > 0 ) { array_push($wh,"upper((cr_pedido)) like '%".UpperCaseSQL(trim($dd[4])). "%'"); }
		if (strlen($dd[5]) > 0 ) { array_push($wh,"upper((cr_doc)) like '%".UpperCaseSQL($dd[5]). "%'"); }
		if (($dd[6] != 'Z' ) and ($dd[6] != 'T' )) { array_push($wh,"cr_status = '".$dd[6]."'"); }
				else { if ($dd[6] == 'Z' ) { array_push($wh,"cr_status != 'X'"); } }

		if ($dd[7] != -1 ) { array_push($wh,'cr_valor > '.$dd[7]); }
		if ($dd[8] < 9999999.99 ) { array_push($wh,'cr_valor < '.$dd[8]); }
			
		$where = '';
		for ($wk = 0 ; $wk < count($wh); $wk++)
			{
			if (strlen($where) > 0) { $where = $where . ' and '; } else { $where = 'where '; }
			$where = $where . ' ('.trim($wh[$wk]).') ';
			}
		$sql = $sql . $where;
		$sql = $sql . ' order by cr_venc desc ';

		$rlt = db_query($sql);
		$saldo = 0;
		$ss = '';
		$pg_cr_close = 'finan_receber_fechar.php';
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
			$linkd='<A HREF="'.$pg.'?dd0='.$line['cr_venc'].'">'; 
			$linkp='';
			if (strlen(trim($line['cr_pedido'])) > 4) { $linkp='<A HREF="#" onclick="newwin('.chr(39).$pg_pedido."?dd0=".trim($line['cr_pedido'])."');".'">'; }
			$ss = $ss .'<TR '.$cor.' class="lt1">';
			$ss = $ss .'<TD align="center">'.$linkd.stodbr($line['cr_venc']).'</TD>';
			$ss = $ss .'<TD align="right"><B>'.$link.numberformat_br($line['cr_valor'],2).'</TD>';
			$ss = $ss .'<TD>&nbsp;'.$link.$line['cr_historico'];
			$ss = $ss .'<TD align="center">&nbsp;'.$linkp.$line['cr_pedido'];
			$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_parcela'];
			$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_doc'];
			$ss = $ss .'<TD align="center">&nbsp;'.$linkc.$line['cr_status'];
			$ss = $ss .'</TR>';
			$saldo = $saldo + $line['cr_valor'];
			}
	require("finan_cab.php");
	?>
	<TABLE cellpadding="2" cellspacing="0" border="1" width="<?=$tab_max?>">
	<TR bgcolor="#c0c0c0" align="center" class="lt0">
	<TD width="9%"><B>vencimento</B></TD>
	<TD width="15%"><B>valor</B></TD>
	<TD><B>histórico / tipo</B></TD>
	<TD width="10%"><B>pedido</B></TD>
	<TD width="10%"><B>parcela</B></TD>
	<TD width="10%"><B>documento</B></TD>
	<TD width="2%"><B>st</TD>
	</TR>
	<?=$ss?>

	</TABLE>
<? } ?>
<? require("foot.php");	?>
