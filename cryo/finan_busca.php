<?

if (strlen($dd[1]) == 0) { $dd[1] = stodbr(DateAdd("m",-6,date("Ymd"))); }
if (strlen($dd[2]) == 0) { $dd[2] = stodbr(DateAdd("m",6,date("Ymd"))); }
if (strlen($dd[7]) == 0) { $dd[7] = '0.00'; }
if (strlen($dd[8]) == 0) { $dd[8] = '9999999.99'; }
$dd[0] = '';
$cp = array();
array_push($cp,array('$H8','','id',False,True,''));
array_push($cp,array('$d8','','Data inicial',False,True,''));
array_push($cp,array('$d9','','Data final',False,True,''));
array_push($cp,array('$S30','','Histótico / tipo',False,True,''));
array_push($cp,array('$S15','','Pedido',False,True,''));
array_push($cp,array('$S15','','Documento',False,True,''));
array_push($cp,array('$O Z:Abertos/Quitados&T:Todos&A:Abertos&B:Quitados','','<I>Status</I>',False,True,''));
array_push($cp,array('$N15','','Valor de',False,True,''));
array_push($cp,array('$N15','','Até',False,True,''));

echo editar();

?>

