<?
require('db.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_number.php');
$ip = $_SERVER["REMOTE_ADDR"];

$sql = "select * from cr_boleto ";
$sql = $sql . "where id_bol = ".sonumero($dd[0]);
$rlt = db_query($sql);
$ip = $_SERVER["REMOTE_ADDR"];
if ($bline = db_read($rlt))
	{
	$banco = trim($bline['bol_conta']);
	$lido = intval("0".$line['bol_lido']);
	} else {
	echo '<CENTER><FONT COLOR=RED><B>Boleto bancario nao localizado</B></FONT></CENTER>';
	exit;
	}
	
$sql = '';	
if ($ip != '201.22.7.253')
	{
	$sql = "update cr_boleto set ";
	$sql .= "bol_lido = ".($lido+1);
	$sql .= ", bol_lido_data = ".date("Ymd");
	$sql .= " where id_bol = ".sonumero($dd[0]).' ;';
	$rlt = db_query($sql);
	
	$sql = 'insert into cr_boleto_log (';
	$sql .= 'blog_id,blog_data,blog_hora,';
	$sql .= 'blog_user,blog_status,blog_ip';
	$sql .= ') values (';
	$sql .= "0".sonumero($dd[0]).",".date("Ymd").",'".date("H:i")."',";
	$sql .= "0".round(strlen($user_id)).",'V','".$ip."');";
	$rlt = db_query($sql);	
}

$sql = "select * from conta_corrente where cc_codigo = '".$banco."'";
$rlt = db_query($sql);

if (!($qbanco = db_read($rlt)))
	{
	echo '<CENTER><FONT COLOR=RED><B>Cï¿½digo bancario nao localizado</B></FONT></CENTER>';
	exit;
	}

$codigobanco = trim($qbanco['cc_banco']);
$codigobanco_dv = trim($qbanco['cc_banco_dv']);

if (strlen($codigobanco) == 0) 
	{ 
	echo '<CENTER><FONT COLOR=RED><B>Cï¿½digo bancï¿½rio nï¿½o localizado</B></FONT></CENTER>';
	exit; 
	}

$dadosboleto["cedente"] = $qbanco['cc_cedente'];	


// INï¿½CIO DA ï¿½REA DE CONFIGURAï¿½ï¿½O

    $codigobanco = '341'; // O Itau sempre serï¿½ este nï¿½mero
    $agencia = '0098'; // 4 posiï¿½ï¿½es
	$agencia = trim($qbanco['cc_agencia']);
    $conta = '20677';  // 5 posiï¿½ï¿½es sem dï¿½gito
	$conta = trim($qbanco['cc_nr_conta']);
	$conta_dv = $qbanco['cc_nr_conta_dv'];
    $carteira = '176'; // A sem registro ï¿½ 175 para o Itaï¿½
	$carteira = trim($qbanco['cc_bol_carteira']);
    $moeda = '9'; // Sempre serï¿½ 9 pois deve ser em Real
    $nossonumero = trim($bline['bol_nosso_numero']); // Nï¿½mero de controle do Emissor (pode usar qq nï¿½mero de atï¿½ 8 digitos);
    $data = stodbr($bline['bol_data_processamento']); // Data de emissï¿½o do boleto
	$vencimento = stodbr($bline['bol_data_vencimento']); // Data no formato dd/mm/yyyy
	$vencimento_2 = $bline['bol_data_vencimento_2']; // Data no formato dd/mm/yyyy
	$valor = intval($bline['bol_valor_boleto']*100)+intval($bline['bol_tx_boleto']*100); // Colocar PONTO no formato REAIS.CENTAVOS (ex: 666.01)
	$valor_desconto = intval($bline['bol_valor_boleto']*5); // Colocar PONTO no formato REAIS.CENTAVOS (ex: 666.01)
	$txbc = number_format($bline['bol_tx_boleto'],2,',','.'); // Colocar PONTO no formato REAIS.CENTAVOS (ex: 666.01)
	$valor = substr($valor,0,strlen($valor)-2).'.'.substr($valor,strlen($valor)-2,2);
// NOS CAMPOS ABAIXO, PREENCHER EM MAIï¿½SCULAS E DESPREZAR ACENTUAï¿½ï¿½O, CEDILHAS E
// CARACTERES ESPECIAIS (REGRAS DO BANCO)

    $cedente = $qbanco['cc_cedente'];

    $sacado = trim($bline['bol_sacado']);
    $endereco_sacado = trim($bline['bol_endereco_1']);
    $cidade = trim($bline['bol_endereco_2']);
	$cpf_cnpj = trim($bline['bol_cpf']);
	$contrato = trim($bline['bol_contrato']);
	$obs = mst(trim($bline['bol_obs']));
	$multa = $qbanco['cc_bol_multa_atraso'];
	$juros = $qbanco['cc_bol_correcao_mes'];
	$vlr_multa = ($multa / 100) * $valor;
	$vlr_juros = ($juros / 100) * $valor;
	$nao_aceitar = Stodbr(DateAdd('d',7,brtos($vencimento)));
	$instrucoes1 = 'Cobrar multa de R$ '.number_format($vlr_multa,2,',','.').' (2%) após vencimento e juros de R$ '.number_format($vlr_juros,2).' (';
	$instrucoes1 = $instrucoes1 . ($juros);
	$instrucoes1 = $instrucoes1 . '%) por dia de atraso.';
	$instrucoes2 = 'Nao aceitar depois de '.$nao_aceitar;
	$instrucoes3 = '';
	if ($txbc > 0) { $instrucoes3 = 'Taxa bancária de R$ '.number_format($txbc,2,',','.'). ' inclusa na fatura'; }

	$instrucoes4 = 'Acesse : www.cryogene.com.br <BR>';
	if (intval('0'.$vencimento_2) >= date("Ymd"))
		{
		$instrucoes2 = 'Após vencimento valor nominal do boleto R$ '.number_format($valor,2,',','.').',';
		$instrucoes2 .= 'cobrar multa de R$ '.number_format($vlr_multa,2,',','.').' (2%) e juros de R$ '.number_format($vlr_juros,2).' (';
		$instrucoes2 .=  ($juros);
		$instrucoes2 .= '%) por dia de atraso, não receber após 5 dias.';

		$instrucoes1 = '<FONT COLOR="red">APÓS VENCIMENTO NÃO CONSIDERAR O DESCONTO</FONT>';
		
		$instrucoes4a .= '<FONT COLOR="#0071e1">** ANTENÇÃO **';
		$instrucoes4a .= '<BR>Este boleto tem uma bonificação de 5% se for pago até o vencimento.';
		$instrucoes4a .= '<BR>Após esta data o valor volta ao integral de R$ <B>'.number_format($valor,2,',','.').'</B>';
		$valor = intval($bline['bol_valor_boleto']*100)+intval($bline['bol_tx_boleto']*100); // Colocar PONTO no formato REAIS.CENTAVOS (ex: 666.01)
		$valor = substr($valor,0,strlen($valor)-2).'.'.substr($valor,strlen($valor)-2,2);
		

		$instrucoes2 = 'Após vencimento não considerar o desconto e cobrar multa de R$ '.number_format($vlr_multa,2,',','.').' (2%) e juros de R$ '.number_format($vlr_juros,2).' (';
		$instrucoes2 .=  ($juros);
		$instrucoes2 .= '%) por dia de atraso, não receber após 5 dias.';

		$instrucoes1 = '<FONT COLOR="red">APÓS VENCIMENTO NÃO CONSIDERAR O DESCONTO</FONT>';
		
		$instrucoes2 .= '<BR>Valor Integral do boleto: '.number_format($valor,2,',','.');
		$instrucoes2 .= '<BR>Desconto de R$ '.number_format($valor*0.05,2,',','.').' (5%) para pagamente até o '.($vencimento).'.';
		$instrucoes2 .= '<BR>Valor com bonificação <B>R$ '.number_format($valor*0.95,2,',','.').'</B>';
		$valor = intval($bline['bol_valor_boleto']*100)+intval($bline['bol_tx_boleto']*100); // Colocar PONTO no formato REAIS.CENTAVOS (ex: 666.01)
		$valor = substr($valor,0,strlen($valor)-2).'.'.substr($valor,strlen($valor)-2,2);

		}

/////////////////////// Busca dados do Responsavel
	$sql = "select * from contrato ";
	$sql = $sql . "inner join cliente on ctr_responsavel = cl_codigo ";
	$sql = $sql . " where ctr_numero='".$contrato."' ";

	$rqq = db_query($sql);
	if ($tline = db_read($rqq))
		{
		$sacado = $tline['cl_nome'];
		$cpf_cnpj = trim($tline['cl_cpf']);
	    $endereco_sacado = trim($tline['cl_endereco']);
	    $cidade = 'CEP : '.trim($tline['cl_cep']);		
		}
///////////////////////
$numero_documento = trim($bline['bol_numero_documento']);
$aceite = trim($qbanco['cc_bol_aceite']);

// FIM DA ï¿½REA DE CONFIGURAï¿½ï¿½O
$banco = trim($qbanco['cc_banco']);
echo '<center>';
if ($banco == '341') { require("boleto_itau/boletos_layout_itau.php"); }
if ($banco == '104') { require("boleto_cef/boletophp/index.php"); }

?>