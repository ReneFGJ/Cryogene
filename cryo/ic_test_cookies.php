<?
ob_start();
$idc = $_COOKIE['ic_test'];
if (strlen($idc) == 0) { $idc = $_COOKIE['ic_test'] . ' [hcv]'; }
echo '<BR>===>'.$idc;
if (strlen($idc) == 0) { setcookie('ic_test','gravado',time()+7200); echo '<BR>Gravado cookie</B>'; }
echo '<BR>';
?>

<?php

// Set a cookie
// Cookie name: name
// Cookie value: Dennis Pallett
// Cookie expire: in 24 hours

setcookie ('name', '<font color=gree>[GRAVADO]</font>', time() + (60*60*24));
?>

<?php
echo 'Status do cookie <B>' . $_COOKIE['name'].'</B>';
echo '<HR>';
print_r($_COOKIE);
echo '<HR>';
echo $_COOKIE[1];
?>
	