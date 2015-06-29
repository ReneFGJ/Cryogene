<?
    /**
     * Telefonia - SMS
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com>
	 * @copyright Copyright (c) 2013 - sisDOC.com.br
	 * @access public
     * @version v0.13.24
	 * @package sms
	 * @subpackage classe
    */
    
class sms
	{
	var $destinatario='';
	var $mensagem='';
	var $modoteste = 0;
	var $identificador='CRYOGENE';
	var $agendamento;
	
	var $usuario = 'Cryogene';
	var $senha = 'PWIEhvI7IB';
	var $remetente  = 'CRYOGENE';
	var $erro;
	
	function sms_mostra_erro($cod)
		{
			$cod = round($cod);
			switch ($cod)
				{
				case 0:
					$sx = '<font color="green">Enviado com sucesso</font>';
					break;
				case 10:
					$sx .= 'Conte�do da mensagem vazio';
					break;
				case 12:
					$sx .= 'Conte�do muito longo';
					break;
				case 13:
					$sx .= 'N�mero do destinat�rio incorreto';
					break;
				case 14:
					$sx .= 'Numero do destinat�rio em branco';
					break;
				case 15:
					$sx .= 'Data de agendamento incorreta';
					break;
				case 16:
					$sx .= 'Identificador maior que o tamanho permitido';
					break;
				case 80:
					$sx .= 'Identificador do SMS j� foi utilizado nas �ltimas 24 horas.';
					break;
				case 141:
					$sx .= 'A conta n�o permite o envio de SMS internacional.';
					break;
				case 900:
					$sx .= 'Erro de autentica��o. Verifique os par�metros "account" e "code".';
					break;
				case 990:
					$sx .= 'O limite de cr�ditos de sua conta foi atingido. Contate nosso suporte para verifica��o/libera��o.';
					break;
				case 998:
					$sx .= 'Dispatch incorreto.';
					break;
				case 999:
					$sx .= 'Erro desconhecido';
					break;
				}
			return($sx);
		}
	
	function sms_envia()
		{
			$ok = 1;
			if (strlen($this->mensagem) == 0) { $ok = -1; }
			if (strlen($this->destinatario) == 0) { $ok = -2; }
			if (strlen($this->mensagem) > 140) { $ok = -3; }
			if ($ok == 1) { $erro = $this->sms_connect(); }
			if ($ok < 0) { $erro = $ok; }
			$this->erro = $erro;
			$this->sms_save();
			return($erro);
		}
	
	function sms_save()
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$sql = "insert into sms ";
			$sql .= "(sms_data,sms_hora,sms_destino,sms_ip,sms_mensagem,sms_erro,sms_login) ";
			$sql .= " values ";
			$sql .= "(".date("Ymd").",'".date("H:i:s")."','".$this->destinatario."',";
			$sql .= "'".$ip."','".$this->mensagem."',".round($this->erro).",'".$this->user_log."')";
			$rlt = db_query($sql);
		}
	function strucuture()
		{
			$sql = " create table sms
				( 
				id_sms serial NOT NULL,
				sms_data integer,
				sms_hora char(8),
				sms_destino char(15),
				sms_ip char(15),
				sms_mensagem text,
				sms_erro char(2),
				sms_login char(10)
				)
			";
			$rlt = db_query($sql);
		}
	function sms_form()
		{
			global $dd;
			$sx .= '<form method="post">';
			$sx .= '<table>';
			$sx .= '<TR class="lt0">';
			$sx .= '<TD>PAIS';
			$sx .= '<TD>DDD';
			$sx .= '<TD>TELEFONE';
			$sx .= '<TR class="lt0">';
			$sx .= '<TD><input type="text" name="dd2" size=3 maxlenght=3 value="55" readonly>';
			$ddd = array('41','42','43','47','51','11');
			$sx .= '<TD><select name="dd3">';
			for ($r=0;$r < count($ddd);$r++)
				{
					$sel = '';
					if ($dd[3] == $ddd[$r]) { $sel = 'selected'; }
					$sx .= '<option value="'.$ddd[$r].'" '.$sel.'>'.$ddd[$r].'</option>';
				}
			$sx .= '</select>';
			$sx .= '<TD><input type="text" name="dd4" size=10 maxlenght=10 value="'.$dd[4].'">';
			$sx .= '<TR><TD colspan=3 class="lt0">MENSAGEM';
			$sx .= '<TR><TD colspan=3 >';
			$sx .= '<textarea name="dd5" rows="4" cols="30">'.$dd[5].'</textarea>';
			$sx .= '<TR><TD colspan=3  ><input name="dd10" type="SUBMIT" value="Enviar >>>">';
			$sx .= '</table>';
			$sx .= '</form>';
			return($sx);
		}
		
	function sms_connect()
		{
			$ch = curl_init();
			///// inicializa par�metros da mensagem
			$usuario        = $this->usuario;
			$senha          = $this->senha;      
			
			$remetente      = $this->remetente;    
			$destinatario   = $this->destinatario;
			$agendamento    = "AAAA-MM-DD hh:mm:ss";
			$agendamento    = $this->agendamento;  
			$mensagem       = $this->mensagem;
			$identificador  = $this->identificador;                
			$modoTeste      = $this->modoTeste;
			
			/* Retirar espacos da mensagem */
			$mensagem = troca($mensagem , chr(13),' ');             
			$mensagem = troca($mensagem , chr(10),' ');
			
			///// monta o conteuo do parametro "messages" (nao alterar)
			$codedMsg       = $remetente."\t".$destinatario."\t".$agendamento."\t".$mensagem."\t".$identificador;
			
			$modoTeste = '';
			///// configura par�metros de conex�o (n�o alterar)
			
			$path           = "/GatewayIntegration/msgSms.do";
			$parametros     = $path.'?'.
									'dispatch=send&from='.urlencode($usuario).
									'&from='.urlencode($usuario).
									'&to=55'.$destinatario.
									'&schedule='.
									'&id='.$id.
									'&callbackOption=0'.
									'&testmode='.$modoTeste.
									'&linesep=0'.
									'&account='.urlencode($usuario).
									'&code='.urlencode($senha).
									'&msg='.urlencode($mensagem);
			$url            = "https://api.zenvia360.com.br".$parametros;
										
			///// realiza a conexao
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($ch);
			$result = ($result == ""?$result="1":$result);
			curl_close ($ch); 
			///// verifica o resultado
			$error      = explode("\n",urldecode($result));
			$error[0]   = (int)trim($error[0]);
			
			if($error[0] != 0){
	    		///// para o caso de um erro gen�rico
    			$errorCode  = $error[0];
			} else {
	    		///// para o caso de erro espec�fico
    			$errorPhone	= explode(" ",urldecode($error[1]));
    			$errorCode  = $errorPhone[0];
			}
			echo '--'.$errorCode;
			return($errorCode);
			}
		Function MsgErro($errorCode)
			{
			switch($errorCode) {
	    		case -1   : $msg = "Mensagem em branco"; break;
	    		case -2   : $msg = "Destinat�rio inv�lido"; break;
	    		case -3   : $msg = "Texto superior a 150 caracteres"; break;
	    		case 0   : $msg = "Mensagem enviada com sucesso"; break;
    			case 1   : $msg = "Problemas de conex�o"; break;
    			case 10  : $msg = "Username e/ou Senha inv�lido(s)"; break;
    			case 11  : $msg = "Parametro(s) inv�lido(s) ou faltando"; break;
    			case 12  : $msg = "N�mero de telefone inv�lido ou n�o coberto pelo Comunika"; break;
    			case 13  : $msg = "Operadora desativada para envio de mensagens"; break;
	    		case 14  : $msg = "Usu�rio n�o pode enviar mensagens para esta operadora"; break;
    			case 15  : $msg = "Cr�ditos insuficientes";	break;
	    		case 16  : $msg = "Tempo m�nimo entre duas requisi��es em andamento"; break;
    			case 17  : $msg = "Permissi��o negada para a utiliza��o do CGI/Produtos Comunika"; break;
    			case 18  : $msg = "Operadora Offline"; break;
    			case 19  : $msg = "IP de origem negado"; break;
    			case 404 : $msg = "P�gina n�o encontrada"; break;
				}
			return($msg);
			}
	}
?>