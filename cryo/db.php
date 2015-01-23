<?
ob_start();
session_start();
date_default_timezone_set('UTC');

header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

$include = '../_include/';
$inc = $include;
for ($r=0;$r < 10;$r++)
	{
		if (file_exists($inc.'sisdoc_char.php')) { $include = $inc; $r=99; }
		$inc = '../'.$inc;
	}
//-------------------------------------- Paramentros para DEBUG
//$debug = true;
ini_set('display_errors', 0);
ini_set('error_reporting', 0);
global $user_id,$user_nome,$dd,$user_nivel;
require($include."sisdoc_char.php");
require($include.'sisdoc_sql.php');
require($include.'sisdoc_debug.php');
//-------------------------------------- Paramentros para DEBUG
$debug = true;
//ini_set('display_errors', 0);
//ini_set('error_reporting',7);

//-------------------------------------- Diretorios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$uploaddir = $dir.'/nep/';
//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{
	$varf='dd'.$k;
	$varf=$vars[$varf];
	//if (isset($varf) and ($k > 1)) {	//$varf = str_replace($varf,"A",""); }
	$dd[$k] = troca($varf,"'","´");
	}
$acao = $vars['acao'];
$nocab = $vars['nocab'];
//-------------------------------------- Determina o Idioma de Navegaï¿½ï¿½o
$idv = $vars['idioma'];
//-------------------------------------------- Biblioteca
$tab_max = '95%';
$db_config = '_db/db_cryo.php';

require($db_config);


$charset = 'utf-8';
header('Content-Type: text/html; charset='.$charset);

$edit_mode = round($_SESSION['editmode']);

?>
