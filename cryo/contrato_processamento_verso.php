<?
require("cab.php");
global $saved;
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

if (($dd[11]='DEL') and (strlen($dd[10]) >0))
	{
	$sql = "delete from produto_uso ";
	$sql .= "where id_uso = ".$dd[10]." ";
	$sql .=" and uso_contrato = '".$dd[0]."' ";
	$rlt = db_query($sql);
	}

$sql = "select * from produto_uso ";
$sql .= "left join produto_lote on uso_lote = pl_codigo ";
$sql .= "left join produto on pl_produto = produto_codigo ";
$sql .= "left join produto_marca on pl_marca = pm_codigo ";
$sql .= " where uso_contrato = '".$dd[0]."'";
$rlt = db_query($sql);

$ss='';
while ($line = db_read($rlt))
	{
	$ss .= '<TR>';
	$ss .= '<TD>';
	$ss .= $line['produto_descricao'];
	$ss .= '<TD align="center">';
	$ss .= $line['uso_quan'];
	$ss .= '<TD>';
	$ss .= $line['pl_nr_lote'];
	$ss .= '<TD align="center">';
	$valid  = $line['pl_dt_validade'];
	$vali = nomemes_short(intval(substr($valid,4,2)));
	$vali .= '/'.substr($valid,0,4);
	$ss .= $vali;
	$ss .= '<TD>';
	$ss .= $line['pm_descricao'];
	$ss .= '<TD align="center">';
	$ss .= '<A HREF="contrato_processamento_verso.php?dd0='.$dd[0].'&dd10='.$line['id_uso'].'&dd11=DEL">';
	$ss .= '[del]';
	$ss .= '</A>';
	$ss .= '</TR>';
	}
?>
	<TABLE class="lt2" width="<?=$tab_max;?>" border=1 >
	<TR bgcolor="#c0c0c0">
	<TH>material</TH>
	<TH>quan</TH>
	<TH>lote</TH>
	<TH>validade</TH>
	<TH>marca</TH>
	<TH>ação</TH>
	</TR>
	<?=$ss;?>
	</TABLE>
<?
$cp = array();
$tabela = '';
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$A','','Contrato '.$dd[0],False,False,''));
if (strlen($dd[2]) > 0)
	{
	array_push($cp,array('$Q produto_descricao:produto_codigo:select * from produto where produto_codigo = '.chr(39).$dd[2].chr(39),'','Produto',True,False,''));
	array_push($cp,array('$Q pl_nr_lote:pl_codigo:select * from produto_lote where pl_ativo = 1 and pl_produto = '.chr(39).$dd[2].chr(39). ' and pl_ativo=1','','Lote',True,False,''));
	} else {
	array_push($cp,array('$Q produto_descricao:produto_codigo:select * from produto order by upper((produto_descricao))','','Produto',True,False,''));
	array_push($cp,array('$H8','','Lote',True,False,''));
	}
if ((strlen($dd[2]) > 0) and (strlen($dd[3]) > 0))
	{
	array_push($cp,array('$I8','','Quantidade',True,False,''));
	} else {
	array_push($cp,array('$H8','','Quantidade',True,False,''));
	}
	array_push($cp,array('$B8','','Avançar >>',True,False,''));
?>
<TABLE width="<?=$tab_max;?>">
<TR><TD>
<? $saved = editar(); ?>
</TABLE>
<TABLE width="<?=$tab_max;?>">
<TR><TD>
<?
if ((strlen($dd[3]) > 0) and (strlen($dd[4]) > 0))
	{
	$sql = "insert into produto_uso (";
	$sql .= "uso_lote,uso_data,uso_quan,";
	$sql .= "uso_saida,uso_contrato) values (";
	$sql .= "'".$dd[3]."',".date("Ymd").",".$dd[4].",";
	$sql .= "0,'".$dd[0]."');";
	$rlt = db_query($sql);
	
	redirecina("contrato_processamento_verso.php?dd0=".$dd[0]);
	echo "GRAVAR";
	} else {
	?>
	<form method="post" action="contrato_processamento_verso.php">
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<input type="submit" name="dx" value="selecionar novo material">
	</form>
	<?
	
	}
?>
</TD></TR></TABLE>
<?
require("foot.php");
?>	