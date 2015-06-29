<? require("par_cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_colunas.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<? require("par_cab_2.php"); ?>
<? require("par_security.php"); ?><CENTER>
<FONT class="lt5">Contratos com médicos</FONT>
<TABLE border="1" align="center" cellpadding="0" cellspacing="0" width="<?=$tab_max?>" >
<TR><TD>
<?
security();
	{	
	$tabela = "(contrato_medico left join medico on md_codigo = col_medico) as contrato_medico";
	$etabela = "contrato_medico";

	$http_edit = 'par_contrato_novo.php'; 
	$editar = true;
	}
	$http_redirect = 'par_contrato.php';
//	$http_ver = 'sistema.php';
	$cdf = array('id_ctm','col_contrato','md_nome','md_cr','col_dt_ass','col_ativo','col_ano','col_parceiro');
	$cdm = array('Código','Nº contrato','Médico','CRM','Dt.assinatura'  ,'ativo',    'ano','parceiro');
	$masc = array('','','','','D','SN');
	$busca = true;
	$offset = 20;
	$pre_where = "";
	$order  = "col_contrato desc ";
	require('include/sisdoc_row.php');	
?>
</TD>
</TR>
</TD></TR></TABLE>
