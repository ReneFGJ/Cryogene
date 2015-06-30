<?php
class ICs extends CI_Model
	{
		var $tabela = "ic_noticia";
		
	function row($obj) {
		$obj -> fd = array('id_nw', 'nw_titulo', 'nw_ref', 'nw_thema');
		$obj -> lb = array('ID', 'Equipamento', 'Marca', 'Modelo');
		$obj -> mk = array('', 'L', 'L', 'L');
		return ($obj);
	}
	
	function cp()
		{
			$cp = array();
			array_push($cp,array('$H8','id_nw','',False,True));
			array_push($cp,array('$S120','nw_titulo',msg('eq_nome'),True,True));
			array_push($cp,array('$D','nw_dt_de',msg('ic_de'),True,True));
			array_push($cp,array('$D','nw_dt_ate',msg('ic_ate'),True,True));
			array_push($cp,array('$S20','nw_ref',msg('ic_ref'),True,True));
			array_push($cp,array('$T80:4','nw_descricao',msg('ic_descricao_1'),True,True));
			array_push($cp,array('$O 1:SIM&0:NÃO','nw_ativo',msg('eq_ativo_2'),True,True));
			array_push($cp,array('$B','',msg('enviar'),false,True));			
			return($cp);
		}
	
	function le($id = 0)
		{
			$sql = "select * from ".$this->tabela." 
					where id_nw = ".$id;
					
			$rlt = $this->db->query($sql);
			$rlt = $rlt->result_array($rlt);
			$data = $rlt[0];
			
			return($data);
		}		
		
	}
?>
