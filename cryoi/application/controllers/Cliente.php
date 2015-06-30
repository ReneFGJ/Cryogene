<?php
class cliente extends CI_Controller {
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
