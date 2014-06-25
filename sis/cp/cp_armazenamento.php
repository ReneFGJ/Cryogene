<?
$tabela = "nitro_armazenagem";
if (($acao == 0) and (strlen($dd[0]) > 0))
	{
	$sql = "select * from ".$tabela;
	$sql .= " where id_na = ".$dd[0];
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$dd[6] = $line['na_tanque'];
		}
	}
$cp = array();
$bl = "1:1&2:2&3:3&4:4";
array_push($cp,array('$H4','id_na','id_na',False,True,''));
array_push($cp,array('$S12','na_contrato','Contrato',True,False,''));
array_push($cp,array('$O '.$bl,'na_bolsa','Bolsa',True,True,''));

array_push($cp,array('$A8','','DADOS DO ARMAZENAMENTO',False,True,''));
array_push($cp,array('$D8','na_data','Data de armazenamento',True,True,''));
array_push($cp,array('$D8','na_data_quarentena','Data liberaзгo da quarentena',True,True,''));

//if (strlen($dd[6]) == 0)
//	{
//	array_push($cp,array('$Q tq_descricao:tq_codigo:select * from nitrogenio_tanque where tq_tipo=1','na_tanque','Tanque de armazenamento',True,True,''));
//	array_push($cp,array('$H8','na_local_1','Local no tanque',True,True,''));
//	$dd[7] == '';
//	} else {
	array_push($cp,array('$Q tq_descricao:tq_codigo:select * from nitrogenio_tanque where tq_tipo=1','na_tanque','Tanque de armazenamento',True,True,''));
//	array_push($cp,array('$Q tq_descricao:tq_codigo:select * from nitrogenio_tanque where tq_codigo='.chr(39).$dd[6].chr(39),'na_tanque','Tanque de armazenamento',True,True,''));
	array_push($cp,array('$S12','na_local_1','Local no tanque',True,True,''));
//	}
array_push($cp,array('$S15','na_barcod','Cуdigo de barras',True,True,''));
array_push($cp,array('$Q us_nome:us_login:select * from usuario where us_ativo=1 order by us_nome','na_responsavel','Responsбvel',True,True,''));
array_push($cp,array('$T40:3','na_obs','Observaзгo',False,True,''));
	
/// Gerado pelo sistem "base.php" versao 1.0.2
?>