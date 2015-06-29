<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_form2.php");
require($include."cp2_gravar.php");
global $gravar;
$tabela = "";

$cp = array();
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$Q chk_descricao:chk_codigo:select * from check_list where ativo=1 order by chk_descricao','','Tipo do documento',True,True,''));
array_push($cp,array('$Q c_cidade:c_codigo:select * from cidade order by c_cidade','','Cidade',True,True,''));
array_push($cp,array('$O 1:Presente&0:Pendente&A:Todos','','Tipo',True,True,''));

echo '==>'.$dd[1].'<==';
if (strlen($dd[1]) == 0)
	{
	editar();
	} else {
		if ($dd[2] == '00003') { $dd[2] = ''; }
		$sql = "select * from contrato ";
		$sql .= " left join cliente on ctr_mae = cl_codigo ";
		$sql .= " left join cidade on c_codigo = cl_cidade ";
		$sql .= " left join coleta on col_contrato = ctr_numero ";
		if (strlen($dd[2]) > 0)
			{ $sql .= "where cl_cidade = '".$dd[2]."' "; }
		$sql .= " order by col_dp_data ";
		$rlt = db_query($sql);

		$cto = array();
		$ctn = array();
		while ($line = db_read($rlt))
			{
			array_push($ctn,trim($line['ctr_numero']));
			array_push($cto,array($line['ctr_numero'],$line['cl_nome'],0,$line['col_dp_data'],$line['col_rc_med_nome'],$line['c_cidade'],$line['ctr_status']));
			}
		echo '<HR>';
		$sql = "select * from check_list ";
		$sql .= " left join contrato_check_list on ccl_codigo = chk_codigo ";
		$sql .= " where chk_codigo = '".$dd[1]."'";
		$rlt = db_query($sql);
		
		while ($line = db_read($rlt))
			{
			$ctr = trim($line['ccl_contrato']);
			if ($ret = array_search($ctr,$ctn))
				{
				$cto[$ret][2] = $line['ccl_ativo'];
				}
			}
		
		$s = '';
	$tot = 0;
	$xx="0000";
	for ($k=0;$k < count($ctn);$k++)
		{
		$tot++;
		$ok = 0;
		if (($dd[3] == '1') and ($cto[$k][2] == 1)) { $ok = 1; }
		if (($dd[3] == '0') and ($cto[$k][2] != 1)) { $ok = 1; }
		if (($dd[3] == 'A')) { $ok = 1; }
//	echo '<BR>'.$dd[3].'=='.$cto[$k][2];
	if ($ok==1)
	{
		$xcor = coluna();
		$s .= '<TR><TD colspan="10" bgcolor="#c0c0c0" height="1">';
		$s .= '<TR '.$xcor.'>';
		$s .= '<TD align="center">';
		$s .= $cto[$k][0];
		$s .= '<TD align="left">';
		$s .= $cto[$k][1];
		$s .= '<TD>';
		$atn = $cto[$k][2];
		if ($atn == 0) { $at = '<font color="RED">-não cadastrato-'; }
		if ($atn == 1) { $at = '-ok-'; }
		if ($atn == 2) { $at = '<FONT COLOR="ORANGE">-pendente-'; }
		$s .= $at;
		$s .= '<TD align="center">';
		$s .= stodbr($cto[$k][3]);
		$s .= '<TR '.$xcor.'><TD>';
		$s .= '<TD align="left">';
		$s .= $cto[$k][4];
		$s .= '<TD align="left">';
		$s .= $cto[$k][5];
		$s .= '<TD align="left">Ativo: ';
		$s .= $cto[$k][6];
		}
	}
	?>
	<font class="lt5">Relatório Consentimento Informado Médico</FONT>
	<TABLE class="lt1" width="<?=$tab_max;?>" align="center">
	<TR>
	<TH>Nome da mãe
	<TH>contrato
	<?=$s;?>
	<TR><TD colspan="10" align="right">Total de <?=$tot;?> RN registrados.
	</TABLE>
	<?
}
require("foot.php");
?>