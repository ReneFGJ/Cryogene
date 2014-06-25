<?
require("db.php");
require($include."sisdoc_data.php");
?>
<head>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>

<?
require($include."sisdoc_form2.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");

$contrato = $dd[98];
$forma = $dd[97];

$sqlx = "select * from contrato_check_list where ccl_contrato='".$contrato."' and ccl_codigo='".$forma."' ";
$xrlt = db_query($sqlx);

if ($line = db_read($xrlt))
	{
	$sql = "select count(*) as total from iso_pesquisa_field ";
	$sql .= " left join iso_pesquisa on pes_codigo = pfl_codigo ";
	$sql .= " where pes_ativo=1 ";
	$sql .= " and pes_contrato = '".$dd[98]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		if ($line['total'] <= 0)
			{ 
			echo "Arquivo vazio"; 
			$sqlx = "update contrato_check_list ";
			$sqlx .= " set ccl_contrato = '*' || trim(ccl_contrato) ";
			$sqlx .= " where ccl_contrato='".$contrato."' and ccl_codigo='".$forma."' ";
//			echo $sqlx;
			$rlt = db_query($sqlx);
			redirecina("pesquisa_de_satisfacao.php");
			}
		}


	$sql = "select * from iso_pesquisa_field ";
	$sql .= " left join iso_pesquisa on pes_codigo = pfl_codigo ";
	$sql .= " where pes_ativo=1 ";
	$sql .= " and pes_contrato = '".$dd[98]."' ";
	$sql .= " order by pfl_ordem ";
	$rlt = db_query($sql);
	echo '<font class="lt1">';
	echo '<TABLE width="100%">';
	$mst = 0;
	while ($line = db_read($rlt))
		{
		if ($mst == 0)
			{ echo '<TR><TD colspan="2" class="lt3" align="center">Pesquisa de satisfação<BR>Contrato '.$dd[98]."<BR></TD>"; $mst = 1; }
		$op = trim($line['pes_dados']);
		if (substr($op,0,2) == '20')  { $op = stodbr($op); }
		if ($op=='1') { $op = 'Ótimo'; }
		if ($op=='2') { $op = 'Bom'; }
		if ($op=='3') { $op = 'Regular'; }
		if ($op=='4') { $op = 'Ruim'; }
		if ($op=='5') { $op = 'Péssimo'; }
		echo '<TR class="lt1"><TD align="right">';
		echo $line['pfl_descricao'];
		echo ':';
		echo '<TD><B>';
		echo $op;
		echo '</B><BR>';
		}
		echo '</TABLE>';
	exit;
	}

$sql = "select * from iso_pesquisa_field ";
//$sql .= " where pfl_tipo='0000001' ";
$sql .= " order by pfl_ordem ";
$rlt = db_query($sql);
$tab_max = '100%';

$tabela = "";
$cp = array();
array_push($cp,array('$H8',$dd[0],'',False,True,''));
array_push($cp,array('$H8',$dd[1],'',False,True,''));
array_push($cp,array('$H8',$dd[2],'',False,True,''));
while ($line = db_read($rlt))
	{
	$tf = false;
	$desc = trim($line['pfl_descricao']);
	$pfl = trim($line['pfl_field']);
	$pflc = trim($line['pfl_codigo']);
	if (substr($pfl,0,2) == '$O') { $tf = true; }
	array_push($cp,array($pfl,$pflc,$desc,$tf,True,''));
	}
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
echo editar();
echo '</table>';	

if ($saved > 0)
	{
	$sql = "update iso_pesquisa set pes_ativo=0 where pes_contrato='".$contrato."'; ";
	$rlt = db_query($sql);
	for ($k=3;$k < count($cp);$k++)
		{
		if (strlen($dd[$k]) > 0)
			{
			$sql = "insert into iso_pesquisa ";
			$sql .= "(pes_codigo,pes_contrato,pes_dados,pes_ativo)";
			$sql .= " values ";
			$sql .= "('".$cp[$k][1]."','".$contrato."','".$dd[$k]."',1); ";
			echo '<BR>'.$sql;
			$rltx = db_query($sql);
			}
		}
		$sqlx = "select * from contrato_check_list where ccl_contrato='".$contrato."' and ccl_codigo='".$forma."' ";
		$xrlt = db_query($sqlx);
		if (!($line = db_read($xrlt)))
			{
			$sql = "insert into contrato_check_list (ccl_contrato,ccl_ativo,ccl_codigo) values ";
			$sql .= "('".$contrato."',1,'".$forma."');";
			$rltx = db_query($sql);
			}
	
	?>
	<script>
		close();
	</script>
	<?
	}
?>
