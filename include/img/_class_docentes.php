<?
class docentes
	{
	var $id_pp;
	var $pp_nome;
	var $pp_nasc;
	var $pp_codigo;
	var $pp_cracha;
	var $pp_login;
	var $pp_escolaridade;
	var $pp_titulacao;
	var $pp_carga_semanal;
	var $pp_ss;
	var $pp_cpf;
	var $pp_negocio;
	var $pp_centro;
	var $pp_curso;
	var $pp_telefone;
	var $pp_celular;
	var $pp_lattes;
	var $pp_email;
	var $pp_email_1;
	var $pp_senha;
	var $pp_endereco;
	var $pp_afiliacao;
	var $pp_ativo;
	var $pp_grestudo;
	var $pp_prod;
	var $pp_ass;
	var $pp_instituicao;
	var $pp_pagina;
	var $coordenador;
	var $coordenador_nome;
	var $line;
	
	var $tabela = 'pibic_professor';

	function docente_escolas($escola)
		{
			$escola_cod = round($escola);
			$sql = "select * from centro
					inner join pibic_professor on centro_codigo = pp_escola
					where centro_codigo = '$escola' or id_centro = $escola_cod
					order by pp_nome
			";
			$rlt = db_query($sql);
			$sx = $this->rel_prof_mostra($rlt);
			echo $sx;
			return($sx);		
		}
	

	function documentos_pessoais($cracha)
		{
			$file = '../';
			$rg = $file.'pibic/ass/cpf/';
			$rg .= $cracha.checkfile($cracha).$cracha;
			echo $rg;
		}
	function cadastrar_orientacao($professor,$aluno,$ano,$modalidade,$programa)
		{
			$modalidade = UpperCase(substr($modalidade,0,1));
			$sql = "select * from docente_orientacao 
					where od_professor = '$professor'
					and od_aluno = '$aluno'
					and od_modalidade = '".$modalidade."'
			";			
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$sx .= '<BR>Já cadastrado';
				} else {
						$ano_ini = $ano;
						$status = 'C';
						$ano_fim = 0;
						$defesa = 19000101;					
						$quali = 19000101;
						$artigo = 19000101;
						$credi = 19000101;
						$idioma1_dt = 19000102;
						$idioma2_dt = 19000103;
						$idioma1 = '';
						$idioma2 = '';
						$sql = "insert into docente_orientacao
							(
							od_professor, od_aluno, od_status, od_programa,  
							od_ano_ingresso, od_ano_diplomacao, 
							od_qualificacao, od_defesa, od_artigo, od_creditos,
							od_idioma_1, od_idioma_1_tipo, 
							od_idioma_2, od_idioma_2_tipo,
							od_titulo_projeto, od_bolsa,
							od_obs, od_modalidade							
							)
							values
							(
							'$professor','$aluno','$status','$programa',
							$ano_ini, $ano_fim, 
							$quali, $defesa, $artigo, $credi,
							$idioma1_dt, '$idioma1',
							$idioma2_dt, '$idioma2',
							'', '',
							'', '$modalidade'
							) ";
							$rlt = db_query($sql);
							return(0);
					}			
		}
	
	function orientador_da_discente($estudante)
		{
			$sql = "select * from docente_orientacao
						inner join programa_pos on od_programa = pos_codigo
						left join pibic_professor on pp_cracha = pos_coordenador
						where od_aluno = '".$estudante."' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->coordenador = $line['pp_cracha'];
					$this->coordenador_nome = trim($line['pp_nome']);
					$this->line = $line;		
				}
			return(1);
		}

	function cp()
		{
			global $dd;
			if (strlen($dd[4])==0 ) { $dd[4] = UpperCaseSql($dd[1]); }
			$dd[4] = UpperCaseSql($dd[4]);
			//$sql = "CREATE VIEW docentes as SELECT * from pibic_professor";
			//$rlt = db_query($sql);
			//$sql = "ALTER TABLE ".$this->tabela." ADD COLUMN pp_nome_lattes char(100);";
			//$rlt = db_query($sql);
			
			$prod = $this->produtividade();
			$keys = array_keys($prod);
			$op = ' : ';
		    foreach ($keys as $key) { $op .= '&'.trim($key).':'.trim($prod[$key]); }
			$cp = array();
			array_push($cp,array('$H8','id_pp','id_pp',False,True));
			array_push($cp,array('$S100','pp_nome','Nome completo',True,True));
			array_push($cp,array('$HV','pp_nome_asc','',False,True));
			array_push($cp,array('$H8','','',False,True));
			array_push($cp,array('$S100','pp_nome_lattes','Nome completo no Lattes',True,True));
			array_push($cp,array('$S30','pp_cpf','CPF',False,True));
			array_push($cp,array('$I8','pp_carga_semanal','Carga horária',True,True));
			array_push($cp,array('$S30','pp_negocio','Negócio',False,True));
			array_push($cp,array('$S11','pp_cracha','Cracha',False,True));
			
			array_push($cp,array('$O N:N&S:S','pp_ss','Stricto Sensu',False,True));
			array_push($cp,array('$S40','pp_centro','Campus',False,True));
			
			array_push($cp,array('$Q ap_tit_titulo:ap_tit_codigo:select * from apoio_titulacao order by ap_tit_titulo','pp_titulacao','Titulação',False,True));
			
			array_push($cp,array('$S50','pp_curso','Curso',False,True));
			array_push($cp,array('$S100','pp_email','e-mail',False,True));
			array_push($cp,array('$S100','pp_email_1','e-mail (alt)',False,True));
			array_push($cp,array('$O '.$op,'pp_prod','Produtividade',True,True));
			array_push($cp,array('$S100','pp_lattes','Link para lattes',False,True));
			
			array_push($cp,array('$O 0:NÃO&1:SIM','pp_avaliador','Avaliador',True,True));
			array_push($cp,array('$O 0:Sem participação&1:Comitê Local&2:Comitê Gestor','pp_comite','Participação do Comitê',True,True));
			array_push($cp,array('$Q centro_nome:centro_codigo:select * from centro order by centro_codigo','pp_escola','Escola',False,True));

			array_push($cp,array('$[2008-'.date("Y").']','pp_update','Atualizado',False,True));
			array_push($cp,array('$O 1:SIM&0:NÃO','pp_ativo','Ativo',True,True));
			
			array_push($cp,array('$S20','pp_telefone','Telefone',False,True));
			array_push($cp,array('$S20','pp_celular','Celular',False,True));
			
			
			return($cp);
		}

	function structure_od()
		{
			$sql = "create table docente_orientacao
					(
					id_od serial not null,
					ob_modalidade char(1),
					od_professor char(8),
					od_aluno char(8),
					od_ano_ingresso int8,
					od_ano_diplomacao int8,
					od_status char(1),
					od_programa char(7),
					od_qualificacao int8,
					od_defesa int8,
					od_artigo int8,
					od_creditos int8,
					od_idioma_1 int8,
					od_idioma_1_tipo char(3),
					od_idioma_2 int8,
					od_idioma_2_tipo char(3),
					od_titulo_projeto text,
					od_bolsa char(3),
					od_obs text														
					)				
			";
			$rlt = db_query($sql);
			return(1);
		}
	function splitx($v1,$v2)
		{
		$v2 .= $v1;
		$vr = array();
		while (strpos(' '.$v2,$v1))
			{
			$vp = strpos($v2,$v1);
			$v4 = trim(substr($v2,0,$vp));
			$v2 = trim(substr($v2,$vp+1,strlen($v2)));
			if (strlen($v4) > 0)
				{ array_push($vr,$v4); }
			}
		return($vr);
	}		
	function orientacoes_inport($text,$programa,$modalidade)
		{
			global $dd;
			if ($dd[5]=='S')
			{
				$sql = "delete from docente_orientacao where od_programa = '".$programa."' ";
				$rlt = db_query($sql);
			}
			//exit;
			/*
			 * ORIENTADOR	ALUNO	MODALIDADE	INICIO	STATUS	DEFESA
			 * */
			$ln = array();
			$text = troca($text,chr(10),'');
			$loop = 0;
			while ((strpos($text,chr(13)) > 0) and (loop < 400))
				{
					$loop++;
					$lna = substr($text,0,strpos($text,chr(13)));
					$text = substr($text,strpos($text,chr(13))+1,strlen($text));
					$lna = troca($lna,chr(9),';');
					array_push($ln,$lna);
				}
				
			/** Dados */
			echo '<TT>';
			for ($r=0;$r < count($ln);$r++)
				{
					$lnb = $this->splitx(';',trim($ln[$r]));
					
					$professor = trim($lnb[1]);
					if (strlen($professor) > 8)
						{ $professor = substr($professor,3,8); }
					$professor = substr($professor,0,8);

					$aluno = $lnb[0];
					if (strlen($aluno) > 8)
						{ $aluno = substr($aluno,3,8); }
					$aluno = substr($aluno,0,8);
											
					$status = substr($lnb[4],0,1);
					if (strpos($lnb[2],'/')) { $ano_ini = brtos($lnb[2]); }
					else { $ano_ini = round(sonumero($lnb[2])); }
					
					if (strpos($lnb[3],'/')) { $ano_fim = brtos($lnb[3]); }
					else { $ano_fim = round(sonumero($lnb[3])); }

					
					$quali = 19000102;
					$defesa = 19000102;
					$artigo = 19000102;
					$credi = 19000102;
					$idioma1_dt = 19000101;
					$idioma2_dt = 19000101;
					$dd1=round($lnb[3]);
					$dd2=round($lnb[4]);
					$idioma1 = "''";
					$idioma2 = "''";	
					
					
					/* Status */
					$status = 'C';
					if ($ano_fim > 19900101) { $status = 'T'; }
					
					
					if (strlen($programa) ==0)
						{
							echo 'Programa não foi definido';
							return(0);
						}
					
					$sql = "select * from docente_orientacao 
							where od_professor = '$professor'
							and  od_aluno = '$aluno'
							and od_modalidade = '$modalidade'
					";		

					$rlt = db_query($sql);
					if ($line = db_read($rlt))
					{
						echo '<BR>Já cadastrado';
						$sql = "update docente_orientacao set od_programa = '$programa' 
								, od_status = '$status'
								, od_ano_ingresso = $ano_ini
								, od_ano_diplomacao = $ano_fim
								where id_od = ".$line['id_od'];
						$qrlt = db_query($sql);
					} else {
//						$sql = "ALTER TABLE docente_orientacao add column od_saida int4";
//						$rlt = db_query($sql);					
						$sql = "insert into docente_orientacao
							(
							od_professor, od_aluno, od_status, od_programa,  
							od_ano_ingresso, od_ano_diplomacao, 
							od_qualificacao, od_defesa, od_artigo, od_creditos,
							od_idioma_1, od_idioma_1_tipo, 
							od_idioma_2, od_idioma_2_tipo,
							od_titulo_projeto, od_bolsa,
							od_obs, od_modalidade, od_entrada, od_saida							
							)
							values
							(
							'$professor','$aluno','$status','$programa',
							$ano_ini, $ano_fim, 
							$quali, $defesa, $artigo, $credi,
							$idioma1_dt, $idioma1,
							$idioma2_dt, $idioma2,
							'', '',
							'', '$modalidade', $dd1,$dd2
							) ";
							$rlt = db_query($sql);
					}
				}
				
			return(1);
		}

	function docentes_orientacoes($programa='',$area='')
		{
			$sql = "select * from docente_orientacao 
					left join pibic_professor on od_professor = pp_cracha
					left join pibic_aluno on od_aluno = pa_cracha
					where od_programa = '$programa'
					order by pp_nome, od_ano_ingresso desc, od_modalidade
			";
			
			$totd = 0;
			$toto = 0;
			
			$rlt = db_query($sql);
			$xprof = 'x';
			$sx .= '<H2>Docentes Orientações</H2>';
			$sx .= '<table class="lt1" width="704" border=1>';
			$sh = '<TR><TH>Mod<TH>Estudante<TH>Entrada<TH>Defesa<TH>Status';
			$stt = array('C'=>'Cursando','T'=>'Titulado','R'=>'Desistente');
			while ($line = db_read($rlt))
				{
					$prof = trim($line['pp_cracha']);
					if ($xprof != $prof)
						{
							$sx .= '<TR class="lt2" '.coluna().'>';
							$sx .= '<TD colspan=6><B>'.$line['pp_nome'].' ('.$line['od_professor'].')';
							$sx .= $sh;
							$xprof = $prof;
						}
					$sx .= '<TR>';
					$sx .= '<TD>'.$line['od_modalidade'];
					$sx .= '<TD>'.$line['pa_nome'].' ('.$line['od_aluno'].')';
					$sx .= '<TD>'.substr($line['od_ano_ingresso'],0,4);
					$sx .= '<TD>'.substr($line['od_ano_diplomacao'],0,4);
					$sta = trim($line['od_status']);
					if ($line['od_ano_diplomacao'] > date("Ymd")) { $sta = 'C'; }
					$sx .= '<TD>'.$stt[$sta];
				}
			$sx .= '</table>';
			return($sx);
		}

	function resumo_teses_dissertacoes($programa='',$area='', $anoi=19000101, $anof=29990101)
		{
			global $include;
			require($include.'sisdoc_debug.php');
			//$wh = 'and (od_ano_diplomacao >= $anoi and od_ano_diplomacao <= $anof);'
			$sql = "
					select count(*) as total, od_ano_ingresso, 0 as od_ano_diplomacao, 0 as desistencia, od_modalidade from docente_orientacao 
					where od_programa = '$programa'
					$wh 
					group by od_ano_ingresso, od_modalidade
					";
			$sql .= "union
					select count(*) as total, 0, od_ano_diplomacao, 0, od_modalidade from docente_orientacao 
					where od_programa = '$programa'
					$wh and od_status = 'T'
					group by od_ano_diplomacao, od_modalidade
					";
			$sql .= "union
					select count(*) as total, 0, 0, od_ano_diplomacao, od_modalidade from docente_orientacao 
					where od_programa = '$programa'
					$wh and (od_status = 'D' or od_status = 'R')
					group by od_ano_diplomacao, od_modalidade
										
					";
			$sql .= " order by od_ano_ingresso ";
			$rlt = db_query($sql);
			
			$tt = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
			$rsu = array();
			for ($r=1990;$r <= date("Y");$r++)
				{ array_push($rsu,$tt); }
										
			while ($line = db_read($rlt))
				{	
					$status = $line['od_status'];
					$total = $line['total'];
					$anoi = round(substr($line['od_ano_ingresso'],0,4))-1990;
					$anof = round(substr($line['od_ano_diplomacao'],0,4))-1990;
					$anod = round(substr($line['desistencia'],0,4))-1990;
					$xmod = trim($line['od_modalidade']);
					$mod = 0;
					
					if ($xmod=='M') { $mod = 1; }
					if ($xmod=='D') { $mod = 4; }
					if ($xmod=='P') { $mod = 7; }
								
					if ($anoi > 0)
						{
							/* Estudante matriculado */
							$rsu[$anoi][$mod] = $rsu[$anoi][$mod] + $line['total']; 
						}	
					if ($anof > 0)
						{
							/* Estudante matriculado */
							$rsu[$anof][$mod+1] = $rsu[$anof][$mod+1] + $line['total']; 
						}
					if ($anod > 0)
						{
							/* Estudante matriculado */
							$rsu[$anod][$mod+2] = $rsu[$anod][$mod+2] + $line['total']; 
						}						
				}
			$sx = '<table border=1 class="lt1" width="600">';
			$sx .= '<TR><TH rowspan=2><TH colspan=3>mestrado';
			$sx .= '<TH colspan=3>doutorado';
			$sx .= '<TH colspan=3>pós-doutorado';
			$sx .= '<TR>';
			$sx .= '<TH>entrada<TH>egresso<TH>desistente';
			$sx .= '<TH>entrada<TH>egresso<TH>desistente';
			$sx .= '<TH>entrada<TH>egresso<TH>desistente';
			
			
			for ($r=0;$r < count($rsu);$r++)
				{
					$sa = '<TR>';
					$sa .= '<TD>';
					$sa .= (1990+$r);
					$t1 = 0;
					for ($t=1;$t <= 9;$t++)
						{
							$tt[$t] = $tt[$t] + $rsu[$r][$t];
							$t1 = $t1 + $rsu[$r][$t];
							$sa .= '<TD align="center">';
							$sa .= $rsu[$r][$t];
						}
					if ($t1 > 0) { $sx .= $sa . chr(13); }
				}
			$sx .= '<TR><TH>';
			for ($t=1;$t <= 9;$t++)
				{
					$sx .= '<TD align="center">';
					$sx .= $tt[$t];
				}			
			$sx .= '</table>';
			
			return($sx);
		}
	function row_docente_orientacoes()
		{
				global $cdf,$cdm,$masc,$tabela;
				//$sql = "ALTER TABLE docente_orientacao ADD COLUMN od_modalidade char(1);";
				//$rlt = db_query($sql);
				$tabela = "
						( select * from docente_orientacao 
							left join pibic_professor on pp_cracha = od_professor
							left join pibic_aluno on pa_cracha = od_aluno							
						) as docente_orientacao
					";
				$cdf = array('id_od','od_modalidade','pp_nome','od_professor','pa_nome','od_aluno','od_ano_ingresso','od_ano_diplomacao','od_status','od_programa');
				$cdm = array('cod',msg('modalida_ss'),msg('professor'),msg('professor'),
							msg('estudante'),msg('estudante'),
							msg('entrada'),msg('diplocacao'),msg('Status'),msg('programa'));
				$masc = array('','','','','','','');
				return(1);
		}
	function cp_docente_orientacoes()
		{
			$cp = array();
			array_push($cp,array('$H8','id_od','',False,True));
			array_push($cp,array('$S8','od_professor','Professor (cracha)',True,True));
			array_push($cp,array('$S8','od_aluno','Estudante (cracha)',True,True));
			array_push($cp,array('$S8','od_ano_ingresso',msg('entrada_ano'),True,True));
			array_push($cp,array('$S8','od_ano_diplomacao',msg('diplamacao_ano'),True,True));
			array_push($cp,array('$O A:Ativo&T:Titulado&R:Trancado&C:Cursando','od_status','Status',True,True));
			array_push($cp,array('$Q pos_nome:pos_codigo:select * from programa_pos where pos_ativo=1 order by pos_nome','od_programa','Programa',True,True));
			array_push($cp,array('$D8','od_qualificacao','Qualificacao',True,True));
			array_push($cp,array('$D8','od_defesa','Defesa',True,True));
			array_push($cp,array('$D8','od_artigo','Artigo',True,True));
			array_push($cp,array('$D8','od_creditos','Integralização dos créditos',True,True));
			array_push($cp,array('$D8','od_idioma_1','Idioma 1',True,True));
			array_push($cp,array('$S3','od_idioma_1_tipo','Idioma 1',False,True));
			array_push($cp,array('$D8','od_idioma_2','Idioma 2',True,True));
			array_push($cp,array('$S3','od_idioma_2_tipo','Idioma 2',False,True));
			array_push($cp,array('$T70:4','od_titulo_projeto','Título do projeto',False,True));
			array_push($cp,array('$H3','od_bolsa','Bolsa',False,True));
			array_push($cp,array('$H8','od_obs','Observacao',False,True));
			array_push($cp,array('$O : &M:Mestrado&D:Doutorado&P:Pós-Doutorado','od_modalidade','MOdalidade',True,True));
			return($cp);
						
		}

	function enviar_email($subj,$texto,$ss,$link)
		{
			$sql = "select * from ".$tabela." 
				where pp_ativo = 1 
				and pp_ss = 'S' 
				order by pp_nome
				";
			$rlt = db_query($sql);
			
			while ($line = db_read($rlt))
				{
					$this->le($line['id_pp']);
				}
			return(1);
			
		}
		
	function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_pp','pp_nome','pp_cracha','pp_cpf','pp_carga_semanal','pp_ss','pp_centro','pp_curso');
				$cdm = array('cod',msg('nome'),msg('cracha'),msg('cpf'),msg('carga_semanal'),msg('Stricto Sensu'),msg('centro'),msg('curso'));
				$masc = array('','','','','','','');
				return(1);				
			}		
				
	function le($id)
		{
			if (strlen($id) > 0) { $this->id_pp = $id; }
			$sql = "select * from ".$this->tabela." 
				left join apoio_titulacao on ap_tit_codigo = pp_titulacao
				where (id_pp = ".round($this->id_pp).") or (pp_cracha = '$id')";
			$rlt = db_query($sql);
			$prod = $this->produtividade();
			
			if ($line = db_read($rlt))
				{
					$this->id_pp= $line['id_pp'];
					$this->pp_nome= $line['pp_nome'];
					$this->pp_nasc= $line['pp_nasc'];
					$this->pp_codigo= $line['pp_codigo'];
					$this->pp_cracha= $line['pp_cracha'];
					$this->pp_login= $line['pp_login'];
					$this->pp_escolaridade= $line['pp_escolaridade'];
					
					//$this->pp_titulacao= $line['pp_titulacao'];
					$this->pp_titulacao= $line['ap_tit_titulo'];
					
					$this->pp_carga_semanal= $line['pp_carga_semanal'];
					$this->pp_ss= $line['pp_ss'];
					$this->pp_cpf= $line['pp_cpf'];
					$this->pp_negocio= $line['pp_negocio'];
					$this->pp_centro= $line['pp_centro'];
					$this->pp_curso= $line['pp_curso'];
					$this->pp_telefone= $line['pp_telefone'];
					$this->pp_celular= $line['pp_celular'];
					$this->pp_lattes= $line['pp_lattes'];
					$this->pp_email= $line['pp_email'];
					$this->pp_email_1= $line['pp_email_1'];
					$this->pp_senha= $line['pp_senha'];
					$this->pp_endereco= $line['pp_endereco'];
					$this->pp_afiliacao= $line['pp_afiliacao'];
					$this->pp_ativo= $line['pp_ativo'];
					$this->pp_grestudo= $line['pp_grestudo'];
					$this->pp_prod= $prod[$line['pp_prod']];
					$this->pp_ass= $line['pp_ass'];
					$this->pp_instituicao= $line['pp_instituicao'];
					$this->pp_pagina = 'http://www2.pucpr.br/reol/a.php?dd0='.trim($this->pp_cracha).'&dd90='.substr(md5('pesquisador'.$this->pp_cracha),0,2);
					return(1);					
				}
			return(0);
		}

	function sobre_corpo_docente($mod='',$ss='')
		{
			$sql = "select * from ".$this->tabela."
					inner join apoio_titulacao on pp_titulacao = ap_tit_codigo
					where pp_ativo = 1
					and pp_centro <> 'DOUTORANDO'
					";
			$ch40 = 0;
			$ch20 = 0;
			$ch10 = 0;
			$ss = 0;
			$rst = array();
			array_push($rst,array('Dr.',0,0,0,0,0));
			array_push($rst,array('Msc.',0,0,0,0,0));
			array_push($rst,array('Esp.',0,0,0,0,0));
			array_push($rst,array('Gra.',0,0,0,0,0));
			array_push($rst,array('Outros',0,0,0,0,0));
			$rlt = db_query($sql);
			$tot = 0;
			while ($line = db_read($rlt))
				{
					$tot++;
					$ch40 = 0;
					$ch20 = 0;
					$ch10 = 0;
					$ss = 0;
					
					$tit = trim($line['ap_tit_titulo']);
					$id_tit = -1;
					if ($tit == 'Dr.') { $id_tit = 0; }
					if ($tit == 'Dra.') { $id_tit = 0; }
					if ($tit == 'Msc.') { $id_tit = 1; }
					if ($tit == 'Esp.') { $id_tit = 2; }
					if ($tit == 'Grad.') { $id_tit = 3; }
					
					if ($id_tit == -1) { echo 'Erro '.$tit; exit; }
					
					
					$ch = trim($line['pp_carga_semanal']);
					$ss = trim($line['pp_ss']);
					if ($ss == 'S') { $ss=1; }
					if ($ch == 40) { $ch40=1; }
					if (($ch >= 20) and ($ch < 40)) { $ch20=1; }
					if ($ch < 20) { $ch10=1; }
					
					$rst[$id_tit][1] = $rst[$id_tit][1] + $ch40; 
					$rst[$id_tit][2] = $rst[$id_tit][2] + $ch20;
					$rst[$id_tit][3] = $rst[$id_tit][3] + $ch10;
					$rst[$id_tit][4] = $rst[$id_tit][4] + $ss;
					
				}
				$sx = '<CENTER><h2>Sobre o corpo docente</h2>';
				$sx .= '<table width="704" border=1 class="lt1" cellpadding=2 cellspacing=0>';
				$sx .= '<TR><TH>Titulação<TH>40 horas<TH>20-39 horas<TH>1-19 horas<TH>Stricto<BR>Sensu<TH>Proporção';
				$sx .= '<TR><TD>Dr.';
				$sx .= '<TD align="center">'.$rst[0][1];
				$sx .= '<TD align="center">'.$rst[0][2];
				$sx .= '<TD align="center">'.$rst[0][3];
				$sx .= '<TD align="center">'.$rst[0][4];
				if ($tot > 0)
					{
						$drs = $rst[0][1]+$rst[0][2]+$rst[0][3];
						$sx .= '<TD align="center">'.number_format(($drs/$tot*100),1).'%';
					}
				
				$sx .= '<TR><TD>Msc.';
				$sx .= '<TD align="center">'.$rst[1][1];
				$sx .= '<TD align="center">'.$rst[1][2];
				$sx .= '<TD align="center">'.$rst[1][3];
				$sx .= '<TD align="center">'.$rst[1][4];
				if ($tot > 0)
					{
						$drs = $rst[1][1]+$rst[1][2]+$rst[1][3];
						$sx .= '<TD align="center">'.number_format(($drs/$tot*100),1).'%';
					}

				$sx .= '<TR><TD>Esp.';
				$sx .= '<TD align="center">'.$rst[2][1];
				$sx .= '<TD align="center">'.$rst[2][2];
				$sx .= '<TD align="center">'.$rst[2][3];
				$sx .= '<TD align="center">'.$rst[2][4];
				if ($tot > 0)
					{
						$drs = $rst[2][1]+$rst[2][2]+$rst[2][3];
						$sx .= '<TD align="center">'.number_format(($drs/$tot*100),1).'%';
					}

				$sx .= '<TR><TD>Grad.';
				$sx .= '<TD align="center">'.$rst[3][1];
				$sx .= '<TD align="center">'.$rst[3][2];
				$sx .= '<TD align="center">'.$rst[3][3];
				$sx .= '<TD align="center">'.$rst[3][4];
				if ($tot > 0)
					{
						$drs = $rst[3][1]+$rst[3][2]+$rst[3][3];
						$sx .= '<TD align="center">'.number_format(($drs/$tot*100),1).'%';
					}
				

				$tot_dr = $rst[0][1]+$rst[1][1]+$rst[2][1]+$rst[3][1];
				$tot_msc = $rst[0][2]+$rst[1][2]+$rst[2][2]+$rst[3][2];
				$tot_esp = $rst[0][3]+$rst[1][3]+$rst[2][3]+$rst[3][3];
				$tot_gra = $rst[0][4]+$rst[1][4]+$rst[2][4]+$rst[3][4];

				if ($tot > 0)
					{
						$tot_dr .=  ' ('.number_format($tot_dr / $tot * 100,1).'%)';
						$tot_msc .= ' ('.number_format($tot_msc / $tot * 100,1).'%)';
						$tot_esp .= ' ('.number_format($tot_esp / $tot * 100,1).'%)';
						$tot_gra .= ' ('.number_format($tot_gra / $tot * 100,1).'%)';
					}
				$sx .= '<TR><TD><B>Total</B>';
				$sx .= '<TD align="center">'.($tot_dr);
				$sx .= '<TD align="center">'.($tot_msc);
				$sx .= '<TD align="center">'.($tot_esp);
				$sx .= '<TD align="center">'.($tot_gra);
				$sx .= '<TD align="center">-';

				$sx .= '<TR><TD colspan=6><I>Total de docentes: '.$tot;
				$sx .= '</table>';
				return($sx);
		}
	function processar_cursos()
		{
			global $cs;
			$sql = "select * from pibic_professor 
						where pp_curso_cod = '' 
						and pp_curso like '%Biologia%'
						limit 1";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
				$curso = $line['pp_curso'];
				$cs->curso_busca($curso);
				if (strlen(trim($cs->curso_codigo)) > 0)
				{
				$sql = "update pibic_professor set 
						pp_curso_cod = '".$cs->curso_codigo."' ,
						pp_escola = '".$cs->centro_codigo."' ,
						pp_curso = '".$cs->curso_nome."' 
						where id_pp = ".$line['id_pp'];
				$rlt = db_query($sql);
				}
				
				
				}
			return(1);
		}

	function rel_prof_produtividade()
		{
			$sql= 'select * from '.$this->tabela." 
				inner join centro on centro_codigo = pp_escola
			where pp_prod > 0 and pp_ativo = 1 
			
			order by pp_nome ";
			$rlt = db_query($sql);
			return($rlt);
		}
		
	function rel_prof_comite($tp=1)
		{
			$sql= 'select * from '.$this->tabela." 
				inner join centro on centro_codigo = pp_escola
			where pp_comite=".$tp." and pp_ativo = 1 
			order by pp_nome ";
			$rlt = db_query($sql);
			
			return($rlt);
		}

	function rel_prof_prod_ss($ss)
		{
			if ($ss == 'S')
				{
					$where = "pp_ss = 'S'";
				} else {
					if ($ss == 'N') { $where = "pp_ss <> 'S'"; } else { $where = "(pp_ativo = 1 )"; }
					
				}
			$wh = 'and (la_ano = \'2010\' or la_ano = \'2011\')';	
			$sql= 'select * from '.$this->tabela.'
				left join (
					select count(*) as total, sum(artigo) as artigo, sum(livro) as livro, sum(evento) as evento,
							sum(organizado) as organizado, la_professor from (
								select count(*) as artigo, 0 as livro, 0 as evento, 0 as organizado, la_professor from lattes_artigos where la_tipo = \'A\' '.$wh.' group by la_professor
								union 
								select 0 as artigo, count(*) as livro, 0 as evento, 0 as organizado, la_professor from lattes_artigos where (la_tipo = \'L\'  or la_tipo = \'O\') '.$wh.' group by la_professor
								union 
								select 0 as artigo, 0 as livro, count(*) as evento, 0 as organizado, la_professor from lattes_artigos where la_tipo = \'E\' '.$wh.' group by la_professor
								union 
								select 0 as artigo, 0 as livro, 0 as evento, count(*) as organizado, la_professor from lattes_artigos where la_tipo = \'C\' '.$wh.' group by la_professor
							) as tabela group by la_professor					
				) as tabprof on la_professor = pp_cracha
				left join centro on centro_codigo = pp_escola
			where '.$where.' and pp_ativo = 1 
			and pp_centro <> \'DOUTORANDO\'
			
			order by centro_nome, pp_nome ';
						
			$rlt = db_query($sql);
			return($rlt);
		}

	function rel_prof_pibic_ss($ss)
		{
			if ($ss == 'S')
				{
					$where = "pp_ss = 'S'";
				} else {
					if ($ss == 'N') { $where = "pp_ss <> 'S'"; } else { $where = "(pp_ativo = 1 )"; }
					
				}

			$sql = "select count(*) as total, pp_nome from pibic_bolsa_contempladas ";
			$sql .= " inner join docentes on pp_cracha = pb_professor ";
			$sql .= " inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
			$sql .= " where ".$where;
			$sql .= " and (pb_status <> 'C' and pb_status <> '@' )";
			$sql .= " and (pb_ano = '2010' or pb_ano = '2011')";
			$sql .= " group by pp_nome ";
			//$sql .= " and (pb_tipo = 'P' or pb_tipo = 'G' or pb_tipo = 'E')";
			//$sql .= " and (pb_tipo = 'V')";
			
			$rlt = db_query($sql);
						
			$sx .= '<table class="lt1">';
			$tot = 0;
			while ($line = db_read($rlt))
			{
				$ano = trim($line['pb_ano']);
				//if (($ano == '2010') or ($ano == '2011'))
					{
					$tot++;
					$sx .= '<TR>';
					$sx .= '<TD>'.$line['pp_nome'];
					$sx .= '<TD>'.$line['pb_tipo'];
					$sx .= '<TD>'.$line['pb_ano'];
					$sx .= '<TD>'.$line['pbt_descricao'];
					}
			}
			$sx .= '<TR><TD colspan=5>Total '.$tot;
			$sx .= '</table>';
			return($sx);
		}

	function rel_prof_ss($ss)
		{
			if ($ss == 'S')
				{
					$where = "pp_ss = 'S'";
				} else {
					if ($ss == 'N') { $where = "pp_ss <> 'S'"; } else { $where = "(pp_ativo = 1 )"; }
					
				}
				
			$sql= 'select * from '.$this->tabela.' 
				left join centro on centro_codigo = pp_escola
			where '.$where.' and pp_ativo = 1 
			and pp_centro <> \'DOUTORANDO\'
			order by pp_nome ';
						
			$rlt = db_query($sql);
			return($rlt);
		}
				

	function rel_prof_ss_prog($ss)
		{
			$sql= 'select * from '.$this->tabela.' 
				left join centro on centro_codigo = pp_escola
				left join programa_pos_docentes on pp_cracha = pdce_docente and pdce_ativo = 1
				left join programa_pos on pos_codigo = pdce_programa
				left join programa_pos_linhas on pdce_programa_linha = posln_codigo
			where pp_ativo = 1 and pp_ss = \'S\'
			and pp_centro <> \'DOUTORANDO\'
			order by pp_nome ';
			$rlt = db_query($sql);
			$sx .= '<table class="lt1">';
			$sx .= '<TR><TH>Docente<TH>Programa<TH>Linha';
			$xprof = "x";
			$tot = 0;
			while ($line = db_read($rlt))
				{
					$prof = trim($line['pp_nome']);
					$ln = $line;
					$sx .= '<TR '.coluna().'>';
					$sx .= '<TD>';
					if ($xprof != $prof)
						{
							$tot++;
							$sx .= trim($line['pp_nome']);
							$xprof = $prof;							
						} else {
							$sx .= '&nbsp;';
						}
					$sx .= '<TD>';
					$sx .= trim($line['pos_nome']);
					$sx .= '<TD>';
					$sx .= trim($line['posln_descricao']);
				}
			$sx .= '<TR><TD colspan=4>Total de '.$tot.' professores Stricto Sensu';
			$sx .= '</table>';
			
			echo $sx;
			exit;
			return($sx);
		}

	function link_lattes($link)
		{
			$lattes = trim($link);
			if (strlen($lattes) > 0)
				{ $lattes = '<A HREF="'.$lattes.'" target="_new">'; }
			$lattes = troca($lattes,'.jsp?','.do?');
			$lattes .'</A>';
			return($lattes);			
		}
		
	function produtividade()
		{
			
			$pd = array(0 =>' ',
						1 => '--',
						2 => 'Nível PQ 1A',
						3 => 'Nível PQ 1B',
						4 => 'Nível PQ 1C',
						5 => 'Nível PQ 1D',
						6 => 'Nível PQ 2',

						12 => 'Nível DT 1A',
						13 => 'Nível DT 1B',
						14 => 'Nível DT 1C',
						15 => 'Nível DT 1D',
						16 => 'Nível DT 2',
						
						20 => 'Nível PQ (FA)'
						);
			return($pd);
			}
					
	function rel_prof_prod_mostra($rlt)
		{
			global $tab_max;
			$sx .= '<table width="'.$tab_max.'" class="lt1">';
			$sx .= '<TR><TH>Nome<TH>Tít.<TH>Produtivade<TH>SS<TH>Cracha<TH>Campus<TH>Atualizado';
			$sx .= '<TH>Art.<TH>Livro<TH>Event.<TH>Cap.Livro<TH>Total';
			$tot = 0;
			$tot1=0;
			$tot2=0;
			$tot3=0;
			$tot4=0;
			
			$tot1a=0;
			$tot2a=0;
			$tot3a=0;
			$tot4a=0;
			$xcentro = 'X';
			$prod = $this->produtividade();
			while ($line = db_read($rlt))
				{
					$tot1 = $tot1 + $line['artigo'];
					$tot2 = $tot2 + $line['livro'];
					$tot3 = $tot3 + $line['evento'];
					$tot4 = $tot4 + $line['organizado'];

					$tot1a = $tot1a + $line['artigo'];
					$tot2a = $tot2a + $line['livro'];
					$tot3a = $tot3a + $line['evento'];
					$tot4a = $tot4a + $line['organizado'];

					$tot++;
					
					$centro = trim($line['centro_nome']);
					if ($centro != $xcentro)
						{
							$xcentro = $centro;
							if (($tot1a+$tot2a+$tot3a+$tot4a) > 0)
								{
									$sx .= '<TR><TD colspan=7 align="right">sub-total';
									$sx .= '<TD align="center">'.$tot1a;
									$sx .= '<TD align="center">'.$tot2a;
									$sx .= '<TD align="center">'.$tot3a;
									$sx .= '<TD align="center">'.$tot4a;									
								}
							$sx .= '<TR><TD colspan=5>';
							$sx .= '<B><I>'.$centro;
							$tot1a=0; $tot2a=0; $tot3a=0; $tot4a=0;  
						}
					
					$link = '<A HREF="docentes_detalhe.php?dd0='.$line['id_pp'].'&dd90='.checkpost($line['id_pp']).'">';
					$sx .= '<TR '.coluna().'>';
					$sx .= '<TD>';
					$sx .= $this->link_lattes($line['pp_lattes']).$line['pp_nome'].'</A>';
					$sx .= '<TD>';
					$sx .= $line['pp_titulo'];
					$sx .= '<TD>';
					$sx .= $prod[$line['pp_prod']];
					$sx .= '<TD>';
					$sx .= $line['pp_ss'];
					$sx .= '<TD>';
					$sx .= $link;					
					$sx .= $line['pp_cracha'];
					$sx .= '<TD>';
					$sx .= $line['pp_centro'];
					$sx .= '<TD align="center">';
					$sx .= $line['pp_update'];
					$sx .= '<TD align="center">';
					$sx .= $line['artigo'];
					$sx .= '<TD align="center">';
					$sx .= $line['livro'];
					$sx .= '<TD align="center">';
					$sx .= $line['evento'];
					$sx .= '<TD align="center">';
					$sx .= $line['organizado'];
					$sx .= '<TD align="center">';
					$sx .= $line['total'];					
				}
			if (($tot1a+$tot2a+$tot3a+$tot4a) > 0)
					{
					$sx .= '<TR><TD colspan=7 align="right">sub-total';
					$sx .= '<TD align="center">'.$tot1a;
					$sx .= '<TD align="center">'.$tot2a;
					$sx .= '<TD align="center">'.$tot3a;
					$sx .= '<TD align="center">'.$tot4a;									
					}


			$sx .= '<TR><TD colspan=7 align="right">Total';
			$sx .= '<TD align="center"><B>'.$tot1;
			$sx .= '<TD align="center"><B>'.$tot2;
			$sx .= '<TD align="center"><B>'.$tot3;
			$sx .= '<TD align="center"><B>'.$tot4;
			$sx .= '<TD align="center"><B>'.($tot1+$tot2+$tot3+$tot4);
			$sx .= '<TR><TD colspan=8><B>Total de '.$tot.' docentes nesta categoria';
			
			$sx .= '</table>';
			return($sx);
		}		
							
					
	function rel_prof_mostra($rlt)
		{
			global $tab_max;
			$sx .= '<table width="'.$tab_max.'" class="lt1">';
			$sx .= '<TR><TH>Nome<TH>Tít.<TH>Produtivade<TH>SS<TH>Cracha<TH>Campus<TH>Curso<TH>Escola<TH>Atualizado';
			$tot = 0;
			$prod = $this->produtividade();
			while ($line = db_read($rlt))
				{
					$tot++;
					$link = '<A HREF="docentes_detalhe.php?dd0='.$line['id_pp'].'&dd90='.checkpost($line['id_pp']).'">';
					$sx .= '<TR '.coluna().'>';
					$sx .= '<TD>';
					$sx .= $this->link_lattes($line['pp_lattes']).$line['pp_nome'].'</A>';
					$sx .= '<TD>';
					$sx .= $line['pp_titulo'];
					$sx .= '<TD>';
					$sx .= $prod[$line['pp_prod']];
					$sx .= '<TD>';
					$sx .= $line['pp_ss'];
					$sx .= '<TD>';
					$sx .= $link;					
					$sx .= $line['pp_cracha'];
					$sx .= '<TD>';
					$sx .= $line['pp_centro'];
					$sx .= '<TD>';
					$sx .= $line['pp_curso'];
					$sx .= '<TD>';
					$sx .= $line['centro_nome'];
					$sx .= '<TD align="center">';
					$sx .= $line['pp_update'];
				}
			$sx .= '<TR><TD colspan=8><B>Total de '.$tot.' docentes nesta categoria';
			$sx .= '</table>';
			return($sx);
		}	
	function recupera_foto()
		{
			global $nw;
			$img_photo = '<IMG SRC="'.http.'cip/img/no_photo.jpg" border=0 width="130"  class="foto-perfil">';
			$fotod= "cip/img_prof/".trim($nw->user_cracha).'.jpg';
			if (!(file_exists($fotod)))
				{ $fotod= "../cip/img_prof/".trim($nw->user_cracha).'.jpg'; }
				
			if (!(file_exists($fotod)))
			{
				$lattes = trim($this->pp_lattes);
				$lattes = troca($lattes,'.jsp','.do');
				
				if ((substr($lattes,0,4)=='http') and (substr($lattes,0,5) != 'https'))
				{
					if (strlen($lattes) > 20)
						{ 
						$rlt = fopen($lattes,'r');
						$sr = '';
						while (!(feof($rlt)))
							{
								$sr .= fread($rlt,1024);
							}
						fclose($rlt);
						}
					
					$fotol = '<TD WIDTH="120px" VALIGN="TOP" ALIGN="LEFT"><img class="foto-perfil" src="';
					if (strpos($sr,$fotol) > 0)
						{
							$pos = strpos($sr,$fotol);
							$foto = substr($sr,$pos+strlen($fotol),100);
							$foto = substr($foto,0,strpos($foto,'"'));
							echo $foto;
							return(1);
							$rla = fopen($foto,'r');
							$rls = fopen($fotod,'w');
							
							$sr = '';
							while (!(feof($rla)))
							{
								$sr = fread($rla,1024);
								fwrite($rls,$sr);
							}
						fclose($rla);
						fclose($rls);
					}
				}	
			} else {
				$fotod= http."cip/img_prof/".trim($this->pp_cracha).'.jpg';
				$img_photo = '<IMG SRC="'.$fotod.'" border=0 width=150 class="foto-perfil">';
			}
			return($img_photo);
			
		}	
	function mostra_dados()
		{
			global $tab_max;
			
			$lattes = trim($this->pp_lattes);
			$lattes = troca($lattes,'.jsp','.do');
			if (strlen($lattes) > 10)
				{
					$lattes = '<a href="'.$lattes.'" target="new">';
					$lattes .= '<img src="'.http.'img/icone_plataforma_lattes.png" height="35" border=0>';
					$lattes."</A>"; 
				} else {
					$lattes = '';
				}
			$img_photo = $this->recupera_foto();
			
			$ss = ($this->pp_ss);
			if ($ss == 'S') { $ss = "SIM"; } else { $ss = "NÃO"; }			
					// class="foto-perfil"	
					
			$pp =trim($this->pp_prod);
			if (strlen($pp) == 0) { $pp = 'NÃO'; }
			$sx = '
			<table id="cabecalho-user-perfil" class="info-pessoais" border=0>
			<TR>
			<TD width="150">
			<div id="foto-perfil">'.$img_photo.'</div>
			<TD>
			<div id="nome-dados-perfil">
				<li><h1>'.$this->pp_nome.'&nbsp;</h1></li>
				<li>CPF: '.$this->pp_cpf.'</li>
				<li>'.$this->pp_telefone.'</li>
				<li>'.$this->pp_celular.'</li>
				<li>'.$this->pp_email.'</li>
				<li>'.$this->pp_email_1.'</li>
				<li>'.mst($this->pp_endereco).'</li>
				<li>'.$lattes.'</li>
			</div>
			<TD width="300">
			<div id="info-pesquisador" class="info-pesquisador lt1">
				<span class="lt2 titulo-info-pesquisador">Informações do Pesquisador</span><br /><br />
				<li><strong>Crachá:</strong> '.$this->pp_cracha.'</li>
				<li><strong>Maior titulação:</strong> '.$this->pp_titulacao.'</li>
				<li><strong>Escolaridade:</strong> '.$this->pp_escolaridade.'</li>				
				<li><strong>Curso:</strong> '.$this->pp_curso.'</li>
				<li><strong>Stricto Sensu:</strong> '.$ss.'</li>
				<li><strong>Bolsa produtividade:</strong> '.$pp.'&nbsp;</li>
				<li><strong>Carga horária:</strong> '.$this->pp_carga_semanal.'</li>
			</div>	
			</table>
			';
			return($sx);		
		}
	function mostra_dados_pessoais()
		{
			global $tab_max;
			
			$lattes = trim($this->pp_lattes);
			$lattes = troca($lattes,'.jsp','.do');
			if (strlen($lattes) > 0)
				{ $lattes = '<a href="'.$lattes.'" target="new">'.$lattes."</A>"; }
			$img_photo = $this->recupera_foto();
			
			$sx .= '<table width="100%" cellspacing=0 cellpadding=0>';
			$sx .= '<TR><TD>';
			$sx .= '<fieldset><legend>'.msg('dados_pessoais').'</legend>';
			$sx .= '<table width="100%" cellspacing=0 cellpadding=0 border=0>';
			$sx .= '<TR class="lt0" >';
			$sx .= '<TD colspan=3>'.msg('nome_completo');
			$sx .= '<TD width=100 align="center">'.msg('photo');
			$sx .= '<TR class="lt1"><TD colspan=3><B>'.$this->pp_nome.'&nbsp;';
			$sx .= '<TD rowspan=12 width=100 align="center">'.$img_photo;

			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD>'.msg('titulacao');
			$sx .= 		'<TD colspan=2>'.msg('escolaridade');
			$sx .= '<TR class="lt1">';
			$sx .= 		'<TD colspan=1><B>'.$this->pp_titulacao.'&nbsp;';
			$sx .= 		'<TD colspan=2><B>'.$this->pp_escolaridade.'&nbsp;';

			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD>'.msg('Bolsista Prod.');
			$sx .= 		'<TD>'.msg('Stricto Sensu');
			$sx .= 		'<TD>'.msg('Carga Horária');
			$sx .= '<TR class="lt1">';
			$ss = ($this->pp_ss);
			if ($ss == 'S') { $ss = "SIM"; } else { $ss = "NÃO"; }
			$sx .= 		'<TD colspan=1><B>'.$this->pp_prod.'&nbsp;';
			$sx .= 		'<TD colspan=1><B>'.($ss.'&nbsp;');
			$sx .= 		'<TD colspan=1><B>'.$this->pp_carga_semanal.'&nbsp;horas';


			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD>'.msg('cracha');
			$sx .= 		'<TD>'.msg('codigo');
			$sx .= '<TR class="lt1">';
			$sx .= 		'<TD><B>'.$this->pp_cracha.'&nbsp;';
			$sx .= 		'<TD><B>'.$this->pp_codigo.'&nbsp;';

			$sx .= '<TR class="lt0"><TD colspan=4>'.msg('email');
			$sx .= '<TR class="lt1"><TD colspan=4><A HREF="mailto:'.$this->pp_email.'">'.$this->pp_email."</A>&nbsp;";

			$sx .= '<TR class="lt0"><TD colspan=4>'.msg('email2');
			$sx .= '<TR class="lt1"><TD colspan=4><A HREF="mailto:'.$this->pp_email_1.'">'.$this->pp_email_1."</A>&nbsp;";

			$sx .= '<TR class="lt0"><TD colspan=4>'.msg('lattes');
			$sx .= '<TR class="lt1"><TD colspan=4>'.$lattes.'&nbsp;';

			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD>'.msg('centro');
			$sx .= 		'<TD>'.msg('negocio');
			$sx .= 		'<TD colspan=2>'.msg('curso');
			$sx .= '<TR class="lt1">';
			$sx .= 		'<TD>'.$this->pp_centro.'&nbsp;';
			$sx .= 		'<TD>'.$this->pp_negocio.'&nbsp;';
			$sx .= 		'<TD colspan=2>'.$this->pp_curso.'&nbsp;';

			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD colspan=3>'.msg('link do pesquisador');
			$sx .= '<TR class="lt1">';
			$sx .= 		'<TD colspan=3><A HREF="'.$this->pp_pagina.'" target="new">'.$this->pp_pagina.'</A>&nbsp;';


			$sx .= '</table>';
			$sx .= '</table>';
			return($sx);
		}

	function mostra()
		{
			global $tab_max;
			
			$lattes = trim($this->pp_lattes);
			$lattes = troca($lattes,'.jsp','.do');
			if (strlen($lattes) > 0)
				{ $lattes = '<a href="'.$lattes.'" target="new">'.$lattes."</A>"; }
			$img_photo = $this->recupera_foto();
			
			$sx .= '<table width="100%" cellspacing=0 cellpadding=0>';
			$sx .= '<TR><TD>';
			$sx .= '<fieldset><legend>'.msg('dados_pessoais').'</legend>';
			$sx .= '<table width="100%" cellspacing=0 cellpadding=0 border=0>';
			$sx .= '<TR class="lt0" >';
			$sx .= '<TD colspan=3>'.msg('nome_completo');
			$sx .= '<TD width=100 align="center">'.msg('photo');
			$sx .= '<TR class="lt1"><TD colspan=3><B>'.$this->pp_nome.'&nbsp;';
			$sx .= '<TD rowspan=8 width=100 align="center">'.$img_photo;

			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD>'.msg('titulacao');
			$sx .= 		'<TD colspan=1>'.msg('escolaridade');
			$sx .= 		'<TD>'.msg('cracha');
			$sx .= '<TR class="lt1">';
			$sx .= 		'<TD colspan=1><B>'.$this->pp_titulacao.'&nbsp;';
			$sx .= 		'<TD colspan=1><B>'.$this->pp_escolaridade.'&nbsp;';
			$sx .= 		'<TD><B>'.$this->pp_cracha.'&nbsp;';
			
			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD>'.msg('Bolsista Prod.');
			$sx .= 		'<TD>'.msg('Stricto Sensu');
			$sx .= 		'<TD>'.msg('Carga Horária');
			$sx .= '<TR class="lt1">';
			$ss = ($this->pp_ss);
			if ($ss == 'S') { $ss = "SIM"; } else { $ss = "NÃO"; }
			$sx .= 		'<TD colspan=1><B>'.$this->pp_prod.'&nbsp;';
			$sx .= 		'<TD colspan=1><B>'.($ss.'&nbsp;');
			$sx .= 		'<TD colspan=1><B>'.$this->pp_carga_semanal.'&nbsp;horas';

			$sx .= '<TR class="lt0"><TD colspan=1>'.msg('email');
			$sx .= '<TD colspan=1>'.msg('email2');
			$sx .= '<TR class="lt1"><TD colspan=1><A HREF="mailto:'.$this->pp_email.'">'.$this->pp_email."</A>&nbsp;";
			$sx .= '<TD colspan=1><A HREF="mailto:'.$this->pp_email_1.'">'.$this->pp_email_1."</A>&nbsp;";

			$sx .= '<TR class="lt0">';
			$sx .= 		'<TD>'.msg('centro');
			$sx .= 		'<TD>'.msg('negocio');
			$sx .= 		'<TD colspan=2>'.msg('curso');
			$sx .= '<TR class="lt1">';
			$sx .= 		'<TD>'.$this->pp_centro.'&nbsp;';
			$sx .= 		'<TD>'.$this->pp_negocio.'&nbsp;';
			$sx .= 		'<TD colspan=2>'.$this->pp_curso.'&nbsp;';
			$sx .= '</table>';
			$sx .= '</table>';
			return($sx);
		}
	function updatex()
		{
			$sql = "select * from ".$this->tabela." where pp_nome_asc = ''";
			$rlt = db_query($sql);
			$sqlx = '';
			while ($line = db_read($rlt))
				{
					$sqlx .= "update ".$this->tabela." set pp_nome_asc = '".UpperCaseSql($line['pp_nome'])."' 
						where id_pp = ".$line['id_pp'].';'.chr(13);			
				}
			$xrlt = db_query($sqlx);
			return(1);	
		}
	}
?>
