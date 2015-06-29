<?
require("cab.php");

$link = 'http://www.cryogene.com.br/ic_mailing_export.php';
	$arq = fopen($link,'r');
	$ok = 1;
	$s = '';
	while ($ok == 1)
		{
		$sr = fread($arq,1024);
		$s .= $sr;
		if (strlen($sr)==0) { $ok = 0; }
		}
	$msg = array();
	//echo $s;
$sr = $s;

$isql = '';
$tt=0;
while (strpos($sr,'<BR>') > 0)
	{
	$email = substr($sr,0,strpos($sr,'<BR>'));
	$sr = substr($sr,strpos($sr,'<BR>')+4,strlen($sr));
	if (strlen($email) > 0)
		{
			$sql = "select * from mailing_cryo where ml_email = '".$email."' ";
//			echo $sql;
//			echo '<BR>';
			$rlte = db_query($sql);
			if (!($xline = db_read($rlte)))
				{		
				echo '<BR>==>'.$email;
				echo '<font color="green">cadastro</font>';
				$isql = "insert into mailing_cryo (ml_tipo,ml_nome,ml_email,ml_data,ml_hora,ml_ativo) values (";
				$isql .= "'00001','','".$email."','".date("Ymd")."','".date("H:i")."',1); ".chr(13);
				$rlte = db_query($isql);
				$tt++;
				}
		}
	}
	if (strlen($isql) > 0)
		{
		$rlte = db_query($isql);		
		}
echo '<BR>Total de '.$tt.' e-mail importados do sistema';
require("foot.php");
?>