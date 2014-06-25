<?
require("db.php");
require("include/sisdoc_email.php");
$sql = "select * from ic_contact ";
$sql .= "where r_status='A'";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	//enviaremail($email,"contato@abpr.org.br","classinfo : ".$assunto,body)
	$e2 = "cryogene@cryogene.inf.br";
	$e1 = "cryogene@cryogene.inf.br;rene@fonzaghi.com.br";
	$e3 = "[CRYOGENE] Assunto";
	$e4 = '<FONT SIZE=3 face="verdana">Dúvida'.$line['r_texto'];
	enviaremail($e1,$e2,$e3,$e4);
	echo $line['r_texto'];
	}
?>
enviado