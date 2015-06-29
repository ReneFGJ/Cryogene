<?php
class contratos extends CI_model
	{
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
	function le($id)
		{
			$sql = "select * 
						from contrato where ctr_numero = '".$id."' ";
						
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
			
			
			/* Resonsaveis - PAI*/
			$sql = "select * from cliente where cl_codigo = '".$line['ctr_pai']."' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$ln = $rlt[0];
			$line['pai_nome'] = trim($ln['cl_nome']);
			
			/* Resonsaveis - Mae*/
			$sql = "select * from cliente where cl_codigo = '".$line['ctr_mae']."' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$ln = $rlt[0];
			$line['mae_nome'] = trim($ln['cl_nome']);

			/* Resonsaveis - Cobranca*/
			$sql = "select * from cliente where cl_codigo = '".$line['ctr_responsavel']."' ";
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array();
			$ln = $rlt[0];
			$line['responsavel_nome'] = trim($ln['cl_nome']);
			
			return($line);
		}	
	}
?>
