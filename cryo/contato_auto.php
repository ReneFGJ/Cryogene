<?
require("db.php");
$e1 = $dd[0];
$e2 = $dd[1];
$e3 = $dd[2];
$e4 = $dd[3];

$sql = "insert into ic_contact ";
$sql .= "(r_status,r_email,r_nome, r_destino, ";
$sql .= 'r_texto,r_data,r_hora,rl_id ';
$sql .= ') values (';
$sql .= "'A','".$e1."','".$e2."','".substr($e3,0,5)."',";
$sql .= "'".$e4."',".date("Ymd").",'".date("H:i")."',9 ";
$sql .= ")";

$rlt = db_query($sql);
echo "recebimento confirmado";
?>