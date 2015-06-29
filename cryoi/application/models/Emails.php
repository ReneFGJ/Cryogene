<?php
class emails extends CI_model {
	var $to = array();
	function enviar_email($email) {
		$config = Array('protocol' => 'smtp', 'smtp_host' => 'ssl://mail.cryogene.inf.br', 'smtp_port' => 465, 'smtp_user' => 'info@cryogene.inf.br', 'smtp_pass' => '102030fo40', 'mailtype' => 'html', 'charset' => 'iso-8859-1', 'wordwrap' => TRUE);
		$this -> load -> library('email', $config);

		$email_to = $email['to'];
		$email_subject = $email['subject'];
		$email_message = $email['message'];
		

		$this -> email -> from('info@cryogene.inf.br', 'Cryogene');
		$this -> email -> to($email_to);
		//$this->email->cc('another@another-example.com');
		$this -> email -> bcc('info@cryogene.inf.br');

		$this -> email -> subject($email_subject);
		$this -> email -> message($email_message);

		$this -> email -> send();

		echo $this -> email -> print_debugger();
	}

}
