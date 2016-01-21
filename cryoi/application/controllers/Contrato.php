<?php
class contrato extends CI_Controller {
	function __construct() {
		global $db_public;

		$db_public = 'brapci_publico.';
		parent::__construct();
		$this -> lang -> load("app", "portuguese");
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('cryo_url');
		$this -> load -> helper('url');
		$this -> load -> library('session');

		date_default_timezone_set('America/Sao_Paulo');
	}

	function index() {
		$this -> load -> view('header/cab.php');
	}

	function view($id = 0, $chk = '') {
		/* Model */
		$this -> load -> model('contratos');
		$this -> load -> model('boletos');
		$this -> load -> model('relacionamentos');

		/* RP */
		if ((strlen(get("dd1")) > 0) and (strlen(get("dd2")) > 0) and (strlen(get("dd4")) > 0)) {
			$ok = $this -> relacionamentos -> inserir_pr();
			if ($ok == 1)
				{
					redirect(base_url('index.php/contrato/view/'.$id.'/'.$chk.'?dd3=7'));
					exit;
				}
		}

		$this -> load -> view('header/cab.php');
		$data = array();

		$data = $this -> contratos -> le($id);

		$this -> load -> view("contrato", $data);
		$data['data'] = $data;
		$this -> load -> view("contrato_dados", $data);

	}

}
?>