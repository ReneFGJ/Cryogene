<?
require("db.php");
global $saved;

require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_cookie.php");
require($include."cp2_gravar.php");

$user_id = read_cookie('nw_user');
$user_nome = read_cookie('nw_user_nome');
$user_nivel = read_cookie('nw_nivel');
$user_log = strtolower(substr(read_cookie('nw_log'),0,15));
$user_log = strtoupper(substr($user_log,0,1)).substr($user_log,1,14);

$opt = troca($dd[50],'*','&');

$tabela = "cliente_relacionamento";
$cp = array();
array_push($cp,array('$H8','id_crl','id_crl',False,True,''));
array_push($cp,array('$H8','crl_data','Data',False,True,''));
array_push($cp,array('$O '.$opt,'crl_contrato','Contrato:',False,True,''));
array_push($cp,array('$H4','crl_hora','Hora',False,True,''));
array_push($cp,array('$H3','crl_cliente',$dd[51],False,True,''));
array_push($cp,array('$A','',' '.$user_log.' ',False,True,''));
array_push($cp,array('$H8','crl_log',$user_log,False,True,''));
array_push($cp,array('$S40','crl_contato','Nome contato',True,True,''));
array_push($cp,array('$T40:5','crl_content','Texto',True,True,''));

$dd[1] = $user_log;
//if (strlen($dd[50]) > 0) { $dd[2] = $dd[50]; }
if (strlen($dd[51]) > 0) { $dd[3] = $dd[52]; }
$dd[3] = date("H:i");
$dd[1] = date("Ymd");
$dd[6] = $user_log;

echo '<font class="lt5">Relacionamento</font>';

$http_redirect = 'close.php';
editar();
?>
<link rel="STYLESHEET" type="text/css" href="letras.css">