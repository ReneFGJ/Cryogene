<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');

$label = "Acompanhamento de Pagamentos";
echo '<font class="lt5"><center>'.$label.'</center></font>';
if (strlen($dd[1]) == 0)
	{
	$cp = array();
	array_push($cp,array('$A8','','Boletos no período',False,True,''));	
	array_push($cp,array('$D8','','De:',True,True,''));
	array_push($cp,array('$D8','','Até:',True,True,''));
	array_push($cp,array('$O A:Abertos&B:Quitados&X:Cancelados&C:Abertos e Quitados','','Tipo:',True,True,''));
	
	echo '<table width="'.$tab_max.'". class="lt1" >';
	echo '<TR><TD>';
	editar();
	echo '</table>';
	} else {
		$tabela = "cr_boleto";	
		$sql = "select * from ".$tabela." ";	 
		$sql .= " left join contrato on bol_contrato = ctr_numero ";
		$sql .= " where bol_data_vencimento >= ".brtos($dd[1])." and bol_data_vencimento <= ".brtos($dd[2]); 
		if ($dd[3] != 'C')
			{ 
			$sql .= " and bol_status = '".$dd[3]."' ";
			} else {
			$sql .= " and (bol_status <> 'X' ) ";
			}
		$sql .= " order by bol_data_vencimento  "; 
		$rlt = db_query($sql);
		 $tot1 = 0;
		 $tot2 = 0;
		while ($line = db_read($rlt))
			{		
			$tot1 = $tot1 + $line['bol_valor_boleto'];
			$tot2++;				 
			$pago= $line['bol_data_pago'];
			$tipo= $line['bol_tipo'];
			$bol = $line['bol_nosso_numero'];
			$doc = $line['bol_numero_documento'];
			$sac = $line['bol_sacado'];
			$lid = $line['bol_lido'];
			$lia = $line['bol_lido_data'];
			$auto= $line['bol_auto'];
			$valor = $line['bol_valor_boleto'];
			$taxa = $line['bol_tx_boleto'];
			$venc = $line['bol_data_vencimento'];	 
			$status=$line['bol_status'];
			$idc = $line['id_ctr'];
			$xcor = '';			
			if ($status=='A')
				{
					if ($venc < date("Ymd"))
						{
							$xcor = '<font color="red">';							
						} else {
							$xcor = '<font color="green">';							
						}
				} else {
					 $xcor = '<font color="blue">';	
				}
			$link = '<A HREF="contrato_ver.php?dd0='.$idc.'" target="_new'.date("Ims").'">';
			$sx .= '<TR><TD colspan="10"><HR></TD></TR>';
			$sx .= '<TR>'; 
			$sx .= '<TD>';
			$sx .= $link;
			$sx .= $line['bol_contrato'];
			$sx .= '<TD colspan="2"><B>'.$xcor;
			$sx .= $sac;
			$sx .= '<TD align="right"><B>';
			$sx .= numberformat_br($valor,2);
			$sx .= ' + ';
			$sx .= numberformat_br($taxa,2);
			$sx .= '</TR>';
			
			$sx .= '<TR>'; 
			$sx .= '<TD>';
			$sx .= '<TD>'.$xcor;
			$sx .= $doc;
			$sx .= '<TD align="right">Visualizado:';
			$sx .= stodbr($lia);
			$sx .= '<TD align="right">Venc:';
			$sx .= stodbr($venc);
			$sx .= '<TD align="right">Pago em:';
			$sx .= stodbr($pago);		
			$sx .= '<TD>Status:'.$line['bol_status'];
			$sx .= '</TR>';
			
			}
		?>
		<table width="<?=$tab_max;?>" class="lt1">
			<TR><TD></TD></TR>
			<?=$sx;?>
		</table>			  
		<center>
		Total de <?=$tot2;?> boletos, R$ <?=numberformat_br($tot1,2);  ?>
		</center>
		<?
	}
	
require("foot.php");	
?>