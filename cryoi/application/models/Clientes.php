<?php
class clientes extends CI_model {
	var $nome = '';
	var $cliente = '';
	var $cpf = '';
	var $line = array();
	
	function busca_cliente_cpf($cpf = '') {
		$cpf = strzero(sonumero($cpf), 11);
		$cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
		$sql = "select * from cliente where cl_cpf = '" . $cpf . "'";
		$rlt = $this->db->query($sql);
		$rlt = $rlt->result_array();
		if (count($rlt) > 0)
			{
				$line = $rlt[0];
				$this->line = $line;
				return(1);
			} else {
				$this->line = array();
				return(0);
			}
	}

}
?>
