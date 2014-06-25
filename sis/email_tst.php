<?
require("cab.php");
//require($include.'sisdoc_email_autho.php');
require($include.'sisdoc_email_autho.php');

$ema = new email;
$rlt = $ema->resumo();
print_r($rlt);
echo '<HR>';
echo 'Total de '.$ema->resumo_email_enviar().' email(s) para enviar';

echo $ema->enviar_proximo();

$e1 = 'renefgj@gmail.com';
$e2 = '';
$e3 = 'Assunto';
$e4 = 'Conteúdo';
echo enviaremail($e1,$e2,$e3,$e4);
?>
