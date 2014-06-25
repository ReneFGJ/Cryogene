<?
require("wb_cab.php");
require("include/sisdoc_email.php");
require("include/sisdoc_data.php");
global $email_adm;
$site = "http://www.revivendomusicas.com.br/";
$email_adm = "revivendo@revivendomusicas.com.br";
//$debug = true;

if ($dd[99] == 'novo')
	{
	$sql = "update mailing set ml_valido=0 ";
	$sql .= " , ml_ativo = 1 ";
	$rlt = db_query($sql);
	echo '<CENTER>ZERADO</CENTER>';
	}

$e1 = "rene@sisdoc.com.br";
$e2 = "revivendo@revivendomusicas.com.br";
$e3 = "Lançamentos Revivendo ".nomemes(intval(date("m")))."/".date("Y");
$e4 = "BODY";
$sql = "select * from mail where id_m = ".$dd[0];

$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$e3 = trim($line['m_descricao']).' '.nomemes(intval(date("m")))."/".date("Y");
	$e4 = $line['m_content'];
	
	}
$sql = "select * from mailing where ml_valido = 0 and ml_ativo=1 limit 1";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$id = $line['id_ml'];
	$e1 = $line['ml_email'];

	$sql = "update mailing set ml_valido = 1 where id_ml = ".$id;
	$rlt = db_query($sql);
	
	////////////////////////// retirar
	$ss .= '<BR><BR><TABLE width="600" align="center"><TR><TD>';
	$ss .= '<DIV align="justify">';
	$ss .= '<font face="ARIAL" style="font-size: 10px;">';
	$ss .= "A Revivendo Músicas respeita a privacidade de sua conta de correio eletronico e é contra o spam. ";
	$ss .= "Mantendo sigilo de seu cadastro a terceiros faz parte de nossa politica de privacidade. Você optou por receber este e-mail, e por esta recebendo novidades sobre a Revivendo. ";
	$ss .= "Mas se deseja não mais receber e-mails da Revivendo, ";
	$ss .= '<A Href="'.$site.'wb_remover.php?dd0='.$e1.'">';
	$ss .= "clique aqui.</A> ";
	$ss .= "<BR><BR>";
	$ss .= "Não responda este e-mail, ele é enviando automaticamente"; 
	$ss .= '</DIV>';
	$ss .= "</TD></TR></TABLE>";
	$ss .= '<img src="http://www.revivendomusicas.com.br/wb_lido.php?dd0='.$e1.'" alt="" border="0" width="1" height="1">';
	////////////// Une com informações adicionais
	$e4 .= $ss;
//	$e1 = 'rene@sisdoc.com.br';
	enviaremail($e1,$e2,$e3,$e4);
	$msg = "enviado para <B>".$e1.'</B><BR><BR>';
	$msg .= "as ".date("d/m/Y H:i:s");
	/////////////
	$ddx = intval('0'.$dd[1]);
	$ddx++;
	?>
	<CENTER><font face="Arial" color="#0080c0" style="font-size : 22px;">WEB Mailing Direto (Send)</font>
	<font face="Arial" style="font-size : 12px;">
	<?=$msg; ?>
	<META HTTP-EQUIV="Refresh" CONTENT="15;URL=<?=$site;?>wb_enviar_email_2.php?dd0=<?=$dd[0];?>&dd1=<?=$ddx;?>">
	<?
	} else {
	echo 'Fim do envio '.date("d/m/Y H:i:S");
	}
	?>
	