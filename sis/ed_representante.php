<? require("par_cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_colunas.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<? require("par_cab_2.php"); ?>
<? require("par_security.php"); ?><CENTER>
<FONT class="lt5">Cadastro de Representante</FONT>
<TABLE border="1" align="center" cellpadding="0" cellspacing="0" width="<?=$tab_max?>" >
<TR><TD>
<?
security();
	{	
	$tabela = "representante";
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99='.$tabela; 	
	$editar = true;
	}
	$http_redirect = 'ed_representante.php';
//	$http_ver = 'sistema.php';
	$tabela = "representante";
	$cdf = array('id_rp','rp_cr','rp_nome','rp_codigo','rp_fone_ddd','rp_fone_1');
	$cdm = array('Código','CRM','Descricao','Codigo','ativo');
	$masc = array('','','','','','');
	$busca = true;
	$offset = 20;
	$pre_where = "";
	$order  = "rp_nome ";
	require('include/sisdoc_row.php');	
?>
</TD>
</TR>
</TD></TR></TABLE>
