
<?
$hoje_tmp = getdate();
$hoje = ($hoje_tmp[hours].":".$hoje_tmp[minutes].":".$hoje_tmp[seconds]);

$destino = "cristina.mallmann@corp.plugin.com.br, cristina.mallmann@gmail.com";
$conteudo = "<font color=\"red\"> Teste Funcao Mail - webcaldas.com.br</font> $hoje";
$headers = "From: Sistema UOLHOST <norelay@uolhostidc.com.br>\n";


//$returnpath = "emailderetorno@dominio.com.br"
$headers .= "X-Mailer: PHP5\n";
$headers .= "X-Priority: 3\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html;boundary=\"==MIME_BOUNDRY_alt_main_message\"\n\n";
$assunto = "Teste Funcao Mail - webcaldas.com.br";
$enviou = mail($destino, $assunto, $conteudo, $headers);
if ($enviou)
echo "Enviado $hoje";
else

echo "Nao enviado $hoje";
?> 