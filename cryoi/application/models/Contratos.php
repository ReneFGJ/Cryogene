<?php
class contratos extends CI_model
	{
	function resumo()
		{
			$sql = "select ctr_status, count(*) as total, substring(ctr_dt_assinatura,1,4) as ano
						FROM contrato 
						GROUP BY ano, ctr_status";
						
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			for ($r=0;$r < count($rlt);$r++)
				{
					$line = $rlt[$r];
					
					$ano = $line['ano'];
					print_r($line);
					echo '<hr>';
				}
		}
	function status($sta) {
		switch($sta) {
			case 'S' :
				$sta = '<font color="blue">Ativo</font>';
				break;
			case 'N' :
				$sta = '<font color="red">Inativo</font>';
				break;
			case 'F' :
				$sta = '<font color="green">Já faturado</font>';
				break;
			case 'Z' :
				$sta = '<font color="orange">Conferir</font>';
				break;	
			case 'I' :
				$sta = '<font color="orange">Isento</font>';
				break;							
		}
		return ($sta);
	}	
	
	function busca($term='')
		{
			$sx = '<br><br>';
			$sx .= '<h1>'.$term.'</h1>';
			
			$tnum = sonumero($term);
			$wh = " ((pai_nome like '%$term%') or (mae_nome like '%$term%') or (resp_nome like '%$term%')) ";
			if ($tnum == $term)
				{
					$wh = " (ctr_numero like '%$term%' )";
				}
					
			$sql = "select * from contrato
						left join (select cl_codigo as cl_pai, cl_nome as pai_nome from cliente) as pais on ctr_pai = cl_pai
						left join (select cl_codigo as cl_mae, cl_nome as mae_nome from cliente) as mae on ctr_mae = cl_mae
						left join (select cl_codigo as cl_resp, cl_nome as resp_nome from cliente) as resp on ctr_responsavel = cl_resp
					where $wh 
					ORDER BY ctr_numero DESC
					LIMIT 50";
										
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$tot1=0;
			$tot2=0;
			$tot3=0;
			$sx = '<table width="100%" class="tabela00 lt2">';
			for ($r=0;$r < count($rlt);$r++)
				{
					$line = $rlt[$r];
					$sx .= $this->load->view('contrato/lista',$line,true);
				}				
			return($sx);
		}	
	function le($id)
		{
			$sql = "select * 
						from contrato 
						left join coleta on ctr_numero = col_contrato
						where ctr_numero = '".$id."' ";
						
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$line = $rlt[0];
			
			$line['situacao'] = $this->status($line['ctr_status']);
			$contrato = $line['ctr_numero'];
			
			/* Boletos */
			$sql = "select bol_status, (bol_valor_boleto + bol_tx_boleto) as total, bol_data_vencimento from cr_boleto where bol_contrato = '$contrato' and bol_status = 'A' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$vlra = 0; $vlrb = 0;
			for ($r=0;$r < count($rlt);$r++)
				{
					$ln = $rlt[$r];
					if ($ln['bol_data_vencimento'] < date("Ymd"))
						{
							$vlra = $vlra + $ln['total'];
							$vlrb = $vlrb + $ln['total'];
						} else {
							$vlra = $vlra + $ln['total'];
						}
				}
			
			$line['boleto_aberto'] = ($vlra);
			$line['boleto_atrasado'] = ($vlrb);
			
			$DadosContatos = '';
			/* Resonsaveis - PAI*/
			$sql = "select * from cliente where cl_codigo = '".$line['ctr_pai']."' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$ln = $rlt[0];
			$line['pai_nome'] = trim($ln['cl_nome']);
			$ln['tipo'] = 'Pai';
			$DadosContatos .= $this->load->view('contato',$ln,True);
			
			/* Resonsaveis - Mae*/
			$sql = "select * from cliente where cl_codigo = '".$line['ctr_mae']."' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$ln = $rlt[0];
			$line['mae_nome'] = trim($ln['cl_nome']);
			$ln['tipo'] = 'Mãe';
			$DadosContatos .= $this->load->view('contato',$ln,True);

			/* Resonsaveis - Cobranca*/
			$sql = "select * from cliente where cl_codigo = '".$line['ctr_responsavel']."' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$ln = $rlt[0];
			$line['responsavel_nome'] = trim($ln['cl_nome']);
			$ln['tipo'] = 'Cobrança';
			$DadosContatos .= $this->load->view('contato',$ln,True);
			
			$line['DadosContatos'] = $DadosContatos.'XXX';
			
			return($line);
		}	
	}
?>
