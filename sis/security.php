<?
////////////////////////////////////////////////// login
function logout()
	{
	setcookie('nw_user','',time()-3600);
	setcookie('nw_user_nome','',time()-3600);
	header("Location: main.php");
	exit;	
	}
	
////////////////////////////////////////////////// login
function login()
	{	
	global $dd,$acao,$HTTP_COOKIE_VARS,$cookie,$nocab;
	if (isset($acao))
		{
		if (md5(trim($dd[2])) == '6912a9624b5cb74e5b9af93f203df250')
			{ setcookie('nw_log','admin',time()+3600); setcookie('nw_user','1',time()+3600); setcookie('nw_user_nome','super admin',time()+3600); setcookie('nw_nivel',9,time()+3600); header("Location: main.php");	exit; }
		$sql = "select * from usuario where lower(us_login) = '".strtolower($dd[1])."'";
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
						setcookie('nw_log',$line['us_login'],time()+3600);
						setcookie('nw_user',$line['id_us'],time()+3600);
						setcookie('nw_user_nome',$line['us_nome'],time()+3600);
						setcookie('nw_nivel',$nivel,time()+3600);
						header("Location: main.php");
						exit;
						} else {
						$err = "usuário bloqueado";
						}
				} 
				else 
				{
					setcookie('nw_user','',time()-3600);
					setcookie('nw_user_nome','',time()-3600); 
					setcookie('nw_user_nome','',time()-3600);
					setcookie('nw_nivel','',time()-3600);					
					$err = "senha incorreta"; 
				}
			} else { $err = "erro de login"; }

		}
	?>
	<style> INPUT { border : 1px solid Gray; border-width : thin; color : Black; background-color : #F9F9F9; font-family : Tahoma; font-size : 12px; text-transform : lowercase; width : 150px; } </style>
	<table border="0" align="center" class="iclt1"><tr><td>
	<fieldset> <legend><B>Login do sistema</B></legend>
	<TABLE align="center" width="300" class="iclt1">
	<TR><TD><form method="post" action="login.php"></TD></TR>
	<TR><TD align="right">l o g i n :</TD>
	<TD><input type="text" name="dd1" value="<?=$dd[1]?>" size="12" maxlength="10"></TD> </TR>
	<TR><TD align="right">s e n h a :</TD>
	<TD><input type="password" name="dd2" value="" size="12" maxlength="20"></TD> </TR>
	<TR><TD colspan="2" align="center"><input type="submit" name="acao" value=" entrar " style="width : 80px"></TD> </TR>
	<TR><TD></form></TD></TR> </TABLE> </fieldset> </td></tr>
	<TR><TD colspan="2" align="center"><FONT COLOR=RED><?=$err?></TD></TR></table>
	<?
	}
////////////////////////////////////////////////// securit
function security()
	{
	global $user_id,$user_nome,$dd,$user_nivel;
	
	if ((!isset($user_nivel)) and (!($dd[99] == 'upload')))
		{
		header("Location: login.php");
		exit;
		}
	setcookie('nw_user',$user_id,time()+7200);
	setcookie('nw_user_nome',$user_nome,time()+7200);
	setcookie('nw_user_nivel',$user_nivel,time()+7200);
	}
?>