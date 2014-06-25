<?
require("cliente_cab.php");
require("include/cp2_gravar.php");
require("include/sisdoc_form2.php");
require("cliente_log.php");

$tabela = "cr_boleto";
$cp = array();
array_push($cp,array('$H8','id_bol','id_bol',False,True,''));
array_push($cp,array('$P15','','Senha antiga',False,True,''));
array_push($cp,array('$P15','','Nova senha',False,True,''));
array_push($cp,array('$P15','','Nova senha (redigitar)',False,True,''));
array_push($cp,array('$B8','','gravar',False,True,''));
$label = "alterar senha";
$http_edit = 'cliente_senha.php';
$alterado = false;
if (strlen($acao) > 0)
	{
	$ok = 0;
	$dd[1] = strtolower($dd[1]);
	$dd[2] = strtolower($dd[2]);
	$dd[3] = strtolower($dd[3]);
	if (strlen($dd[1]) > 0) { $ok++; }
	if (strlen($dd[2]) >= 4) { $ok++; } else { $msg = "senha muito curta"; }
	if (strlen($dd[3]) >= 4) { $ok++; } 
	if ($dd[2] == $dd[3]) { $ok++; } else { $msg = "reentrada de senha não confere"; }
	if (strlen($cliente_id) > 0) { $ok++; }
	if ($ok == 5)
		{
		$sql = "select * from cliente where id_cl = ".$cliente_id;
		$rlt = db_query($sql);		
		if ($line = db_read($rlt))
			{
			$pass = strtolower(trim($line['cl_senha']));
			if ($pass == $dd[1])
				{
				cliente_log('Senha alterada de "'.$dd[1].'" para "'.$dd[2].'"','SNH');
				$sql = "update cliente set cl_senha = '".$dd[2]."' where id_cl = ".$cliente_id;
				$rlt = db_query($sql);		
				$alterado = true;
				} else { $msg = "senha atual não confere"; }
			}
		}
	}
?>
<TABLE cellpadding="0" cellpadding="0" border="0" width="<?=$tab_max?>" class=lt2 >
<TR align="center" valign="top">
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD width="120" bgcolor="#f0f0f0">
<? require("cliente_menu.php"); ?>
</TD>
<TD background="img/bar_point_vertical.gif" width="1"></TD>
<TD align="left">
<BR><BR>
<?
if ($alterado == false)
	{ ?>
	<TABLE cellpadding="0" cellpadding="0" border="0" width="85%" class=lt2 align="center" >
	<TR><TD><P>
	<B><?=trim($cliente_nome)?></B> para realizar a alteração de senha voce precisa digitar sua senha antiga e escolher uma senha de pelo menos 5 (cinco) caracteres.</B>
	<BR><BR>
	</TD></TR>
	<TR><TD>
		<TABLE cellpadding="0" cellpadding="0" border="0" width="100%" class=lt2 >
		<TR><TD colspan="10"><font class=lt5 ><?=$label?></font></TD></TR>
		<TR><TD width="1%" colspan="10"><form method="post" action="<?=$http_edit;?>"></TD>
		</TABLE>
		<? $tab_max = "100%"; ?>
		<?=gets_fld();?>
	<TR><TD></form></TD></TR>	
	</TD></TR>
	<TR><TD colspan="10" align="center"><font color=red><?=$msg?></font></TD></TR>
	</TABLE>
	<BR><BR><BR><BR><BR><BR><BR>
	<? } else { ?>
	<font class="lt3">
	<font color=green><CENTER>Senha alterado com sucesso !</CENTER></font>
	<?
	}
	echo '</TABLE>';
require("foot.php");
?>