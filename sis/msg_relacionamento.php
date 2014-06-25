<?
require('cab.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');
require('include/sisdoc_form2.php');
require('include/sisdoc_email.php');

if (strlen($acao) > 0)
	{
		$sql = "insert into ic_contact ";
		$sql .= "(r_status,r_email,r_nome,";
		$sql .= "r_destino,r_texto,r_data,";
		$sql .= "r_hora,rl_id) ";
		$sql .= " values ";
		$sql .= "('C','".$dd[3]."','".$user_nome."',";
		$sql .= "'RESPO','".$dd[1]."',".date("Ymd").",";
		$sql .= "'".date("H:i")."',".$dd[0];
		$sql .= ");";
		$rlt = db_query($sql);
		$sql = "update ic_contact set r_status='B' where id_r=".$dd[0];

		echo '<table width="700" align="center" class="lt2"><TR><TD>';
		//enviaremail($dd[3],$email_adm,'Atendimento ao cliente Cryogene',mst($dd[1]));
		echo 'enviado de '.$email_adm.' para '.$dd[3];
		$rlt = db_query($sql);

		redirect("main.php");
		echo '</TD></TR></TABLE>';
	} else {
	$tabela = "ic_contact";
	$sql = "select * from ".$tabela." ";
	$sql .= " left join ic_contact_local on r_destino = id_rl ";
	$sql .= " where id_r = ".$dd[0];
	$sql .= " order by r_data desc ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$s .=  '<TABLE class="lt1">';
		$s .= '<TR><TD>Data: '.stodbr($line['r_data']).' '.$line['r_hora'];
		$s .= '<TR><TD>';
		$s .= '<br>Nome: <B>'.$line['r_nome'];
		$s .= '<TR><TD>';
		$s .= '<br>e-mail: <B><A HREF="mailto:'.trim($line['r_email']).'">'.trim($line['r_email']).'</A>';
		$s .= '<TR><TD>';
		$s .= '<br>Secção: <B>'.$line['rl_nome'];
		$s .= '<TR><TD>';
		$s .= '<br>Descricao: <B>'.mst($line['r_texto']);
		$s .= '<TR><TD>Resposta:<BR><textarea cols="50" rows="10" name="dd1"></textarea></TD></TR>';
		$s .= '</TABLE>';
		}
	$s .= '</TABLE>';
	?>
	<TABLE border="0" width="<?=$tab_max?>">
	<TR valign="top">
	<TD width="*">
		<form method="post" action="msg_relacionamento.php">
			<?=$s; ?>
			<input type="submit" name="acao" value="responder >>>">
			<input type="hidden" name="dd0" value="<?=$dd[0];?>">
			<input type="hidden" name="dd2" value="<?=trim($line['r_nome']);?>">
			<input type="hidden" name="dd3" value="<?=trim($line['r_email']);?>">
		</form>
	</TABLE>
	<?
	}
require('foot.php');
?>