<? 
require("extranet_cab.php"); 
require("security.php"); 

require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Usuários cadastrados";
	{	
	$http_edit = 'cryo_usuario_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'cryo_usuario.php';
	$tabela = "cryo_user";
	$cdf = array('id_user','user_nome','user_login','user_update');
	$cdm = array('Código','nome','login','acesso');
	$masc = array('','','','D');
	$busca = true;
	$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
	$order  = "user_nome ";
	require('include/sisdoc_row.php');	
	
require("foot.php");	
?>