<?php
class fatura {
	var $tabela = "fatura";
	function cp() {
		$this->updatex();
		$cp = array();
		array_push($cp, array('$H8', 'id_ft', '', False, True));
		array_push($cp, array('$O ANU:Anuidade&CON:Contrato', 'ft_tipo', 'Tipo', False, True));
		array_push($cp, array('$[2000-2099]', 'ft_referencia_ano', 'Ano Base', True, True));
		array_push($cp, array('$S7', 'ft_contrato', 'Contrato', False, True));
		array_push($cp, array('$O : &S:SIM', 'ft_negociacao', 'Negociado', False, True));
		array_push($cp, array('$H8', 'ft_nr', '', False, True));
		array_push($cp, array('$HV', 'ft_status', '1', False, True));
		array_push($cp, array('$I8', 'ft_valor_boleto', 'Valor do boleto', True, True));
		array_push($cp, array('$U8', 'ft_data_vencimento', '', False, True));
		array_push($cp, array('$U8', 'ft_data_documento', '', False, True));
		array_push($cp, array('$U8', 'ft_data_processamento', '', False, True));
		
		return ($cp);
	}

	function updatex() {

		global $base;
		$c = 'ft';
		$c1 = 'id_' . $c;
		$c2 = $c . '_nr';
		$c3 = 12;
		$sql = "update " . $this -> tabela . " set $c2 = lpad($c1,$c3,0) where $c2='' or $c2 is null";
		if ($base == 'pgsql') { $sql = "update " . $this -> tabela . " set $c2 = trim(to_char(id_" . $c . ",'" . strzero(0, $c3) . "')) where $c2='' or  $c2 isnull ";
		}
		$rlt = db_query($sql);
	}

}
?>
