<?
$nucleo = 'cep';
$nucleo_cod = '00001';
if (strlen($dd[0]) == 0) { $dd[0] = date('Ym'); }
$data = $dd[0];
$dias = array();

$sql = "select * from ".$nucleo."_calendario ";
$sql .= " inner join ".$nucleo."_calendario_tipo on ct_ev = cal_ev ";
$sql .= " where (cal_data >= ".$data."00 and cal_data <= ".$data.'31)';
$sql .= " and cal_status <> 'X' ";
$sql .= " order by cal_data,cal_hora, id_cal ";

$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	if ($line['cal_data'] == 19000101)
		{
		echo '<BR>>>>'.$line['id_cal'].'=='.$line['cal_data'].'='.$line['cal_descricao'].'='.$line['cal_status'];
		echo '<HR>';
		}
	$dd_dia = intval(substr($line['cal_data'],6,2));
//	echo '-'.$dd_dia;
	array_push($dias,array($dd_dia,trim($line['cal_descricao']),trim($line['cal_hora']),trim($line['ct_cor']),$line['cal_data'],$line['id_cal']));
	}
echo calendario($data,$dias);
echo '<BR>';
echo agenda($data,$dias);
?>