<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
$label = "Contratos de clientes";
if ($user_nivel > 0)
	{	
	$http_edit = 'contrato_edit.php'; 
	$editar = true;
	}
	$http_redirect = 'contrato.php';
	$http_ver = 'contrato_ver.php';
//	$http_ver = 'sistema.php';
	$tabela = "(select * from contrato ";
	$tabela .= "left join cliente on cl_codigo = ctr_responsavel ";
	$tabela .= "left join cidade on cl_cidade = c_codigo) as contrato";
	$cdf = array('id_ctr','cl_nome','ctr_numero','ctr_vencimento_dia','ctr_dt_assinatura','c_cidade','ctr_status');
	$cdm = array('Código','Nome','contrato','mes','dt.assinatura','cidade','status');
	$masc = array('','@','@','','D');
	$busca = true;
	$offset = 40;
	if (strlen(trim($dd[1])) == 0)
		{ $pre_where = " (ctr_status <> 'N')"; }

	$order = "upper((ctr_responsavel_nome))";
	require('include/sisdoc_row.php');	
	
require("foot.php");
?>	