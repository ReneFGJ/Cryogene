<? require("cab.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<? require("include/sisdoc_colunas.php"); ?>
<? require("include/sisdoc_windows.php"); ?>
<FONT class="lt5">Cadastro de Representante Comerciais</FONT>
<TABLE border="1" align="center" cellpadding="0" cellspacing="0" width="<?=$tab_max?>" >
<TR><TD>
<?
if ($user_nivel >= 9)
	{	
	$tabela = "parceiros";
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99='.$tabela; 	
	$editar = true;
	}
	$http_redirect = 'ed_parceiros.php';
//	$http_ver = 'sistema.php';
	$tabela = "parceiros";
	$cdf = array('id_us','us_nome','us_email','us_fone_1','us_fone_2','us_fone_3');
	$cdm = array('Código','Nome','e-mail','fone','fone','fone');
	$masc = array('','','','','','');
	$busca = true;
	$offset = 20;
	$pre_where = "us_ativo = 1";
	$order  = "us_nome ";
	require('include/sisdoc_row.php');	
?>
</TD>
</TR>
</TD></TR></TABLE>
