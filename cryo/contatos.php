<?
require('cab.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_colunas.php');

$tabela = "ic_contact";
$sql = "select * from ".$tabela." ";
$sql .= "left join ic_contact_local on r_destino = id_rl ";
//$sql .= " where r_status = 'A' ";
$sql .= " where r_data > 20010101 ";
$sql .= " order by r_data desc ";
$rlt = db_query($sql);
$sr = '<TABLE class="lt0" width="'.$tab_max.'" align="center">';
while ($line = db_read($rlt))
	{
	$link = '<A HREF="msg_relacionamento.php?dd0='.$line['id_r'].'">';
	$sr .= '<TR '.coluna().'></TR><TD>'.$link.$line['r_nome'];
	$sr .=  '<TD>'.$line['r_email'];
	$sr .=  '<TD>'.$line['r_destino'];
	$sr .=  '<TD>'.substr(stodbr($line['r_data']),0,5);
	}
$sr .= '</TABLE>';	
echo $sr;
require("foot.php");
?>
