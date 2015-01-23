<?php
class contrato
	{
	var $tabela = "contrato";
	var $contratos=array();
	
	function cp_avulso()
		{
			global $cp;
			$cp = array();
			
		}
	
	function selecionar_contrato($cliente)
		{
			global $dd,$acao;
			$sql = "select * from contrato 
					where ctr_pai = '$cliente' or ctr_mae = '$cliente' or ctr_cobranca = '$cliente'
					order by ctr_dt_assinatura
			";
			$rlt = db_query($sql);
			$id = 0;
			$sx = '<form method="post" action="'.page().'">';
			$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">'.chr(13).chr(10);
			$sx .= '<input type="hidden" name="dd1" value="'.$dd[1].'">'.chr(13).chr(10);
			$sx .= '<BR><B>Selecione o contrato</b><HR>';
			while ($line = db_read($rlt))
				{
					$id++;
					$contrato = $line['ctr_numero'];
					$status = $line['ctr_status'];
					$rn = stodbr($line['ctr_parto_data']);
					$ass = stodbr($line['ctr_dt_assinatura']);
					
					$sx .= '<input type="radio" name="dd2" value="'.$contrato.'">'.$contrato.' - Nascimento em '.$rn.', contrato assinato em '.$ass.'<BR>';
				}
			if ($id == 0)
				{
					$sx .= '<font color="red">Não foi localizado contrato para este cliente</font>';
				} else {
					$sx .= '<input type="submit" value="selecionar contrato >>>>">';
				}
			$sx .= '</form>';
			return($sx);
		}
	
	function mostra()
		{
			$line = $this->line;
			
			$nome_rn = trim($line['col_rn_nome']);
			if (strlen($nome_rn)==0) { $nome_rn = '<I>Não informado</I>'; }
			$sx = '<table width="100%" class="tabela00">';
			$sx .= '<TR valign="top">';
			$sx .= '<TD width="15%" align="right">Nome (RN):
					<TD width="80%"><B>'.$nome_rn.'</B>';
			$sx .= '<TD rowspan=6 align="center" class="lt0">CONTRATO
					<br><font class="lt3"><B>'.$line['ctr_numero'].'</B></font>';
			
			$cli = new cliente;
			$cli->le($line['ctr_mae']);
			$sx .= '<TR>
					<TD align="right">Nome da mãe</td>
					<TD class="lt2">'.$cli->nome;
			$cli->le($line['ctr_pai']);
			$sx .= '<TR>
					<TD align="right">Nome do pai</td>
					<TD class="lt2">'.$cli->nome;
			$cli->le($line['ctr_responsavel']);
			$sx .= '<TR>
					<TD align="right">Responsável financeiro</td>
					<TD class="lt2">'.$cli->nome;
			$sx .= '</table>';
			return($sx);
		}

	function le($id)
		{
			$sql = "select * from ".$this->tabela." 
					left join coleta on ctr_numero = col_contrato
			where ctr_numero = '".$id."' ";
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$this->line = $line;
			return(1);
		}
	function mostra_contrato($contratos)
		{
			$wh = '';
			for ($r=0;$r < count($contratos);$r++)
				{
					if (strlen($contratos[$r]) > 0)
						{
						if (strlen(trim($wh)) > 0) { $wh .= ' or '; }
						$wh .= " (ctr_numero = '".$contratos[$r]."') ";
						}
				}
			$sql = "select * from ".$this->tabela." where 
				$wh
				order by ctr_numero
			";
			$rlt = db_query($sql);
			$sx = '<table width="300" class="tabela01">
					<TR><TH width="30%">Contrato
						<TH width="40%">Status
						<TH width="30%">Assinatura';
			$contra = array();
			while ($line = db_read($rlt))
				{
					array_push($contra,trim($line['ctr_numero']));
					$sx .= $this->mostra_contrato_linha($line);
				}
			$sx .= '</table>';
			$this->contratos = $contra;
			return($sx);
		}
			
	function mostra_contrato_cliente($cliente)
		{
			$sql = "select * from ".$this->tabela." where 
				ctr_pai = '$cliente' or
				ctr_mae = '$cliente' or
				ctr_cobranca = '$cliente'
				order by ctr_numero
			";
			$rlt = db_query($sql);
			$sx = '<table width="300" class="tabela01">
					<TR><TH width="30%">Contrato
						<TH width="40%">Status
						<TH width="30%">Assinatura';
			$contra = array();
			while ($line = db_read($rlt))
				{
					array_push($contra,trim($line['ctr_numero']));
					$sx .= $this->mostra_contrato_linha($line);
				}
			$sx .= '</table>';
			$this->contratos = $contra;
			return($sx);
		}	
	function mostra_status($tipo)
		{
			switch ($tipo)
				{
					case 'S': $sx = '<TD style="background-color: #E0FFE0;" align="center">ATIVO</td>'; break;
					case 'N': $sx = '<TD style="background-color: #E0E0E0;" align="center">ISENTO</td>'; break; 
					default: $sx .= '<TD>????'.$tipo.'</td>'; break;
				}
			return($sx);
				
		}
	function mostra_contrato_linha($line)
		{
			$status = $this->mostra_status($line['ctr_status']);
			$link = '<A HREF="contrato_ver.php?dd0='.$line['ctr_numero'].'&dd90='.checkpost(trim($line['ctr_numero'])).'" class="link">';
			$sx = '<TR>';
			$sx .= '<TD align="center">';
			$sx .= $link;
			$sx .= trim($line['ctr_numero']);
			$sx .= '/';
			$sx .= substr($line['ctr_dt_assinatura'],2,2);
			$sx .= '</A>';
			
			$sx .= $status;
			$sx .= '<TD align="center">'.
					stodbr($line['ctr_dt_assinatura']);
			
			return($sx);
			
		}
		
	}
?>
