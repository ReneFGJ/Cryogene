<?php
$include = '';
require("db.php");
$login = 1;
require($include.'sisdoc_security_v2.php');
$file = $include.'js/jquery.js';
if (!(file_exists($file))) { echo 'nao localizado jquery.js na pasta do Include'; exit; }

/* Mensagens do sistema */
$msg = array(	'login_cab' => 'login de acesso ao sistema',
				'login' => 'login',
				'password' => 'senha',
				'submit' => 'acessar',
				'erro1' => 'login não localizado',
				'erro2' => 'senha inválida',
				'erro3' => 'login ou senha em branco'
								
);


/* Valida login */
$nw = new usuario;
if (strlen($acao) > 0)
	{
	$rst = $nw->login($dd[1],$dd[2]);
	$rst = $nw->user_erro;
	$msg_erro = 'Erro:'.abs($rst);
	/* recupera mensagem */	
	if ($rst < 0)
		{
			$rst = abs($rst);
			$msg_erro = $msg['erro'.$rst]; 
		} else {
			if ($rst == 1)
				{ redirecina('main.php'); }
		}
			
	}
?>
<head>
	<title>::Login::</title>
	<script src="<?=$file;?>" type="text/javascript"></script>
	<META HTTP-EQUIV=Refresh CONTENT="360; URL=login.php">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />		
</head>
<style>
body
	{
	margin-bottom: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-top: 0px;
	text-align: center;
	background-color: #FFFFFF;
	background-attachment: fixed;
	background-image: url('img/login_bg.png');
	background-position: center;
	background-repeat: repeat;
	padding: 80px 0px 0px 0px;	
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #303030;
	}
.login
	{
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #303030;
	}
.login_cab
	{
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #303030;
	}
.login_erro
	{
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: red;
	}		
.input_stly
	{
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #303030;
	background: transparent;
	background: transparent;
	border: 1px solid;
	}	
#div_login {}
</style>
<?php
$div3_style = 'style="display: none;"';
if (strlen($acao) > 0)
	{ $div1_style = 'style="display: block;"'; $div2_style = 'style="display: none;"'; }
else
	{ $div2_style = 'style="display: block;"'; $div1_style = 'style="display: none;"'; }
	

?>
<body>
<?php
/* Chama cabeçalho institucional no topo da página */
require("cab_institucional.php");
?>
	<img src="img/login_logo.png">
	<HR width="744" size="1" color="#c0c0c0" align="center">
	<font style="font-size: 16px;">I N T R A N E T</font>
	<?php require("foot.php"); ?>
	<BR><BR>
	<div id="div_login" <?=$div1_style;?> >
		<form method="post" action="_login.php">
			<table align="center" class="login">
				<TR><TD align="center" colspan=2 class="login_cab"><B><?=$msg['login_cab'];?></B>

				<TR><TD><?=$msg['login'];?>
					<TD><input type="text" name="dd1" value="<?=$dd[1];?>" size="35" maxsize="100" class="input_stly"></TD>
				</TR>

				<TR><TD><?=$msg['password'];?>
					<TD><input type="password" name="dd2" size="20" maxsize="20"class="input_stly"></TD>
				</TR>

				<TR><TD><TD colspan=1 align="left">
					<input type="submit" name="acao" value="<?=$msg['submit'];?>"></TD>
				</TR>
			</table>
		</form>
		
	</div>
	<div id="div_msg" <?=$div2_style;?>>não logado</div>
	<div id="div_erro" <?=$div3_style2;?>><font class="login_erro"><?=$msg_erro;?></div>
</body>

<script>
   $('#div_msg').mouseover(function() {
      $('#div_login').fadeIn('slow', function() { });
      $('#div_msg').fadeOut('slow', function() { });
    });
</script>
<BR><BR><BR><BR><BR>

