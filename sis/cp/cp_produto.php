
<?
$tabela = "produto";
$cp = array();
array_push($cp,array('$H8','id_produto','id_produto',False,True,''));
array_push($cp,array('$S60','produto_descricao','Nome do produto',True,True,''));
array_push($cp,array('$H8','produto_codigo','Codigo',False,True,''));
array_push($cp,array('$I8','produto_quantidade','Qta. estoque',True,True,''));
array_push($cp,array('$U8','produto_ultima_compra','Ult. Compra',True,True,''));
array_push($cp,array('$H8','produto_custo','Preço Custo',False,True,''));
array_push($cp,array('$H8','produto_venda','Preço vendda',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','produto_ativo','ativo',True,True,''));
$dd[5] = 0;
$dd[6] = 0;

/// Gerado pelo sistem "base.php" versao 1.0.5
?>