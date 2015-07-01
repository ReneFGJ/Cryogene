<?php
class ic extends CI_Controller {
	function __construct() {
		global $db_public;

		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('form');
		$this -> load -> helper('form_sisdoc');
		$this -> load -> helper('url');
		$this -> load -> library('session');
		//$this -> lang -> load("app", "portuguese");
	}

	function index($id=0) {
		$this -> load -> view('header/cab.php');

		/* Load Models */
		$this -> load -> model('ics');

		$data = array();

		$form = new form;
		$form -> tabela = $this -> ics -> tabela;
		$form -> see = true;
		$form -> edit = true;
		$form -> novo = true;
		$form = $this -> ics -> row($form);

		$form -> row_edit = base_url('index.php/ic/edit');
		$form -> row_view = base_url('index.php/ic/view');
		$form -> row = base_url('index.php/ic');

		$tela['content'] = row($form, $id);

		$tela['title'] = $this -> lang -> line('title_ics');

		$this -> load -> view('content', $tela);
	}
	
	function sendmail()
		{
			$this -> load -> view('header/cab.php');
			$this -> load -> model('emails');
			
			$this->emails->enviar_cache();
			
		}
	
	function view($id = 0, $check = '') {
		/* Load Models */
		$this -> load -> model('ics');

		$this -> load -> view('header/cab.php');
		
		$data = $this->ics->le($id);

		$this -> load -> view('equipamento/view', $data);
		
		}
	
	function edit($id = 0, $check = '') {
		/* Load Models */
		$this -> load -> model('ics');
		$cp = $this->ics->cp();
		

		$this -> load -> view('header/cab.php');
		
		$form = new form;
		$form->id = $id;
		
		$tela = $form->editar($cp,$this->ics->tabela);
		$data = array();
		$data['title'] = msg('ic_title');
		
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
		
		/* Salva */
		if ($form->saved > 0)
			{
				redirect(base_url('index.php/ic'));
			}
		
	}	

}
?>