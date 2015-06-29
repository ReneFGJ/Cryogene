<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$titulo_cab = "Contas a Pagar";
$pg = 'finan_pagar.php';
$pg_edit = 'finan_pagar_edit.php';
$pg_search = 'finan_pagar_busca.php';
$pg_cal = 'finan_calendario.php';

$vlr = array();
for ($k=0;$k < 35;$k++) { array_push($vlr,0); }

if (strlen($dd[0]) ==0) { $dd[0] = date('Ymd'); }

//$sql="DROP TABLE contas_pagar ";
//$rlt = db_query($sql);

//$sql="CREATE TABLE contas_pagar (  id_cr serial NOT NULL,  cr_fatura char(8), cr_cliente char(7),  cr_valor float8,  cr_venc int8,  cr_tipo char(1),  cr_historico char(80),  cr_pedido char(10),  cr_previsao int2,  cr_parcela char(8),  cr_dt_quitacao int8,  cr_status char(1),  cr_img char(15),  cr_doc char(20),  cr_lastupdate int8,  cr_data int8,  cr_conta char(5),  cr_empresa char(3),  cr_valor_original float8,  cr_cc char(7)) ";
//$rlt = db_query($sql);



$sql = "select sum(cr_valor) as valor,cr_venc from contas_pagar where cr_status <> 'X' and (cr_venc >= ".substr($dd[0],0,6)."01 and cr_venc <= ".substr($dd[0],0,6)."31) group by cr_venc";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$ddia = substr($line['cr_venc'],6,2);
	$vlr[$ddia] = $line['valor'];
	}

//$sql = "ALTER TABLE cc ADD COLUMN cc_ativo int2;";
//$rlt = db_query($sql);	
	
$sql = "select * from contas_pagar where cr_status <> 'X' and cr_venc = ".$dd[0];
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
	$ss = $ss .'<TD>&nbsp;'.$link.$line['cr_historico'];
	$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_pedido'];
	$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_parcela'];
	$ss = $ss .'<TD align="center">&nbsp;'.$line['cr_doc'];
	$ss = $ss .'<TD align="center">&nbsp;'.$linkc.strzero($line['id_cr'],7);
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
<TD width="10%"><B>serial</B></TD>
<TD width="2%"><B>st</TD>
</TR>
<?=$ss?>
</TABLE>
<? require("foot.php");	?>
