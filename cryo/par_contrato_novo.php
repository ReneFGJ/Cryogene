<? require("par_cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_colunas.php"); ?>
<? require("include/sisdoc_form2.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<? require("par_cab_2.php"); ?>
<? require("par_security.php"); ?><CENTER>
<FONT class="lt5">Selecione o nome do médico para contrato</FONT>
<TABLE border="1" align="center" cellpadding="0" cellspacing="0" width="<?=$tab_max?>" >
<TR><TD>
<?
if (strlen($dd[0]) > 0)
	{
	redirect("par_contrato_novo_ed.php?dd0=".$dd[0].'&dd98=editar');
	}
security();
	{	
	$tabela = "medico";
	$http_ver = 'par_contrato_novo_ed.php'; 
	$http_ver_para = '&dd99='.$tabela; 	
	$editar = true;
	}
	$http_redirect = 'par_contrato_novo.php';
//	$http_ver = 'sistema.php';
	$tabela = "medico";
	$cdf = array('md_codigo','md_cr','md_nome','md_codigo','md_fone_ddd','md_fone_1');
	$cdm = array('Código','CRM','Descricao','Codigo','ativo');
	$masc = array('','','','','','');
	$busca = true;
	$offset = 20;
	$pre_where = "";
	$order  = "md_nome ";
	require('include/sisdoc_row.php');	
?>
</TD>
</TR>
</TD></TR></TABLE>
