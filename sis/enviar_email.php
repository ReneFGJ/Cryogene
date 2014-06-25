<?
require("db.php");
require($include."sisdoc_email.php");
require($include."sisdoc_data.php");
global $email_adm, $admin_nome;

if (strlen($dd[10]) == 0)
	{
	echo 'Mailing não definido';
	exit;
	}
ini_set("sendmail_from", "info@cryogene.com.br");
ini_set("SMTP", "smtp.cryogene.com.br");
ini_set("sendmail_path","sendmail -t -i -F ".$email_admin." -f ".$email_admin);
//upload_max_filesize
//phpinfo();

$site = "http://www.cryogene.inf.br/";
$email_adm = "info@cryogene.com.br";
$admin_nome = "Cryogene";
//$debug = true;

if ($dd[99] == 'novo')
	{
	$sql = "update ".$dd[10]." set ml_valido=0 ";
	$sql .= " , ml_ativo = 1 ";
	$rlt = db_query($sql);
	echo '<CENTER>ZERADO</CENTER>';
	}

$e1 = "renefgj@gmail.com";
$e2 = "info@cryogene.com.br";
$e3 = "Cryogene ".nomemes(intval(date("m")))."/".date("Y");
$e4 = "";
$sql = "select * from mail_pg where id_mpg = ".$dd[0];

$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$e3 = trim($line['mpg_descricao']).' '.nomemes(intval(date("m")))."/".date("Y");
	$e4 = $line['mpg_content'];
	$e5 = $line['mpg_codigo'];
	}
$sql = "select * from ".$dd[10]." where ml_ativo=1 limit 1";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$id = $line['id_ml'];
	$e1 = $line['ml_email'];

	$sql = "update ".$dd[10]." set ml_ativo = 2 where id_ml = ".$id.'; ';
	$rlt = db_query($sql);
	$sql = " update mail_pg set mpg_enviado=(mpg_enviado+1) where id_mpg=".$dd[0]." ";
	$rlt = db_query($sql);
	
	////////////////////////// retirar
	$ss .= '<BR><BR><TABLE width="600" align="center"><TR><TD>';
	$ss .= '<DIV align="justify">';
	$ss .= '<font face="ARIAL" color="#808080" style="font-size: 10px;">';
	$ss .= "A Cryogene respeita a privacidade de sua conta de correio eletronico e é contra o spam. ";
	$ss .= "Mantendo sigilo de seu cadastro a terceiros faz parte de nossa politica de privacidade. Você optou por receber este e-mail, e por esta recebendo novidades sobre a Cryogene. ";
	$ss .= "Mas se deseja não mais receber e-mails da Cryogene, ";
	$ss .= '<A Href="http:/www.cryogene.inf.br/remover.php?dd0='.$e1.'">';
	$ss .= "clique aqui.</A> ";
	$ss .= "<BR><BR>";
	$ss .= "Não responda este e-mail, ele é enviando automaticamente"; 
	$ss .= '</DIV>';
	$ss .= "</TD></TR></TABLE>";
	$ss .= '<img src="'.$site.'wb/lido.php?dd0='.$e1.'&dd1='.$e5.'&dd10='.$dd[10].'" alt="" border="0" width="1" height="1">';
	
	////////////// Une com informações adicionais
	$e4 .= $ss;
	$rsp = enviaremail($e1,$e2,$e3,$e4);
//	$rsp = enviaremail('renefgj@gmail.com',$e2,$e3,$e4);


	$msg = "enviado para <B>".$e1.' '.$rsp.'</B><BR><BR>';
	$msg .= "as ".date("d/m/Y H:i:s");
	/////////////
	$ddx = intval('0'.$dd[1]);
	$ddx++;
	?>
	<CENTER>
	<font face="Arial" color="#0080c0" style="font-size : 12px;">
	WEB Mailing Direto (Send)
	</font>
	<HR>
	<font face="Arial" style="font-size : 12px;">
	<?=$msg; ?>
MST
	<? $site = "http://www.cryogene.inf.br/"; ?>
	<META HTTP-EQUIV="Refresh" CONTENT="3;URL=<?=$site;?>enviar_email.php?dd0=<?=$dd[0];?>&dd1=<?=$ddx;?>&dd10=<?=$dd[10];?>">
	<?
	if ($rsp != "OK")
		{
		//$rsp = enviaremail('rene@sisdoc.com.br','Erro de envio',$e1,'');
		}
	
	} else {
	echo 'Fim do envio '.date("d/m/Y H:i:s");
	}
	?>
	