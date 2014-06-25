<?
////////////////////////////////////////////////// login
function logout()
	{
	setcookie('cl_user','',time()-3600);
	setcookie('cl_user_nome','',time()-3600);
	header("Location: main.php");
	exit;	
	}
	
////////////////////////////////////////////////// login
function login_usr()
	{	
	global $dd,$acao,$HTTP_COOKIE_VARS,$cookie,$nocab;
	if (isset($acao))
		{
		$sql = "select *,sonumero(cl_cpf) as cpf from cliente where (lower(cl_email) = '".strtolower($dd[1])."') or (sonumero(cl_cpf) = sonumero('".$dd[1]."'))";
		$rlt = db_query($sql);

		if ($line = db_read($rlt))
			{
			$pass = strtolower(trim($line['cl_senha']));	
			$logi = strtolower(trim($line['cl_email']));	
			$dd[2] = strtolower(trim($dd[2]));
			$nivel = 10;
			if (($pass == $dd[2]) and ($dd[2] == $pass) and (strlen($pass) > 0))
				{ 
					if ($nivel >= 0)
						{
						setcookie('cl_log',$line['cl_codigo'],time()+3600);
						setcookie('cl_user',$line['id_cl'],time()+3600);
						setcookie('cl_user_nome',$line['cl_nome'],time()+3600);
						setcookie('cl_nivel',9,time()+3600);
						header("Location: cliente_main.php");
						exit;
						} else {
						$err = "usuário bloqueado";
						}
				} 
				else 
				{
					setcookie('cl_user','',time()-3600);
					setcookie('cl_user_nome','',time()-3600); 
					setcookie('cl_user_nome','',time()-3600);
					setcookie('cl_nivel','',time()-3600);					
					$err = "senha incorreta"; 
				}
			} else { $err = "e-mail ou CPF incorreto"; }

		}
	?>
	<style> INPUT { border : 1px solid Gray; border-width : thin; color : Black; background-color : #F9F9F9; font-family : Tahoma; font-size : 12px; text-transform : lowercase; width : 150px; } </style>
	<table border="0" align="center" class="iclt1"><tr><td>
	<fieldset> <legend><B>Login do sistema</B></legend>
	<TABLE align="center" width="300" class="iclt1">
	<TR><TD><form method="post" action="cliente_login.php"></TD></TR>
	<TR><TD align="right">CPF ou e-mail :</TD>
	<TD><input type="text" name="dd1" value="<?=$dd[1]?>" size="20" maxlength="80"></TD> </TR>
	<TR><TD align="right">s e n h a :</TD>
	<TD><input type="password" name="dd2" value="" size="12" maxlength="20"></TD> </TR>
	<TR><TD colspan="2" align="center"><input type="submit" name="acao" value=" entrar " style="width : 80px"></TD> </TR>
	<TR><TD></form></TD></TR> </TABLE> </fieldset> </td></tr>
	<TR><TD colspan="2" align="center"><FONT COLOR=RED><?=$err?></TD></TR></table>
	<?
	$link = '<A HREF="#" onclick="newxy('."'cliente_acesso_cadastro.php'".',400,300)" >';
	?>
	<table border="0" align="center" class="lt1" width="400">
	<TR><TD colspan="10">
	Bem vindo a Central de Relacionamento Cryogene, voce terá acesso as informações referentes ao seu relacionamento com a Cryogene.
	</TD></TR>
	<tr align="center">
	<td width="40%"><fieldset>
	<?=$link?>
	<B>esqueci minha senha</B>
	</fieldset>
	<TD width="20%"></TD>
	<td width="40%"><fieldset>
	<?=$link?>
	<B>não tenho senha</B>
	</fieldset>
	</TABLE>
	<?
	}
////////////////////////////////////////////////// securit
function security()
	{
	global $cliente_id,$cliente_nome,$dd,$cliente_nivel;
	
	if ((!isset($cliente_nivel)) and (!($dd[99] == 'upload')))
		{
		header("Location: cliente_login.php");
		exit;
		}
	setcookie('cl_user',$cliente_id,time()+3600);
	setcookie('cl_user_nome',$cliente_nome,time()+3600);
	setcookie('cl_user_nivel',$cliente_nivel,time()+3600);
	}
?>	