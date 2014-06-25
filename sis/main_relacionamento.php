<?
$tabela = "ic_contact";
$sql = "select * from ".$tabela." ";
$sql .= "left join ic_contact_local on r_destino = id_rl ";
$sql .= " where r_status = 'A' ";
$sql .= " order by r_data desc ";
$rlt = db_query($sql);
$sr = '<TABLE class="lt0" width="100%">';
while ($line = db_read($rlt))
	{
	$link = '<A HREF="msg_relacionamento.php?dd0='.$line['id_r'].'">';
	$sr .= '<TR><TD>'.$link.$line['r_nome'];
	$sr .=  '<TD>'.$line['r_email'];
	$sr .=  '<TD>'.$line['r_destino'];
	$sr .=  '<TD>'.substr(stodbr($line['r_data']),0,5);
	}
$sr .= '</TABLE>';	
echo $sr;
?>
<iframe src="relacionamento_importar.php" width="100" height="30" marginheight="0" marginwidth="0">
</iframe>