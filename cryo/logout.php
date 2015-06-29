<?
$login = 1;
$nocab = 'PR';
require("cab.php");
$user->LimparUsuario();
header("Location: login.php");
echo 'Stoped'; exit;	
?>