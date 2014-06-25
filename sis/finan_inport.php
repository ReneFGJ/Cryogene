<?
$debug = false;
require("cab.php");
?>
<form method="post">
<textarea cols="80" rows="10" name="dd1"><?=$dd[1];?></textarea>
<BR>
<input type="submit" name="acao">
</form>

<?
$isql = '';
global $s;
if (strlen($dd[1]) > 0)
	{
	$ln = array();
	$s = $dd[1].chr(13);
	while (strpos($s,chr(13)) > 0)
		{
		$lln = trim(substr($s,0,strpos($s,chr(13))));
		if (strlen($lln) > 0) { array_push($ln,$lln); }
		$s = substr($s,strpos($s,chr(13))+1,strlen($s));
		}
	}

	
	
function exv($s)
	{
	global $s;	
	$sx = substr($s,0,strpos($s,';'));
	$s = substr($s,strpos($s,';')+1,strlen($s));
	return($sx);
	}
	

	
for ($k = 0;$k < count($ln);$k++)
	{
	$s = $ln[$k].';';
//	echo $s;
	$cp1 = exv($s);
	$cp2 = exv($s);
	$cp3 = exv($s);
	$cp4 = exv($s);
	$cp5 = exv($s);
	$cp6 = exv($s);
	$cp7 = exv($s);
	$cp8 = exv($s);
	$cp9 = exv($s);
	$cp10 = exv($s);
	$cp11 = exv($s);
	$cp12 = exv($s);
	$cp13 = exv($s);
	$cp14 = exv($s);
	$cp15 = exv($s);
	$cp16 = exv($s);
	$cp17 = exv($s);
	$cp18 = exv($s);
	$cp19 = exv($s);

//////////////////////////
	$dt = strzero(substr($cp4,0,strpos($cp4,'/')),2);
	$cp4 = substr($cp4,strpos($cp4,'/')+1,100);
	$dt = strzero(substr($cp4,0,strpos($cp4,'/')),2).$dt;
	$cp4 = substr($cp4,strpos($cp4,'/')+1,100);
	$dt = strzero($cp4,4).$dt;
	$cp4 = $dt;
	if (strlen($cp4) <> 8)
		{ $cp4 = '20041231'; }
//////////////////////////////////////
	$bco = '6';		
	if ($cp11='Itaú') { $bco = '1'; }
	if (strlen($cp11)==0) { $bco = '6'; }
	if ($cp11='City Bank') { $bco = '8'; }
	if ($cp11='B Boston') { $bco = '7'; }
	$cp11 = $bco;

	$banco = $cp11;
//////////////////////////////////////	
	$status = $cp12;
	if ($cp12 == 'pago') { $status = 'B'; }
	if ($cp12 == 'cancelado') { $status = 'X'; }
	if ($cp12 == 'aberto') { $status = 'A'; }
	
	$cp7 = troca($cp7,'.','');
	$cp7 = troca($cp7,',','.');
	$doc = $cp8;
	/// busca cliente
	$sql = "select * from cliente where upper((cl_nome)) = '".UpperCaseSql($cp13)."'";
	$rlt = db_query($sql);
	if (($line = db_read($rlt)) and (strlen($cp13) > 0))
		{
		$codigo = $line['cl_codigo'];
		echo '======='.$codigo.'==========';
		$sql = "select * from contrato where ctr_mae = '".$codigo."' ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$contrato = trim($line['ctr_numero']);
			if ($contrato == '1999999') { $contrato = '1000133'; }
			echo 'Contrato==[[[['.$contrato.']]]]';
			} else {
			echo '<font color="blue">Contrato nao localizado</font>';
			}
		} else {
			echo '<font color=red>ops, nao localizado mae</font><BR>';
		}
//	echo $sql;
//	
//	echo '<HR>';
//	echo 'cp1=['.$cp1.'],';
//	echo 'cp2=['.$cp2.'],';
//	echo 'cp3=['.$cp3.'],';
//	echo 'cp4=['.$cp4.'],';
//	echo 'cp5=['.$cp5.'],';
//	echo 'cp6=['.$cp6.'],';
//	echo 'cp7=['.$cp7.'],';
//	echo 'cp8=['.$cp8.'],';
//	echo 'cp9=['.$cp9.'],';
//	echo 'cp10=['.$cp10.'],';
//	echo 'cp11=['.$cp11.'],';
//	echo 'cp12=['.$cp12.'],';
//	echo 'cp13=['.$cp13.'],';
//	echo 'cp14=['.$cp14.'],';
//	echo 'cp15=['.$cp15.'],';
//	echo 'cp16=['.$cp16.'],';
//	echo 'cp17=['.$cp17.'],';
//	echo 'cp18=['.$cp18.'],';
//	echo 'cp19=['.$cp19.'],';
	
	$sql = "select * from cr_boleto where ";
	$sql .= "bol_contrato = '".$contrato."' and ";
	$sql .= " bol_valor_boleto = 0".$cp7;
	$sql .= " and bol_data_vencimento = ".$cp4;
	$sql .= " and bol_conta = '".strzero($boc,5)."' ";
	$sql .= " and bol_nosso_numero = '".$cp2."' ";
	$rlt = db_query($sql);
	if (!($line = db_read($rlt)))
		{
		if ($cp4 == '00000000') { $cp4 = '20041231'; }
		$isql = "insert into cr_boleto (";
		$isql .= "bol_contrato ,bol_status , bol_data_vencimento, ";
		$isql .= "bol_data_documento , bol_data_processamento , bol_valor_boleto ,";
		$isql .= "bol_tx_boleto , bol_aceite , bol_especie , ";
		$isql .= "bol_especie_doc , bol_nosso_numero , bol_numero_documento  , ";
		$isql .= "bol_cpf_cnpj , bol_endereco , bol_cidade , ";
		$isql .= "bol_sacado , bol_endereco1 , bol_endereco2 , ";
		$isql .= "bol_conta , bol_obs , bol_valor_pago , ";
		$isql .= "bol_data_pago ) values ( ";
		$isql .= "('".$contrato."','".$status."',".$cp4.",";
		$isql .= $cp4.",".$cp4.",0".$cp7.",";
		$isql .= "0,'N','R$',";
		$isql .= "'','".$cp2."','".$cp2."',";
		$isql .= "'','Importação de dados','',";
		$isql .= "'".strzero($bco,5)."','".$cp8."',0".$cp7.",";
		$isql .= $cp4.") ";
		echo '<font color="green">Inserir na base</font>';
		echo '<BR>'.$isql;
		$rlt = db_query($isql);
		}
	echo $sql;
	}		
?>