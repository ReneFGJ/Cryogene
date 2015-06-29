<?
$email = "rene@fonzaghi.com.br";
$from = "info@cryogene.inf.br";
mail($email, "Assunto", "Texto", "From: $from");
print "Mensagem enviada com sucesso para $email de $from!";
?>