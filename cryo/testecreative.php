<?
$destino = "suporte@creativehost.com.br";
$conteudo = "Teste";
$headers = "From: Suporte <suporte@creativehost.com.br>\n";
$headers .= "X-Mailer: PHP4\n";
$headers .= "X-Priority: 3\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html;boundary=\"==MIME_BOUNDRY_alt_main_message\"\n\n";
$assunto = "PHP Mail - Teste de envio";
$enviou = mail($destino, $assunto, $conteudo, $headers);
echo "TESTE - A mensagem foi enviada com sucesso !";
?>
