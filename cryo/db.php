<?
ob_start();
global $email_adm;
$include .= "../include/";
$include = "include/";
//-------------------------------------- Paramentros para DEBUG
//ini_set('display_errors', 255);
//ini_set('error_reporting', 7);
$email_adm = "info@cryogene.com.br";

//-------------------------------------- Diretѓrios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir_public = $dir . '/img/ic/';
$img_dir = '/img/ic/';
$img_pub_dir = '/img/ic/';
$http_site = '/img/ic/';
$http_public = '/img/ic/';
$tab_max = "98%";
$secu = "cryogene2009";
//----------------------------------------------------------
require("include/sisdoc_char.php"); 
require("include/sisdoc_sql.php"); 
require('include/sisdoc_debug.php');
//-------------------------------------- Definiчѕes Iniciais
define(site,'http://www.cryogene.inf.br');
define(http,'http://www.cryogene.inf.br/');
define(idioma,"pt_br");
define(path,''.$_SERVER['PATH_INFO']);
define(host,getServerHost());
define(secu,'cryogene2009');
$path = substr(path,1,100);
$charset = "ASCII";
//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{
	$varf='dd'.$k;
	$varf=$vars[$varf];
	//if (isset($varf) and ($k > 1)) {	//$varf = str_replace($varf,"A","Д"); }
	$dd[$k] = troca($varf,"'","Д");
	}
$acao = $vars['acao'];
$nocab = $vars['nocab'];
//-------------------------------------- Determina o Idioma de Navegaчуo
$idv = $vars['idioma'];
//-------------------------------------- Recuperar dados de GET / POST
function getServerHost() {
return isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST']
		: (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
		: (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
		: 'localhost'));
}
//require("db_cryogene.php");
require("db_cryogene_webhost.php");
?>