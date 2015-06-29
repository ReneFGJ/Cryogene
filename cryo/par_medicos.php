<? require("par_cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_colunas.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<? require("par_cab_2.php"); ?>
<? require("par_security.php"); ?><CENTER>
<FONT class="lt5">Cadastro de Médicos</FONT>
<TABLE border="1" align="center" cellpadding="0" cellspacing="0" width="<?=$tab_max?>" >
<TR><TD>
<?
security();
	{	
	$tabela = "(medico left join cidade on c_codigo = md_cidade ) as medico " ;
	$http_edit = 'par_edit.php'; 
	$http_edit_para = '&dd99=medico'; 	
	$editar = true;
	}
	$http_redirect = 'par_medicos.php';
//	$http_ver = 'sistema.php';
	$cdf = array('id_md','md_nome','md_cr','c_cidade','md_codigo','md_fone_ddd','md_fone_1');
	$cdm = array('Código','Nome do médico','CRM','Cidade','Codigo','ativo');
	$masc = array('','','','','','');
	$busca = true;
	$offset = 20;
	$pre_where = " md_ativo=1 ";
	$order  = "md_nome ";
	require('include/sisdoc_row.php');	
?>
</TD>
</TR>
</TD></TR></TABLE>
<? require("foot.php"); ?>
