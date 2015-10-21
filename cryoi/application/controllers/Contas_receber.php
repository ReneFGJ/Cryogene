<?php
class contas_receber extends CI_Controller {
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
		$this -> load -> view('header/cab_nav');
	}

	function boletos() {
		$this -> load -> view('header/cab.php');
		$this -> load -> view('header/cab_nav');
		$this -> load -> model("boletos");
		$this -> load -> model("emails");
		$this->boletos->preparar_email_anuidade();
	}
	
	function gerar_faturamento_emitir($id,$chk) {
		/* Models */
		$this -> load -> model("faturamentos");
		$this -> load -> model("boletos");
		$this -> load -> model("emails");
		$this -> load -> view('header/cab.php');
		
		/* Dados */
		$dd0 = $this->input->post('dd0');
		$dd1 = $this->input->post('dd1');
		$dd2 = $this->input->post('dd2');

		
		if ((strlen($dd0) > 0) and (strlen($dd1)) and (strlen($dd2) > 0))
			{
				$data = array();

				$data['content'] = $this->faturamentos->gerar_faturas($id);
				$this -> load -> view('content',$data);
				
				/* Envia e-mail */
				$data['to'] = 'renefgj@gmail.com';#
				$data['subject'] = 'Resumo das Anuidades '.$id;
				$data['message'] = $data['content'];
				$this->emails->enviar_email($data);				
				return('');
			}
		
		$data = array();
		$data['content'] = $this->faturamentos->armazenamento_faturar($id);
		
		$this -> load -> view('content',$data);
	}	
	
	function gerar_faturamento() {
		/* Models */
		$this -> load -> model("faturamentos");
		
		$this -> load -> view('header/cab.php');
		$data = array();
		$data['title'] = 'Gerar Faturamento';
		
		$form = new form;
		$cp = $this->faturamentos->cp_mes_faturamento();
		$data['content'] = $form->editar($cp,'');
		$data['title'] = 'Faturamento - Contrato ';
		if ($form->saved > 0)
			{
				$dd1 = $this->input->post("dd1");
				redirect(base_url('index.php/contas_receber/gerar_faturamento_emitir/'.$dd1.'/'.checkpost_link($dd1)));
			} else {
				$this -> load -> view('content',$data);				
			}

	}	

	function razao_boleto($ano1 = 0, $ano2 = 0, $gran = 'M') {
		$this -> load -> view('header/cab.php');

		$this -> load -> model("boletos");
		$tela = $this -> boletos -> boleto_razao($ano1, $ano2, $gran,'B');
		echo $tela;
	}

}
