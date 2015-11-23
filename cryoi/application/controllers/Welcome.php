<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		global $db_public;

		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');		

	}
	
	public function index()
	{
		global $dd;
		$this->load->model('clientes');
		form_sisdoc_getpost();
		$this->load->view('header/header');
		$this->load->view('header/cab_client');
		$data = array();
		
		/* Dados do Login */
		$cpf = get("dd1");
		$nasc = get("dd2");
		if ((strlen($cpf) > 0) and (strlen($nasc) > 0))
			{
				$this->clientes->login_cliente($cpf,$nasc);
			}
		$this->load->view('welcome_message',$data);
	}
}
