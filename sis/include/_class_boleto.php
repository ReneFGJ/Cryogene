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
			$sx .= '<TD width=25%><B>'.$this->data_processamento;
			$sx .= '<TD width=25%><B>'.$this->data_vencimento;
			$sx .= '<TD width=25%><B>'.numberformat_br($this->valor);
			
			$sx .= '</table>';
			$sx .= '</field>';
			
			$sx .= '<BR>';
			return($sx);
		}
	}
?>
