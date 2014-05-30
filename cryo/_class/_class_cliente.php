<?php
class cliente
	{
	var $nome;
	var $id;
	var $cpf;
	var $line;
	var $nasc;
	
	var $contratos = array();
	
	var $messa = 0;
	var $tabela = "cliente";
	function le($id)
		{
			$sql = "select * from ".$this->tabela." 
				left join cidade on cl_cidade = c_codigo
				where cl_codigo = '".$id."' ";
			$rlt = db_query($sql);
			
			if ($line = db_read($rlt))
				{
					$this->messa = 1;
					$this->nome = trim($line['cl_nome']);
					$this->cpf = trim($line['cl_cpf']);
					$this->nasc = trim($line['cl_dt_nasc']);
					$this->id = trim($line['cl_codigo']);
					
					$this->line = $line;
				} else {
					$this->messa = 0;
				}
			return($this->messa);
		}
		
	function mostra()
		{	
			$cr = chr(13).chr(10);
			
			$sx = '';
			$sx .= '<table width="100%" cellpadding=0 cellspacing=0 class="tabela00" border=0>';
			$sx .= '<TR valign="top">';
			$sx .= '<TD width="70%">';
			$sx .= '<font class="lt4"><B>'.$this->nome.'</B></font><BR>'.$cr;
			$sx .= '<font class="lt2">CPF: '.$this->cpf.'</font>'.$cr;
			$sx .= '<font class="lt2">RG: '.$this->line['cl_rg'].'</font>'.$cr;
			$sx .= '<font class="lt2">NASC: '.$this->mostra_data_nascimento($this->line['cl_dt_nasc']).'</font>'.$cr;
			$sx .= '<font class="lt2">CADASTRADO: '.$this->line['cl_dt_cadastro'].'</font>'.$cr;
			$sx .= '<font class="lt2">ATUALIZADO: '.$this->line['cl_lastupdate'].'</font>'.$cr;
			
			$sx .= '<TD><BR>';
			$sx .= $this->mostra_email($this->line['cl_email']);
			$sx .= '<BR>';
			$sx .= $this->mostra_email($this->line['cl_email_alt']);
			$sx .= '</table>';
			
			$sx .= '<table width="100%" cellpadding=0 cellspacing=0 class="tabela00">';
			$sx .= '<TR CLASS="lt0">
						<TH>ENDEREÇO
						<th>BAIRRO
						<TH>CIDADE
						<TH>CEP';
			$sx .= '<tr class="lt2">';
			$sx .= '<TD width="50%"><font class="lt2">'.$this->line['cl_endereco'].'</font>'.$cr;
			$sx .= '<TD width="20%"><font class="lt2">'.$this->line['cl_bairro'].'</font>'.$cr;
			$sx .= '<TD width="20%"><font class="lt2">'.$this->line['c_cidade'].'-'.trim($this->line['c_estado']).'</font>'.$cr;
			$sx .= '<TD width="10%"><font class="lt2">'.$this->line['cl_cep'].'</font>'.$cr;
			$sx .= '</table>';
			
			
			$sx .= '<table width="100%" cellpadding=0 cellspacing=0 class="tabela00">';
			$sx .= '<tr valign="top">';
			$sx .= '<TD width="15%" >';
				$sx .= $this->mostra_telefone($this->line);
			$sx .= '<TD width="30%">';
				$sx .= $this->mostra_ocupacao($this->line);
			$sx .= '<TD width="30%">';
				$sx .= $this->mostra_contato($this->line);
			$sx .= '</table>';
			return($sx);
		}	
	function mostra_contato($line)
		{			$sx .= '<table width="250" cellpadding=0 cellspacing=0 class="tabela00" border=0>';
			$sx .= '<TR CLASS="lt0" align="center">
					<TH>CONTATO</th>
					';
			$sx .= '<TR><TD>';
			$sx .= '<B>'.$line['cl_contato_nome'].'</B>';
			$sx .=' <BR>'.$line['cl_contato_endereco'];
			$sx .=' <BR>'.$line['cl_contato_bairro'];
			$sx .=' <BR>'.$this->mostra_cidade($line['cl_contato_cidade']);
			
			$sx .=' <BR>'.$line['cl_contato_telefone'];
			$sx .= '</table>';
						
			return($sx);
			
		}
	function mostra_email($email)
		{
			return($email);
		}
	function mostra_cidade($cidade)
		{
			$sql = "select * from cidade where c_codigo = '".$cidade."' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$sx = trim($line['c_cidade']);
					$sx .= '-'.trim($line['c_estado']);
				}
			return($sx);
		}
	function mostra_ocupacao($line)
		{
			$sx .= '<table width="250" cellpadding=0 cellspacing=0 class="tabela00" border=0>';
			$sx .= '<TR CLASS="lt0" align="center">
					<TH>OUTRAS INFORMAÇÕES</th></tr>';
			$sx .= '<TR><TD>'.trim($line['cl_profissao']).'</b>, ';

			$ec = ($line['cl_est_civil']);
			$sx .= $this->mostra_estado_civil($ec,$line['cl_sexo']).', ';

			$sx .= trim($line['cl_nacionalidade']);
			
			$sx .= '</table>';
			return($sx);
		}
	function mostra_estado_civil($tipo,$genero)
		{
			if ($genero = 'M')
				{
					switch ($tipo)
					{
					case 'C': $sx = 'Cadado'; break;
					case 'S': $sx = 'Solteiro'; break;
					default: '???????-'.$tipo; break;
					}
				} else {
					switch ($tipo)
					{
					case 'C': $sx = 'Cadada'; break;
					case 'S': $sx = 'Solteira'; break;
					default: '???????-'.$tipo; break;
					}					
				}
			return($sx);
		}
	function mostra_telefone($line)
		{
			$ddd = trim($line['cl_fone_ddd']);
			$fone1 = sonumero(trim($line['cl_fone_1']));
			$fone2 = sonumero(trim($line['cl_fone_2']));
			$fone3 = sonumero(trim($line['cl_fone_3']));
			
			
			$sx .= '<table width="250" cellpadding=0 cellspacing=0 class="tabela00" border=0>';
			$sx .= '<TR CLASS="lt0">
					<TH>TIPO
					<TH>&nbsp;
					<TH>NÚMERO';			
			if (strlen($fone1) > 0) { $sx .= '<TR class="lt2"  align="center"><TD>RESIDENCIAL</td><TD>&nbsp;</td><TD> '.$this->format_telefone_br($ddd,$fone1); }
			if (strlen($fone2) > 0) { $sx .= '<TR class="lt2"  align="center"><TD>COMERCIAL</td><TD>&nbsp;</td><TD>'.$this->format_telefone_br($ddd,$fone2); }
			if (strlen($fone3) > 0) { $sx .= '<TR class="lt2"  align="center"><TD>CELULAR</td><TD>&nbsp;</td><TD>'.$this->format_telefone_br($ddd,$fone3); }
			$sx .= '</table>';
			return($sx);
		}
	function format_telefone_br($ddd,$fone)
		{
		$fone = trim($fone);
		$size = strlen($fone);
		switch ($size)
			{
			case 9:
				$sx = substr($fone,0,5).'-'.substr($fone,5,4);
				break;
			case 8:
				$sx = substr($fone,0,4).'-'.substr($fone,4,4);
				break;
			default:
				$sx = substr($fone,0,4).'-'.substr($fone,4,strlen($fone));
				break;				
			}
		if (strlen($ddd) > 0)
			{
				$sx = '('.$ddd.') '.$sx;
			}
		return($sx);
		}
		
	
	function mostra_data_nascimento($data)
		{
			$sx = stodbr($data);
		}
	}
?>
