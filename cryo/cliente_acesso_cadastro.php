<? ob_start(); ?>
<title>Cryogene - Armazenamento do Sangue de Cordão Umbilical</title>
<?
global $nocab;
require('db.php');
require('include/sisdoc_form.php');
require('include/cp2_gravar.php');
require('include/sisdoc_colunas.php');
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<?

if ((strlen($dd[1]) == 0) or (strlen($dd[2]) == 0))
	{
	?>
	<BR><BR>
	Para ter gerar um nova senha é necessário confirmar algumas informações, primeiramente o número de seu CPF.
	<BR><BR>	
	<TABLE class="lt1">
	<TR><TD>
	<form method="post" action="cliente_acesso_cadastro.php">
	<TR>
	<TD align="right">CPF:</TD>
	<TD><input type="text" name="dd1" value="<?=$dd[1];?>" size="20" maxlength="20"></TD>
	<TR>
	<TD align="right">Data nascimento:<BR><font class=lt0>(dd/mm/aaaa)</TD>
	<TD><input type="text" name="dd2" value="<?=$dd[2];?>" size="10" maxlength="10"></TD>
	</TR>
	<TR><TD align="center" colspan="2"><input type="submit" name="acao" value="avançar >>>"></TD></TR>
	<TR><TD></form>
	</TABLE><?
	exit;
	} else {
		$sql = "select * from cliente where sonumero(cl_cpf) = sonumero('".$dd[1]."')";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$pass = trim($line['cl_senha']);
			echo '<BR>Bem vindo, <B>'.$line['cl_nome'].'</B>';
			if (strlen($pass) > 0)
				{
				echo '<BR><BR><BR><BR>';
				echo 'Sua senha é <B>'.$pass.'</B>'; 
				} else {
					$id = $line['cl_cpf'];
					if (strlen($dd[3]) > 0)
						{
						if (($dd[3] == $dd[4]) and (strlen($dd[3]) > 3) and (strlen($id) > 0))
						{
						$sql = "update cliente set cl_senha = '".$dd[3]."' where cl_cpf = '".$id."'";
						$rlt = db_query($sql);
						echo '<BR><BR><BR>Senha registrada com sucesso !';
						echo '<BR><BR><a href="close.php">[fechar]</a>';
						setcookie('cl_log',$line['cl_codigo'],time()+3600);
						setcookie('cl_user',$line['id_cl'],time()+3600);
						setcookie('cl_user_nome',$line['cl_nome'],time()+3600);
						setcookie('cl_nivel',9,time()+3600);
						exit;
						} else {
						echo '<font color="red">senha digitada incorretamente ou menor que 4 caracteres</font>';
						}
						}
					?>
					<BR><BR><BR>
					Não existe senha cadastrada no sistema, por favor registre uma senha com pelo menos 4 caracteres.
					<TABLE class="lt1">
					<TR><TD>
					<form method="post" action="cliente_acesso_cadastro.php">
					<input type="hidden" name="dd1" value="<?=$dd[1];?>">
					<input type="hidden" name="dd2" value="<?=$dd[2];?>">
					<TR>
					<TD align="right">Entre com uma senha:</TD>
					<TD><input type="password" name="dd3" value="<?=$dd[3];?>" size="20" maxlength="20"></TD>
					<TR>
					<TD align="right">Digite novamente:</TD>
					<TD><input type="password" name="dd4" value="<?=$dd[4];?>" size="20" maxlength="20"></TD>
					<TR><TD align="center" colspan="2"><input type="submit" name="acao" value="avançar >>>"></TD></TR>
					<TR><TD></form>
					</TABLE>
					<?
				}
			}
	}

?>