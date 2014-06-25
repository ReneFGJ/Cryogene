<?php
class boleto
	{
		var $id;

		var $aceite;
		var $automatico;
		var $cidade;
		var $conta;
		var $cpf;
		var $data_pago;
		var $data_processamento;
		var $data_vencimento;
		var $data_vencimento2;
		var $documento_numero;
		var $endereco;
		var $endereco1;
		var $endereco2;
		var $especie;
		var $especie_doc;
		var $fatura;
		var $lido;
		var $lido_data;
		var $nossonumero;
		var $obs;
		var $sacado;
		var $savado2;
		var $taxa;
		var $valor;
		var $valor_pago;

		var $tabela = 'cr_boleto';
		
	function saldos_cliente($cliente)
		{
			$sql = "select * from cr_boleto ";
			$sql .= "inner join contrato on bol_contrato = ctr_numero ";
			$sql .=" where (ctr_mae = '".$cliente ."' ";
			$sql .= " or ctr_pai = '".$cliente."' ";
			$sql .= " or ctr_responsavel = '".$cliente."') ";
			$sql .= " and (bol_status = 'A' or bol_status = 'B')";
			$sql .= " order by bol_data_vencimento desc ";
			$rlt = db_query($sql);
			
			$tot1 = 0; $tot2 = 0; $tot3 = 0; $tot4 = 0;
			$tot1a = 0; $tot2a = 0; $tot3a = 0; $tot4a = 0;
			
			while ($line = db_read($rlt))
				{
					$sta = trim($line['bol_status']);
					$vlr = $line['bol_valor_boleto'];
					if ($sta=='B')
						{
							$tot1 = $tot1 + 1;
							$tot1a = $tot1a + $vlr;
						}		
					if ($sta=='A')
						{
							$tot2 = $tot2 + 1;
							$tot2a = $tot2a + $vlr;
						}		
					if ($sta=='X')
						{
							$tot3 = $tot3 + 1;
							$tot3a = $tot3a + $vlr;
						}		
		
				}
			$sx = '<table class="lt1" width="100%" class="lt2" border=1>';
			$sx .= '<TR>';
			$sx .= '<TD>Total de quitados <B>'.$tot1.'</B> somando '.number_format($tot1a,2,',','.');
			$sx .= '<TD>Total de abertos <B>'.$tot2.'</B> somando '.number_format($tot2a,2,',','.');
			$sx .= '<TD>Total de cancelados <B>'.$tot3.'</B> somando '.number_format($tot3a,2,',','.');
				$sx .= '</table>';
			
			return($sx);
		}		
		
	function le($id='')
		{
			if (strlen($id) > 0)
				{ $this->id = $id; }
			$sql = "select * from ".$this->tabela." where id_bol = ".round($this->id);
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->data_processamento = $line['bol_data_processamento'];
					$this->valor = $line['bol_valor_boleto'];
					$this->taxa = $line['bol_tx_boleto'];
					$this->aceite = $line['bol_aceite'];
					$this->especie = $line['bol_especie'];
					$this->especie_doc = $line['bol_especie_doc'];
					$this->nossonumero = $line['bol_nosso_numero'];
					$this->documento_numero = $line['bol_numero_documento'];
					$this->cpf = $line['bol_cpf_cnpj'];
					$this->endereco = $line['bol_endereco'];
					$this->cidade = $line['bol_cidade'];
					
					$this->endereco1 = $line['bol_endereco1'];
					$this->endereco2 = $line['bol_endereco2'];
					$this->conta = $line['bol_conta'];
					$this->obs = $line['bol_obs'];
					$this->valor_pago = $line['bol_valor_pago'];
					$this->data_pago = $line['bol_data_pago'];
					
					$this->sacado = $line['bol_sacado'];
					$this->sacado2 = $line['bol_sacado_2'];
					
					$this->lido = $line['bol_lido'];
					$this->lido_data = $line['bol_lido_data'];
					$this->automatico = $line['bol_auto'];
					
					$this->tipo = $line['bol_tipo'];
					$this->data_vencimento = $line['bol_data_vencimento'];
					$this->data_vencimento2 = $line['bol_data_vencimento_2'];
					$this->fatura = $line['bol_fatura'];
				}
			return(True);
		}
		
	function mst_detalhe()
		{
			$sx = '';
			$sx .= '<fieldset><legend>Sacado</legend>';
			$sx .= '<table width="100%" class="lt0">';
			$sx .= '<TR><TD>';
			$sx .= 'SACADO';
			$sx .= '<TD>CPF';
			
			$sx .= '<TR class="lt2"><TD><B>';
			$sx .= $this->sacado;
			
			$sx .= '<TD width=25%>';
			$sx .= $this->cpf;

			$sx .= '<TR><TD>';
			$sx .= 'ENDEREÇO';
			$sx .= '<TD>ACEITE';
			$sx .= '<TR class="lt1"><TD><B>';
			$sx .= $this->endereco;
			$sx .= '<BR>'.$this->endereco1;
			$sx .= '<BR>'.$this->endereco2;

			$sx .= '<TD width=25%>';
			$sx .= $this->aceite;

			$sx .= '</table>';
			$sx .= '</field>';
			
			/* Valores do boleto */
			$sx .= '<fieldset><legend>Dados do boleto</legend>';
			$sx .= '<table width="100%" class="lt0">';
			$sx .= '<TR><TD>Nosso número';
			$sx .= '<TD>Data Processamento';
			$sx .= '<TD>Vencimento';
			$sx .= '<TD>Valor';
			
			
			$sx .= '<TR class="lt2">';
			$sx .= '<TD width=25%><B>'.$this->nossonumero;
			$sx .= '<TD width=25%><B>'.stodbr($this->data_processamento);
			$sx .= '<TD width=25%><B>'.stodbr($this->data_vencimento);
			$sx .= '<TD width=25%><B>'.numberformat_br($this->valor,2);
			
			$sx .= '</table>';
			$sx .= '</field>';
			
			$sx .= '<BR>';
			$sx .= '<fieldset><legend>Boleto</legend>';
			$sx .= '<table width="100%" class="lt0">';	
			$sx .= '<TR align="center">';
			$link = 'onclick="newxy2(\'bb.php?dd0='.$this->id.'\',710,600);"';
			$sx .= '<BR><input type="button" value="visualizar boleto" '.$link.'>';
					
			return($sx);
		}
	}
?>
