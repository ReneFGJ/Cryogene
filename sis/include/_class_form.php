<?php
    /**
     * Header
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011 - sisDOC.com.br
	 * @access public
     * @version v0.14.11
	 * @package Library
	 * @subpackage Form
    */
    
if(!isset($LANG) || $LANG == ''){ $LANG = 'pt_BR'; }
//XXX Idealmente, daria para testar com file_get_contents(filename) para ver se o arquivo de localiza��o do datepicker 
//	existe antes de puxar ele aqui (e carregando jquery.ui.datepicker-pt-BR.js caso n�o exista)
if ($form_no_js != 1)
{
echo '
		<script type="text/javascript" src="'.$http.'include/js/jquery-ui.js"></script>
		<script type="text/javascript" src="'.$http.'include/js/jquery-ui-datepicker-localisation/jquery.ui.datepicker-'.str_replace('_', '-', $LANG).'.js"></script>
		<script type="text/javascript" src="'.$http.'include/js/jquery.maskedit.js"></script>
		<script type="text/javascript" src="'.$http.'include/js/jquery.maskmoney.js"></script>
		<script type="text/javascript" src="'.$http.'include/js/jquery.tagsinput.js"></script>
		<link rel="stylesheet" href="'.$http.'include/css/calender_data.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="'.$http.'include/css/style_keyword_form.css" type="text/css" media="screen" />
	';

/*
 * Depend�ncias do dynatree e do tinymce
 */
echo '
		<script type="text/javascript" src="'.$http.'include/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="'.$http.'include/js/jquery/jquery.cookie.js"></script>
		<script type="text/javascript" src="'.$http.'include/js/jquery.dynatree.js"></script> 
	';
$ajax = 1;
}

if (!(function_exists("cpf")))
	{
	function cpf($cpf)
	{
		$cpf = sonumero($cpf);
		if (strlen($cpf) <> 11) { return(false); } 
		
		$soma1 = ($cpf[0] * 10) + ($cpf[1] * 9) + ($cpf[2] * 8) + ($cpf[3] * 7) + 
			 	($cpf[4] * 6) + ($cpf[5] * 5) + ($cpf[6] * 4) + ($cpf[7] * 3) + 
			 	($cpf[8] * 2); 
		$resto = $soma1 % 11; 
		$digito1 = $resto < 2 ? 0 : 11 - $resto; 
		
		$soma2 = ($cpf[0] * 11) + ($cpf[1] * 10) + ($cpf[2] * 9) + 
			 	($cpf[3] * 8) + ($cpf[4] * 7) + ($cpf[5] * 6) + 
			 	($cpf[6] * 5) + ($cpf[7] * 4) + ($cpf[8] * 3) + 
			 	($cpf[9] * 2); 
			 	
		$resto = $soma2 % 11; 
		$digito2 = $resto < 2 ? 0 : 11 - $resto; 
		if (($cpf[9] == $digito1) and ($cpf[10] == $digito2))
			{ return(true); } else
			{ return(false); }
		}
	}

class form
	{
		var $ajax = 0;
		var $size=10;
		var $maxlength = 10;
		var $name='';
		var $caption='';
		var $required=0;
		var $rq = '';
		var $readonly='';	
		var $fieldset='';
		/* Classe */
		var $class='';
		var $class_memo;
		
		/* Valores */
		var $value='';
		var $line;
		var $par;
		var $js = '';
		var $cols=80;
		var $rows=5;
		var $js_valida = '';
		
		var $required_message = 1;
		var $required_message_post = 1;		
		var $saved = 0;
		
		var $total_cps = 0;		

		/**
		 * �ndice de $cp onde se encontram par�metros (opcionais) de um tipo
		 *  Usado, e.g., em type_ARV() para receber a �rvore
		 * @var integer
		 */
		var $indiceParams = 5;

		/**
		 * Framework a ser usado para gerar campo de rich text (ver type_RT())
		 * @var string
		 */
		var $geradorCampoRichText = 'tinymce';

		/**
		 * Javascript adicional a ser executado no submit (ver type_B(), usado por type_ARV())
		 * @var string
		 */
		var $jsOnSubmit='';
		
		function keyid()
			{
				global $secu;
				$key = md5(microtime() . $secu . rand());
				$keysid = trim($_SESSION['token_field']);
				$keys = trim($_SESSION['token']);
				if (strlen($keys) > 0)
					{
						$key = $keys;
					} else {
						/* New KeyId*/
					}
				$_SESSION['token'] = $key;
				$this->key = $key;
				return(md5($key));				
			}
		function keyid_form()
			{
				global $secu;
				$size = 10;
				$key = troca(microtime() + rand(),'.','');
				$key = substr($key,strlen($key)-$size,$size);

				$this->key_form = $key;
				$this->key_form_check = strzero(3*$key,$size);
				return($key);				
			}		
		
		function editar($cp,$tabela,$post='')
			{
				global $dd,$acao,$path,$http;
				$bto = 0;
				
				if ($this->ajax==1)
					{
						if (strlen($this->frame) == 0) { echo 'FRAME NAME NOT FOUND'; exit; }
						$vars = ''; $data = '';
						for ($r=0;$r < (count($cp)+3); $r++)
							{
								$vars .= 'var ddv'.$r.' = $("#dd'.$r.'").val();'.chr(13).chr(10);
								if (strlen($data) > 0) { $data .= ', '; }
								$data .= 'dd'.$r.': ddv'.$r.' ';								
							}
						$data .= ', dd89: \''.$this->frame.'\', acao: \'gravar\' ';
						$sx = '
						<script>
						function enviar_formulario(id)
							{
								'.$vars.'
								var tela01 = $.ajax({
										type: "POST",
										url: "'.page().'",  
										data: { '.$data.'}
										}) 
										.done(function(data) { $("'.$this->frame.'").html(data); }) 
										.fail(function() { alert("error"); }) 
										.always(function(data) { $("'.$this->frame.'").html(data); }); 
							}
						</script>
						';
					}
				$this->total_cps = count($cp);
				
				for ($r=0;$r < count($cp);$r++)
					{
						if (substr($cp[$r][0],0,2)=='$B') { $bto = 1; }
					}
				if ($bto == 0)
					{ array_push($cp,array('$B8','',msg('save'),false,false)); }
				$this->keyid();
				array_push($cp,array('$TOKEN','','',True,False));
				/**
				 * Recupera informacoes
				 */
				$recupera = 0;
				if ((strlen($tabela) > 0) and 
						(strlen($acao)==0) and 
						(strlen($dd[0]) > 0) and 
						(strlen($cp[0][1]) > 0))
							{
								$sql = "select * from ".$tabela." where ".$cp[0][1]." = '".$dd[0]."'";
								$rrr = db_query($sql);
								if ($line = db_read($rrr)) { $this->line = $line; }
								$recupera = 1;							
							}
				/**
				 * Processa
				 */
				$this->js_submit = '<script>';
				if (strlen($post)==0) { $post = page(); }
				
				$this->saved = 1;
				$this->rq = '';
				$sx .= '<TR><TD><form id="formulario" method="post" action="'.$post.'" >'.chr(13).chr(10);
				$sh .= '<table class="tabela00" width="100%">'.chr(13);
				
				for ($r=0;$r < count($cp);$r++)
					{
						if ($recupera == 1) 
							{
								$fld = $cp[$r][1]; 
								$dd[$r] = trim($this->line[$fld]);
								if (substr($cp[$r][0],0,2)=='$D')
									{
										$dd[$r] = stodbr($this->line[$fld]);		
									} 
							}
						$this->name = 'dd'.$r;
						if (!(is_array($dd))) { $dd = array(); }
						
						$this->value = trim($dd[$r]);
						$sx .= $this->process($cp[$r]);
						
						if (($cp[$r][0]=='$TOKEN') and (strlen($acao) > 0))
							{
								$keyc = md5($this->key);
								if ($keyc != $this->value)
									{
									//if ($this->required_message_post == 1)
										{ $sx .= '<TR><TD colspan=2><font color="red">Try CSRF ingected</font><BR>'; }
									$this->saved = -99;
									}
							}

						if (($cp[$r][0]=='$TOKEN') and (strlen($acao) > 0))
							{
								$array = $_POST;
								if (is_array($array))
									{
										$fld = array_keys($_POST);
									} else {
										$fld = array();
									}
								
								$fldk_value = '1';
								$fldk_vlr = '2';
								
								$sz = round(count($fld));
								$fldk = '';

								if ($sz > 0) 
									{
										for ($rq=0;$rq < count($fld);$rq++)
										{
										$flda = $fld[$rq];
										if (!(is_array($flda)))
											{
											if (substr($fld[$rq],0,2)=='tk')
												{ $fldk = $fld[$rq]; }
											}								
										}
			
										if (strlen($fldk) > 0)
										{
											$fldk_value = substr($fldk,2,strlen($fldk));
											$fldk_vlr = (round($_POST[$fldk]/3));
										} else {
											$fldk_value = '1'; $fldk_vlr = '2';
										}
									}
								
								if (($fldk_value != $fldk_vlr) and ($this->ajax != 1))
									{
										$sx .= '<TR><TD colspan=2><font color="red">Try CSRF ingected (2)</font><BR>';
										$this->saved = -98;
									}								
							}	
													
						if (($this->required == '1') and (strlen($this->value) == 0) )
							{
								if ($this->required_message_post==1)
									{
									$this->rq .= msg('field').' '.$this->caption.' '.msg('is_requered').'(dd'.$r.')<BR>';
									}
								$this->saved = 0; 
							}
					}
				$sx .= '<input type="hidden" name="dd99" id="dd99" value="'.$dd[99].'">'.chr(13);
				$sx .= '<TR><TD></form>';
				$sx .= chr(13).'</table>';
				
				$this->js_submit .= chr(13).'</script>';
				
				$sx .= $this->js;
				$sx .= $this->js_submit;
				
				if ((strlen($this->rq) > 0) and (strlen($acao) > 0))
					{
						$sa = '<TR><TD colspan=2 bgcolor="#FFC0C0">';
						$sa .= '<img src="'.$http.'img/icone_alert.png" height="50" align="left">';
						$sa .= '<font class="lt1">';
						$sa .= $this->rq;
						$sa .= '</font>';
						$sa .= $sx; 
						$sx = $sa;
					}

				if (($this->saved > 0) and (strlen($acao) > 0))
					{
						if (strlen($tabela) > 0)
							{ $this->save_post($cp,$tabela); }
						//$sx = 'SAVED TABLE '.$tabela.' id = '.$dd[0];
					} else {
						$this->saved = 0;
					}
				return($sh.$sx);
			}
		function save_post($cp,$tabela)
			{
				global $dd,$acao,$path;
				if (isset($dd[0]) and (strlen($dd[0]) > 0) and (strlen($cp[0][1]) > 0)) 
					{
			//		echo "==gravado";
					$sql = "update ".$tabela." set ";
					$cz=0;
					for ($k=1;$k<100;$k++)
						{
							if ((strlen($cp[$k][1])>0) and ($cp[$k][4]==True))
							{
								if (($cz++)>0) {$sql = $sql . ', ';}
								if (substr($cp[$k][0],0,2) == '$D') 
									{
										//echo '<BR>===>'.$dd[$k];	
								 		$dd[$k] = brtos($dd[$k]); 
									}
								$sql = $sql . $cp[$k][1].'='.chr(39).$dd[$k].chr(39).' ';
							}
						}
						$sql = $sql .' where '.$cp[0][1]."='".$dd[0]."'";
					if (strlen($tabela) >0)
						{ $result = db_query($sql) or die("<P><FONT COLOR=RED>ERR 002:Query failed : " . db_error()); }
					$acao=null;
					$saved=1;
					}
				else
					{
					$sql = "insert into ".$tabela." (";
					$sql2= "";
					$tt=0;
					for ($k=1;$k<100;$k++)
						{
							if (strlen(trim(($cp[$k][1]))))
							{
								if ($tt++ > 0) { $sql = $sql . ', '; $sql1 = $sql1 .', ';}
								$sql = $sql . $cp[$k][1];
								if (substr($cp[$k][0],0,2) == '$D') { $dd[$k] = brtos($dd[$k]); }
								$sql1= $sql1. chr(39).$dd[$k].chr(39);
							}
						}
					$sql = $sql . ') values ('.$sql1.')';
			//		echo $sql;
					$sqlc = $sql;
		
					if (strlen($tabela) > 0)
						{ $result = db_query($sql); }
		//				$dd[1] = null;
						$acao=null;
						$saved=2;
					}
				return($saved);
				
			}
		
		function process($cp)
			{
				global $dd,$acao,$ged,$http;
				
				$i = UpperCaseSql(substr($cp[0],1,5));
				if (strpos($i,' ') > 0) { $i = substr($i,0,strpos($i,' ')); }
				$this->required = $cp[3];
				$this->caption = $cp[2];
				$this->fieldset = $cp[1];
				$size = sonumero($cp[0]);
				$this->maxlength = $size;
				$this->caption = $cp[2];
				if (($cp[4]==True) or ($cp[4]==1))
					{
						$this->readonly = '';
					} else {
						$this->readonly = ' readonly ';
						
					}
				
				if ((strlen(trim($acao)) > 0) 
						and ($this->required==1) 
						and (strlen(trim($this->value))==0))
					{ $this->caption = '<font color="red">'.$this->caption.'</font>'; }
					
				if ($size > 80) { $size = 80; }
				$this->size = $size;
				$i = troca($i,'&','');
				$i = troca($i,':','');
				$sn = sonumero($i);
				$i = troca($i,$sn,'');
				//echo '['.$i.']';
				if ((substr($i,0,1)=='T') and ($i != 'TOKEN')) { $i = 'T'; }
				if (substr($i,0,1)=='[') { $i = '['; }
				
				$sx .= chr(13).'<TR valign="top"><TD align="right">';
				$sh .= $this->caption.'<TD>';

				switch ($i) 
				{
					/* Field Sets */
					case '{':  $sx .= $this->type_open_field(); break;	
					case '}':  $sx .= $this->type_close_field(); break;	
										
					/* Sequencial */
					case '[':
						$this->par = substr($cp[0],2,strlen($cp[0]));  
						$sx .= $sh. $this->type_seq(); break;	

					case 'AUTOR':  $sx .= '<TR><TD colspan=2>'.$this->type_Autor(); break;	
					/* Caption */
					case 'A':  $sx .= '<TR><TD colspan=2>'.$this->type_A(); break;	
					/* Alert */
					case 'ALERT':  $sx .= '<TR><TD><TD colspan=1>'.$this->type_ALERT(); break;
					/* Button */	
					case 'B':  $sx .= '<TD>'.$this->type_B(); break;	
					/* Checkbox */	
					case 'C':  $sx .= '<TD>'.$this->type_C(); break;	
					/* City, State, Country */
					case 'CITY':  $sx .= $sh. $this->type_City(); break;
					
					/* Date */
					case 'DECLA':  $sx .= $this->type_DECLA(); break;
										
					/* Date */
					case 'D':  $sx .= $sh. $this->type_D(); break;
					/* Date */
					case 'EMAIL':  $sx .= $sh. $this->type_EMAIL(0); break;					
					case 'EMAIL_UNIQUE':  $sx .= $sh. $this->type_EMAIL(1); break;
					/* Funcoes adicionais */
					case 'FC':				
						$this->par = substr($cp[0],3,strlen($cp[0])); 
						
						if ($this->par == '001') { $sx .= function_001(); } 
						if ($this->par == '002') { $sx .= function_002(); }
						if ($this->par == '003') { $sx .= function_003(); }
						if ($this->par == '004') { $sx .= function_004(); }
						if ($this->par == '005') { $sx .= function_005(); }
						if ($this->par == '006') { $sx .= function_006(); } 
						
						break;		
					/* Files */
					case 'FILES':
						
						$sx .= '<TD>';
						$sx .= $ged->file_list();
						$sx .= $ged->upload_botton_with_type($ged->protocolo,'','');
						break;
					/* KeyWord */
					case 'KEYWO':  $sx .= $sh. $this->type_KEYWORDS(); break;						
					/* Hidden */
					case 'H':  $sx .= $this->type_H(); break;
					/* Hidden with value */
					case 'HV':  $sx .= $this->type_HV(); break;					
					/* Inteiro */
					case 'I':  $sx .= $sh. $this->type_I(); break;	
					/* MEnsagens */
					case 'M':  $sx .= $this->type_M(); break;
					/* Valor com dias casas */
					case 'N':  $sx .= $sh. $this->type_N(); break;
					/* Options */
					case 'O':  
						$this->par = substr($cp[0],2,strlen($cp[0]));
						$sx .= $sh. $this->type_O(); break;					
					/* String Simple */
					case 'P':  $sx .= $sh. $this->type_P(); break;					
					/* Query */
					case 'Q':
						$this->par = splitx(':',substr($cp[0],2,strlen($cp[0])));  
						$sx .= $sh. $this->type_Q(); 
						break;										
					/* String Simple */
					case 'S':  $sx .= $sh. $this->type_S(); break;
					/* String Simple */
					case 'T':
						$this->cols = sonumero(substr($cp[0],0,strpos($cp[0],':')));
						$this->rows = sonumero(substr($cp[0],strpos($cp[0],':'),100));
						$sx .= $sh. $this->type_T(); 
						break;
					/* Token */
					case 'TOKEN':
						$sx .= $this->type_TOKEN(); 
						break;						
					/* String Ajax */
					case 'SA': $sx .= $sh. $this->type_SA(); break;
					/* Update */
					case 'U':  $sx .= $sh. $this->type_U(); break;
					/* Estados */
					case 'UF': $sx .= $sh. $this->type_UF(); break;
					
					case 'RT': /* Editor de texto rico (Rich Text) */
					case 'ARV': /* �rvore com checkboxes */
					case 'ATAGS': /* Textarea com autocomplete de tags */
						$params  = $this->_cp_get_params($cp);
						$sx .= $sh.call_user_func_array(array(&$this, 'type_'.$i), $params);
						break;		
				}
				return($sx);
			}

		/**
		 * {
		 */
		 function type_open_field()
		 	{
				$sx = "";
				if (strlen($this->caption) > 0) 
					{ 
					$vcol = 0;
					$sx .= '<TR><TD colspan="2">';
					$sx .= '<fieldset '.$this->class.'>';
					$sx .= '<legend><font class="lt1"><b>'.$this->caption.'</b></legend>';
					$sx .= '<table cellpadding="0" cellspacing="0" class="lt2" width="100%">';
					$sx .= '<TR valign="top">';
					}
				return($sx);
		 	}
		/**
		 * {
		 */
		 function type_close_field()
		 	{
				$sx = "";
				$sx .= '</fieldset>';
				$sx = '</table>';
				return($sx);
		 	}
		/**
		 * Function Sequencial
		 */	
		 function type_seq()
		 	{
		 		global $line;
		 		$par = $this->par;
				$dec = strpos($par,']D');
				if ($dec > 0) { $dec = 1; }
				$par = substr($par,0,strpos($par,']'));
				$par = splitx('-',$par);
				$txt = round($this->value);
				$sx = '
				<select name="'.$this->name.'" id="'.$this->name.'" size="1" '.$this->class.'>
					'.$this->class.' 
					id="'.$this->name.'" >';
				$sx .= '<option value="">'.msg('select_option').'</option>';
				if ($dec==0)
					{									
						for ($nnk=round($par[0]);$nnk <= round($par[1]);$nnk++)
						{
							$sel = '';
							if ($nnk==$txt) {$sel="selected";}
							$sx= $sx . "<option value=\"".$nnk."\" ".$sel.">".$nnk."</OPTION>";
						}
					} else {
						for ($nnk=round($par[1]);$nnk >= round($par[0]);$nnk--)
						{
							$sel = '';
							if ($nnk==$txt) {$sel="selected";}
							$sx= $sx . "<option value=\"".$nnk."\" ".$sel.">".$nnk."</OPTION>";
						} 
					}
				$sx = $sx . "</select>" ;
				return($sx);	
			}
					
		/***
		 * type_Autor
		 */
		function type_Autor()
			{
				global $dd,$ged,$http;
				$sx = '<div id="autores">
				carregando.... aguarde...
				</div>';
				
				$link = $http.'pb/ajax_autores.php?dd1='.$ged->protocolo;
				echo $link;
				$sx .= '
				<script>
					$.post(\''.$link.'\', function(data) {
					$("#autores").html(data);
					alert("load...");
					});
				</script>
				';
				return($sx);
			}
		/**
		 * Hidden
		 */	
		function type_A()
			{
				$sx = '
				<HR>
				<h2>'.$this->caption.'</h2>				
				';
				return($sx);
			}
		/**
		 * Hidden
		 */	
		function type_ALERT()
			{
				global $http;
				if (strlen($this->caption) > 0)
				{
					$sx = '<img src="'.$http.'/img/icone_alert.png" height=40 align="left">';
					$sx .= $this->caption;
				}
				return($sx);
			}			
		/***
		 * Hidden
		 */	
		function type_B()
			{
				global $dd, $cp;
				if ($this->ajax == 0)
				{
					$sx = '
					<input 
						type="submit" value="'.$this->caption.'" 
						name="acao"
						id="'.$this->name.'" class="bottom_submit" />';
				} else {
					$sx = '
					<input type="button"
						value="'.$this->caption.'" 
						name="acao"
						id="acao" onclick="enviar_formulario(\''.$this->total_cps.'\')" />';
				} 
				return($sx);
			}
		/***
		 * Checkbox
		 */	
		function type_C()
			{
				global $dd, $cp;
					$checked = '';
					if (trim($this->value)=='1') { $checked = ' checked ';}
					$sx = '
					<input 
						type="checkbox" value="1" 
						name="'.$this->name.'"
						id="'.$this->name.'" '.$checked.' />';
					$sx .= '&nbsp;'.$this->caption;						
				return($sx);
			}
		/***
		 * City
		 */
		function type_City()
			{
				global $LANG;

				$sql = "Select * from ajax_pais where pais_ativo > 0 order by pais_prefe desc, pais_ativo desc, pais_nome ";
				$rrr = db_query($sql); 
				$opt = '<option value="">'.msg('select_your_country').'</option>';
				while ($line = db_read($rrr))
				{
					$check = '';
					$opv = trim($line['pais_codigo']);
					$opd = trim($line['pais_nome']);
					if (trim($this->value)==$opv) { $check = 'selected'; }
					$opt .= chr(13);
					$opt .= '			<option value="'.$opv.'" '.$check.'>';
					$opt .= $opd;
					$opt .= '</option>';
				}
				/* Script dos estados */
				$js = '';
				$sx = '
				<select name="'.$this->name.'" id="'.$this->name.'" size="1" '.$this->class.'>
					'.$this->class.' 
					id="'.$this->name.'" >';
				$sx .= $opt.chr(13);
				$sx .= '</select>';
				return($sx);

			}
			
		/*********************************
		 * Data
		 */
		function type_D()
			{
				global $include,$acao,$http;
				$sx = '
				<input 
					type="text" name="'.$this->name.'" size="13"
					value = "'.$this->value.'"
					maxlength="10" '.$this->class.' 
					id="'.$this->name.'"
					'.$msk.' />&nbsp;';
				$sx .= $this->requerido();

				/* SCRIPT */
				$gets = '
				<script>
					$("#'.$this->name.'").mask("99/99/9999");
					$("#'.$this->name.'").datepicker({
							showOn: "button",
							buttonImage: "'.$http.'include/img/icone_calender.gif",
							buttonImageOnly: true,
							showAnim: "slideDown"	 
					});
				</script>
				';
				$this->js .= $gets;
				return($sx);				
			}

		/* Declaracao */
		function type_DECLA()
			{
				global $include,$acao;
				$sx ='<TR><TD colspan=2>';
				$sx .= $this->caption;
				$sx .= '<BR><BR>';
				$sx .= '
				<select name="'.$this->name.'" >
					<option value=""></option>
					<option value="SIM">SIM</option>
				</select>
				, concordo.
				';
				$sx .= $this->requerido();
				return($sx);				
			}

		/***
		 * String
		 */			
		function type_EMAIL($unique=0)
			{
				$style = ' size="60" style="width: 90%;';
				$sx = '
				<input 
					type="text" name="'.$this->name.'" 
					value = "'.$this->value.'"
					maxlength="'.$this->maxlength.'" '.$this->class.' '.$style.' 
					id="'.$this->name.'" />'.chr(13);
				$sx .= $this->requerido();
				return($sx);
			}

		/***
		 * Hidden
		 */	
		function type_H()
			{
				$sx = '
				<input 
					type="hidden" name="'.$this->name.'" 
					value="'.$this->value.'" id="'.$this->name.'" />';
				return($sx);
			}
		/***
		 * Hidden with value
		 */	
		function type_HV()
			{ 
				$sx = '
				<input 
					type="hidden" name="'.$this->name.'" 
					value="'.$this->caption.'" id="'.$this->name.'" />';
				return($sx);
			}

		/**
		 * KEYWORD
		 */
		function type_KEYWORDS()
			{
			$sx = '
				<input 
					type="text" name="'.$this->name.'" value="'.$this->value.'" 
					id="'.$this->name.'" '.$this->class.' />';
				$this->js .= '
				<script>
					$(function() {
						$("#'.$this->name.'").tagsInput({width:\'auto\'});
					});
				</script>
				';
				/* $('#target').submit();*/ 
				return($sx);
			}
		/***
		 * Valores Interiors
		 */
		function type_I()
			{
				global $include;
				$sx = '
				<input 
					type="text" name="'.$this->name.'" size="18"
					value = "'.$this->value.'"
					maxlength="15" '.$this->class.' 
					id="'.$this->name.'"
					'.$msk.'
					'.$this->readonly.'
					 />&nbsp;';
				
				/* SCRIPT */
				$gets = '
				<script>
					$(document).ready(function(){
						$("#'.$this->name.'").maskMoney({precision:0, thousands:""});
					});
				</script>
				';
				$this->js .= $gets;
				return($sx);				
			}
		/* Mensagem */
		function type_M()
			{
				global $include,$acao;
				$sx ='<TR><TD colspan=2 '.$this->class_memo.'>';
				$sx .= $this->caption;
				return($sx);				
			}			
			
		/***
		 * Valor com duas casa decimais
		 */
		function type_N()
			{
				global $include;
				$sx = '
				<input 
					type="text" name="'.$this->name.'" size="18"
					value = "'.$this->value.'"
					maxlength="15" '.$this->class.' 
					id="'.$this->name.'"
					'.$msk.' 
					'.$this->readonly.' />&nbsp;';
				
				/* SCRIPT */
				$gets = '
				<script>
					$("#'.$this->name.'").maskMoney();
				</script>
				';
				$this->js .= $gets;
				return($sx);				
			}


		/***
		 * String
		 */			
		function type_Q()
			{
				$sql = $this->par[2];
				$rrr = db_query($sql);
				$opt = '<option value="">'.msg('select_an_option').'</option>';
				while ($line = db_read($rrr))
				{
					$check = '';
					$opd = trim($line[$this->par[0]]);
					$opv = trim($line[$this->par[1]]);
					if ($this->value==$opv) { $check = 'selected'; }
					$opt .= chr(13);
					$opt .= '			<option value="'.$opv.'" '.$check.'>';
					$opt .= $opd;
					$opt .= '</option>';
				}
				$sx = '
				<select name="'.$this->name.'" size="1" '.$this->class.'>
					'.$this->class.' 
					id="'.$this->name.'" >';
				$sx .= $opt.chr(13);
				$sx .= '</select>';
				return($sx);
			}
			
		
		/***
		 * String
		 */			
		function type_S()
			{
				if ($this->size > 70) { $style = ' size="70" style="width: 90%;" ';}
				else { $style = 'size="'.$this->size.'" '; }
				$sx = '
				<input 
					type="text" name="'.$this->name.'" 
					value = "'.$this->value.'"
					maxlength="'.$this->maxlength.'" '.$this->class.' '.$style.' 
					id="'.$this->name.'"
					'.$this->readonly.' />'.chr(13);
				$sx .= $this->requerido();
				return($sx);
			}
		/***
		 * Options
		 */			
		function type_O()
			{
				$ops = splitx('&',$this->par);
				
				$sx = '
				<select name="'.$this->name.'"
					'.$this->class.' '.$style.' 
					id="'.$this->name.'" >'.chr(13);
					
				for ($r=0;$r < count($ops);$r++)
					{
						$so = $ops[$r];
						$check = '';
						
						$vl = substr($so,0,strpos($so,':'));
						if ($this->value==$vl) { $check = 'selected'; }
						$sx .= '<option value="'.$vl.'" '.$check.'>';
						$sx .= trim(substr($so,strpos($so,':')+1,strlen($so)));
						$sx .= '</option>'.chr(13);
					}
				$sx .= '</select>';
				return($sx);
			}
		/***
		 * String
		 */			
		function type_P()
			{
				if ($this->size > 70) { $style = ' size="70" style="width: 90%;" ';}
				else { $style = 'size="'.$this->size.'" '; }
				$sx = '
				<input 
					type="password" name="'.$this->name.'" 
					value = "'.$this->value.'"
					maxlength="'.$this->maxlength.'" '.$this->class.' '.$style.' 
					id="'.$this->name.'" />'.chr(13);
				$sx .= $this->requerido();
				return($sx);
			}
			
		/**
		 * String Ajax
		 */	
		function type_SA()
			{
				if ($this->size > 70) { $style = ' size="70" style="width: 90%;" ';}
				else { $style = 'size="'.$this->size.'" '; }				
				$sx = '
				<input 
					type="text" name="'.$this->name.'" 
					value = "'.$this->value.'"
					maxlength="'.$this->maxlength.'" '.$this->class.' '.$style.' 
					id="'.$this->name.'" />';
				
				$gets = '
				<script>
					$("#'.$this->name.'").autocomplete({
						source: "/reol/pb/ajax_instituicao.php",
   						minLength: 1,
   						matchContains: true,
        				selectFirst: false
					});				
				</script>';
				$this->js .= $gets;
				return($sx);
			}
		/***
		 * String
		 */			
		function type_T()
			{
				if (round($this->cols)==0) { $this->cols = 80; }
				if (round($this->rows)==0) { $this->rows = 5; }
				$sx = '
				<TEXTAREA 
					type="text" name="'.$this->name.'" size="'.$this->size.'"
					cols="'.$this->cols.'"
					rows="'.$this->rows.'" '.$this->class.' 
					id="'.$this->name.'" />';
				$sx .= $this->value;
				$sx .= '</textarea>';
				$sx .= $this->requerido();
				return($sx);
			}
		/***
		 * TOKEN
		 */	
		function type_TOKEN()
			{
				$this->keyid_form();
				$sx = '
				<input 
					type="hidden" name="'.$this->name.'" 
					value="'.$this->keyid().'" id="'.$this->name.'" />
				';
				
				$sx .= '
				<input 
					type="hidden" name="tk'.$this->key_form.'" 
					value="'.$this->key_form_check.'" />
				';				
				return($sx);
			}
		/***
		 * Hidden
		 */	
		function type_U()
			{
				$sx = '
				<input 
					type="hidden" name="'.$this->name.'" 
					value="'.date("Ymd").'" id="'.$this->name.'" />';
				return($sx);
			}			
		/***
		 * Estado
		 */
		function type_UF()
			{
				global $LANG;

				$estados = array("99"=>"Outside Brazil","AC"=>"Acre","AL"=>"Alagoas","AM"=>"Amazonas","AP"=>"Amap�",
					"BA"=>"Bahia","CE"=>"Cear�","DF"=>"Distrito Federal","ES"=>"Esp�rito Santo",
					"GO"=>"Goi�s","MA"=>"Maranh�o","MT"=>"Mato Grosso","MS"=>"Mato Grosso do Sul",
					"MG"=>"Minas Gerais","PA"=>"Par�","PB"=>"Para�ba","PR"=>"Paran�",
					"PE"=>"Pernambuco","PI"=>"Piau�","RJ"=>"Rio de Janeiro","RN"=>"Rio Grande do Norte",
					"RO"=>"Rond�nia","RS"=>"Rio Grande do Sul","RR"=>"Roraima","SC"=>"Santa Catarina",
					"SE"=>"Sergipe","SP"=>"S�o Paulo","TO"=>"Tocantins");

				$opt = '<option value="">'.msg('select_state').'</option>';
				foreach (array_keys($estados) as $key=>$value) {
					$check = '';
					$opv = $value;
					$opd = $estados[$opv];
					if ($this->value == $opv) { $check = 'selected'; }
					$opt .= chr(13);
					$opt .= '			<option value="'.$opv.'" '.$check.'>';
					$opt .= $opd;
					$opt .= '</option>';
					}				
				$sx = '
				<select name="'.$this->name.'" id="'.$this->name.'" size="1" '.$this->class.'>
					'.$this->class.' 
					id="'.$this->name.'" >';
				$sx .= $opt.chr(13);
				$sx .= '</select>';
				
				return($sx);

			}
		function requerido()
			{
				$sx = '';
				if ($this->required == 1)
					{
						if (strlen($this->value) == 0 )
						{ 
							$sx .= '<div style="color: red">'.msg('field_requered').'</div>'.chr(13);
						}
						
					}
				return($sx);
			}

		function _cp_get_params($cp)
			{
				return isset($cp[$this->indiceParams]) ? $cp[$this->indiceParams] : array();
			}

		/**
		 * PRIVADO: Helper para type_ARV
		 * @param  array   $arvore       	   uma �rvore no formato ($chv, $nome, $filhos)
		 * @param  array   $chavesSelecionadas Chaves que ser�o selecionadas na inicializa��o
		 * @param  boolean $expandirRaiz 	   Expande a visualiza��o da raiz por padr�o
		 * @return string                	   a �rvore expandida no formato esperado pelo dynatree
		 */
		function _type_ARV_expande_arvore($arvore, $tokenSepFormArvore, $expandirRaiz=true)
			{
				if(!$arvore) { return ''; }
				list($chv, $nome, $filhos) = $arvore;
				if(strpos($chv, $tokenSepFormArvore) !== false){
					die("ERRO: Chave inv�lida por cont�m separador de chaves: $chv");
				}
				if(!is_array($filhos) && !$filhos) { $filhos = array(); }
				$strFilhos = "children: [";
				foreach($filhos as $filho){
					$strFilhos .= "\t".$this->_type_ARV_expande_arvore($filho, $tokenSepFormArvore, false)." ";
				}
				$strFilhos .= "]";
				$strExpandir = $expandirRaiz ? 'true' : 'false';
				$saida = "{title: '$nome', key: '$chv', expand: $strExpandir, isFolder: ".($filhos ? "true, $strFilhos" : "false")."}, ";
				return $saida;
			}
		/**
		 * �rvore com checkboxes para sele��o
		 * Aqui usando o dynatree: http://code.google.com/p/dynatree/
		 * @param  array $arvore uma �rvore no formato ($chv, $nome, $filhos)
		 * @return string        html/js de uma �rvore com checkboxes selecion�veis
		 */
		function type_ARV($arvore, $tokenSepFormArvore='%%')
			{
				assert($arvore);
				$arvoreExemplo = array('chaveRaiz', 'Natureza', array(
									array(0,'Aranha',false),
									array(1,'Mam�feros', array(
											array(0, 'Coala', false),
											array(1, 'Le�o', false),
										)),
								));
			    $sel = '
			  	  	<!-- Add code to initialize the tree when the document is loaded: -->
					<link href="css/dynatree/ui.dynatree.css" rel="stylesheet" type="text/css" id="skinSheet">

				    <script type="text/javascript">
				    $(function(){
				        // Attach the dynatree widget to an existing <div id="tree"> element
				        // and pass the tree options as an argument to the dynatree() function:
				        $("#'.$this->name.'-tree").dynatree({
				        	checkbox: true,
				        	selectMode: 3,
				            onActivate: function(node) {
				                // A DynaTreeNode object is passed to the activation handler
				                // Note: we also get this event, if persistence is on, and the page is reloaded.
				                // alert("You activated " + node.data.title);
				            },
				            persist: false,
				            children: [ // Pass an array of nodes.
								'.$this->_type_ARV_expande_arvore($arvore, $tokenSepFormArvore).'
				            ]
				       });
				';

				// Persist�ncia de sele��o (entre POSTs, etc.)
				$sel .= "
						preSelecionar = {}; ";
				if($this->value){
					$chavesSelecionadas = 'preSelecionar[\''.implode('\'] = preSelecionar[\'', explode($tokenSepFormArvore, $this->value)).'\'] = true;'."\n";
					$sel .= $chavesSelecionadas;
				}

				$sel .='
						$("#'.$this->name.'-tree").dynatree("getRoot").visit(function(node){
					        if(preSelecionar[node.data.key]) { node.select(true); }
					    });
				    });
				    </script>
				    <div id="'.$this->name.'-tree" style="width: 93%;"> </div>
				    <input type="hidden" id="'.$this->name.'" name="'.$this->name.'" />
    			';

    			$this->jsOnSubmit .= '
	    			var tree = $("#'.$this->name.'-tree").dynatree("getTree");
	      			selRootNodes = tree.getSelectedNodes(true);
	      			var selRootKeys = $.map(selRootNodes, function(node){
			          return node.data.key;
			        });

    				$("#'.$this->name.'").val(selRootKeys.join("'.$tokenSepFormArvore.'"));    				
    			'; 

				return $sel;
			}

		/**
		 * Campo de Rich Text
		 * TinyMCE: http://www.tinymce.com
		 * @return string html/js de um campo com controles de texto rico
		 */
		function type_RT()
			{
				$conteudo = $this->value;

				if($this->geradorCampoRichText === 'tinymce'){
					$conteudo = htmlspecialchars($this->value, ENT_QUOTES);
					$height = 400;
					return '
						<script type="text/javascript">
						tinymce.init({
						    selector: "textarea.tinymce_'.$this->name.'",
						    language: "pt_BR",
						    menubar: false,
						    statusbar: false,
						    plugins: "textcolor paste link",
						    height: '.$height.',
						    toolbar: "bold italic underline | alignleft aligncenter alignright | bullist | forecolor | link | formatselect fontsizeselect | removeformat",
						    
						    paste_text_sticky_default: true,
						    paste_text_sticky: true,

						    valid_elements: "a[href],p[style],b[style],i[style],u[style],del[style],h1[style],h2[style],h3[style],h4[style],h5[style],h6[style],ul,li,br,span[style]",

						    formats: {
						        bold : {inline : "b" },  
						        italic : {inline : "i" },
						        underline : {inline : "u"},
						        strikethrough: {inline: "del"},
						        
						    },
						 });
						</script>

						<div style="width: 93%;">
							<textarea name="'.$this->name.'" id="'.$this->name.'" class="tinymce_'.$this->name.'" style="height:'.($height+35).'px; min-width:700px">'.$conteudo.'</textarea>
						</div>
					';
				}

				die('Tipo de gerador de campo n�o suportado: '.$this->geradorCampoRichText);
			}

		/**
		 * Campo de sele��o de tags com autocomplete
		 * http://jqueryui.com/autocomplete/#multiple-remote
		 * @param  string $fonteDados    -Se for uma string come�ada com 'http', � tratada como uma URL que retorna uma lista de dados
		 *                                 no formato JSON (objetos com atributos 'label' e 'value')
		 *                               -Se for uma string come�ada com 'function', � tratada como fun��o de autocomplete segundo documenta��o em http://api.jqueryui.com/autocomplete/
		 *                               -Se for um array, � tratada como uma lista de tags 
		 * @param  string $jsTermFun     Se especificado, a fun��o javascript f(request.term) � chamada na inser��o de um termo no campo (ver jsAutocompleteSource)
		 * @return string                Um campo com autocomplete
		 */
		function type_ATAGS($fonteDados, $jsTermFun='')
			{

				$jsTermFun = 'var termFun = '.($jsTermFun !== '' ? $jsTermFun : 'function(term){}').';' ;
				//Formata fonte de dados
				if(is_array($fonteDados)){
					$jsTags = "[";
					foreach($fonteDados as $tag){
						if(is_array($tag) && count($tag) === 2){ list($label, $value) = $tag; }
						elseif(is_string($tag)){ list($label, $value) = array($tag, $tag); }
						else{ die("ERRO type_ATAGS(): Tipo de tag inv�lido."); }

						if(!preg_match('/^[#_a-z][_a-z0-9]*$/', $label)){
							var_dump($tag);
							var_dump(debug_backtrace(false));
							die('ERRO type_ATAGS(): Apenas tags alfanum�ricas min�sculas (sem acentos) come�adas com uma letra ou cerquilha (#) s�o suportadas.');
						}
						if(preg_match('/\'/',$value)){
							die("ERRO type_ATAGS(): valor de tag possui caracter inv�lido: \'.");
						}
						$jsTags .= "{label:'$label', value:'$value'}, ";
					}
					$jsTags .= "]";

					$jsAutocompleteSource = '
						function( request, response ) {
							var availableTags = '.$jsTags.';
							'.$jsTermFun.'
							termFun(request.term);
							// delegate back to autocomplete, but extract the last term
							response( $.ui.autocomplete.filter(
								availableTags, extractLast( request.term ) ) );
						}
					';
				}
				elseif(is_string($fonteDados) && preg_match('/^http[^ ]+$/', strtolower($fonteDados))){
					//XXX n�o testado!
					$jsAutocompleteSource = '
						function( request, response ) {
							termFun(request.term);
							$.getJSON( "'.$fonteDados.'", {
								term: extractLast( request.term )
							}, response );
						}
					';
				}
				elseif(is_string($fonteDados) && preg_match("/^\s*function/", $fonteDados)){
					$jsAutocompleteSource = $fonteDados;
				}
				else{
					var_dump($fonteDados);	
					die('ERRO type_ATAGS(): Fonte de dados inv�lida, vazia ou n�o suportada.');
				}

				
				$jsSearchFun = '
					function() {
						// custom minLength
						var term = extractLast( this.value );
						'.$jsTermFun.'
						termFun(this.value);
						if ( term.length < 2 ) {
							return false;
						}
					}	
				';

				$jsSelectFun = '
					function( event, ui ) {
							var terms = split( this.value );
							// remove the current input
							terms.pop();
							// add the selected item
							terms.push( ui.item.value );
							'.$jsTermFun.'
							termFun(ui.item.value);
							// add placeholder to get the comma-and-space at the end
							terms.push( "" );
							this.value = terms.join( ", " );
							return false;
						}
					}
				';

				return '
					  <script>

						$(function() {
							function split( val ) {
								return val.split( /,\s*/ );
							}
							function extractLast( term ) {
								return split( term ).pop();
							}

							$( "#'.$this->name.'" )
								// don\'t navigate away from the field on tab when selecting an item
								.bind( "keydown", function( event ) {
									if ( event.keyCode === $.ui.keyCode.TAB &&
											$( this ).data( "ui-autocomplete" ).menu.active ) {
										event.preventDefault();
									}
								})
								.autocomplete({
									source: '.$jsAutocompleteSource.'
									,
									search: '.$jsSearchFun.'
									,
									focus: function() {
										// prevent value inserted on focus
										return false;
									},
									select: '.$jsSelectFun.'
									);
						});	
					  </script>
					<input 
						id="'.$this->name.'" 
						name="'.$this->name.'" 
						value="'.$this->value.'" 
						size="'.$this->size.'"
						'.($this->size > 70 ? 'style="width: 90%;"' : '').'
					>
				';
				//return '<input id="'.$this->name.'" type="text" style="width: 90%;" size="70" maxlength="120" value="'.$this->value.'" name="'.$this->name.'"></input>';
			}	
	}
?>