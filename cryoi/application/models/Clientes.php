<?php
class clientes extends CI_model {
	var $nome='';
	var $cliente='';
	var $cpf='';
	var $line=array();
	var $erro = '';
	
	function le($id)
		{
			$sql = "select * from cliente where id_cl = ".$id;
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			if (count($rlt) > 0)
				{
					return($rlt[0]);
				} else {
					return(array());
				}
		}
	
	function cliente_contratos($cliente)
		{
			$sql = "select * from contrato
						left join (select cl_codigo as cl_pai, cl_nome as pai_nome from cliente) as pais on ctr_pai = cl_pai
						left join (select cl_codigo as cl_mae, cl_nome as mae_nome from cliente) as mae on ctr_mae = cl_mae
						left join (select cl_codigo as cl_resp, cl_nome as resp_nome from cliente) as resp on ctr_responsavel = cl_resp
					where ctr_responsavel = '$cliente'
					or ctr_pai = '$cliente'
					or ctr_mae = '$cliente' ";
			$sx = '<table width="100%" class="lt3 tabela00">';
			$sx .= '<tr><th colspan=5>Contratos do cliente</th></tr>';
			
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			
			for ($r = 0; $r < count($rlt); $r++) {
				$data = $rlt[$r];				
				$sx .= $this -> load -> view('contrato/lista', $data,true);			
				}
			$sx .= '</table>';
			return($sx);
		}
	
	function login_cliente($cpf,$nasc) {
		$nasc = brtos($nasc);
		$sql="select * from cliente where cl_cpf = '".$cpf."'";
		$rlt=$this->db->query($sql);
		$rlt=$rlt->result_array();
		if (count($rlt) > 0)
			{
				$line = $rlt[0];
				$cliente = $line['cl_codigo'];
				$cliente_nome = $line['cl_nome'];
				$sql = "select * from contrato 
							left join coleta on col_contrato = ctr_numero 
							where ctr_mae = '$cliente' or ctr_pai = '$cliente' 
										or ctr_cobranca = '$cliente' ";
				$rlt = $this->db->query($sql);
				$rlt = $rlt->result_array();
				for ($r=0;$r < count($rlt);$r++)
					{
						$linex = $rlt[$r];
						$data = $linex['col_dp_data'];
						$contrato = $linex['ctr_numero'];

						if ($nasc == $data)
							{
								$newdata = array('contrato_nome'=>$cliente_nome, 'contrato' => $contrato, 'ctr' => checkpost_link($contrato));
								$this->session->set_userdata($newdata);
								redirect(base_url('index.php/client'));
							}
					}
				$msg = 'Data de nascimento não confere';
				$this->erro = $msg;
			} else {
				$msg = 'Erro de Login';
				$this->erro = $msg;
			}
	}
	
	function busca_cliente($nome,$cpf)
		{
			$wh = '(';
			$nome = troca($nome,' ',';');
			$keys = splitx(';',$nome);
			
			if (strlen($cpf)==0)
				{
					$cpf = 'SEM CPF';
				}
			if (strlen($nome) == 0)
				{
					$wh = '(1=2';
				}
			/* Nome */
			for ($r=0;$r < count($keys);$r++)
				{
					$nm = $keys[$r];
					if (strlen($wh) > 1)
						{
							$wh .= ' and ';
						}
					$wh .= "(cl_nome like '%$nm%') ";
				}
			$wh .= ')';
			$sql = "select * from cliente where
				cl_cpf = '$cpf'
				or 
				($wh)		
				order by cl_nome
			";

			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$sx = '<table width="100%" class="tabela00 lt2">';
			$sx .= '<tr><th>Nome</th>
						<th>CPF</th>
						<th>e-mail</th>
						<th>Telefone</th>
						<th>Profissão</th>
						</tr>
						';
			$tot = 0;
			for ($r=0;$r < count($rlt);$r++)
				{
					$tot++;
					$line = $rlt[$r];
					
					/* Links */
					$link = '<a href="'.base_url('index.php/cliente/view/'.$line['id_cl'].'/'.checkpost_link($line['id_cl'])).'" class="link lt1">';
					$sx .= '<tr>';
					$sx .= '<td>';
					$sx .= $link.$line['cl_nome'].'</a>';
					$sx .= '</td>';

					$sx .= '<td>';
					$sx .= $line['cl_cpf'];
					$sx .= '</td>';
					
					$sx .= '<td>';
					$sx .= $line['cl_email'];
					$sx .= '</td>';
										
					$sx .= '<td>';
					$sx .= $line['cl_contato_telefone'];
					$sx .= '</td>';
										
					$sx .= '<td>';
					$sx .= $line['cl_profissao'];
					$sx .= '</td>';
										

					$sx .= '</tr>';
				}
			$sx .= '<tr><td colspan=5>Total de '.$tot.' registros</td></tr>';
			$sx .= '</table>';
			return($sx);
		}
	
	function busca_cliente_cpf($cpf='') {
		$cpf=strzero(sonumero($cpf),11);
		$cpf=substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
		$sql="select * from cliente where cl_cpf = '".$cpf."'";
		$rlt=$this->db->query($sql);
		$rlt=$rlt->result_array();
		if(count($rlt)>0) {
			$line=$rlt[0];
			$this->line=$line;
			return (1);
		} else {
			$this->line=array();
			return (0);
		}
	}
}
?>
