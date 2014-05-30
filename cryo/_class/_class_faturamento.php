<?php
class faturamento
	{
	var $tabela = 'faturamento';
	
	function gera_faturamento_pelo_boleto($contrato)
			{
				$sql = "update cr_boleto set bol_data_documento = 19000101 where bol_data_documento = 0";
				$rlt = db_query($sql);
				
				$cp = 'bol_obs, round(sum(bol_valor_boleto + bol_tx_boleto)*100)/100 as valor, bol_data_documento ';
				//$cp = '*';
				$sql = "select $cp from cr_boleto 
					where bol_contrato = '$contrato' and
					(bol_status = 'A' or bol_status = 'B') and
					bol_obs like '%Anuidade%'
					group by bol_data_documento
				";
				
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
					{
						$ano = sonumero($line['bol_obs']);
						$ano = substr($ano,0,4);
						$valor = $line['valor'];
						$data = $line['bol_data_documento'];
						$this->gera_fatura($contrato,$valor,$data,$ano);
					}
			}
	function gera_fatura($contrato,$valor,$data,$ano=0)
		{
			if ($ano==0) { $ano = substr($data,0,4); }
			$tipo = 'A';
			
			if (($ano < 2005) or ($ano > date("Y"))) { echo '-->'.$ano; return(0); }
			
			$sql = "select * from ".$this->tabela." 
					where fat_ano = '$ano' and
						  fat_tipo = '$tipo' and
						  fat_contrato = '$contrato'
			";
			$rlt = db_query($sql);
			
			if (!($line = db_read($rlt)))
				{
				$sql = "insert into ".$this->tabela." 
					(
					fat_nr, fat_ano, fat_contrato,
					fat_valor, 	fat_status, fat_tipo,
					fat_vlr_pago, fat_vlr_desconto, fat_vlr_juros,
					fat_dt_pago, fat_dt_fatura, fat_obs
					) values (
					'','$ano','$contrato',
					$valor, 'A', '$tipo',
					0,0,0,
					19000101, $data, ''
					)			
				";
				//echo $sql;
				//exit;
				$rlt = db_query($sql);
				}
		}	
	function show_status($status)
		{
			$status = trim($status);
			switch ($status)
				{
				case 'A': $sx = 'Aberto'; break;
				}
			return($sx);
		}
	function mostra_fatura_historico($contrato)
		{
			$sql = "select * from ".$this->tabela." 
					where fat_contrato = '$contrato'
					order by fat_tipo, fat_ano 
			";
			$rlt = db_query($sql);
			$sx = '<table width="100%" class="tabela00">';
			while ($line = db_read($rlt))
				{
					$sx .= '<TR class="lt2">';
					$sx .= '<TD align="center">';
					$sx .= $line['fat_ano'];
					$sx .= '<TD align="center">';
					$sx .= $this->show_status($line['fat_status']);
					$sx .= '<TD align="right">';
					$sx .= fmt($line['fat_valor'],2);
				}
			$sx .= '</table>';
			return($sx);
		}
	}
?>
