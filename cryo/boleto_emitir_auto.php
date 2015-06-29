<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

$sql = "update contrato set ctr_reajuste_indice = 7.81";
//$rlt = db_query($sql);

$label = "Emitir Boleto para Clientes / Mensal";
if (strlen($dd[0]) == 0)
	{
	$om = '';
	$dd[0] = intval(date("m"));
	for ($r = 1; $r <= 12; $r++)
		{
		if ($r > 1) { $om .= '&'; }
		$om .= $r.':'.nomemes($r);
		}
	$cp = array();
	array_push($cp,array('$O '.$om,'','',False,True,''));	
	?>
	<TABLE width="704" align="center" class="lt1">
	<TR><TD colspan="10"><font class=lt5 ><?=$label?></font></TD></TR>
	<TR>
	<TD width="1%"><form method="post" action="<?=$http_edit;?>"></TD>
	<TD width="10%"><NOBR>Selecione o mês:</TD>
	<TD width="10%"><?=gets_fld();?></TD>
	<TD><input type="submit" name="dd50" value="avancar >>"></TD>
	<TD></form></TD></TD></TR>
	</TABLE>
	<?
	} else {
	/////////////////////////////////////// Mes selecionado - Phase II
	$sql = "select * from contrato ";
	$sql .= ' left join cobranca_forma on ctr_cobranca_tipo = fc_codigo ';
	$sql .= ' left join cliente on cl_codigo = ctr_responsavel ';
	$sql .= ' left join (select bol_contrato,sum(bol_valor_boleto) as total from cr_boleto ';
	$sql .= ' where bol_data_documento >= '.date("Y")."0000 and bol_status <> 'X'";
	$sql .= ' group by bol_contrato ' ; 
	$sql .= ' ) as boletos on boletos.bol_contrato = contrato.ctr_numero ';
	$sql .= ' where ctr_vencimento_dia = '.$dd[0];
	$sql .= ' order by ctr_dt_assinatura,ctr_numero ';
	$rlt = db_query($sql);
	/////////////////////////////////////////////// GERAR BOLETOS
	if ((strlen($acao) > 0) and ($dd[1] == 'SIM') and (strlen($dd[2]) == 10) )
		{
		echo 'Gravar';
		require("boleto_emitir_auto_2.php");
		exit;
		}
	//////////////////////////////////////////////////////////////
	$tot = 0;
	$tov = 0;
	$toit = 0;
	$toiv = 0;
	echo '<TABLE width="704" align="center" class="lt1">';
	echo '<TR><TD colspan="10"><form method="post" action="boleto_emitir_auto.php">';
	echo '<font class="lt5">'.$label.'</font>';
	echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	echo '</TD></TR>';
	echo '<TR align="center" bgcolor="#c0c0c0">';
	echo '<TD><B>Contrato</B></TD>';
	echo '<TD><B>Responsável cobrança</B></TD>';
	echo '<TD><B>Mês</B></TD>';
	echo '<TD><B>Valor aunidade</B></TD>';
	echo '<TD><B>Dt.contrato</B></TD>';
	echo '<TD><B>Status</B></TD>';
	echo '<TD><B>Base</B></TD>';
	echo '</TR>';

	echo '<TR align="center" bgcolor="#c0c0c0">';
	echo '<TD><B></B></TD>';
	echo '<TD><B>Forma pagamento</B></TD>';
	echo '<TD><B></B></TD>';
	echo '<TD><B>Parcelas</B></TD>';
	echo '<TD><B></B></TD>';
	echo '<TD><B></B></TD>';
	echo '<TD><B>Índice</B></TD>';
	echo '</TR>';
	$xano = '0000';
	$btot1=0;
	$btot2=0;
	while ($line = db_read($rlt))
		{
		$ativo = $line['ctr_status'];
		$indice = $line['ctr_reajuste_indice'];
		
		$boleto = $line['total'];
		
		
		$ok = 1;
		$idc = $line['id_ctr'];
		$data_ass = $line['ctr_dt_assinatura'];
		$nr_contrato = trim($line['ctr_numero']).'/'.substr($data_ass,2,2);
		$ano_ass  = intval(substr($data_ass,0,4));
		$ano_now  = intval(date("Y"));
		$anuidade = $line['ctr_anuidade_atual'];
		$cobrarem = $line['ctr_data_inicio_cobranca'];
		$anuidade = $anuidade + round($anuidade*($indice/100));
		$ba = $line['ctr_anuidade_atual'];
		
		$email_a = trim($line['cl_email']);
		$email_b = trim($line['cl_email_alt']);

		if (($anuidade == 0) and ($ativo == 'S'))
			{
			$anuidade = $line['ctr_anuidade'];
			$anuidade = $anuidade + intval($anuidade*$indice)/10000;
			}

		$ano = substr($data_ass,0,4);
		if ($ano != $xano)
			{
			//if ($btot1 > 0)
				{
				echo '<TR><TD colspan="10" align="right">';
				echo 'Total do ano <B>'.numberformat_br($btot1,2);
				echo '</TD></TR>';
				$btot1=0;
				}
			echo '<TR><TD colspan="10"><H1>'.$ano.'</H1></TD></TR>';
			$xano = $ano;
			}
		////////////////////////////////////////////////////////////
		$cob_nome = trim($line['cl_nome']);
		$cob_codigo = $line['ctr_responsavel'];
		if (strlen($cob_nome) == 0)
			{ $ok = 0; $cob_nome = '<font color=red >Responsável pela cobrança não definido</font>'; }
		////////////////////////////////////////////////////////////
		$ativo = $line['ctr_status'];
		$dsp_ativo = '<font color="RED">inválida</font>';
		if ($ativo == 'Z') { $ok = 2; $dsp_ativo = '<font color="Orange">Ativo/conferir</font>'; }
		if ($ativo == 'S') { $dsp_ativo = '<font color="Green">Ativo</font>'; }
		if ($ativo == 'N') { $dsp_ativo = '<font color="Red">Inativo</font>'; $ok = -99; }
		if ($ativo == 'D') { $dsp_ativo = '<font color="#008000">Deletado</font>'; }
		if ($ano_ass >= $ano_now) { $anuidade = -1; }
		if ($cobrarem > date("Ymd")) { $ok = -99; $dsp_ativo = '<font color="#6171e0">Isento</font>'; }
		////////////////////////////////////////////////////////////
		$cobranca = $line['ctr_cobranca_tipo'];
		$cobranca = $line['ctr_cobranca_tipo'];		
		$parcelas = $line['fc_parcela'];
		$dsp_cobranca = $line['fc_nome'];
		$dsp_cobranca_cod = $line['fc_codigo'];
		if (strlen($cobranca) == 0)
			{
			$ok = 0; 
			$dsp_cobranca = '<font color="RED">inválida</font>'; 
			}
		//////////////////////////////////////////////////////////////
		if ($anuidade > 0)
			{ $dsp_anuidade = numberformat_br($anuidade,2); } else
			{ 
			if ($anuidade == 0)
				{ $dsp_anuidade = '<font color="RED">inválida</font>'; $ok = 0; 
				} else { $dsp_anuidade = 'Isenta'; }
			}
		//////////////////////////////////////////////////////////////
		$link = '<A HREF="contrato_ver.php?dd0='.$idc.'" target="new">';
		//////////////////////////////////////////////////////////////
		$col = coluna();
		if ($parcelas > 0)
			{
			$par = numberformat_br(intval(10 * $anuidade / $parcelas)/10,2);
			} else { $par = '<font color="RED">inválida</font>'; $ok = 0; }

		if ($anuidade == 0)
			{ $ok = -98; }
		if ($anuidade < 0)
			{ $ok = -97; }
		if (($ok == 0) or ($ok == -97))
			{$col = 'bgcolor="#ffe8e8" '; }
		if (($ok == -98))
			{$col = 'bgcolor="#c4e4be" '; }
		if ($ok == 2)
			{$col = 'bgcolor="#f2f1fe" '; }
		
		$chk = '';
		if ($ok > 0)	
			{
			$btot1 = $btot1 + $anuidade;
			$btot2 = $btot2 + $anuidade;
			if (strlen($acao) > 0) 
				{ 
				$chked = ''; 
				if ($vars['bol'.trim($line['id_ctr'])] == '1')
					{ $chked = 'checked'; }
				} else { 
					//////////// caso já exista cobrança - ignorar
					if ( $boleto == 0) { $chked = 'checked'; }
				}
			$chk = '<input type="checkbox" name="bol'.trim($line['id_ctr']).'" value="1" '.$chked.'>';
			$chk .= '&nbsp;<font color=#808080 >gerar';
			}
		if ($ok == 0)
			{ $col = 'bgcolor="#fed8de"'; }
		if ($ok == -99)
			{ $col = 'bgcolor="#d8d8d8"'; }
			
		echo '<TR '.$col.' valign="top">';
		echo '<TD align="center">';
		echo $link.$nr_contrato.'</A>';
		echo '<TD>'.$cob_nome.'</TD>';
		echo '<TD align="center">'.$line['ctr_vencimento_dia'];
		echo '<TD align="right">'.$dsp_anuidade;
		echo '<TD align="center">'.stodbr($line['ctr_dt_assinatura']);
		echo '<TD align="center">'.$dsp_ativo;
		echo '<TD>';
		echo '('.numberformat_br($ba,2).')';
		echo '<TR '.$col.'><TD>'.$chk.'</TD>';
		echo '<TD align="center">';
		if (substr($dsp_cobranca_cod,0,1) =='B')
			{ echo '<img src="img/correios.gif" width="32" height="32" align="left" alt="" border="0">'; }
		echo $dsp_cobranca;
		echo '<TD>&nbsp;</TD>';
		echo '<TD align="center"><B>'.$parcelas.'x '.$par;
		echo '<TD colspan="2">';
		echo '['.numberformat_br($boleto,2).']';
		echo '<TD>';
		echo '('.numberformat_br($indice,2).')';

		if (strlen($email_a.$email_b) > 0)
			{ echo '<TR><TD colspan="5">'.$email_a.' '.$email_b.'</TD></TR>'; } else
			{ echo '<TR><TD colspan="5"><font color="red">:::Sem e-mail registrado :::</font>'; }

		echo '<TR><TD colspan="10" height="1" bgcolor="#c0c0c0"><img src="img/p.gif" width="704" height="1" alt="" border="0"></TD>';

		if ($ok > 0)
			{
			$tot = $tot + 1;
			$tov = $tov + $anuidade;
			} else {
			$toit = $toit + 1;
			$toiv = $toiv + $anuidade;
			}
		}

		if ($btot1 > 0)
				{
				echo '<TR><TD colspan="10" align="right">';
				echo 'Total do ano <B>'.numberformat_br($btot1,2);
				echo '</TD></TR>';
				}

		echo '<TR><TD colspan="10"><B>Total de '.$tot.' contrato, R$ '.numberformat_br($tov,2);
		if ($toit > 0)
			{ echo ',&nbsp;&nbsp;<font color=red >inválido '.$toit.' contrato, R$ '.number_format($toiv,2).'</font>'; }
		echo '</TD></TR>';
		echo '<TR><TD colspan="2">';
		echo '<select name="dd1" size="1"><option values="">NÃO</option><OPTION VALUES="SIM">SIM</option></select>';
		echo '<input type="submit" name="acao" value="gerar boletos">';
		echo gets("dd2",$dd[2],'$D8',"no vencimento",true,true);
		echo '</table><TABLE width="'.$tab_max.'"><TR>';
		echo gets("dd3",$dd[3],'$T40:5',"Informações no boleto",false,true);
		echo '<TR>';
		echo gets("dd4",$dd[4],'$Q cc_nome:cc_codigo:select * from conta_corrente where cc_ativo=1 order by cc_nome','Conta emitente',False,True);
		
		echo '</TD><TD></form></TD>';
	echo '</TABLE>';
	}
	
	
	
require("foot.php");
?>	