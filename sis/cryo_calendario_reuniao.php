<?
require('cab.php');
require('include/sisdoc_data.php');
require('include/sisdoc_colunas.php');
$col_max = 410;
$nucleo = "cep";
$nucleo_cod = "00001";
?>
<TABLE width="<?=$tab_max?>" class=lt1 >
<TR class="lt5"><TD colspan="10">Calendário de Pauta do dia <?=$dd[0]?></TD></TR>
<?
//$sql = "update cep set cep_relator = cep_atual, cep_reuniao = '20071121' where cep_status = 'C' ";
//$rlt = db_query($sql);

$sql = "select * from ".$nucleo;
$sql .= ' left join usuario on '.$nucleo.'_relator = us_codigo ';
$sql .= " where ".$nucleo."_reuniao = ".brtos($dd[0]);
$sql .= ' order by '.$nucleo.'_protocol ';
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$link = '<A HREF="cep_detalhe.php?dd0='.$line['id_cep'].'" onmouseover="return true" target="new">';
	echo '<TR '.coluna().' valign="top">';
	echo '<TD width="5%">'.$link.$line[$nucleo.'_protocol'].'</TD>';
	echo '<TD><B>'.$link.$line[$nucleo.'_titulo'].'</B>';
	echo '<BR>Relator: '.$line['us_nome'].'</TD>';
	echo '<TD class="lt0"  width="1%">v.'.$line[$nucleo.'_versao'].'&nbsp;</TD>';
	echo '<TD class="lt0"  width="5%">'.stodbr($line[$nucleo.'_atualizado']).'</TD>';
	echo '</TR>';
	echo '<TR><TD colspan="10" height="1" bgcolor="#c0c0c0"></TD></TR>';
	}
	
?>
</TABLE>
<?
require('foot.php');
?>