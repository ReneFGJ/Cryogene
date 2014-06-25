<?php
$login = 1;
require("cab.php");
echo $nw->login_form();

$nw->field_login = 'us_login';
$nw->field_pass = 'us_senha';
$nw->field_name = 'us_nome';
$nw->field_id = 'id_us';
$nw->field_nivel = 'us_nivel';
$nw->field_perfil = '';
$nw->tabela = "usuario";
$nw->cryp = 0;

if (strlen($acao) > 0)
	{
		$nw->valida_session($dd[90]);
		$er = $nw->valida_login($dd[1],$dd[2]);
		if ($er <> 1)
			{
				echo '<font color="red">';
				echo $nw->show_login_error($er);
				echo '</font>'.chr(13).chr(10);
			} else {
				redirecina('main.php');
			}
	}

?>
