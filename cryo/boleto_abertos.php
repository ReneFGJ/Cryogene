<?
require("cab.php");
require($include.'cp2_gravar.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
$label = "Boletos abertos";
echo '<font class=lt5><center>'.$label.'</center></font>';
if ((strlen($dd[1]) == 0) or (strlen($dd[2]) == 0))
	{
		if (strlen($dd[1]) ==0) { $dd[1]='01/01/2007'; }
		if (strlen($dd[2]) ==0) { $dd[2]=date("d/m/Y"); }
		$tabela = "";
		$cp = array();
		array_push($cp,array('$H1','','',False,True,''));
		array_push($cp,array('$D8','','Vencimento de',False,True,''));
		array_push($cp,array('$D8','','até',False,True,''));
		editar();
	} else {
	
	$dd1 = brtos($dd[1]);
	$dd2 = brtos($dd[2]);
	
	$sql = "select *, ";
	$sql .= " clie_pai.cl_nome as pai, ";
	$sql .= " clie_pai.cl_fone_1 as pai_f1, ";
	$sql .= " clie_pai.cl_fone_2 as pai_f2, ";
	$sql .= " clie_pai.cl_fone_3 as pai_f3,  ";
	$sql .= " clie_pai.cl_email as pai_e1, ";
	$sql .= " clie_pai.cl_email_alt as pai_e2, ";
	$sql .= " clie_resp.cl_email as resp_e1, ";
	$sql .= " clie_resp.cl_email_alt as resp_e2 ";
	$sql .= " from cr_boleto ";
	$sql .= "left join contrato on bol_contrato = ctr_numero ";
	$sql .= "left join cliente as clie_resp on clie_resp.cl_codigo = ctr_responsavel ";
	$sql .= "left join cliente as clie_pai on clie_pai.cl_codigo = ctr_pai ";
	$sql .= "where (bol_data_vencimento >= ".$dd1;
	$sql .= " and bol_data_vencimento <= ".$dd2.' )';
	$sql .= " and (bol_status = 'A') ";
	$sql .= " order by clie_resp.cl_nome, bol_contrato ";
	$rlt = db_query($sql);
	$ss = '';
	$xx = "X";
	$tot = 0;
	$sub = 0;
	while ($line = db_read($rlt))
		{
		$pai = $line['pai'];
		$xcol = coluna();
		if ($xx != $line['bol_contrato'])
			{
			$email_1 = trim($line['resp_e1']);
			$email_2 = trim($line['resp_e2']);
			$email_3 = trim($line['pai_e1']);
			$email_4 = trim($line['pai_e2']);
			if (strlen($email_1) > 0) { $email = '<A HREF="mailto:'.$email_1.'">e-mail</A>'; }
			if (strlen($email_2) > 0) { $email .= '<A HREF="mailto:'.$email_2.'"> (alt)</A>'; }
			if (strlen($email_3) > 0) { $emailp = '<A HREF="mailto:'.$email_3.'">e-mail</A>'; }
			if (strlen($email_4) > 0) { $emailp .= '<A HREF="mailto:'.$email_4.'"> (alt)</A>'; }
			if ($sub > 0)
				{ $ss .= '<TR><TD colspan="10" align="right">sub-total <B>'.numberformat_br($sub,2).'</B></TR>';	}
			$ss .= '<TR><TD colspan="10"><HR size="1"></TD></TD>';
			$ss .= '<TR '.$xcol.' valign="top">';
			$ss .= '<TD colspan="5" class="lt2">';
			$ss .= '<B>'.$line['bol_sacado'].'</B>'.$email;
			$ss .= '<BR>('.$line['cl_ddd'].')';
			$ss .= ' '.$line['cl_fone_1'];
			$ss .= ' '.$line['cl_fone_2'];
			$ss .= ' '.$line['cl_fone_3'];
			$ss .= '<BR>Pai: '.$pai.' '.$emailp.' ('.$line['cl_ddd'].')';
			$ss .= ' '.$line['pai_f1'];
			$ss .= ' '.$line['pai_f2'];
			$ss .= ' '.$line['pai_f3'];
			$ss .= '<TD align="right"><B>nº contrato ';
			$ss .= $line['bol_contrato'];
			$sub = 0;
			}

		$ss .= '<TR '.$xcol.' valign="top">';
		$ss .= '<TD>';
		$ss .= stodbr($line['bol_data_vencimento']);
		$ss .= '<TD align="center">';
		$ss .= $line['bol_nosso_numero'];
		$ss .= '<TD align="left">';
		$ss .= $line['bol_numero_documento'];
		$ss .= '<TD align="right">';
		$ss .= numberformat_br($line['bol_tx_boleto'],2);
		$ss .= '<TD align="right">';
		$ss .= numberformat_br($line['bol_valor_boleto'],2);
		$ss .= '</TR>';
		$xx = $line['bol_contrato'];
		$tot = $tot + $line['bol_valor_boleto'];
		$sub = $sub + $line['bol_valor_boleto'];
		
		}
		if ($sub > 0)
			{ $ss .= '<TR><TD colspan="10" align="right">sub-total <B>'.numberformat_br($sub,2).'</B></TR>';	}
			{ $ss .= '<TR><TD colspan="10" align="right">Total em aberto <B>'.numberformat_br($tot,2).'</B></TR>';	}
		?>
		<TABLE width="<?=$tab_max?>" class="lt1">
		<?=$ss; ?>
		</TABLE>
		<?
	
	}
?>
