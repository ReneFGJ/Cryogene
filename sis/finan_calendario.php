<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$titulo_cab = "Contas a Pagar";
$pg = 'finan_pagar.php';
$pg_edit = 'finan_pagar_edit.php';
$pg_search = 'finan_pagar_busca.php';
if (strlen($dd[0]) ==0) { $dd[0] = date('Ymd'); }
echo '<BR><BR>';
require("finan_calendario_mst.php");
require("cpaga_menu.php");
$dd[0] = $dd2;
echo '<BR><BR>';
require("finan_calendario_mst.php");

$dd[0] = $dd2;
echo '<BR><BR>';
require("finan_calendario_mst.php");

require("foot.php");	?>
