<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");

if (strlen($dd[0]) == 0)
	{ redirecina("iso.php"); }
?>
<TABLE width="<?=$tab_max;?>" border="0">
<TR valign="top">
<TD>
<?
$sql = "select * from iso_tipo_documento where iso_tdoc_codigo_desc='".$dd[0]."'";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$tit = $line['iso_tdoc_descricao'];
	$cod = $line['iso_tdoc_cod'];
	}
?>
<font class="lt5"><?=$tit;?></font><BR>
<?
/////////////////////////// Documentos
$sql = "select * from iso_documento where iso_doc_tipo='".$cod."' and iso_doc_ativo=1";
$sql .= " order by iso_doc_nrdoc ";
$rlt = db_query($sql);
$s = '';
while ($line = db_read($rlt))
	{
	$codx = trim($line['iso_doc_codigo']);
	$chave = md5($codx.date("YmdH").'1234');
	$link = '<A href="#" onclick="newxy('.chr(39).'iso_download.php?dd1='.$dd[0].'&dd0='.$line['iso_doc_codigo'].'&dd2='.$chave.chr(39).',300,200);" title="documentos da qualidade">';
	$linkd = '<A href="iso_tp.php?dd0='.$dd[0].'&dd1='.$line['iso_doc_codigo'].'" title="vinculos">';
	$s .= '<TR '.coluna().' valign="top">';
	$s .= '<TD align="left" class="lt1"><B><NOBR>';
	$s .= trim($line['iso_doc_nrdoc']);
	$s .= '<TD>';
	$s .= '<fieldset>';
	$s .= $link;
	$s .= trim($line['iso_doc_descricao']);
	$s .= '</A>';
	$s .= '</fieldset>';
	if (trim($dd[1])==$codx)
		{
		$s .= '<TABLE width="100%" cellpadding="0" cellspacing="0" class="lt1">';
		$xsql = "select * from iso_doc_rq ";
		$xsql .= "inner join iso_documento on iso_doc_codigo = drq_codigo_rq ";
		$xsql .= "where drq_codigo_doc = '".$dd[1]."' ";
		$xsql .= "and iso_doc_ativo=1 ";
		$xrlt = db_query($xsql);

		while ($xline = db_read($xrlt))
			{
			$codx = trim($xline['iso_doc_codigo']);
			$chave = md5($codx.date("YmdH").'1234');			
			$linkr = '<A href="#" onclick="newxy('.chr(39).'iso_download.php?dd1='.$xline['id_iso_doc'].'&dd0='.$xline['iso_doc_codigo'].'&dd2='.$chave.chr(39).',300,200);" title="documentos da qualidade">';
			$s .= '<TR><TD width="10%">&nbsp;</TD>';
			$s .= '<TD>';
			$s .= $linkr;			
			$s .= trim($xline['iso_doc_nrdoc']);
			$s .= '<TD>';
			$s .= $linkr;
			$s .= trim($xline['iso_doc_descricao']);
			$s .= '<TD align="center">';
			$s .= trim($xline['iso_doc_versao']);
			$s .= '</TR>';
			$s .= '<TR bgcolor="#c0c0c0"><TD colspan="4" height="1">';
			$s .= '<img src="img/nada_white.gif" width="1" height="1" alt="" border="0">';
			$s .= '</TD></TR>';
			}
		$s .= '</TABLE>';
		}
	
	$s .= '<TD>';
	$s .= '<fieldset>';
	$s .= '&nbsp;'.$linkd;
	$s .= '+</A>';
	$s .= '&nbsp;';
	$s .= '</fieldset>';
	$s .= '<TD align="center" class="lt1">';
	$s .= trim($line['iso_doc_versao']);
	}
?>
<TABLE width="100%" class="lt3">
<TR bgcolor="#c0c0c0" class="lt1" align="center">
<TH width="20%"><B>doc.nº.</TH>
<TH width="70%"><B>descrição</TH>
<TH width="2%"><B></TH>
<TH width="7%"><B>rev.</TH>
</TR>
<?=$s;?>
</TABLE>
</TD>
<TD width="30"><? require("iso_piramide_mini.php");?></TD>
</TR>
</TABLE>
<? require("foot.php");	?>
