<?
function cliente_log($ltexto,$lcod)
	{
	global $nr_contrato,$cliente_id;
	$lsql = "insert into log_cliente ";
	$lsql .= '(log_data,log_hora,log_ip,';
	$lsql .= 'log_dd1,log_cliente,log_contrato, ';
	$lsql .= 'log_tipo )';
	$lsql .= ' values ';
	$lsql .= "(".date("Ymd").",'".date("H:i")."','".$_SERVER['REMOTE_ADDR']."',";
	$lsql .= "'".$ltexto."','".strzero($cliente_id,7)."','".$nr_contrato."',";
	$lsql .= "'".$lcod."')";
	$xrql = db_query($lsql);
	}
?>