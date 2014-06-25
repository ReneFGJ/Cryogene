<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_form2.php');
require('include/cp2_gravar.php');
$label = "Emitir Faturamento para Clientes";
if (strlen($dd[0]) > 0)
	{
	$dd[1] = sonumero($dd[0]);
	$dd[0] = '';
	$dd[2] = stodbr(DateAdd('m',1,date("Ymd")));
	$dd[3] = date("Ymd");
	$dd[4] = date("Ymd");
	$dd[18] = '0.00';
//	$dd[4] = date("d/m/Y");
	
	}
$sql = "select * from contrato where (id_ctr = ".$dd[1].") or (ctr_numero = '".$dd[1]."')";
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
	} else { echo 'Contrato não localizado'; exit; }
	
$dd[16] = trim($resp_ende);
$dd[17] = trim(trim($resp_bair).' '.trim($resp_cep).' '.trim($resp_cida));
$dd[12] = trim($resp_cpf);
$dd[15] = trim($resp_nome);
//////////////////////
$tabela = "fatura";
$cp = array();
array_push($cp,array('$H8','id_ft','id_ft',False,True,''));
array_push($cp,array('$O '.$opc,'ft_contrato','Nº contrato',False,True,''));
array_push($cp,array('$D8','ft_data_vencimento','Vencimento',True,True,''));
array_push($cp,array('$H8','ft_data_processamento','ft_data_processamento',False,True,''));
array_push($cp,array('$H8','ft_data_documento','ft_data_documento',False,True,''));
// dd5
array_push($cp,array('$N8','ft_valor_boleto','Valor da fatura',True,True,''));
array_push($cp,array('$N8','ft_tx_boleto','Taxa Boleto',True,True,''));
array_push($cp,array('$H1','ft_aceite','ft_aceite',False,True,''));
array_push($cp,array('$H3','ft_especie','ft_especie',False,True,''));
array_push($cp,array('$H5','ft_especie_doc','ft_especie_doc',False,True,''));
array_push($cp,array('$H15','ft_nosso_numero','ft_nosso_numero',False,True,''));
// dd10
array_push($cp,array('$H8','ft_nr','NR. Doc. / Parcela',False,True,''));
array_push($cp,array('$H16','ft_cpf_cnpj','ft_cpf_cnpj',False,True,''));
array_push($cp,array('$H80','ft_endereco','ft_endereco',False,True,''));
array_push($cp,array('$H20','ft_cidade','ft_cidade',False,True,''));
array_push($cp,array('$H40','ft_sacado','ft_sacado',False,True,''));
// dd15
array_push($cp,array('$H60','ft_endereco1','ft_endereco1',False,True,''));
array_push($cp,array('$H60','ft_endereco2','ft_endereco2',False,True,''));
array_push($cp,array('$H8','ft_conta','ft_conta',False,True,''));
array_push($cp,array('$T20:6','ft_obs','Obs',False,True,''));

array_push($cp,array('$O ANU:Anuidade&CON:Contrato','ft_tipo','Tipo',False,True));
array_push($cp,array('$[2004-2099]','ft_referencia_ano','Ano Base',True,True));


array_push($cp,array('$O 1:Aberto&2:Liquidado&3:Suspenso&9:Cancelado','ft_status','status',False,True,''));
////////////////////////	
if (cp2_gravar()  > 0)
	{
//	$sql = "update contrato set 
	redirect('update.php?dd0=fatura');
	exit;
	echo 'gravado';
	exit;
	}
$dd[20] = '1';
echo '<TABLE width="50%" border="1">';
echo '<TR valign="top"><TD class="lt1">';
echo 'SISTEMA DE GERAÇÂO DE FATURAS BANCÁRIOS POR CONTRATO<HR>';
echo 'nome<BR><B>'.$resp_nome.'</B><BR>&nbsp;<BR>';
echo 'cpf<BR><B>'.$resp_cpf.'</B><BR>&nbsp;<BR>';
echo 'endereço<BR><B>'.$resp_ende.'<BR>'.$resp_bair.' '.$resp_cep.' '.$resp_cida.'</B><BR>&nbsp;<BR>';
echo 'contrato<BR><B>'.$contrato.'</B><BR>&nbsp;<BR>';
echo '</TD><TD class="lt0">';
echo '<TABLE width="300">';
echo '<TR><TD bgcolor="#c0c0c0" align="center" colspan="2"><B>Emitir FATURA bancário</B></TD></TR>';
echo '<TR><TD><form method="fat_fatura_emitir_a.php" method="post"></TD></TR>';
echo '<TR><TD>';
echo gets_fld();
echo '<TR><TD><input type="submit" name="acao" value="gravar fatura"></TD></TR>';
echo '<TR><TD></form></TD></TR>';
echo '</TABLE>';

echo '</TABLE>';

require("foot.php");
?>	