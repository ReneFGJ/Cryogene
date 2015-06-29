<?
$docs = array();
$ss = '<font class=lt2><B>Documentos obrigatórios</B></font>';
$sql = "select * from check_list ";
$sql .= "order by chk_descricao";
$rrr = db_query($sql);
while ($xline = db_read($rrr))
	{
	array_push($docs,array($xline['chk_descricao'],$xline['chk_obrigatorio'],$xline['chk_codigo'],'','','','',$xline['chk_list']));
	}
//$sql = "delete from contrato_check_list  ";
//$rrr = db_query($sql);
	
$sql = "Select * from contrato_check_list  ";
$sql .= "where (ccl_contrato = '".$contrato."')";
$rrr = db_query($sql);
$ss .= '<UL>';
while ($xline = db_read($rrr))
	{
	$xx = $xline['id_ccl'];
	$yy = $xline['ccl_contrato'];
	$vv = $xline['ccl_ativo'];
	$cc = $xline['ccl_codigo'];

	for ($k=0;$k < count($docs);$k++)
		{
		if (trim($docs[$k][2]) == trim($cc))
			{
			$docs[$k][3] = $vv;
			$docs[$k][4] = $xx;
			$docs[$k][5] = $yy;
			}
		}
	}
	for ($k=0;$k < count($docs);$k++)
		{
		$id = $docs[$k][4];;
//		echo '==>'.$id;
		$link = '<A HREF="#" onclick="newxy2('.chr(39).'contrato_checklist_ed.php?dd99=contrato_check_list&dd0='.$id.'&dd1='.$contrato.'&dd2='.$docs[$k][2].'&dd10='.$docs[$k][7].chr(39).',600,450);">';
		$ss .= '<LI><font class=lt1>';
		$ss .= $docs[$k][0];
		$cll = trim($docs[$k][5]);
		$ati = trim($docs[$k][3]);
		$cob = $docs[$k][1];
		if ((strlen($cll) >4 ) and ($ati == 1))
			{
			$ss .= $link.'<font color=green >(arquivado)</font></A>';
			} else {
			if ($cob == 1)
				{
				$ss .= $link.'<font color=red >(pendente)</font></A>';
				} else {
				$ss .= $link.'<font color=orange >(opcional)</font></A>';
				}
			}
			$ss .= ' ('.$id.')';
		}
	$ss .= '</UL>';
?>