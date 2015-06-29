<?
require("db.php");
require($include."sisdoc_data.php");
?>
<head>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>
<?
$contrato = $dd[0];
/////////////////////////////////// PROCESSAMENTO
		$sql = "select * from contrato_processamento where cpp_contrato = '".$dd[0]."' ";
		$xrlt = db_query($sql);
		
		if ($aline = db_read($xrlt))
			{
			$idproc = $aline['id_cpp'];
			}
			
?>
<TABLE width="100%" class="lt1" border="0">
<TR><TD align="center" class="lt4" colspan="3"><CENTER>PROCESSAMENTO</TD></TR>
<TR class="lt4"><TD colspan="3">Bolsa <?=$aline['cpp_bolsa'];?></TD>
<TR class="lt0">
	<TD>data</TD>
	<TD>Horário: início</TD>
	<TD>Horário: término</TD>
</TR>

<TR class="lt2">
	<TD><?=stodbr($aline['cpp_data']);?></TD>
	<TD><?=$aline['cpp_hora_i'];?></TD>
	<TD><?=$aline['cpp_hora_f'];?></TD>
</TR>

<TR>
	<TD colspan="3">
	Volume de sangue de cordão coletado = <B><?=$aline['cpp_vs_pb_g'];?>g</B>
	-
	<B><?=$aline['cpp_vs_pl_g'];?>g</B>
	=
	<B><?=$aline['cpp_vs_cl_scup'];?>ml</B>
	</TD>
</TR>
<TR>
	<TD colspan="3">
	Volume a ser processado = <B><?=$aline['cpp_vs_cl_scup'];?>ml</B> +
	<B><?=$aline['cpp_vp_anti'];?>ml</B> =
	<B><?=$aline['cpp_vp_vl_proc'];?>ml</B> (<?=numberformat_br($aline['cpp_vs_cl_scup']+$aline['cpp_vp_anti'],2)?>)
</TR>

<TR>
	<TD colspan="3">
	<TABLE width="98%" align="center" class="lt1" border="1" cellpadding="1" cellspacing="0">
		<TR><TD rowspan="2">Pré-processamento</TD>
			<TD class="lt0">Vol. processamento</TD>
			<TD class="lt0">Vol. Expansor Plasmático</TD>
			<TD class="lt0">Nº leucócitos</TD>
			<TD class="lt0">Celularidade inicial</TD>
		</TR>
		<TR>
			<TD align="center"><B><?=$aline['cpp_vp_vl_proc'];?>ml</B></TD>
			<TD align="center"><B><?=$aline['cpp_vp_vl_expansor'];?></B>ml</TD>
			<TD align="center"><B><?=$aline['cpp_vp_leucocitos'];?></B></TD>
			<TD align="center"><B><?=$aline['cpp_vp_celulidade_ini'];?></B>x10<SUP>8</SUP></TD>
		</TR>
	</TABLE>
</TR>	

<TR>
	<TD colspan="3">
	<TABLE width="98%" align="center" class="lt1" border="1" cellpadding="1" cellspacing="0">
		<TR><TD rowspan="2">Pós-processamento</TD>
			<TD class="lt0">Vol. SCUP final</TD>
			<TD class="lt0">Nº leucócitos</TD>
			<TD class="lt0">Celularidade inicial</TD>
			<TD class="lt0">Rendimento</TD>
		</TR>
		<TR>
			<TD align="center"><B><?=$aline['cpp_vpos_scup'];?>ml</B></TD>
			<TD align="center"><B><?=$aline['cpp_vpos_leucocitos'];?></B></TD>
			<TD align="center"><B><?=$aline['cpp_vpos_celulidade_fim'];?></B>x10<SUP>8</SUP></TD>
			<TD align="center"><B><?=$aline['cpp_vpos_rendimento'];?></B>%</SUP></TD>
		</TR>
	</TABLE>
</TR>	

<TR class="lt0">
<TD colspan="3">Observação</TD></TR>
<TR class="lt1">
<TD colspan="3"><?=mst($aline['cpp_obs']);?></TD></TR>

<TR class="lt0">
<TD colspan="3">Responsável</TD></TR>
<TR class="lt1">
<TD colspan="3"><B><?=mst($aline['cpp_responsavel']);?></TD></TR>
</TABLE>

<TABLE width="100%" class="lt1" border="0">
<TR><TD align="center" class="lt4" colspan="3"><CENTER>DADOS DO PROCESSAMENTO</TD></TR>
<TR class="lt0">
	<TD>data</TD>
	<TD>Horário: início</TD>
	<TD>Horário: término</TD>
</TR>

<TR class="lt2">
	<TD><?=stodbr($aline['cpp_dp_data']);?></TD>
	<TD><?=$aline['cpp_dp_hora_ini'];?></TD>
	<TD><?=$aline['cpp_dp_hora_fim'];?></TD>
</TR>

<TR><TD colspan="3">
	<TABLE width="100%" class="lt1" border="1">
	<TR class="lt3" align="center">
		<TD><?=$aline['cpp_vl_congelado'];?> ml</TD>
		<TD>+</TD>
		<TD><?=$aline['cpp_vl_sol_dmso']+$aline['cpp_vl_sol_dextran'];?> ml</TD>
		<TD>=</TD>
		<TD><?=($aline['cpp_vl_congelado']+$aline['cpp_vl_sol_dmso']+$aline['cpp_vl_sol_dextran']);?> ml</TD>
		<TD>-</TD>
		<TD><?=$aline['cpp_vl_controles'];?> ml</TD>
		<TD>=</TD>
		<TD><B><?=$aline['cpp_vl_congelado']+$aline['cpp_vl_sol_dmso']+$aline['cpp_vl_sol_dextran'] - $aline['cpp_vl_controles'];?></B> ml</TD>
	<TR class="lt0" align="center">
		<TD>vol.congelamento</TD>
		<TD></TD>
		<TD>sol.crioprotetora</TD>
		<TD></TD>
		<TD>amostra final</TD>
		<TD></TD>
		<TD>controles</TD>
		<TD></TD>
		<TD>vol. final congelamento</TD>
	</TR>
	</TABLE>
</TD></TR>

<TR class="lt0">
<TD colspan="3">Observação</TD></TR>
<TR class="lt1">
<TD colspan="3"><?=mst($aline['cpp_vl_obs']);?></TD></TR>

<TR class="lt0">
<TD colspan="3">Responsável</TD></TR>
<TR class="lt1">
<TD colspan="3"><B><?=mst($aline['cpp_vl_resposnsavel']);?></TD></TR>

</TABLE>

<?
/////////////////////////////////// CONGELAMENTO
		$sql = "select * from contrato_congelamento where cdc_contrato = '".$contrato."' ";
		$xrlt = db_query($sql);
		
		if ($aline = db_read($xrlt))
			{ $idcong = $aline['id_cdc']; }			
?>
<TABLE width="100%" class="lt1" border="0">
<TR><TD align="center" class="lt4" colspan="3"><CENTER>DADOS DO CONGELAMENTO</TD></TR>
<TR class="lt0">
	<TD>data</TD>
	<TD>Horário: início</TD>
	<TD>Horário: término</TD>
</TR>

<TR class="lt2">
	<TD><?=stodbr($aline['cdc_data']);?></TD>
	<TD><?=$aline['cdc_hora_i'];?></TD>
	<TD><?=$aline['cdc_hora_f'];?></TD>
</TR>

<TR class="lt0">
	<TD colspan="2">Congelamento através do congelado</TD>
	<TD>Nº programa</TD>
</TR>
<TR class="lt2">
	<TD colspan="2"><?=$aline['cdc_congelamento_automatico'];?></TD>
	<TD><?=$aline['cdc_programa'];?></TD>
</TR>

<TR class="lt0">
	<TD colspan="2">Observação</TD>
	<TD>Resposável</TD>
</TR>
<TR class="lt2">
	<TD colspan="2"><?=$aline['cdc_obs'];?></TD>
	<TD><?=$aline['cdc_responsavel'];?></TD>
</TR>

</TABLE>
<?			
/////////////////////////////////// ARMAZENAMTO
		$sql = "select * from nitro_armazenagem ";
		$sql .= " inner join nitrogenio_tanque on tq_codigo = na_tanque ";
		$sql .= "where na_contrato = '".$contrato."' ";
		$xrlt = db_query($sql);
		
		if ($aline = db_read($xrlt))
			{ $idarma = $aline['id_na']; }	
?>	

<TABLE width="100%" class="lt1" border="0">
<TR><TD align="center" class="lt4" colspan="3"><CENTER>DADOS DO ARMAZENAMENTO</TD></TR>
<TR class="lt0">
	<TD>data</TD>
	<TD>liberação da quarentena</TD>
</TR>

<TR class="lt2">
	<TD><?=stodbr($aline['na_data']);?></TD>
	<TD><?=stodbr($aline['na_data_quarentena']);?></TD>
</TR>

<TR class="lt0">
	<TD colspan="2">Tanque de armazenamento</TD>
	<TD>Local</TD>
	<TD>Código</TD>
</TR>
<TR class="lt2">
	<TD colspan="2"><?=$aline['tq_descricao'];?></TD>
	<TD><?=$aline['na_local_1'];?></TD>
	<TD><?=$aline['na_barcod'];?></TD>
</TR>

<TR class="lt0">
	<TD colspan="2">Observação</TD>
	<TD>Resposável</TD>
</TR>
<TR class="lt2">
	<TD colspan="2"><?=$aline['na_obs'];?></TD>
	<TD><?=$aline['na_responsavel'];?></TD>
</TR>

</TABLE>		
