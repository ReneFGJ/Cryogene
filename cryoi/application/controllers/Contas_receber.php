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
		
	}
	
	function boletos_atrasados() {
		$this -> load -> view('header/cab.php');
		
		$this -> load -> model("boletos");
		$this -> load -> model("emails");
		$tela = $this->boletos->boletos_atrasados();
		$data['content'] = $tela;
		$this->load->view("content",$data);
		
	}	

	function boletos() {
		$this -> load -> view('header/cab.php');
		
		$this -> load -> model("boletos");
		$this -> load -> model("emails");
		$this->boletos->preparar_email_anuidade();
	}
	
	function taxa_negociacao($id=0)
		{
		$this -> load -> model("boletos");
		$this -> load -> view('header/cab.php');
		
		$form = new form;
		$form -> tabela = 'taxa_negociacao';
		$form -> see = FALSE;
		$form -> novo = TRUE;
		$form->row = base_url('index.php/contas_receber/taxa_negociacao');
		$form->row_view = '';
		$form->row_edit = base_url('index.php/contas_receber/taxa_negociacao_ed');
		$form->edit = True;
		$form = $this -> boletos -> negociacao_row($form);
		
		
		$tela['content'] = row($form,$id);
		$tela['title'] = 'Negociação';

		$this -> load -> view('content', $tela);
			
		}
		
	function taxa_negociacao_ed($id = '') {
		$this -> load -> model("boletos");
		$this -> load -> view('header/cab.php');

		/* Formulario */
		$form = new form;
		$form -> id = $id;
		$form -> tabela = 'taxa_negociacao';
			$form -> row = base_url('index.php/contas_receber/taxa_negociacao_ed/'.$id.'/'.checkpost_link($id));
			$form -> cp = $this -> boletos -> negociacao_cp();
	
			/* form */
			$data['content'] = $form -> editar($form -> cp, $form -> tabela);
			$data['title'] = msg('taxa_negociacao');
			$this -> load -> view('content', $data);			
	
			if ($form -> saved > 0) {
				$url = base_url('index.php/contas_receber/taxa_negociacao');
				redirect($url);
			}			

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
		$data['content'] = $this -> boletos -> boleto_razao($ano1, $ano2, $gran,'B').'<BR><BR>';
		$data['title'] = 'Contas a receber - Boletos quitados';
		$this->load->view('content',$data);


		$data['content'] = $this -> boletos -> boleto_razao($ano1, $ano2, $gran,'A');
		$data['title'] = 'Contas a receber - Boletos abertos';
		$this->load->view('content',$data);
	}

}
