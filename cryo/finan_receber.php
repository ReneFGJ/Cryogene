<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_data.php');
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$titulo_cab = "Contas a Receber";
$pg = 'finan_receber.php';
$pg_edit = 'finan_receber_edit.php';
$pg_search = 'finan_receber_busca.php';
$pg_cal = 'finan_calendario.php';

$vlr = array();
for ($k=0;$k < 35;$k++) { array_push($vlr,0); }

if (strlen($dd[0]) ==0) { $dd[0] = date('Ymd'); }

$sql = "select sum(cr_valor) as valor,cr_venc from ";
$sql .= "(select cr_valor as cr_valor,cr_venc as cr_venc from contas_receber where cr_status <> 'X' and (cr_venc >= ".substr($dd[0],0,6)."01 and cr_venc <= ".substr($dd[0],0,6)."31) ";
$sql .= "union ";
$sql .= "select (bol_valor_boleto+bol_tx_boleto),bol_data_vencimento from cr_boleto where bol_status <> 'X' and (bol_data_vencimento >= ".substr($dd[0],0,6)."01 and bol_data_vencimento <= ".substr($dd[0],0,6)."31) ";
$sql .= ") as tabela ";
$sql .= "group by cr_venc";
$rlt = db_query($sql);
//echo $sql;
while ($line = db_read($rlt))
	{
	$ddia = substr($line['cr_venc'],6,2);
	$vlr[$ddia] = $line['valor'];
	}

//$sql = "ALTER TABLE cc ADD COLUMN cc_ativo int2;";
//$rlt = db_query($sql);	


$sql = "select * from (select id_cr,'R' as tipo,cr_previsao,cr_valor,cr_historico,cr_pedido,cr_status, cr_parcela,cr_doc from contas_receber where cr_status <> 'X' and cr_venc = ".$dd[0].') as tab1 ';
$sql .= " union ";
$sql .= "select * from (select id_bol, 'B',0,(bol_valor_boleto+bol_tx_boleto),trim(bol_sacado) || ' (boleto ' || bol_nosso_numero || ')',bol_contrato,bol_status, '', bol_numero_documento from cr_boleto where bol_status <> 'X' and bol_data_vencimento = ".$dd[0].') as tab2';
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
	$tipo = $line['tipo'];
	if (trim($line['cr_previsao']) == '1') { $cor = 'bgcolor="#ffdfbf"'; }
	if (($sta == 'A') and ($tipo == 'R'))
		{
		$link='<A HREF="#" onclick="newwin('.chr(39).$pg_edit."?dd0=".$line['id_cr']."');".'">';
		$linkc='<A HREF="#" onclick="newwin('.chr(39).$pg_cr_close."?dd0=".$line['id_cr']."');".'">'; 
		}
	$ss = $ss .'<TR '.$cor.' class="lt1">';
	$ss = $ss .'<TD align="right"><B>'.$link.numberformat_br($line['cr_valor'],2).'</TD>';
	$ss = $ss .'<TD>&nbsp;'.$link.$line['cr_historico'];
	
	
	$ped_link = '';
	if (strlen(trim($line['cr_pedido'])) ==7 )
		{
			$ped_link = '<A HREF="#" onclick="newxy('.chr(39).'pedido_vd_mostra.php?dd0='.trim($line['cr_pedido']);
			$ped_link .= "'".',600,600);">';
		}
	$ss = $ss .'<TD align="center">&nbsp;'.$ped_link.$line['cr_pedido'];
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
<TD width="15%"><B>valor</B></TD>
<TD><B>histórico / tipo</B></TD>
<TD width="10%"><B>pedido</B></TD>
<TD width="10%"><B>parcela</B></TD>
<TD width="10%"><B>documento</B></TD>
<TD width="2%"><B>st</TD>
</TR>
<?=$ss?>
</TABLE>
<? require("foot.php");	?>
