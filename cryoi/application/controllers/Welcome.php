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
		$cp = array();
		array_push($cp,array('$H8','','',False,False));
		array_push($cp,array('$M','','Informe CPF do pai ou da mãe',True,True));
		array_push($cp,array('$S12','','&nbsp;',True,True));
		array_push($cp,array('$M','','Informe a data de nascimento do Bebê',True,True));
		array_push($cp,array('$D8','','&nbsp;',True,True));
		array_push($cp,array('$B8','','Entrar',True,True));
		
		$form = new form;
		$data['form'] = $form->editar($cp,'');
		
		/* Busca cliente */
		if ($this->clientes->busca_cliente_cpf($dd[2]) > 0)
			{
				$data = $this->clientes->line;
				$cliente = $data['cl_cliente'];
			} else {
				$cliente = 'xxxxxxx';
			}
		
		
		$sql = "select * from ctr_data_coleta = '".brtos($dd[4])."' and (ctr_pai = '$cliente')";
		echo $sql;
		
		$this->load->view('welcome_message',$data);
	}
}
