<?php
class relacionamentos extends CI_Model
	{
	var $tabela = 'cliente_relacionamento';
	
	function inserir_pr()
		{
			$data = date("Ymd");
			$hora = date("H:i:s");
			$log = '';
			$status = get("dd4");
			$descricao = get("dd1");
			$contato = get("dd2");
			$ctr = get("dd5");
			$log = $_SESSION['user'];
			
			$sql = "insert into ".$this->tabela."
					(
					crl_contrato, crl_hora, crl_data,
					crl_log, crl_status, crl_content, 
					crl_contato, crl_cliente, crl_resposta,
					crl_retorno_data
					) values (
					'$ctr','$hora','$data',
					'$log','$status','$descricao',
					'$contato','','',
					19000101
					)
				";
			$rlt = $this->db->query($sql);
			return(1);
		}
	
	function mostra_rp($ctr)
		{
			$sql = "select * from ".$this->tabela."
					WHERE crl_contrato = '$ctr' 
					ORDER BY crl_data DESC, crl_hora DESC
			";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$sx = '<table width="100%" class="lt2 tabela01">';
			$sx .= '<tr>
						<th width="10%">Data</th>
						<th width="10%">Contato</th>
						<th width="80%">Descrição</th>
					</tr>';
			for ($r=0;$r < count($rlt);$r++)
				{
					$data = $rlt[$r];
				
					$sx .= '<tr valign="top">';
					$sx .= '<td class="border1">';
					$sx .= stodbr($data['crl_data']);
					$sx .= '<br>';
					$sx .= $data['crl_hora'];
					$sx .= '<br>';
					$sx .= $data['crl_log'];										
					$sx .= '</td>';

					$sx .= '<td class="border1">';
					$sx .= $data['crl_contato'];
					$sx .= '</td>';					

					$sx .= '<td class="border1">';
					$sx .= mst($data['crl_content']);
					$sx .= '</td>';
					$sx .= '</tr>';
				}
			$sx .= '</table>';
			return($sx);
		}	
	}
?>
