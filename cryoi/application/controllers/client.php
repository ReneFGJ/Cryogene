<?php
class client extends CI_Controller {
	function __construct() {
		global $db_public;

		$db_public = 'brapci_publico.';
		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		//$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		//$this -> lang -> load("app", "portuguese");
		
		if (!isset($_SESSION['contrato']))
			{
				redirect(base_url('index.php'));
			}
	}

	function index() {
		$this -> load -> view('header/cab_client.php');

		for ($r = 0; $r < 1; $r++) {
			$data = array();
			$this -> load -> view('client/contrato_mini', $data);
		}
	}
	
	function contrato()
		{
		$this -> load -> view('header/cab_client.php');	
		}

	function logout() {
		$newdata = array('contrato_nome' => '', 'contrato' => '', 'ctr' => '');
		$this -> session -> set_userdata($newdata);
		redirect(base_url('index.php/'));
	}

}
?>
