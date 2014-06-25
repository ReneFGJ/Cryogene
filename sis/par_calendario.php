<?
$nucleo = 'parceiro';
$nucleo_cod = '00001';
if (strlen($dd[0]) == 0) { $dd[0] = date('Ym'); }
$data = $dd[0];
$dias = array();

$sql = "select * from ".$nucleo."_calendario ";
$sql .= " left join cep_calendario_tipo on ct_ev = cal_ev ";
$sql .= " where cal_data >= ".$data."00 and cal_data <= ".$data.'31';
$sql .= " and ct_representante = '".$user_id."' ";
$sql .= " order by cal_data,cal_hora ";

$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$dd_dia = intval(substr($line['cal_data'],6,2));
	array_push($dias,array($dd_dia,trim($line['cal_descricao']),trim($line['cal_hora']),trim($line['ct_cor']),$line['cal_data'],$line['id_cal']));
	}
echo calendario($data,$dias);
echo '<BR>';
echo agenda($data,$dias);
?>