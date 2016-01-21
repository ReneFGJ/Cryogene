<?php
class main extends CI_Controller {
	function __construct() {
		global $db_public;

		$db_public = 'brapci_publico.';
		parent::__construct();
		$this -> lang -> load("app", "portuguese");
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		
	}

	function index() {
		$this->load->model('contratos');
		
		$this -> load -> view('header/cab.php');
		
		$this->load->view('forms/search_form');
		
		$dd1 = get("dd1");
		if (strlen($dd1) > 0)
			{
				$data = array();
				$data['content'] = $this->contratos->busca($dd1);
				$this->load->view('content',$data);
			}
	}
	function logout()
		{
		$this->load->model('securitys');
		
		redirect(base_url('index.php/main/login'));	
		}
	function login()
		{
			$this->load->model('securitys');
			$dd1 = troca($this->input->post('user'),"'",'´');
			$dd2 = troca($this->input->post('pass'),"'",'´');
			if ((strlen($dd1) > 0) and (strlen($dd2) > 0))
				{
					if ($this->valida_login($dd1,$dd2))
						{
							echo 'Autenticado'; exit;							
						} else {
							echo 'Erro de senha'; exit;
						}				
				}
				
			$this -> load -> view('header/cab_client.php');			
			$this->load->view('login');
		}
		
	function valida_login($log,$pass)
		{
			$this->load->model('securitys');
			$sql = "select * from usuario where us_login = '$log' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					if ($pass == trim($line['us_senha']))
						{
							$this->securitys->save($line['us_nome'],$line['us_login'],$line['id_us']);
							redirect(base_url('index.php/main'));
							return(1);
						} else {
							return(0);
						}
				} else {
					return(0);
				}
		}
}
?>