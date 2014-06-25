<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_windows.php");


$tabela = "iso_documento";
if (strlen($dd[0]) ==0)
	{
	redirecina("ed_iso_documento.php");
	}

///////////// EXCLUIR
if ((strlen($acao) > 0) and (strlen($dd[50]) > 0))
	{
		$sql = "update iso_doc_rq set drq_ativo=0 where id_drq = ".$dd[50];
		$rlt = db_query($sql);
	}

////////////////////// ADICIONAR	
if ((strlen($acao) > 0) and (strlen($dd[1]) > 0))
	{
	$sql = "select * from iso_documento where iso_doc_nrdoc = '".$dd[1]."' ";
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$cod_line = $line['iso_doc_codigo'];
		$sql = "insert into iso_doc_rq ";
		$sql .= "(drq_codigo_doc,drq_codigo_rq,drq_update,";
		$sql .= "drq_ativo,drq_log) ";
		$sql .= " values ";
		$sql .= "('".$dd[0]."','".$cod_line."',".date("Ymd").',';
		$sql .= "1,0".$user_id.");";
		$rlt = db_query($sql);
		}
	}
echo '<TABLE width="'.$tab_max.'" align="center" class="lt1"><TR valign="top"><TD>';
$sql = "select * from iso_documento where iso_doc_codigo = '".$dd[0]."'";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$iso_titulo = $line["iso_doc_descricao"];
	$iso_revisao = $line["iso_doc_versao"];
	
	echo '<font class="lt3">'.$iso_titulo.'</font>';
	echo '<BR>Revisão:'.$iso_revisao;


//////////////////////////////////////// ARQUIVOS	
	echo '<HR>';
	require("ed_iso_documento_files.php");
	echo '<HR>';


	////////////////////// UPLOAD
	$chksun = md5($dd[0].$dd[1].'448545');
	
	
	?>
	<BR><BR>
	<a href="#" onclick="newxy('ed_iso_documento_upload.php?dd0=<?=$dd[0];?>&dd1=<?=$dd[1];?>&dd2=<?=$chksun;?>',400,300);">Anexar Documento</a>
	<BR><BR>
	<a href="ed_iso_documento.php">VOLTAR</a>
	<TD width="250">
	<form action="ed_iso_documento_detalhe.php" method="post">
	Número do documento:<BR>
	<input type="text" name="dd1" size="20" maxlength="20">
	<input type="hidden" name="dd0" value="<?=$dd[0];?>">
	<BR><input type="submit" name="acao" value="anexar >>>">
	</form>
	<?
	$sql = "select * from iso_doc_rq ";
	$sql .= " inner join iso_documento on iso_doc_codigo = drq_codigo_rq ";
	$sql .= "where drq_codigo_doc = '".$dd[0]."'";
	$sql .= "and drq_ativo = 1 ";
	$rlt = db_query($sql);
	
	$s = '';
	while ($line = db_read($rlt))
		{
		$s .= '<TR>';
		$s .= '<TD>';
		$s .= $line['iso_doc_nrdoc'];
		$s .= '<TD>';
		$s .= $line['iso_doc_descricao'];
		$s .= '<TD>';
		$s .= $line['iso_doc_versao'];
		$s .= '<TD>';
		$link = '<A HREF="ed_iso_documento_detalhe.php?dd0='.$dd[0].'&dd50='.$line['id_drq'].'&acao=excluir">';
		$s .= $link . 'excluir</a>';
		}
	if (strlen($s) > 0)
		{
		echo '<TABLE width="300" class="lt1">';
		echo '<TR align="center" bgcolor="#c0c0c0">';
		echo '<TH>doc.no.</TH>';
		echo '<TH>título</TH>';
		echo '<TH>revisão</TH>';
		echo $s;
		echo '</TABLE>';
		}
	?>
	</TD>
	<?
	}

echo '</table>';
?>