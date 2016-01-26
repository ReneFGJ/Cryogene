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

	function resumo() {
		$this -> load -> model('contratos');
		$this -> load -> view('header/cab.php');

		$tela = $this -> contratos -> resumo();
		$data['content'] = $tela;
		$this -> load -> view('content', $data);
	}

	function boleto_set($id, $chk) {
		$this -> load -> model('boletos');
		$ctr = get("ctrl");

		if (isset($_SESSION['nego_contrato'])) {
			if ($_SESSION['nego_contrato'] == $ctr) {
				$acr = array();
				$acr['nego_contrato'] = $ctr;
				if (isset($_SESSION['nego_boletos'])) {
					$bols = $_SESSION['nego_boletos'];
				} else {
					$bols = '';
				}

			} else {
				$acr = array();
				$bols = $ctr;
			}
		} else {
			$acr = array();
			$acr['nego_contrato'] = $ctr;
			$bols = '';
		}

		if ($chk == 'true') {
			if (!(strpos($bols, '[' . $id . ']'))) {
				$bols .= '[' . $id . '];';
				//echo '<font color="green">GREEN</font>';
			}
		} else {
			//echo '<font color="red">REMOVE</font>';
				$bols = troca($bols,'[' . $id . '];','');					
		}


		/* Calcula */
		$bole = splitx(';',$bols);
		$wh = '';
		for ($r = 0; $r < count($bole);$r++)
			{
				if (strlen($wh) > 0) { $wh .= ' or ';}
				$wh .= '(id_bol = '.sonumero($bole[$r]).') ';		
			}
		$tot_juros = 0;
		$tot_valor = 0;
		
		if (strlen($wh) > 0)
			{
				$sql = "select * from cr_boleto where ".$wh;
				$rlt = $this->db->query($sql);
				$rlt = $rlt->result_array();
				
				for ($r=0;$r < count($rlt);$r++)
					{
						$line = $rlt[$r];
						$vlra = $this->boletos->correcao_boletos($line['bol_data_vencimento'],$line['bol_valor_boleto']);
						$tot_juros = $tot_juros + $vlra[1];
						$tot_valor = $tot_valor + $line['bol_valor_boleto'];						
					}
			}
		$data = array();
		$data['tit_total'] = count($bole);
		$data['jur_total'] = $tot_juros;
		$data['vlr_total'] = $tot_valor;
		$this -> load -> view('boleto_negociacao_tela', $data);

		$acr['nego_boletos'] = $bols;
		$this -> session -> set_userdata($acr);

	}

	function view($id = 0, $chk = '') {
		/* Model */
		$this -> load -> model('contratos');
		$this -> load -> model('boletos');
		$this -> load -> model('relacionamentos');

		/* RP */
		if ((strlen(get("dd1")) > 0) and (strlen(get("dd2")) > 0) and (strlen(get("dd4")) > 0)) {
			$ok = $this -> relacionamentos -> inserir_pr();
			if ($ok == 1) {
				redirect(base_url('index.php/contrato/view/' . $id . '/' . $chk . '?dd3=7'));
				exit ;
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