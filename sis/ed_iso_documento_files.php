<?
if ((trim($dd[10]) == 'DEL') and (strlen($dd[1]) > 0))
	{
	$sql = "update iso_files set pl_codigo = 'X".substr($dd[0],1,7)."' where id_pl = ".$dd[1];
	$rlt = db_query($sql);
	}

$sql = "select * from iso_files where pl_codigo='".$dd[0]."' ";
$sql .= "order by id_pl desc ";
$rlt = db_query($sql);
$s = '';
while ($line = db_read($rlt))
	{
	$dlink = '<A HREF="ed_iso_documento_detalhe.php?dd0='.$dd[0].'&dd1='.$line['id_pl'].'&dd10=DEL">';
	$chave = md5($dd[0].date("YmdH").'1234');
	$link = '<A HREF="#" onclick="newxy('.chr(39).'iso_download.php?dd0='.$dd[0].'&dd1='.$chave.'&dd99=upload'.chr(39).',60,20)">';
	$s .= '<TR '.coluna().'>';
	$s .= '<TD>'.$link.$line['pl_texto'];
	$s .= '<TD align="center">'.strzero($line['pl_versao'],2);
	$s .= '<TD align="right">'.stodbr($line['pl_data']);
	if ($user_nivel >= 9)
		{
		$s .= '<TD align="center">';
		$s .= $dlink;
		$s .= '[DEL]';
		$s .= '</TD>';
		}
	$s .= '</TR>';
	}
	
if (strlen($s) > 0)
	{
	echo '<TABLE class="lt1" width="100%">';
	echo '<TR bgcolor="#c0c0c0">';
	echo '<TH>Arquivos</TH>';
	echo '<TH>rev.</TH>';
	echo '<TH width="15%">postado</TH>';
	if ($user_nivel >= 9)
		{
		echo '<TH width="15%">acao</TH>';
		}
	echo $s;
	echo '</TABLE>';
	}
?>