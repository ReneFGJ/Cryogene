<?php
$sql = "select * from contrato_message where rp_contrato = '$ctr_numero' order by id_rp desc";
$rlt = $this->db->query($sql);
$rlt = $rlt->result_array($rlt);
$email_list = '';
$email_body = '';
for ($r=0;$r < count($rlt);$r++)
	{
		$line = $rlt[$r];
		$email_list .= $line['rp_subject'].'<br>';
		$email_body .= $line['rp_texto'].'<br>';
	}
?>
<table border=1 width="100%" class="lt1">
	<tr><td width="250">lista e-mail</td>
		<td>texto</td>
	</tr>
	<tr valign="top">
		<td><?php echo $email_list;?></td>
		<td><?php echo $email_body;?></td>
	</tr>
</table>
