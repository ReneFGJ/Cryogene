<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');
global $saved;
//$debug = true;
$label = "Cadastro de Produtos (entrada)";
if (strlen($dd[0]) ==0)
	{ redirecina("produto.php"); }

$sql = "select * from produto where id_produto = ".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$cod = $line['produto_codigo'];
	$des = $line['produto_descricao'];
	
	$tabela = "";
	$cp = array();
	array_push($cp,array('$H8','id_pl','id_pl',False,True,''));
	array_push($cp,array('$Q produto_descricao:produto_codigo:select * from produto where produto_codigo = '.chr(39).$cod.chr(39),'','Descricao',True,True,''));	
	array_push($cp,array('$Q pm_descricao:pm_codigo:select * from produto_marca order by pm_descricao','','Marca',True,True,''));	
	array_push($cp,array('$S20','','nº lote',True,True,''));
	array_push($cp,array('$N8','','Entrada',True,True,''));
	array_push($cp,array('$D8','','Validade',True,True,''));
	array_push($cp,array('$S10','','DOC/NF',True,True,''));
	?>
	<TABLE width="<?=$tab_max;?>">
	<TR><TD class="lt5"><?=$des;?></TD>
	<? editar(); ?>
	</TABLE>
	<?	
	if ($saved)
		{
		$isql = "select * from produto_lote where ";
		$isql .= "pl_marca = '".$dd[2]."' and pl_produto = '".$cod."' and pl_nr_lote = '".$dd[3]."' ";
		$rlt = db_query($isql);
		if ($line = db_read($rlt))
			{
			$lote = $line['pl_codigo'];
			}
			
		if (strlen($lote) ==0)
			{		
			$sql = "insert into produto_lote (";
			$sql .= "pl_codigo,pl_produto,pl_nr_lote,";
			$sql .= "pl_dt_entrada,pl_dt_validade,pl_marca,";
			$sql .= "pl_entrada,pl_saida,pl_ativo,pl_doc) values (";
			$sql .= "'','".$cod."','".$dd[3]."',";
			$sql .= date("Ymd").','.brtos($dd[5]).",'".$dd[2]."',";
			$sql .= "0".$dd[4].",0,1,'".$dd[6]."') ";
			$rlt = db_query($sql);

			$sql = "update produto_lote set pl_codigo=lpad(id_pl,7,'0') where (length(trim(pl_codigo)) < 7);";
			$rlt = db_query($sql);
			$rlt = db_query($isql);
			if ($line = db_read($rlt))
				{
				$lote = $line['pl_codigo'];
				}
	
			$sql = "insert into produto_log (";
			$sql .= "log_produto,log_lote,log_data,";
			$sql .= "log_hora,log_entrada,log_saida,";
			$sql .= "log_tipo,log_doc ) values (";
			$sql .= "'".$cod."','".$lote."',".date("Ymd").',';
			$sql .= "'".date("H:m")."',0".$dd[4].',0,';
			$sql .= "'E','".$dd[6]."');";
			$rlt = db_query($sql);
			} else {
				echo '<font color="red">Lote já cadastrado</font>';
			}
		}
		
	$sql = "select * from produto_lote ";
	$sql .= "inner join produto_marca on pl_marca = pm_codigo ";
	$sql .= "where pl_produto = '".$cod."' ";
	$rlt = db_query($sql);
	$s = '';
	while ($line = db_read($rlt))
		{
		$idpl = $line['id_pl'];
		if ($line['pl_ativo'] == 1)
			{
			$linka = '<A HREF="produto_lote_ativar.php?dd0='.$dd[0].'&dd1=0&dd2='.$idpl.'">desativar</A>';
			$cor = '<font color="#804040">';
			} else {
			$linka = '<A HREF="produto_lote_ativar.php?dd0='.$dd[0].'&dd1=1&dd2='.$idpl.'">ativar</A>';
			$cor = '<font color="#c0c0c0">';
			}
		
		$s .= '<TR '.coluna().'>';
		$s .= '<TD>'.$cor.$des;
		$s .= '<TD>'.$cor.$line['pm_descricao'];
		$s .= '<TD align="center">'.$cor.$line['pl_nr_lote'];
		$s .= '<TD align="center">'.$cor.stodbr($line['pl_dt_validade']);
		$s .= '<TD align="center">'.$cor.dsp_sn($line['pl_ativo']);
		$s .= '<TD align="center">'.$linka;
		$s .= '</TR>';
		}
	?>
	<TABLE class="lt2" width="<?=$tab_max;?>" border=1 >
	<TR bgcolor="#c0c0c0">
	<TH>material</TH>
	<TH>marca</TH>
	<TH>lote</TH>
	<TH>validade</TH>
	<TH>ativo</TH>
	<TH>acao</TH>
	</TR>
	<?=$s;?>
	</TABLE>
	<?
	}	
	?>
	<CENTER>
	<form method="post" action="produto.php">
	<input type="submit" name="botao" value="voltar aos produtos">
	</form>
	<?
require("foot.php");	
?>