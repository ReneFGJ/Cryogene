<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

	$cp = array();
	array_push($cp,array('$I8','id_ft','Informe o número da fatura:',True,True,''));
	array_push($cp,array('$A8','','Faturas - Status',False,True,''));	
	if (strlen($dd[0]) > 0)
		{
			array_push($cp,array('$O 1:Aberto&2:Quitado&-1:Cancelado','ft_status','Posição',True,True,''));	
		} else {
			array_push($cp,array('$h8','','',True,True,''));
		}

	echo '<table width="'.$tab_max.'". class="lt1" >';
	echo '<TR><TD>';
	editar();
	echo '</table>';
	if ((strlen($dd[0]) > 0) and (strlen($dd[2]) > 0))
	{
		$sql = "update fatura set ft_status = ".$dd[2];
		$sql .= " where id_ft = ".$dd[0];
		$rlt = db_query($sql);
	}

	if (strlen($dd[0]) > 0)
	{
		$sql = "select * from fatura ";
		$sql .= " where id_ft = ".$dd[0];
		$sql .= " limit 1";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		?>
		<table width="<?=$tab_max;?>" class="lt1">
			<TR><TD><?=$line['ft_contrato'];?></TD></TR>
			<TR><TD><?=$line['ft_data_vencimento'];?></TD></TR>
			<TR><TD><?=stodbr($line['ft_data_documento']);?></TD></TR>
			<TR><TD><?=stodbr($line['ft_data_processamento']);?></TD></TR>
			<TR><TD><?=numberformat_br($line['ft_valor_boleto'],2);?></TD></TR>
			<TR><TD><?=$line['ft_sacado'];?></TD></TR>
			<TR><TD><?=$line['ft_endereco1'];?></TD></TR>
			<TR><TD><?=$line['ft_endereco2'];?></TD></TR>
			<TR><TD><?=$line['ft_obs'];?></TD></TR>
			<TR><TD><?=$line['ft_status'];?></TD></TR>
		</table>
		<?
	}

require("foot.php");	
?>