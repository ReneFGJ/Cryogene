<?php
class login
	{
	var $us_name;
	var $us_login;
	var $us_nivel;
	var $us_perfil;	
	
	var $caption_login = 'Usuário';
	var $caption_password = 'Senha';
	var $caption_submit = 'Acessar';
	
	var $class_login;
	var $class_password;
	var $class_submit;
	
	var $session_id;
	
	var $field_login;
	var $field_pass;
	var $field_name;
	var $field_nivel;
	var $field_perfil;
	
	var $cryp = 0;
	var $tabela;
	
	function show_login_error($er)
		{
			switch ($er)
				{
				case -1: $sx = 'Usuário não informado'; break;
				case -2: $sx = 'Senha não informada'; break;
				case -99: $sx = 'Campo do login não informado (técnico)'; break;
				case -98: $sx = 'Campo da senha não informado (técnico)'; break;
				case -3: $sx = 'Senha incorreta'; break;
				case -4: $sx = 'Usuário não existe'; break;
				default:
					$sx .= 'Erro no login ('.$er.')';
				}
			return($sx);
		}
	
	function valida_login($user,$pass)
		{
			$check = 0;
			if (strlen($user)==0) { return(-1); }
			if (strlen($pass)==0) { return(-2); }
			if (strlen($this->tabela)==0) { return(-99); }
			if (strlen($this->field_login)==0) { return(-98); }
			if (strlen($this->field_pass)==0) { return(-97); }
			
			$sql = "select * from ".$this->tabela." 
						where ".$this->field_login." = '".$user."' 
						and us_ativo = 1
						";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$password = trim($line[$this->field_pass]);
					if ($pass == $password)
						{
							$name = trim($line[$this->field_name]);
							$id = trim($line[$this->field_id]);
							$nivel = trim($line[$this->field_nivel]);
							$perfil = trim($line[$this->field_perfil]);
							$login = trim($line[$this->field_login]);
							$check = 1;
							$this->save_session($name, $login, $id, $nivel, $perfil);
						} else {
							$check = -3;				
						}
				} else {
					$check = -4;
				}
			return($check);
		}
	
	function save_session($name,$login,$id,$nivel,$perfil)
		{
			$_SESSION['us_nome'] = $name;
			$_SESSION['us_login'] = $login;
			$_SESSION['us_id'] = $id;
			$_SESSION['us_nivel'] = $nivel;
			$_SESSION['us_perfil'] = $perfil;
		}
	function valida_session($sid_post)
		{
			global $secu;
			$sid = $_SESSION['sid'];
			
			if (trim($sid_post) == (md5($sid.$secu)))
				{
					return(1);
				} else {
					echo 'Injection for post';
					exit;
				}
		}
	
	function security()
		{
			global $http;
			$nome = $_SESSION['us_nome'];
			$login = $_SESSION['us_login'];
			if (strlen($nome)==0)
				{
				redirecina($http.'login.php');
				} else {
					$this->us_name = $nome;
					$this->us_login = $login;
					$this->us_nivel = $nivel;
					$this->us_perfil = $perfil;
				}	
		}
	function login_form()
		{
			global $dd,$acao;
			$sx = '';
			$sx .= '<form method="post" action="'.page().'">';
			$sx .= '<table>';
			$sx .= $this->user_form();
			$sx .= $this->user_pass();
			$sx .= $this->user_submit();
			$sx .= $this->user_session();
			$sx .= '</table>';
			$sx .= '</form>';
			return($sx);
		}
	function user_session()
		{
			global $secu;
			$sid = $_SESSION['sid'];
			if (strlen($sid)==0)
				{
					$sid = date("sYhmid");
					$_SESSION['sid'] = $sid;
				}
			$sx .= '<input type="hidden" name="dd90" value="'.md5($sid.$secu).'">'.chr(13).chr(10);
			return($sx);
		}
	function user_form()
		{
			global $dd,$acao;
			$sx = '';
			$sxf = '';
			if (strlen($this->caption_login) > 0)
			{
				$sx .= '<TR><TD>'.$this->caption_login;
				$sx .= '<TD>';
				$sxf = '</td></tr>'.chr(13).chr(10);
			}
			$sx .= '<input type="text" size="40" maxsize="80" name="dd1" id="dd1" value="'.$dd[1].'">'.chr(13).chr(10);
			$sx .= $sxf;
			return($sx);
		}	

	function user_pass()
		{
			global $dd,$acao;
			$sx = '';
			$sxf = '';
			if (strlen($this->caption_password) > 0)
			{
				$sx .= '<TR><TD>'.$this->caption_password;
				$sx .= '<TD>';
				$sxf = '</td></tr>'.chr(13).chr(10);
			}
			$sx .= '<input type="password" size="40" maxsize="80" name="dd2" id="dd2" value="'.$dd[2].'" autocomplete="off" >'.chr(13).chr(10);
			$sx .= $sxf;
			return($sx);
		}	
	function user_submit()
		{
			global $dd,$acao;
			$sx = '';
			$sxf = '';
			if (strlen($this->caption_password) > 0)
			{
				$sx .= '<TR><TD colspan=2>';
				$sxf = '</td></tr>';
			}
			$sx .= '<input type="submit" name="acao" id="acao" value="'.$this->caption_submit.'" >'.chr(13).chr(10);
			$sx .= $sxf;
			return($sx);
		}	

	}
?>