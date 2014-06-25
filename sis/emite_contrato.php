<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");

$tabela = "proposta_contrato";
$idcp = "ppc";
$label = "Propostas de contrato";
$http_edit = 'ed_edit.php'; 
$http_ver = 'proposta.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'emite_contrato.php';
	$cdf = array('id_ppc','ppc_nome','ppc_codigo','ppc_cidade','ppc_modelo','ppc_data','ppc_hora','ppc_status');
	$cdm = array('Código','Nome','proposta','Cidade','modelo','data','hora','status');
	$masc = array('','@','@','@','','D','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
//$order  = $idcp."_pos,sub_ordem";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>