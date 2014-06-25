<?php
class fatura
	{
		var $tabela = "fatura";
		function cp()
			{
				$cp = array();
				array_push($cp,array('$H8','id_ft','',False,True));
				array_push($cp,array('$O ANU:Anuidade&CON:Contrato','ft_tipo','Tipo',False,True));
				array_push($cp,array('$[2000-2099]','ft_referencia_ano','Ano Base',True,True));
				array_push($cp,array('$S7','ft_contrato','Contrato',False,True));
				array_push($cp,array('$O : &S:SIM','ft_negociacao','Negociado',False,True));
				return($cp);
			}
		function cp_tipos()
			{
				$cp = array();
				array_push($cp,array('$H8','id_ft','',False,True));
				array_push($cp,array('$S12','ft_nr','Fatura',False,false));
				array_push($cp,array('$O ANU:Anuidade&CON:Contrato','ft_tipo','Tipo',False,True));
				array_push($cp,array('$[2000-2099]','ft_referencia_ano','Ano Base',True,True));
				array_push($cp,array('$S1','ft_status','Status',True,True));
				array_push($cp,array('$O : &S:SIM','ft_negociacao','Negociado',False,True));
				array_push($cp,array('$S7','ft_contrato','Contrato',False,True));
				return($cp);
			}			
		function fatura($contrato='')
			{
			if (strlen($contrato) > 0)
				{
					$wh = " and ft_contrato = '$contrato' ";
				}
			$sql = "SELECT * FROM fatura
				left join cr_boleto on ft_nr = bol_fatura
				WHERE bol_data_vencimento >= 19000101 and bol_data_vencimento <= 20999999
				$wh
				order by ft_contrato, ft_nr desc, bol_data_vencimento
				";
			$rlt = db_query($sql);
			$sx .= '<table class="lt0" width="100%">';
			$sh .= '<TR>';
			//$sh .= '<TH>fatura';
			$sh .= '<TH>tipo';
			$sh .= '<TH>emissão';
			$sh .= '<TH>vencimento';
			$sh .= '<TH>sacado';
			$sh .= '<TH>descrição';
			$sh .= '<TH>vlr.boleto';
			$sh .= '<TH>vlr.pago';
			$sh .= '<TH>status';
			$sh .= '<TH>documento';
			$xnome = "X";
			$tot = 0;
			$toti = 0;
			$fat = 'X';
			$fat = 0;
			$xfatu = 'X';
			
			while ($line = db_read($rlt))
				{
					$fatu = trim($line['ft_nr']);
					
					$nome = trim($line['ft_contrato']);
					if ($xnome != $nome)
						{
						if ($tot > 0)
						{
							$sx .= '<TR class="lt1">';
							$sx .= '<TD colspan=10 align="right"><B>';
							$sx .= 'Boleto '.number_format($tot,2,',','.').' / Faturado '.number_format($fat,2,',','.');
							$sx .= ' / Pago '.number_format($toti,2,',','.');
							$tot = 0;
							$toti = 0;							
						}

						$sx .= '<TR class="lt1">';
						$sx .= '<TD colspan=10><h2>';
						$sx .= 'Contrato: '.trim($line['ft_contrato']);
						$sx .= '</h2>';
						$xnome = $nome;
						$sx .= $sh;
						}
											
					if ($xfatu != $fatu)
						{
						if ($tot > 0)
						{
							$sx .= '<TR class="lt1">';
							$sx .= '<TD colspan=10 align="right"><B>';
							$sx .= 'Boleto '.number_format($tot,2,',','.').' / Faturado '.number_format($fat,2,',','.');
							$sx .= ' / Pago '.number_format($toti,2,',','.');
							$tot = 0;
							$toti = 0;
						}
													
						$sx .= '<TR class="lt0">';
						$sx .= '<TD colspan=10 align="left"><B>Fatura ';
						$link = '<A HREF="javascript:newxy2(\'fatura_editar.php?dd0='.$line['id_ft'].'\',700,500);">';
						$sx .= $link.trim($line['ft_nr']).'</A>';
						$sx .= ' Valor da fatura: R$ ';
						$sx .= number_format($line['ft_valor_boleto'],2,',','.');
						//$sx .= 'Emitido '.number_format($tot,2,',','.').' / Pago '.number_format($fat,2,',','.');
						//$sx .= ' / Pago '.number_format($toti,2,',','.');
						$xfatu = $fatu;
						}					
					

					$cor = '';
					if ($line['bol_status'] != 'X')
						{
						$tot = $tot + $line['bol_valor_boleto'];
						$toti = $toti + $line['bol_valor_pago'];
						}
					$fat = $line['ft_valor_boleto'];
					
					if (trim($line['bol_status'])=='X')
						{ $cor = '<font color="#C0C0C0">'; }
					if (trim($line['bol_status'])=='A')
						{ $cor = '<font color="green">'; }
					$sx .= '<TR '.coluna().'>';
					//$sx .= '<TD>'.$link.$cor;
					//$sx .= trim($line['ft_nr']);
					$sx .= '</a>';
					$sx .= '<TD align="center">'.$cor;
					$sx .= trim($line['ft_tipo']);
					$sx .= '/';
					$sx .= trim($line['ft_referencia_ano']);
					$sx .= '<TD align="center">'.$cor;
					$sx .= stodbr($line['bol_data_documento']);
					$sx .= '<TD align="center">'.$cor;
					$sx .= stodbr($line['bol_data_vencimento']);

					$sx .= '<TD>'.$cor;
					$sx .= trim($line['bol_sacado']);
					
					$sx .= '<TD align="left">'.$cor;
					$sx .= $line['bol_numero_documento'];
					$sx .= '<TD align="right">'.$cor;
					$sx .= number_format($line['bol_valor_boleto'],2,',','.');
					$sx .= '<TD align="right">'.$cor;
					$sx .= number_format($line['bol_valor_pago'],2,',','.');
					$sx .= '<TD align="center">'.$cor;
					$sx .= $line['bol_status'];
					$sx .= '<TD align="center">'.$cor;
					$sx .= $line['bol_nosso_numero'];
					
					$sx .= '<TD>';
					$sx .= trim($line['ft_nr']);
				}
			if ($tot > 0)
				{
					$sx .= '<TR class="lt1">';
					$sx .= '<TD colspan=10 align="right"><B>';
					$sx .= 'Boleto '.number_format($tot,2,',','.').' / Faturado '.number_format($fat,2,',','.');
					$sx .= ' / Pago '.number_format($toti,2,',','.');
					$tot = 0;
					$toti = 0;							
				}

			$sx .= '</table>';
			
			return($sx);
			
			}	
	}
?>
