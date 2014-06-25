<?
$lk = array();
array_push($lk,array('principal','cliente_main.php'));
array_push($lk,array('fatura','cliente_fatura.php'));
array_push($lk,array('contrato','cliente_main.php'));
array_push($lk,array('alterar senha','cliente_senha.php'));
array_push($lk,array('dados cadastrais','cliente_main.php'));
array_push($lk,array('contato','cliente_relacionamento.php?dd3=5'));
array_push($lk,array('dúvidas','cliente_relacionamento.php?dd3=4'));
array_push($lk,array('&nbsp;',''));
array_push($lk,array('<B>agendar coleta</B>','cliente_main.php'));
array_push($lk,array('&nbsp;',''));
array_push($lk,array('sair','cliente_main.php'));

?>
<TABLE width="120" cellpadding="0" cellspacing="2" class="lt1">
<TR><TD bgcolor="#c0c0c0" align="center" class="lt0"><B>.: menu principal :.</B></TD></TR>
<?
for ($k = 0; $k < count($lk);$k++)
	{
	$link = '<A HREF="'.$lk[$k][1].'" onmouseover="return true" class="lt1">';
	echo '<TR '.coluna().'><TD align="left">';
	echo '&nbsp;'.$link.$lk[$k][0].'</A>';
	echo '</TD></TR>';	
	echo '<TR><TD height="1" bgcolor="#c0c0c0"></TD></TR>';
	}
?>
</TABLE>