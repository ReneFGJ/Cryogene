<?php
require ("cab.php");
require ("_class/_class_sms.php");
$sms = new sms;
//$sms->strucuture();
echo $sms -> sms_form();
if (strlen($dd[5]) > 0) {
	/* dados */
	$phone = $dd[3] . $dd[4];

	$sms -> mensagem = $dd[5];
	$sms -> destinatario = $phone;
	$ok = $sms -> sms_envia();

	echo $sms -> mostra_erro($ok);
}

echo $hd -> foot();
?>