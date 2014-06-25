<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');

$label = "Dados do contrato";
	echo '<TABLE width="'.$tab_max.'">';
	echo '<TR><TD>';
	echo '<font class=lt5 >'.$label.'</font>';
	echo '</TD></TR>';
	echo '</TABLE>';
	
	$sql = "select id_ctr, ctr_numero, ctr_dt_assinatura, cliente_mae.id_cl as id_mae,cliente_mae.cl_nome as mae,
			cliente_res.cl_nome as responsavel,cliente_res.id_cl as id_res,
			cliente_pai.id_cl as id_pai, ";
	$sql = $sql . " cliente_pai.cl_nome as pai from contrato ";
	$sql = $sql . " left join cliente as cliente_mae on ctr_mae=cliente_mae.cl_codigo ";
	$sql = $sql . " left join cliente as cliente_res on ctr_responsavel=cliente_res.cl_codigo ";
	$sql = $sql . " left join cliente as cliente_pai on ctr_pai=cliente_pai.cl_codigo ";
	$sql = $sql . " where id_ctr = ".$dd[0];
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$contrato = trim($line['ctr_numero']);
		$data = $line['ctr_dt_assinatura'];
		$contrato_ano = '/'.substr($data,2,2);
		$link1 = '<a href="cliente_ver.php?dd0='.$line['id_mae'].'">';
		$link2 = '<a href="cliente_ver.php?dd0='.$line['id_pai'].'">';
		$link3 = '<a href="cliente_ver.php?dd0='.$line['id_res'].'">';
		echo '<TABLE width="'.$tab_max.'" border="0" class=1t0 >';
		echo '<TR><TD colspan="10" align="right" class=lt2 >';
		echo '<B>Nº '.$contrato.$contrato_ano.'</B></TD></TR>';
		echo '<TR><TD align="right" class=1t1 >Nome da mãe ';
		echo '<TD colspan="10"><B>'.$link1.$line['mae'].'</B>';
		$link = '<a href="cliente_edit.php?dd0='.$line['id_mae'].'">';
		echo $link.'<img src="img/icone_editar.gif" width="20" height="19" alt="Alterar dados do cliente" border="0">';

		echo '<TR><TD align="right" class=1t1 >Nome do pai ';
		echo '<TD colspan="10"><B>'.$link2.trim($line['pai']).'</B>';
		$link = '<a href="cliente_edit.php?dd0='.$line['id_pai'].'">';
		echo $link.'<img src="img/icone_editar.gif" width="20" height="19" alt="Alterar dados do cliente" border="0">';

		echo '<TR><TD align="right" class=1t1 >Responsável ';
		echo '<TD colspan="10"><B>'.$link3.$line['responsavel'].'</B></TD>';

if (($user_nivel) >=1) 
		{
		$link2 = '<a href="contrato_edit.php?dd0='.$line['id_ctr'].'">';
		echo '<TR>';
		echo '<TD colspan="10" align="right">';
		echo $link2.'<img src="img/icone_editar.gif" width="20" height="19" alt="Alterar Contrato" border="0">';
		}

		echo '</TABLE>';
		}
require('contrato_ver_coleta.php');
require("_class/_class_fatura.php");
$fta = new fatura;

$contrato = $line['col_contrato'];
echo $fta->fatura($contrato);

require("foot.php");
?>	