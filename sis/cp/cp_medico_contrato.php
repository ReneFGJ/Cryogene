<?
$tabela = "contrato_medico";
$cp = array();
$ano = "";
for ($y=date("Y");$y>=(date("Y")-4);$y--)
	{ 
	if (strlen($ano) > 0) {$ano .= '&';}
	$ano = $ano . $y.':'.$y; 
	}
array_push($cp,array('$H8','id_ctm','id_ctm',False,True,''));
if ( strlen($dd[98]) > 0)
	{
	array_push($cp,array('$Q nome:md_codigo:select *,md_nome || chr(32) as nome from medico order by nome','col_medico','Médico',False,True,''));
	} else {
	array_push($cp,array('$Q nome:md_codigo:select *,md_nome || chr(32) as nome from medico where md_codigo = '.chr(39).$dd[1].chr(39),'col_medico','Médico',False,True,''));
	}
array_push($cp,array('$Q us_nome:us_cracha:select * from parceiros','col_parceiro','Parceiro',False,True,''));

array_push($cp,array('$A','','Contato',False,True,''));
array_push($cp,array('$S7','col_contrato','Nº contrato',False,True,''));
array_push($cp,array('$O '.$ano,'col_ano','Ano',False,True,''));
array_push($cp,array('$D8','col_dt_ass','Data assinatura',False,True,''));
array_push($cp,array('$D8','col_dt_encerramento','Encerramento do contrato',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','col_ativo','Ativo',False,True,''));

if (strlen($dd[4]) > 0)
	{
	while (strlen($dd[4]) < 7)
		{ $dd[4] = '0'.$dd[4]; }
	$xsql = "select * from contrato_medico where col_contrato = '".$dd[4]."' ";
	$xrlt = db_query($xsql);
	if ($xline = db_read($xrlt))
		{
		$cl = $xline['col_dt_ass'];
		echo "Contrato ".$dd[4]." já foi assinado em ".$cl;
		$dd[4] = '';
		}
	}

/// Gerado pelo sistem "base.php" versao 1.0.5
?>