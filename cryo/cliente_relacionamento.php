<?
require("cliente_cab.php");
require("include/sisdoc_data.php");
require("include/sisdoc_windows.php");
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');
$cliente_id = strzero($cliente_id,7);
?>
<TABLE cellpadding="0" cellpadding="0" border="0" width="<?=$tab_max?>" class=lt2 >
<TR align="center" valign="top">
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD width="120" bgcolor="#f0f0f0">
<? require("cliente_menu.php"); ?>
</TD>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD align="left">
Prezado(a), <B><?=trim($cliente_nome)?>,</B> voce pode entrar em contato para retirar dúvidas, segunda vias de documentos, solicitar informações que o mais breve possível retornaremos.
<BR><BR>
<?
//////////////////////////////////////////////////////////////////////////////
$tabela = "ic_contact";
$cp = array();
array_push($cp,array('$H8','id_r','id_r',False,True,''));
array_push($cp,array('$S80','r_nome','Seu nome',True,True,''));
array_push($cp,array('$S80','r_email','e-mail retorno',True,True,''));
array_push($cp,array('$Q rl_nome:id_rl:select * from ic_contact_local where rl_ativo=1 order by rl_nome','r_destino','Assunto:',True,True,''));
array_push($cp,array('$T50:6','r_texto','texto',True,True,''));
array_push($cp,array('$H8','r_status','s',False,True,''));
if (strlen($acao) == 0)
	{
	$sql = "select * from cliente where id_cl = ".$cliente_id;
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$dd[1] = $line['cl_nome'];
		$dd[2] = $line['cl_email'];
		}
	}
	$tab_max = "100%";
	$http_edit = 'cliente_relacionamento.php';
	$http_redirect = 'cliente_relacionamento_agradece.php';
	$dd[5] = 'A';
	?><TABLE width="95%" align="center"><TR><TD><?
	echo editar();
	?></TD></TR></TABLE>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
</TR>	
<?
require("foot.php");
?>