<? 
require("extranet_cab.php"); 
require("security.php"); 

$sql = "update cryo_user set cryo_codigo = lpad(id_user,7,0) where cryo_codigo = ''";
$rlt = db_query($sql);

?>