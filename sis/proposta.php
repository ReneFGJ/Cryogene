<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");

$email_admin = "Cryogene Criogenia Biologica Ltda<info@cryogene.com.br>";
$email = "cryo@cryogene.inf.br";
$recipient = "cryo@cryogene.inf.br";

$sql = "select * from proposta_contrato where id_ppc =".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$sta = $line['ppc_status'];
	$nome = $line['ppc_nome'];
	$cida = $line['ppc_cidade'];
	$uf   = $line['ppc_uf'];
	$emai1 = $line['ppc_email_1'];
	$emai2 = $line['ppc_email_2'];
	$proposta = $line['ppc_codigo'];
	$dd[3] = $line['ppc_obs']; 
	}
	
if ($sta == 'A') { require("proposta_a.php"); }
if ($sta == 'B') { require("proposta_b.php"); }

require("foot.php");
?>