<?php
class cliente extends CI_Controller {
	function __construct() {
		global $db_public;

		$db_public = 'brapci_publico.';
		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		//$this -> lang -> load("app", "portuguese");
	}
	
	function view($id=0,$chk='')
		{
		$this->load->model('clientes');
					
			if (checkpost($id,$chk))
				{
					redirect(base_url('index.php/main'));
				}
		$this -> load -> view('header/cab.php');
		
		$data = $this->clientes->le($id);
		$this->load->view('client/view',$data);
		$cliente = $data['cl_codigo'];
		
		$tela = $this->clientes->cliente_contratos($cliente);
		$data['content'] = $tela;
		$this->load->view('content',$data);			
		}

	function busca()
		{
		$this->load->model('clientes');
		
		$this -> load -> view('header/cab.php');
		$this -> load -> view('client/busca');
		
		/* Busca */
		$nome = get("dd1");
		$cpf = get("dd2");
		if (strlen($nome.$cpf) > 0)
			{
				$tela = $this->clientes->busca_cliente($nome,$cpf);
				
				$data['content'] = $tela;
				$this->load->view('content',$data);
			}
			
		}

	function index() {
		$this -> load -> view('header/cab.php');
		$this -> load -> view('header/cab_nav_client');

		for ($r = 0; $r < 1; $r++) {
			$data = array();
			$this -> load -> view('client/contrato_mini', $data);
		}
	}

}
?>
