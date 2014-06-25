<?
require($include."sisdoc_debug.php");
require($include."sisdoc_email.php");
if (strlen($acao) > 0)
	{
	$asql = "select * from contrato_ficha ";
	$asql .= "where fx_proposta = '".strzero($dd[0],7)."' ";
	$rlt = db_query($asql);
	if ($line = db_read($rlt))
		{
			echo 'j� foi gravado';
		} else {
			$sql = "insert into contrato_ficha (";
			$sql .= "fx_proposta,fx_mae_email,fx_pai_email";
			$sql .= ") values (";
			$sql .= "'".$proposta."','".$emai1."','".$emai2."'";
			$sql .= ")";
			$rlt = db_query($sql);
			$rlt = db_query($asql);
			$line = db_read($rlt);
		}
	$email1 = $line['fx_mae_email'];		
	$email2 = $line['fx_pai_email'];		
	

		$body = mst($dd[2]);

		$subject = "Proposta de servico";
		$mailheaders = "From: $email_admin\n";
		$mailheaders .= "To: ";
		for ($kx=0;$kx < count($mailerlist);$kx++)
			{
			$mailheaders .= $mailerlist[$kx].';';
			}
		$mailheaders .= "\n";
		$mailheaders .= "BCC: <rene@sisdoc.com.br>\n";
		$mailheaders .= "Subject: ".$subject."\n";
		$mailheaders .= "Date: Thu, ".date("d")." ".date("M")." ".date("Y")." ".date("H:i:s")." -0300\n";
		$mailheaders .= "Importance: NormalFrom: $email\n";
		$mailheaders .= "Content-Type: text/html; charset=iso-8859-1\n";
		
///////////////////////////////////////////////////////
		$links = '<A HREF="http://www.cryogene.inf.br/atendimento/fichacadastral.php';
		$links .= '?dd0='.$dd[0];
		$links .= '&dd1=';
		$links .= '$dd2='.md5($chave.$dd[0]);
		$links .= '" target="NEWS'.date("Hmis").'">Click aqui para Preenxer a ficha cadastral</A>';
		
		$body .= '<BR><BR>'.$links.'<BR><BR><BR>';
		
		if (strlen($email1) > 0)
		{ enviaremail("$email1", "$subject", "", "$body"); }
		if (strlen($email2) > 0)
		{ enviaremail("$email2", "$subject", "", "$body"); }
				
	echo '<BR><BR><BR>e-mail enviando para '.$email1.'';
	$ss = chr(13)."Enviado em ".date("d/m/Y H:i").chr(13);
	$dd[3] = $dd[3].'-----------------------------------'.$ss.$dd[2].chr(13).'--------------------------------'.chr(13);
	$sql = "update proposta_contrato set ppc_obs = '".$dd[3]."' ";
	$sql .= ", ppc_status = 'B' ";
	$sql .= " where id_ppc = ".$dd[0];
	$rlt = db_query($sql);
	exit;
	}
	$isql = "select * from ic_noticia where nw_ref = 'PROP_A' ";
	$rlt = db_query($isql);
	
	if ($line = db_read($rlt))
		{
		$dd[2] = mst($line['nw_descricao']);
		$dd[2] = troca($dd[2],'$NOME','<B>'.trim($nome).'</B>');
		}

?>
<CENTER><H1>Enviar proposta por e-mail</H1></CENTER>
<TABLE width="<?=$tab_max;?>">
<TR><TD>
Nome: <B><?=$nome;?></B><BR>
Cidade: <B><?=$cida;?></B><BR>
<BR>
<TR><TD>
<form action="proposta.php" method="post">
texto do e-mail<BR>
<textarea cols="60" rows="10" name="dd2"><?=$dd[2];?></textarea>
<BR>
coment�rios
observa��es<BR>
<textarea cols="60" rows="3" name="dd3"><?=$dd[3];?></textarea>

<input type="hidden" name="dd0" value="<?=$dd[0];?>">
<input type="submit" name="acao" value="enviar ficha e modelo de contrato por e-mail">
</form>
</TD></TR>
</TABLE>