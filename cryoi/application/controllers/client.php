<?php
class client extends CI_Controller {
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
		$this -> load -> helper('cryo_url');
		$this -> load -> library('session');
		
		
		if (!isset($_SESSION['contrato']))
			{
				redirect(base_url('index.php'));
			}
	}

	function index() {
		$this->load->model('contratos');
		$this->load->model('boletos');
		$this -> load -> model("emails");
		
		$this -> load -> view('header/cab_client.php');
		$contrato = $_SESSION['contrato'];
		$data = $this->contratos->le($contrato);

		$this -> load -> view('client/contrato_mini', $data);
		
		$data['ctr_numero'] = $contrato;
		$this -> load->view('contrato_financeiro',$data);
	}
	
	function contrato()
		{
		$this -> load -> view('header/cab_client.php');	
		}
		
	function contact()
		{
		$this -> load -> view('header/cab_client.php');				
		$this -> load -> view('client/client_contato');	
		}		

	function logout() {
		$newdata = array('contrato_nome' => '', 'contrato' => '', 'ctr' => '');
		$this -> session -> set_userdata($newdata);
		redirect(base_url('index.php/'));
	}

}
?>
