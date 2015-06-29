<?
require("cab.php");
$sql="select * from cliente order by cl_email";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$email = trim($line['cl_email']);
	$email_2 = trim($line['cl_email_alt']);
	if (strlen($email) > 0) { echo $email.'<BR>'; }
	if (strlen($email_2) > 0) { echo $email_2.'<BR>'; }
	}

require("foot.php");	?>