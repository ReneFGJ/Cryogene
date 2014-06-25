<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include.'sisdoc_email.php');
require($include."sisdoc_data.php");
global $email_adm;

$sql = "select * from ic_noticia where nw_ref = 'BOL_EMAIL'";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$msg = mst($line['nw_descricao']);
	}

if (strlen($dd[0]) ==0)
	{
	echo '<TABLE width="'.$tab_max.'" align="center" class=lt1>';
	echo '<TR><TD>'.$msg.'</TD>';
	echo '</TABLE>';
	echo '<center><form method="post" action="boleto_emitir_email.php">';
	echo 'Titulo do e-mail:';
	echo '<input type="text" name="dd1" value="Anuidade '.date("Y").'" size="60">';
	echo '<input type="submit" name="dd0" value="enviar e-mail para clientes"></form>';
	}

$email_admin = "Cryogene Criogenia Biologica Ltda<info@cryogene.com.br>";
$email = "cryo@cryogene.inf.br";
$recipient = "cryo@cryogene.inf.br";
$subject = $dd[1];

$sql = "update cr_boleto set bol_auto='S' ";
$sql .= " where (bol_auto='E' and bol_status='A') ";
$sql .= " and bol_data_processamento > 20120115 ";
//$rlt = db_query($sql);

$sql = "select * from cr_boleto where (bol_auto='S' and bol_status='A') ";
//$sql .= " or (bol_data_vencimento = '20120205' and bol_valor_boleto > 1 ";
//$sql .= " o bol_valor_boleto < 800 ) ";
$sql .= " and bol_data_processamento > 20120115 ";
$sql .= " order by bol_contrato ";
$rlt = db_query($sql);

echo '<TABLE width="'.$tab_max.'" class="lt1">';
$con = "X";
$vlr = 0;
$nrbol = array();
$nrvnc = array();
$nrvlr = array();
$sc = '';
$ler = true;
$tot = 0;
$toc = 0;
while ($ler)
	{
	$line = db_read($rlt);
//	print_r($line);
//	exit;
	if (!($line)) { $ler = false;}
	$contrato = $line['bol_contrato'];
	$vlr_bol  = $line['bol_valor_boleto'];
	$vlr_tax  = $line['bol_tx_boleto'];
	$nosso = $line['bol_nosso_numero'];
	$tot = $tot + $vlr_bol;
	
//	$nv = round(round($vlr_bol * 100) / 1.1078);
//	$nv = round($nv * 1.0509)/100;

//	$sql = "update cr_boleto set bol_valor_boleto = ";
//	$sql .= $nv;
//	$sql .= " where id_bol = ".$line['id_bol'];
//	$aaarlt = db_query($sql);
	//exit;

	if ($con != $contrato)
		{
///////////////////////////////////////////////		
		if ($vlr > 0)
			{
			$toc++;
			$mailerlist=array();
			$ssq = array();
			array_push($ssq,"select * from contrato left join cliente on cl_codigo = ctr_pai where ctr_numero='".$con."' ");
			array_push($ssq,"select * from contrato left join cliente on cl_codigo = ctr_mae where ctr_numero='".$con."' ");
			array_push($ssq,"select * from contrato left join cliente on cl_codigo = ctr_responsavel where ctr_numero='".$con."' ");
			for ($kz=0;$kz < count($ssq);$kz++)
				{
				//echo '<BR>'.$ssq[$kz].'<BR>';
				$srlt = db_query($ssq[$kz]);
					while ($sline = db_read($srlt))
					{	
					if ($kz==0) { $nome_pai = $sline['cl_nome']; }
					if ($kz==1) { $nome_mae = $sline['cl_nome']; }
					if ($kz==2) { $nome_res = $sline['cl_nome']; }
					$email1 = trim($sline['cl_email']);
					if (strlen($email1) > 0) { $mailerlist = adiciona_email($mailerlist,$email1); }
					$email2 = trim($sline['cl_email_alt']);
					if ((strlen($email2) > 0) and ($email1 != $email2)) { $mailerlist = adiciona_email($mailerlist,$email2); }
					}
				}
			$valor = $vlr;
			echo '<TR><TD colspan="10" height="1" bgcolor="#808080"></TD></TR>';
			echo '<TR '.coluna().' valign="top">';
			echo '<TD>'.$toc.'.';
			echo '<TD align="center">';
			echo $con;
			echo '<TD align="left">';
			echo $nome_mae;
			echo '<BR>'.$nome_pai;
			echo '<TD align="left">';
			for ($kr=0;$kr < count($mailerlist); $kr++)
				{
				if ($kr > 0) { echo '<BR>'; }
				echo $mailerlist[$kr];
				}
			echo '<TD align="right">';
			echo count($nrbol);
			echo '<TD align="right">';
			echo numberformat_br($vlr,2);
			echo '<TD align="center">';
			echo $tip;
			echo '<TD align="center">';
			echo '<font color=green >';
					
			$email = 'rene@sisdoc.com.br';
			$e3 = $dd[1];
			$e4 = 'texto';
			$e2 = 'info@cryogene.com.br';
			$venc = $nrvnc[0];
			$msg2 = troca($msg,'$valor',numberformat_br($valor,2));
			$msg2 = troca($msg2,'$dia_vencimento',substr($venc,6,2));
			$msg2 = troca($msg2,'$mes_vencimento',nomemes(intval(substr($venc,4,2))));
			$msg2 = troca($msg2,'$ano_vencimento',substr($venc,0,4));
			$msg2 = mst($msg2);
			$msg2 .= '<BR>';
			for ($k=0;$k < count($nrbol);$k++)
					{
					$msg2 .= '<BR>';
					$msg2 .= 'Vencimento '.stodbr($nrvnc[$k]).' R$ '.numberformat_br($nrvlr[$k],2);
					$msg2 .= '&nbsp;&nbsp;';
					$msg2 .= '<A HREF="http://www.cryogene.inf.br/bb.php?dd0='.$nrbol[$k].'" target="new">';
					$msg2 .= '[Imprimir boleto]</A>';
					}
			$msg2 .= '<BR><BR>Contrato n. '.$con;
			$msg2 = '<font face=verdada style="font-size=13px;">'.$msg2;
			$sc .= '<HR>'.$msg2;
			
			$mailheaders .= "Content-Type: text/html; charset=iso-8859-1\n";
			if (strlen($dd[0]) > 0)
				{
				for ($kx=0;$kx < count($mailerlist);$kx++)
				{
					$e1 = $mailerlist[$kx] ; enviaremail($e1, "", "$subject", "$msg2");
					enviaremail($mailerlist[$kx], "", "$subject", "$msg2");		
				}					
				$e1 = "info@cryogene.inf.br" ; enviaremail($e1, "", "$subject", "$msg2");
				echo "enviado!";
				echo '<font class="lt0"><BR>Boleto:&nbsp;'.$nosso;
 				} else {
				echo 'preparando envio';
				echo '<font class="lt0"><BR>Boleto&nbsp;'.$nosso;
				}
				//exit;
			}
			////////////////////////////////////////////////
			$con = $contrato;
			$vlr = $vlr_bol + $vlr_tax;
			$nrbol = array($line['id_bol']);
			$nrvlr = array($line['bol_valor_boleto']+$line['bol_tx_boleto']);
			$nrvnc = array($line['bol_data_vencimento']);
		} else {
			$vlr = $vlr + $vlr_bol + $vlr_tax;	
			$tip = $line['bol_tipo'];
			array_push($nrbol,$line['id_bol']);
			array_push($nrvlr,$line['bol_valor_boleto']+$line['bol_tx_boleto']);
			array_push($nrvnc,$line['bol_data_vencimento']);
		}
	}
echo '<TR><TD colspan="5" align="right">Total de '.$toc.' cliente com valor faturado de <B>'.numberformat_br($tot,2).'</TD></TR>';
echo '</TABLE>';

if (strlen($dd[0]) > 0)
	{
	$sql = "update cr_boleto set bol_auto = 'E' where bol_auto='S' ";
	$rlt = db_query($sql);
	echo '<CENTER>Status alterado com sucesso</CENTER>';
	}

require("foot.php");

function adiciona_email($lx,$e1)
	{
//	echo '<BR>>>>>'.$e1;
//	print_r($lx);
//	echo '<HR>';
	$lf = $lx;
	if (strlen($e1) > 0)
		{
		$xok = 0;
		for ($k=0;$k < count($lf);$k++)
			{
			if ($lf[$k]==$e1) { $xok = 1; }
			}
		if ($xok == 0)
			{ array_push($lf,$e1); }
		}
	return($lf);
	}
?>