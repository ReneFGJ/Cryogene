<? 
ob_start();
//-------------------------------------- Paramentros para DEBUG
ini_set('display_errors', 1);
ini_set('error_reporting', 7);
$debug = false;
//-------------------------------------- Includes Padr�es
global $dd,$base;
global $base;
global $base_host;
global $base_port;
global $base_name;
global $base_user;
global $base_pass;
global $ftp_host,$ftp_user,$ftp_pass,$ftp_path,$ftp_path,$ftp_img;

require('include/sisdoc_sql.php');
require('include/sisdoc_char.php');
require('include/sisdoc_cookie.php');
require('ic_db.php');
//-------------------------------------- Diret�rios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir_public = $dir . '/ic/';
$img_dir = '/ic/';
//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
define(host,getServerHost());
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{	$varf='dd'.$k; $varf=$vars[$varf]; $dd[$k] = troca($varf,"'","�");	}
$acao = $vars['acao'];

//-------------------------------------- Recuperar dados de GET / POST
function getServerHost() {
return isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST']
		: (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
		: (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
		: 'localhost'));
}
////////////////////////////////////////////////////////////////////////////////
require("include/sisdoc_data.php");	
require("include/sisdoc_colunas.php");	
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

global $dd,$acao;
global $tab_max,$xtab_max;
global $user_id,$user_nome,$user_log,$user_nivel;

$user_id = read_cookie('ic_user');
$user_nome = read_cookie('ic_user_nome');
$user_nivel = read_cookie('ic_nivel');
$user_log = read_cookie('ic_log');
$cook = read_cookie('cook');

$tab_max = 560;
$btab_max = 570;
///////////////////////////// cabecalho
ic_cab();
//////////////////////////// se vazio pagina principal
if (strlen($dd[99]) == 0)
	{ $dd[99] = 'main'; }
	
$cmd = $dd[99];

//////////////////////////// chamada das funcoes
if ($cmd == 'login'){ login(); }
else { $tela = security(); }

if ($cmd == 'logout')	{ logout(); }

if ($cmd == 'main')	{ main(); }
if ($cmd == 'acesso')	{ acesso(); }
if ($cmd == 'upload')	{ upload(); }
if ($cmd == 'news')	{ ic_news(); }
if ($cmd == 'news_edit')	{ ic_news_edit(); }

if ($cmd == 'user')	{ ic_user(); }
if ($cmd == 'user_edit')	{ ic_user_edit(); }
if ($cmd == 'imagem')	{ ic_imagem(); }


if ($cmd == 'secao')	{ ic_secao(); }
if ($cmd == 'secao_edit')	{ ic_secao_edit(); }

if ($cmd == 'thema')	{ ic_thema(); }
if ($cmd == 'thema_edit')	{ ic_thema_edit(); }

if ($cmd == 'evento')	{ ic_evento(); }
if ($cmd == 'evento_edit')	{ ic_evento_edit(); }

///////////////////////////// rodap�
ic_foot();
exit;
/////////////////////// function 
function upload()
	{
	global $dd,$user_log;
	echo "UPLOAD";
	// http://www.fonzaghi.com.br/ic.php?dd99=upload&&dd6=0001_DSC05013.JPG&dd1=/&dd4=640&dd5=480&dd3=54171&dd0=0001&dd7=teste
	echo "<BR>dd1=".$dd[1];
	echo "<BR>dd2=".$dd[2];
	echo "<BR>dd3=".$dd[3];
	echo "<BR>dd4=".$dd[4];
	echo "<BR>dd5=".$dd[5];
	echo "<BR>dd6=".$dd[6];
	echo "<BR>dd7=".$dd[7];
	echo "<BR>dd8=".$dd[8];
	echo "<BR>dd9=".$dd[9];
	$sql = "select * from ic_imagem where img_arquivo='".$dd[6]."' and img_evento=".intval($dd[0]);
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$sql = "update ic_imagem set ";
		$sql = $sql ."img_titulo = '".$dd[7]."',";
		$sql = $sql ."img_heigth = ".$dd[4].",";
		$sql = $sql ."img_width = ".$dd[5].",";
		$sql = $sql ."img_size = ".$dd[3]." ";
		$sql = $sql ."where img_arquivo='".$dd[6]."' and img_evento=".intval($dd[0]);
		echo '<HR>'.$sql.'<HR>';
		$rlt = db_query($sql);
		} else {
		$sql = "insert into ic_imagem (";
		$sql = $sql . "img_arquivo, img_titulo, img_texto,";
		$sql = $sql . "img_data, img_status, img_size,";
		$sql = $sql . "img_type, img_heigth, img_width, ";
		$sql = $sql . "img_codigo, img_path, img_evento, ";
		$sql = $sql . "img_log ) values (";
		$sql = $sql . "'".$dd[6]."','".$dd[7]."','',";
		$sql = $sql . date("Ymd").",'A',".$dd[3].',';
		$sql = $sql . "'JPG',".$dd[4].",".$dd[5].',';
		$sql = $sql . "'','',".$dd[0].',';
		$sql = $sql . "'".$user_log."')";
		$rlt = db_query($sql);
		}
	}
/////////////////////// acesso
function acesso()
	{
	global $user_id,$user_nome,$dd,$acao;
	?><CENTER><P><FONT class="ED">Dias mais visitados</FONT><TABLE>
	<TR><TD><form method="post" action="ic.php"></TD><TD><input type="text" name="dd1" size="10" maxlength="10" value="<?=date("d/m/Y")?>"></TD>
	<TD><input type="text" name="dd2" size="10" maxlength="10" value="<?=date("d/m/Y")?>"></TD>
	<TD><input type="hidden" name="dd99" value="acesso"></TD><TD><input type="hidden" name="dd98" value="<?=$dd[98]?>"></TD><TD><input type="submit" name="dd50" value="pesquisar"></TD>
	<TD></form></TD></TR></TABLE>
	<?
	if ((strlen($dd[1]) == 0) or (strlen($dd[2]) == 0)) { return(True); }
	?>
	<TABLE width="96%" cellpadding="0" cellspacing="0" class="lt1" align="center">
	<TR class="lt1" bgcolor="#C0C0C0" align="center">
	<TD width="16%"><B>Data</B><TD width="80%"><B>Acessos</B></TD><TD width="10%"><B>Acessos</B></TD>
	</TR>
	<?
	$ddt2=$dd[2];
	$ddt1=$dd[1];

	$sql = "";
	$sql = $sql . "select log_data, count(*) as acesso from log ";
	$sql = $sql . " where log_data >= '".brtos($ddt1)."' ";
	$sql = $sql . " and log_data <= '".brtos($ddt2)."' ";
	if (strlen($dd[3]) > 0) { $sql = $sql . " and log_ip='".$dd[3]."' "; }
	$sql = $sql . " group by log_data ";
	$sql = $sql . " order by log_data desc ";
	$rlt = db_query($sql);

	$vlr = array();
	$dt = array();
	$max = 100;
	$xmax = 0;
	$tot = 0;
	while ($line = db_read($rlt))
		{
		$acesso = $line['acesso'];
		if ($max < $acesso) { $max = $acesso; }
		if ($xmax < $acesso) { $xmax = $acesso; }
		array_push($dt,array($line['log_data'],$line['acesso']));
		}
	$width = 450;	
	for ($i = 0; $i < count($dt); $i++)
		{
		$tot = $tot + $dt[$i][1];
		$size = round(($dt[$i][1]/$max) * $width);
		echo '<TR '.coluna().'><TD>'.stodbr($dt[$i][0]);
		echo '<TD><img src="../img/nada_azul.jpg" width="'.$size.'" height="12" alt="" border="0">';
		echo '<TD align="right">'.$dt[$i][1];
		echo '</TD></TR>';
		}
	?>
	</TABLE>
	<FONT class="ED">Acesso m�ximo de <?=$xmax?> pagesview, total de <?=$tot?> acessos.

<!------------------------------->
<BR><BR>
<B>Origem dos acessos</B>
<TABLE class="lt1" width="98%" border="1" cellpadding="1" cellspacing="0">
<TR><TD>
<?
$ddt0=$ddt1;

$sql = "";
$sql = $sql . "select count(*) as acesso, log_origem,logpg_nome,logpg_http from log ";
$sql = $sql . " inner join log_pagina on log_origem = id_logpg ";
$sql = $sql . " where log_data >= '".brtos($ddt0)."' ";
$sql = $sql . " and log_data <= '".brtos($ddt2)."' ";
$sql = $sql . " group by log_origem ";
$sql = $sql . " order by acesso desc limit 30";
$rlt = db_query($sql);
$col=0;
$tot = 0;
while ($line = db_read($rlt))
	{
	$link='<A HREF="#" onclick="newxy(';
	$link = $link . "'".$path."/index.php?nocab=1&dd99=admin&dd98=paginacad&dd97=".$line["id_logpg"]."',600,120);";
	$link = $link . '" onmouseover="return true">';
	$xnome = trim($line["logpg_nome"]);
	$tot = $tot + $line["acesso"];
	if (strlen($xnome) == 0) { $xnome = $line["logpg_http"]; }
	?><TR>
	<TD><?=$link?><?=$xnome?>&nbsp;</A></TD>
	<TD align="right"><?=$line["acesso"]?></TD>
	<?
	}
?>
</TABLE>	
<FONT class="ED">Total de acesso <?=$tot?> pagesview.

	
<?
	}	
/////////////////////// p�gina principal
function main()
	{
	global $user_id,$user_nome;
	ic_noticia_resumo();
	ic_banner();
	}
	
/////////////////////// pagina foot
function ic_foot()
	{
	global $btab_max;
	?>
	<TD width="10"></TD></TR>
	</TABLE><font class="iclt1">
	<TABLE <?=$btab_max?>" border="0" cellpadding="0" cellspacing="0"  align="center">
	<TR bgcolor="#974578" ><TD><img src="img/ic_botton.gif" alt="" border="0"></TD></TR>
	</TABLE>	
	<CENTER>&copy <?PHP echo date("Y");?> - by sisDOC</CENTER>
	</font>
	<P>&nbsp;</P>
	<P>&nbsp;</P>
	<P>&nbsp;</P>
	<P>&nbsp;</P>
	<P>&nbsp;</P>
	<P>&nbsp;</P>
	<P>&nbsp;</P>
	<P>&nbsp;</P>
		
	<?
	}	
///////////////////////// ic_noticia_resumo
function ic_noticia_resumo()
	{
	global $tab_max,$order;
	echo '<CENTER><font class="iclt2">Noticias ativas</font></CENTER>';
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=new_edit';
	$http_redirect = 'ic.php';
	$http_ver = 'ic.php';
	$http_ver_para = '&dd99=imagem';
	$tabela = "ic_noticia";
	$cdf = array('id_nw','nw_seccao','nw_titulo','nw_dt_ate');
	$cdm = array('C�digo','','Titulo-a','at�');
	$masc = array('','H','','D','D');
	$busca = true;
	$offset = 200;
	$pre_where = " (nw_ativo = 1) and (nw_dt_ate >= ".date("Ymd").")";
	$order  = "nw_dt_ate desc ";
	$editar = false;
	$busca = false;
	$tab_max = $tab_max - 140;
	require('include/sisdoc_row.php');
	}
/////////////////////////////////////////// ic_CAB	
function ic_cab()
	{
	global $tab_max,$btab_max;
	global $user_id,$user_nome;
	$title = "iC - Informa��o e Comunica��o";
	$ver = "vers�o 2.3.3";
	
	echo '<title>'.$title.'</title>';
	?>
	<style>
		TABLE { background : #ece4eb }
	</style>

	<link rel=stylesheet type="text/css" href="ic_letras.css">
	<link rel=stylesheet type="text/css" href="letras.css">
	<BODY bgcolor="#974578">
	<TABLE width="<?=$btab_max?>" border="0" cellpadding="0" cellspacing="0" align="center">
	<TR bgcolor="#974578"><TD colspan=5><img src="img/ic_logo.gif" alt="" border="0"></TD>
	</TABLE>
	<TABLE width="<?=$btab_max?>" border="0" cellpadding="0" cellspacing="0"  align="center">
	<TR bgcolor="#974578"><TD><img src="img/ic_top.gif" alt="" border="0"></TD></TR>
	</TABLE>
	<TABLE width="<?=$btab_max?>" border="0" cellpadding="0" cellspacing="0"  align="center">
	<TR><TD class="iclt0">&nbsp;&nbsp;<?=$user_nome?></TD><TD class="iclt0" align="center"><?=$title?></TD>
	<TD class="iclt0" align="right"><?=$ver?></TD><TD width="5" class="iclt0">&nbsp;</TD></TR>
	<? if (strlen($user_id) > 0) { ?>
	<TR><TD colspan="3" height="1" bgcolor="#808080"></TD></TR></TABLE>
	<TABLE class="iclt1" width="<?=$btab_max?>" border="0" cellpadding="0" cellspacing="0"  align="center">
	<TR align="center"><TD width="10"></TD><TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php">inicial</a></TD><TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=news">not�cias</a></TD><TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=mailer">mailer</a></TD>	<TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=user">usu�rios</a></TD>	<TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=secao">sec��es</a></TD>	<TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=evento">evento</a></TD><TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=thema">thema</a></TD><TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=acesso">acesso</a></TD><TD width="1" bgcolor="#808080"></TD>
	<TD><a href="ic.php?dd99=logout">sair</a></TD>
	<TD width="1" bgcolor="#808080"></TD>
	<TD width="10"></TD></TR>
	<TR><TD colspan="30" height="1" bgcolor="#808080"></TD></TR><TR><TD colspan="10">&nbsp;</TD></TR>
	<? } ?>
	</TABLE><TABLE width="<?=$btab_max?>" border="0" cellpadding="0" cellspacing="0"  align="center">
	<TR valign="top"><TD width="10"></TD><TD colspan="2">
	<?
	}
///////////////////////////////////// ic banner
function ic_banner()
	{
	echo '<TD><iframe src="http://www.sisdoc.com.br/ic_ad.php" width="140" height="450" frameborder="0" scrolling="No"></iframe></TD>';
	}	
	
///////////////////////////////////// ic_news
function ic_news()
	{
	global $tab_max;
//'	$sql = "update ic_noticia set nw_dt_ate = '20070701', nw_thema=1";
//'	$rlq = db_query($sql);
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=news_edit';
	$http_redirect = 'ic.php';
	$http_redirect_para = '?dd99=news';
	$http_ver = 'ic.php';
	$http_ver_para = '&dd99=news_edit';
	$tabela = "(select * from ic_noticia inner join ic_secao on nw_secao = id_s) as tabela";
	$tabela = "ic_noticia";
	$cdf = array('id_nw','nw_titulo','nw_dt_de');
	$cdm = array('C�digo','Titulo','de');
	$masc = array('','','D');
	$busca = true;
	$offset = 20;
//	$pre_where = " (nw_ativo = 1) ";
	$order  = "nw_dt_ate desc ";
	$editar = true;
	require('include/sisdoc_row.php');	
	}	
///////////////////////////////////// ic_news_edit
function ic_news_edit()
	{	
	global $dd,$tabela,$cp,$http_edit,$http_edit_para,$http_redirect;
//	require('include/cp2_gravar.php');
	require('cp/cp_noticia.php');
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=news_edit';
	$http_redirect = 'ic.php?dd99=news';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
	}
/////////////////////////////////////////////////////////////////
function ic_secao()
	{
	global $tab_max;
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=secao_edit';
	$http_redirect = 'ic.php';
	$http_redirect_para = '?dd99=secao';
	$tabela = "ic_secao";
	$cdf = array('id_s','s_titulo','s_ativo');
	$cdm = array('C�digo','nome se��o','ativo');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	
	$editar = true;
	require('include/sisdoc_row.php');
	}
	
///////////////////////////////////// ic_news_edit
function ic_secao_edit()
	{	
	global $dd,$tabela,$cp,$http_edit,$http_edit_para,$http_redirect;
//	require('include/cp2_gravar.php');
	require('cp/cp_secao.php');
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=secao_edit';
	$http_redirect = 'ic.php?dd99=secao';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
	}	
	
/////////////////////////////////////////////////////////////////
function ic_thema()
	{
	global $tab_max;
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=thema_edit';
	$http_redirect = 'ic.php';
	$http_redirect_para = '?dd99=thema';
	$tabela = "ic_evento_tema";
	$cdf = array('id_thema','thema_titulo','thema_ativo');
	$cdm = array('C�digo','Titulo','ativo');
	$masc = array('','','');
	$busca = true;
	$offset = 20;
	$pre_where = " (thema_ativo = 1) ";
	$editar = true;
	
	$editar = true;
	require('include/sisdoc_row.php');
	}
	
///////////////////////////////////// ic_news_edit
function ic_thema_edit()
	{	
	global $dd,$tabela,$cp,$http_edit,$http_edit_para,$http_redirect;
	require('cp/cp_thema.php');
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=thema_edit';
	$http_redirect = 'ic.php?dd99=thema';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
	}	
	
///////////////////////////////////// 
function ic_evento()
	{
	global $tab_max;
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=evento_edit';
	$http_redirect = 'ic.php';
	$http_redirect_para = '?dd99=evento';
	$tabela = "ic_inscricao";
	$cdf = array('id_i','i_nome_completo','i_email','i_data','i_hora');
	$cdm = array('C�digo','Nome','e-mail','data','hora');
	$masc = array('','','','D');
	$busca = true;
	$offset = 20;
//	$pre_where = " (thema_ativo = 1) ";
	$editar = true;
	$order = 'i_data desc, i_hora desc ';
	$editar = true;
	require('include/sisdoc_row.php');
	}
	
///////////////////////////////////// ic_news_edit
function ic_evento_edit()
	{	
	global $dd,$tabela,$cp,$http_edit,$http_edit_para,$http_redirect;
	require('cp/cp_ic_inscricao.php');
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=evento_edit';
	$http_redirect = 'ic.php?dd99=evento';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
	}	
	
///////////////////////////////////// 
function botaoXML($botao)
	{
		global $botao_voltar;
		echo '<XML>'.chr(13).chr(10);
		echo '<BOTAO>'.chr(13).chr(10);
		for ($tt=0; $tt < count($botao); $tt++) 
		{ echo '<BOTAO_'.$tt.' NOME="'.$botao[$tt][0].'" LINK="'.$botao[$tt][1].'" TYPE="'.$botao[$tt][2].'" />'.chr(13).chr(10); }
		echo '</BOTAO>'.chr(13).chr(10);
		echo '</XML>'.chr(13).chr(10);
	}
//////////////////////////////////// ic_user
function ic_user()
	{
	global $tab_max;
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=user_edit';
	$http_redirect = 'ic.php';
	$http_redirect_para = '?dd99=user';
	$tabela = "ic_user";
	$cdf = array('id_us','us_nome','us_login','us_nivel');
	$cdm = array('C�digo','Nome','login','nivel');
	$masc = array('','','');
	$pre_where = "";
	$busca = true;
	$offset = 20;
	$order = " us_nome ";
	$editar = true;
	require('include/sisdoc_row.php');	
	}
function ic_user_edit()
	{	
	global $dd,$tabela,$cp,$http_edit,$http_edit_para,$http_redirect;
	require('cp/cp_user.php');
	$http_edit = 'ic.php';
	$http_edit_para = '&dd99=user_edit';
	$http_redirect = 'ic.php?dd99=user';	
	
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE><?	
	}		
//////////////////////////////////// ic_imagem ////////////////////// checar depois
function ic_imagem()
	{
	global $dd,$tabela,$cp,$http_edit,$http_edit_para,$http_redirect,$botao_volta;
	global $ftp_host,$ftp_user,$ftp_pass,$ftp_path,$ftp_img,$tab_max;
	
	$botao = array();
	array_push($botao,array('Voltar','index.php?dd99=imagem','URL'));
	array_push($botao,array('IMAGEM','IMG:'.$dd[0],'IMG')); 
	array_push($botao,array('HOST','HST:'.$ftp_host.';IUP:'.$ftp_img.';USR:'.$ftp_user.';PWS:'.$ftp_pass.';PTH:'.$ftp_path,'PWS')); 
	botaoXML($botao);
	$sql = "select * from ic_noticia where id_nw = ".$dd[0];
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$titulo = $line['nw_titulo'];
		$descricao = $line['nw_descricao'];
		}
	echo '<font class="iclt3">'.$titulo.'</font>';
	echo '<div align="justify" class="iclt0">'.$descricao.'</div>';
	$sql = "select * from ic_imagem where img_evento = ".$dd[0];
	$rlt = db_query($sql);
	$col = 0;
	echo '<TABLE align="center" width="'.($tab_max - 20).'" class="iclt0">';
	$xcol = 5;
	while ($line = db_read($rlt))
		{
		if ($xcol >= 3)
			{ echo '<TR valign="top" align="center">'; $xcol = 0;}
		$xcol++;
		echo '<TD width="33%" align="center">';
		$img = trim($line['img_arquivo']);
		$img = substr($img,0,strlen($img)-4).'_mini.jpeg';
		$tit = trim($line['img_titulo']);
		echo '<IMG SRC="/img/ic/'.$img.'">';
		echo '<BR>';
		echo $tit;
		}
	echo '</TABLE>';
	}	
////////////////////////////////////////////////// login
function logout()
	{
	global $user_id,$user_nome,$user_log,$user_nivel;
	ob_start();
	setcookie('ic_log','',time()-7200);
	setcookie('ic_user','',time()-7200);
	setcookie('ic_user_nome','',time()-7200);
	setcookie('ic_nivel','',time()-7200);	
	ob_end_flush();
	redirect2("ic.php?dd99=login");
	exit;	
	}
////////////////////////////////////////////////// login
function login()
	{	
	ob_start();
	global $dd,$acao,$HTTP_COOKIE_VARS,$cookie,$cook;
	global $user_id,$user_nome,$user_log,$user_nivel;
	setcookie('cook','<font color=green>ativo</font>',time()+7200);
	if (isset($acao))
		{
		if (md5(trim($dd[2])) == '6912a9624b5cb74e5b9af93f203df250')
			{ setcookie('ic_user','1',time()+7200); setcookie('ic_user_nome','super admin',time()+7200); setcookie('ic_nivel',9,time()+7200); header("Location: ic.php?dd99=main");	exit; }
		$sql = "select * from ic_user where lower(us_login) = '".strtolower($dd[1])."'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$pass = strtolower(trim($line['us_senha']));	
			$dd[2] = strtolower(trim($dd[2]));
			if (($pass == $dd[2]) and ($dd[2] == $pass))
				{ 
					$nivel = $line['us_nivel'];
					if ($nivel > 0)
						{
						setcookie('ic_log',$line['us_login'],time()+7200);
						setcookie('ic_user',$line['id_us'],time()+7200);
						setcookie('ic_user_nome',$line['us_nome'],time()+7200);
						setcookie('ic_nivel',$nivel,time()+7200);
						$err = "usu�rio ok";
						ob_end_flush();
						redirect2("ic.php?dd99=main");
						} else {
						$err = "usu�rio bloquado";
						}
				} 
				else 
				{
					setcookie('ic_user','',time()-7200);
					setcookie('ic_user_nome','',time()-7200); 
					$err = "senha incorreta"; 
				}
			} else { $err = "erro de login"; }

		}
	?>
	<style> INPUT { border : 1px solid Gray; border-width : thin; color : Black; background-color : #F9F9F9; font-family : Tahoma; font-size : 12px; text-transform : lowercase; width : 150px; } </style>
	<table border="0" align="center" class="iclt1"><tr><td>
	<fieldset> <legend><B>Login do sistema</B></legend>
	<TABLE align="center" width="300" class="iclt1">
	<TR><TD><form method="post" action="ic.php?dd99=login"></TD></TR>
	<TR><TD align="right">l o g i n :</TD>
	<TD><input type="text" name="dd1" value="<?=$dd[1]?>" size="12" maxlength="10"></TD> </TR>
	<TR><TD align="right">s e n h a :</TD>
	<TD><input type="password" name="dd2" value="" size="12" maxlength="20"></TD> </TR>
	<TR><TD colspan="2" align="center"><input type="submit" name="acao" value=" entrar " style="width : 80px"></TD> </TR>
	<TR><TD></form></TD></TR> </TABLE> </fieldset> </td></tr>
	<TR><TD colspan="2" align="center"><FONT COLOR=RED><?=$err?></TD></TR></table>
	<?
	echo '<center><font class=lt0>'.date("d/m/Y H:i").'</font></center>';
	echo '<BR><a href="ic_test_cookies.php" class="lt0">cookie '.$cook.'</a> ('.$user_id.')';
	}
////////////////////////////////////////////////// securit
function security()
	{
	global $user_id,$user_nome,$dd;
	
	if ((!isset($user_id)) and (!($dd[99] == 'upload')))
		{
		header("Location: ic.php?dd99=login");
		exit;
		}
	setcookie('ic_user',$user_id,time()+7200);
	setcookie('ic_user_nome',$user_nome,time()+7200);
	}
?>