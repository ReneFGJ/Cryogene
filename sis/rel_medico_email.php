<?
require("cab.php");
$tabela = "medico";
$idcp = "md";
$sql="select * from medico order by md_email";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$email = trim($line['md_email']);
	$email_2 = trim($line['md_email_alt']);
	if (strlen($email) > 0) { echo $email.'; '; }
	if (strlen($email_2) > 0) { echo $email_2.'; '; }
	}
	
$sql="select * from cliente ";
$sql .= "where cl_profissao = 'Médico' or cl_profissao = 'MÉDICO' ";
$sql .= "order by cl_email";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$email = trim($line['cl_email']);
	$email_2 = trim($line['cl_email_alt']);
	if (strlen($email) > 0) { echo $email.'; '; }
	if (strlen($email_2) > 0) { echo $email_2.'; '; }
	}

require("foot.php");	?>