<?php
require('db.php');
$tab_max = '98%';
require($include.'sisdoc_debug.php');

require("_class/_class_login.php");
$nw = new login;

require("_class/_class_header.php");
$hd = new header;
echo $hd->cab();

if ($login != 1)
	{
		$nw->security();
	}
function msg($x)
	{
		switch ($x)
			{
			case "": $x = 'Campo obrigatório'; break;				
			}
			
		return($x);
	}
?>
