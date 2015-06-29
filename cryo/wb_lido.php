<?
require("db.php");
if (strlen($dd[0]) > 0)
	{
	$sql = "update mailing set ml_valido = ml_valido + 1 where ml_email='".trim($dd[0])."'";
	$result = db_query($sql);
	$ln = chr(71)	.	chr(73)	.	chr(72)	.	chr(56);
	$ln .=chr(57)	.	chr(97) .	chr(1)	.	chr(0);
	$ln .=chr(1)	.	chr(0) .	chr(128).	chr(0);
	$ln .=chr(0)	.	chr(255) .	chr(255).	chr(255);
	
	$ln .=chr(0)	.	chr(0) .	chr(0)	.	chr(44);
	$ln .=chr(0)	.	chr(0) .	chr(0)	.	chr(0);
	$ln .=chr(1)	.	chr(0) .	chr(1)	.	chr(0);
	$ln .=chr(0)	.	chr(2) .	chr(2)	.	chr(68);

	$ln .=chr(1)	.	chr(59) .	chr(197);
	Header("content-type: image/gif");
	echo $ln;
	}
?>

