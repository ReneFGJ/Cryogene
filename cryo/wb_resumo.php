<?
require("cab.php");
$sql = "select count(*) as total, 'I' as tipo from mailing where ml_ativo = 0 ";
$sql .= "union ";
$sql .= "select count(*) as total, 'E' as tipo from mailing where ml_ativo = 1 ";
$sql .= "union ";
$sql .= "select count(*) as total, 'V' as tipo from mailing where ml_ativo > 1 ";
$rlt = db_query($sql);
$s = '';
$tipos = array('I'=>"Inativos",'E'=>"Para enviar",'V'=>"Enviados");
while ($line = db_read($rlt))
	{
	$tipo = $line['tipo'];
	$s .= '<TR>';
	$s .= '<TD align="right">'.numberformat_br($line['total'],0);
	$s .= '<TD>'.$tipos[$tipo];
	$s .= '</TR>';
	}
	echo '<font class="lt5">Resumo do Mailing</font>';
	echo '<TABLE border="1" width="400">';
	echo $s;
	echo '</TABLE>';

	
	
require("foot.php");	?>