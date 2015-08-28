<?php
class emails extends CI_model {
	var $to = array();
	
	function enviar_cache()
		{
			$sql = "select * from contrato_message
						inner join contrato on rp_contrato = ctr_numero
						inner join cliente on cl_codigo = ctr_responsavel 
						where rp_status = '@'
						order by rp_data
						limit 1";
						
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			for ($r=0;$r < count($rlt);$r++)
				{
					$line = $rlt[$r];
					$idrp = $line['id_rp'];
					$email1 = trim($line['cl_email']);
					$email2 = trim($line['cl_email_alt']);
					$nome = trim($line['cl_nome']);
					
					$email = array();
					$email['id'] = $line['id_rp'];
					$email['to_nome'] = $nome;
					$email['to'] = $email1;
					$email['cc'] = $email2;
					
					$email['subject'] = $line['rp_subject'];
					$email['message'] = $line['rp_texto'];
					
					$this->enviar_email($email);
					
					$sql = "update contrato_message set  
								rp_status = 'A',
								rp_envio_data = ".date("Ymd").",
								rp_envio_hora = '".date("H:i:s")."'
							where id_rp = ".$idrp;
					$this->db->query($sql);
				}
		}
	function enviar_email($email) {
		$config = Array('protocol' => 'smtp', 'smtp_host' => 'ssl://mail.cryogene.inf.br', 'smtp_port' => 465, 'smtp_user' => 'info@cryogene.inf.br', 'smtp_pass' => '102030fo40', 'mailtype' => 'html', 'charset' => 'iso-8859-1', 'wordwrap' => TRUE);
		$this -> load -> library('email', $config);

		$email_to = $email['to'];
		$email_to_alt = $email['cc'];

		$header = '		
						<img src="http://www.cryogene.inf.br/cryo/img/email_banner.png"><br>
						<table width="750" style="font-family: Tahoma, Verdana, Arial; font-size: 16px; line-height: 160%;" border=0>
						<tr><td>';
		
		$email_subject = $email['subject'];
		$nome = $email['to_nome'];
		$email_message = $header. $email['message'].'</table>';
		$email_message .= '<img src="http://www.cryogene.inf.br/cryo/img/email_banner_end.png"><br>';
		$email_message .= 'message ID:'.$email['id'];
		

		$this -> email -> from('info@cryogene.inf.br', 'Cryogene');
		$this -> email -> to($email_to);
		if (strlen($email_to_alt) > 0)
			{
				$this->email->cc($email_to_alt);
			}
		$this -> email -> bcc('info@cryogene.inf.br');

		$this -> email -> subject($email_subject.' - '.$nome);
		$this -> email -> message($email_message);
		echo '<BR>enviado para '.$email_to.', '.$email_to_alt.'<HR>';
		$this -> email -> send();
		
		echo $email_message;
		
		echo '<meta http-equiv="refresh" content="120">';

		echo $this -> email -> print_debugger();
	}

}
