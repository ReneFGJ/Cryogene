<TABLE width="<?=$tab_max;?>" class="lt1">
<TR bgcolor="silver" align="center">
<TD><B>Contrato</B></TD>
<TD>tp</TD>
<TD>Cidade</TD>
<TD>e-mail</TD>
<TD>parcelas</TD>
<TD>Anuidade</TD>
</TR>
<?
$isql = '';

$send_email = array();
$send_post = array();
$tt0=0;
$tt1=0;
while ($line = db_read($rlt))
	{
	$ativo = $line['ctr_status'];
	$em = ($vars['bol'.trim($line['id_ctr'])]);
	$indice = $line['ctr_reajuste_indice'];
	$contrato = $line['ctr_numero'];		
	$cobranca = $line['ctr_cobranca_tipo'];		
	$parcelas = $line['fc_parcela'];
	$dsp_cobranca = $line['fc_nome'];
	$dsp_cobranca_cod = $line['fc_codigo'];
	$boleto = $line['total'];
	$ok = 1;
	$idc = $line['id_ctr'];
	$data_ass = $line['ctr_data_coleta'];
	if ($data_ass == 19000101)
		{ $data_ass = $line['ctr_dt_assinatura']; }
			
	$nr_contrato = trim($line['ctr_numero']).'/'.substr($data_ass,2,2);
	$ano_ass  = intval(substr($data_ass,0,4));
	$ano_now  = intval(date("Y"));
	$anuidade = $line['ctr_anuidade_atual'];
	//////////////////////////////////////////////////////////////////////
	$anuidade = $anuidade + round($anuidade*($indice/100));
	if ((intval($anuidade) == 0) and ($ativo == 'S'))
		{
		$anuidade = $line['ctr_anuidade'];
		$anuidade = $anuidade + round($anuidade*($indice/100));
		}
	$anuidade = intval($anuidade*10)/10;
	//////////////////////////////////////////////////////////////////////
	$ano = substr($data_ass,0,4);	
	$venc = brtos($dd[2]);
	if (($parcelas == 0) or (strlen($parcelas) ==0))
		{ $parcelas = 1; }
		
	
		
	$par  = intval($anuidade*100 / $parcelas)/100;
	$npr = 1;
	
	$resp = $line['ctr_responsavel'];
	
	$sql = "select * from cliente ";
	$sql = $sql . " inner join cidade on cl_cidade = c_codigo ";
	$sql = $sql . " where cl_codigo = '".$resp."'";
	$rrr = db_query($sql);
	$saldo = $anuidade;
	if ($xline = db_read($rrr))
		{
		$resp_nome = $xline['cl_nome'];
		$resp_cpf  = $xline['cl_cpf'];
		$resp_ende = $xline['cl_endereco'];
		$resp_bair = $xline['cl_bairro'];
		$resp_cida = substr(trim($xline['c_cidade']).'-'.$xline['c_estado'],0,20);
		$resp_cep  = sonumero($xline['cl_cep']);
		if (strlen($resp_cep) == 8) { $resp_cep = substr($resp_cep,0,2).'.'.substr($resp_cep,2,3).'-'.substr($resp_cep,5,3); }
		$email1 = $xline['cl_email'];
		$email2 = $xline['cl_email_alt'];
		}	

	if ($em == '1')
		{
		$tt1 = $tt1 + $line['ctr_anuidade_atual'];
		echo '<TR '.coluna().'>';
		ECHO '<td>';
		echo $nr_contrato.' ';
		ECHO '<td>';
		echo $dsp_cobranca_cod;
		ECHO '<td>';
		echo $resp_cida;
		ECHO '<td>';
		echo $email1;
		ECHO '<td align="center">';
		echo number_format($parcelas,0).'x';
		ECHO '<td align="right">';
		echo number_format($anuidade,2);
		
		$xsql = "insert into fatura (";
		$xsql .= "ft_nr,ft_contrato,ft_status,";
		$xsql .= "ft_data_vencimento,ft_data_documento,ft_data_processamento,";
		$xsql .= "ft_valor_boleto,ft_tx_boleto,ft_aceite,";
		
		$xsql .= "ft_especie,ft_especie_doc,ft_nosso_numero,";
		$xsql .= "ft_descricao,ft_cpf_cnpj,ft_endereco,";
		$xsql .= "ft_cidade,ft_sacado,ft_endereco1,";
		
		$xsql .= "ft_endereco2,ft_conta,ft_obs,";
		$xsql .= "ft_valor_pago,ft_data_pago";
		$xsql .= ") values (";
		$xsql .= "'','".$contrato."',1,".$venc.',';
		$xsql .= date("Ymd").','.date("Ymd").','.$par.',';
		$xsql .= "0.0,'N',";
		
		$xsql .= "'".substr($dsp_cobranca_cod,0,1)."','".$npr.'/'.$parcelas."','',";
		$xsql .= "'Anuidade ".$npr.'/'.$parcelas." ','".$resp_cpf."','".$resp_ende."',";
		$xsql .= "'".substr($resp_cida,0,20)."','".substr($resp_nome,0,40)."','".$resp_cep."',";
		
		$xsql .= "'','".$dd[4]."','".$dd[3]."',";
		$xsql .= "0,19000101";
		$xsql .= ');'.chr(13).chr(10);
//		echo $xsql;
		$prlt = db_query($xsql);
		
		$isql .= "update contrato set ctr_anuidade_atual = ".$anuidade.", ctr_reajuste = '".date("Ymd")."' where id_ctr = ".$idc.';'.chr(13);
		while (round($saldo) > 1)
			{
			$isql .= "insert into cr_boleto (";
			$isql .= 'bol_contrato,bol_status,bol_data_vencimento,';
			$isql .= 'bol_data_documento,bol_data_processamento,bol_valor_boleto,';
			$isql .= 'bol_tx_boleto,bol_aceite,';
			$isql .= 'bol_especie,bol_especie_doc,bol_nosso_numero,';
			$isql .= 'bol_numero_documento, bol_cpf_cnpj, bol_endereco,';
			$isql .= 'bol_cidade, bol_sacado, bol_endereco1,';
			$isql .= 'bol_endereco2, bol_conta, bol_obs, ';
			$isql .= 'bol_valor_pago,  bol_data_pago,bol_auto,bol_tipo,bol_data_vencimento_2)';
			$isql .= ' values (';
			$isql .= "'".$contrato."','A',".$venc.',';
			$isql .= date("Ymd").','.date("Ymd").','.$par.',';
			$isql .= "0.0,'N',";
			$isql .= "'".substr($dsp_cobranca_cod,0,1)."','".$npr.'/'.$parcelas."','',";
			$isql .= "'Anuidade ".$npr.'/'.$parcelas." ','".$resp_cpf."','".$resp_ende."',";
			$isql .= "'".$resp_cida."','".$resp_nome."','".$resp_cep."',";
			$isql .= "'','".$dd[4]."','".$dd[3]."',";
			$isql .= "0,19000101,'S','".substr($cobranca,0,1)."',".$venc;
			$isql .= ');'.chr(13).chr(10);
			$npr++;
			$saldo = $saldo - $par;
			$venc1 = intval(substr($venc,0,4));
			$venc2 = intval(substr($venc,4,2));
			$venc2++;
			if ($venc2 > 12) { $venc2 = 1; $venc1 = $venc1 + 1; }
			$venc = strzero($venc1,4).strzero($venc2,2).substr($venc,6,2);
			}
		if (substr($dsp_cobranca_cod,0,1) =='B')
			{
			array_push($send_post,array($contrato,date("Ymd"),$parcelas,$anuidade));
			} else {
			array_push($send_email,array($contrato,date("Ymd"),$parcelas,$anuidade,$email1,$email2));
			}
			
		}
	}
	echo '<TR><TD colspan="10" align="right">'.number_format($tt1,2).'</TD></TR>';
	ECHO '</table>';
	if (strlen($isql) > 0)
	{
	$rrr = db_query($isql);
	//echo mst($isql);
	
	$usql = "update cr_boleto set bol_nosso_numero = lpad(id_bol,8,'0') where bol_nosso_numero = ''";
	$rrr = db_query($usql);
	//echo '<HR>GRAVADOR';
	}
?>
</TABLE>