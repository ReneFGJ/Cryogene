<?
/////////////////////////////////// PROCESSAMENTO
		$sql = "select * from contrato_processamento where cpp_contrato = '".$contrato."' ";
		$xrlt = db_query($sql);
		
		if ($aline = db_read($xrlt))
			{
			$idproc = $aline['id_cpp'];
			}
			
/////////////////////////////////// CONGELAMENTO
		$sql = "select * from contrato_congelamento where cdc_contrato = '".$contrato."' ";
		$xrlt = db_query($sql);
		
		if ($aline = db_read($xrlt))
			{ $idcong = $aline['id_cdc']; }			
			
/////////////////////////////////// ARMAZENAMTO
		$sql = "select * from nitro_armazenagem where na_contrato = '".$contrato."' ";
		$xrlt = db_query($sql);
		
		if ($aline = db_read($xrlt))
			{ $idarma = $aline['id_na']; }			

	$alink = '<A HREF="#" onclick="newxy2('.chr(39).'contrato_documento_processamento.php?dd0='.$contrato.'&dd1='.$idproc.chr(39).',600,550);" >';
	$docs = array();
	$ss .= '<font class=lt2><B>Documentos disponíveis</B></font>';
	$ss .= '<UL>';

if ($idproc > 0)
	{ $ss .= '<LI>'.$alink.'Ficha de processamento</A>'; }
if ($idcong > 0)
	{ $ss .= '<LI>'.$alink.'Dados do congelamento</A>'; }
if ($idarma > 0)
	{ $ss .= '<LI>'.$alink.'Dados do armazenamento</A>'; }

	$ss .= '</UL>';
	
?>