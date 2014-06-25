<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');
$label = "Emitir Boleto para Clientes";
if (strlen($dd[0]) > 0)
	{
	$dd[1] = sonumero($dd[0]);
	$dd[0] = '';
	$dd[2] = stodbr(DateAdd('m',1,date("Ymd")));
	$dd[3] = date("Ymd");
	$dd[4] = date("Ymd");
	$dd[18] = '0.00';
//	$dd[4] = date("d/m/Y");
	$sql = "select * from contrato where (id_ctr = ".$dd[1].") ";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	redirecina('boleto_emitir_a.php?dd1='.trim($line['ctr_numero']));
	exit;
	}
$sql = "select * from contrato where (ctr_numero = '".$dd[1]."')";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$contrato = trim($line['ctr_numero']);
	$opc = trim($line['ctr_numero']).':'.trim($line['ctr_numero']);
	$resp = $line['ctr_responsavel'];
	$resp_nome = $line['ctr_responsavel_nome'];
	

	$sql = "select * from cliente ";
	$sql = $sql . " inner join cidade on cl_cidade = c_codigo ";
	$sql = $sql . " where cl_codigo = '".$resp."'";
	$rrr = db_query($sql);
	if ($xline = db_read($rrr))
		{
		$resp_nome = $xline['cl_nome'];
		$resp_cpf  = $xline['cl_cpf'];
		$resp_ende = $xline['cl_endereco'];
		$resp_bair = $xline['cl_bairro'];
		$resp_cida = $xline['c_cidade'].'-'.$xline['c_estado'];
		$resp_cep  = sonumero($xline['cl_cep']);
		if (strlen($resp_cep) == 8) { $resp_cep = substr($resp_cep,0,2).'.'.substr($resp_cep,2,3).'-'.substr($resp_cep,5,3); }
		}
	} else { echo 'Contrato nao localizado'; exit; }
	
$dd[15] = trim($resp_ende);
$dd[16] = trim(trim($resp_bair).' '.trim($resp_cep).' '.trim($resp_cida));
$dd[11] = trim($resp_cpf);
$dd[14] = trim($resp_nome);
//////////////////////
$tabela = "cr_boleto";
$cp = array();
array_push($cp,array('$H8','id_bol','id_bol',False,True,''));
array_push($cp,array('$O '.$opc,'bol_contrato','N. contrato',False,True,''));
array_push($cp,array('$D8','bol_data_vencimento','Vencimento',True,True,''));
if (strlen($dd[0]) == 0) { array_push($cp,array('$U8','bol_data_processamento','',False,True,'')); }
array_push($cp,array('$H8','bol_data_documento','bol_data_documento',False,True,''));
// dd5
array_push($cp,array('$N8','bol_valor_boleto','Valor Boleto',True,True,''));
array_push($cp,array('$H1','bol_aceite','bol_aceite',False,True,''));
array_push($cp,array('$H3','bol_especie','bol_especie',False,True,''));
array_push($cp,array('$H5','bol_especie_doc','bol_especie_doc',False,True,''));
array_push($cp,array('$H15','bol_nosso_numero','bol_nosso_numero',False,True,''));
// dd10
array_push($cp,array('$S12','bol_numero_documento','NR. Doc. / Parcela',False,True,''));
array_push($cp,array('$H16','bol_cpf_cnpj','bol_cpf_cnpj',False,True,''));
array_push($cp,array('$H80','bol_endereco','bol_endereco',False,True,''));
array_push($cp,array('$H20','bol_cidade','bol_cidade',False,True,''));
array_push($cp,array('$H40','bol_sacado','bol_sacado',False,True,''));
// dd15
array_push($cp,array('$H60','bol_endereco1','bol_endereco1',False,True,''));
array_push($cp,array('$H60','bol_endereco2','bol_endereco2',False,True,''));
array_push($cp,array('$Q cc_nome:cc_codigo:select * from conta_corrente where cc_ativo=1 order by cc_nome','bol_conta','bol_conta',False,True,''));
array_push($cp,array('$N8','bol_tx_boleto','Taxa Boleto',True,True,''));
array_push($cp,array('$T20:6','bol_obs','Obs',False,True,''));

array_push($cp,array('$S1','bol_status','status',False,True,''));
array_push($cp,array('$Q ft_nr:ft_nr:select * from fatura where ft_status=1 and ft_contrato ='.chr(39).$contrato.chr(39).' order by ft_nr desc','bol_fatura','N. Fatura',True,True,''));

////////////////////////	
if (cp2_gravar()  > 0)
	{
//	$sql = "update contrato set 
	redirect('update.php?dd0=boleto');
	exit;
	echo 'gravado';
	exit;
	}
$dd[20] = 'A';
echo '<TABLE width="50%" border="1">';
echo '<TR valign="top"><TD class="lt1">';
echo 'SISTEMA DE GERACAO DE BOLETOS BANCARIOS POR CONTRATO<HR>';
echo 'nome<BR><B>'.$resp_nome.'</B><BR>&nbsp;<BR>';
echo 'cpf<BR><B>'.$resp_cpf.'</B><BR>&nbsp;<BR>';
echo 'endereco<BR><B>'.$resp_ende.'<BR>'.$resp_bair.' '.$resp_cep.' '.$resp_cida.'</B><BR>&nbsp;<BR>';
echo 'contrato<BR><B>'.$contrato.'</B><BR>&nbsp;<BR>';
echo '</TD><TD class="lt0">';
echo '<TABLE width="300">';
echo '<TR><TD bgcolor="#c0c0c0" align="center" colspan="2"><B>Emitir boleto bancario</B></TD></TR>';
echo '<TR><TD><form method="boleto_emitir_a.php" method="post"></TD></TR>';
echo '<TR><TD>';
echo gets_fld();
echo '<TR><TD><input type="submit" name="acao" value="gravar boleto"></TD></TR>';
echo '<TR><TD></form></TD></TR>';
echo '</TABLE>';

echo '</TABLE>';

require("foot.php");
?>	