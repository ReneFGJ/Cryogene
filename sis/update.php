<?
require("db.php");

if ($dd[0]=='cobranca') { $sql = "update cobranca_forma set fc_codigo = lpad(id_fc,2,'0') where fc_codigo = ''"; $http_redirect = "cobranca_forma.php"; }
if ($dd[0]=='contacorrente') { $sql = "update conta_corrente set cc_codigo = lpad(id_cc,5,'0') where cc_codigo = ''"; $http_redirect = "conta_corrente.php"; }
if ($dd[0]=='cidade') { $sql = "update cidade set c_codigo = lpad(id_c,5,'0') where c_codigo = ''"; $http_redirect = "cidade.php"; }
if ($dd[0]=='coleta') { $sql = "update local_coleta set lc_codigo = lpad(id_lc,5,'0') where lc_codigo = ''"; $http_redirect = "local_coleta.php"; }
if ($dd[0]=='cliente') { $sql = "update cliente set cl_codigo = lpad(id_cl,7,'0') where cl_codigo = ''"; $http_redirect = "cliente.php"; }

if ($dd[0]=='produto') { $sql = "update produto set produto_codigo = lpad(id_produto,7,'0') where produto_codigo = ''"; $http_redirect = "produto.php"; }
if ($dd[0]=='marca') { $sql = "update produto_marca set pm_codigo = lpad(id_pm,7,'0') where pm_codigo = ''"; $http_redirect = "produto_marca.php"; }
if ($dd[0]=='lote') { $sql = "update produto set produto_codigo = lpad(id_produto,7,'0') where produto_codigo = ''"; $http_redirect = "produto.php"; }
if ($dd[0]=='contas') { $sql = "update contas_tipo set ct_codigo = lpad(id_ct,5,'0') where ct_codigo = ''"; $http_redirect = "contas.php"; }

if ($dd[0]=='fatura') { $sql = "update fatura set ft_nr = lpad(id_ft,12,'0') where ft_nr = ''"; $http_redirect = "fat_faturamento.php"; }

if ($dd[0]=='contrato') { 
	$sql = "update contrato set ctr_numero = lpad(id_ctr,7,'0') ";
	$sql = $sql . " where length(ctr_numero) = 0";
	$rlt = db_query($sql);

	$http_redirect = "contrato.php"; 
	$sql = "select * from contrato inner join cliente on ctr_responsavel = cl_codigo ";
	$sql = $sql . " where ctr_responsavel_nome = '' ";
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
		$sql = "update contrato set ctr_responsavel_nome = '".$line['cl_nome']."' where id_ctr = ".$line['id_ctr'];
		$rrr = db_query($sql);
		}
	}
if ($dd[0]=='boleto') { $sql = "update cr_boleto set bol_nosso_numero = lpad(id_bol,8,'0') where bol_nosso_numero = ''"; $http_redirect = "boleto.php"; }

if ($dd[0]=='empresa') { $sql = "update empresa set e_codigo = lpad(id_e,3,'0') where e_codigo = ''"; $http_redirect = "empresa.php"; }

if ($dd[3] == 'CALEVE')
	{
	$sql = "update cep_calendario_tipo set ct_ev = lpad(id_ct,2,'0') where length(trim(ct_ev)) < 2";
	$rlt = db_query($sql);
	$http_redirect = 'cep_cal_evento.php';
	}	

if (strlen($sql) > 0)
	{
	$rlt = db_query($sql);
	}
	
header("Location: ".$http_redirect);	
?>