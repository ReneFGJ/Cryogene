<? ob_start(); ?>
<title>Via Prata - Gestor comercial</title>
<?
global $nocab;
$tabela = "contas_receber";

require('db.php');
require('security.php');
require('include/sisdoc_form2.php');
require('include/sisdoc_data.php');
require('include/cp2_gravar.php');
require('include/sisdoc_colunas.php');

$bb1 = ' e x c l u i r ';
security();

if (strlen($dd[0]) == 0) { header("Location: close.php"); }
?>
<body leftmargin="0" topmargin="0" >
<style>
body {BACKGROUND-POSITION: center 50%; FONT-SIZE: 9px; BACKGROUND-IMAGE: url(img/bg2.gif); MARGIN: 0px; COLOR: ##dfefff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: normal; color: #000000; bgproperties=fixed}
</style><CENTER>
<link rel="stylesheet" href="letras.css" type="text/css" />
<link rel="stylesheet" href="letras_form.css" type="text/css" />
<CENTER>
<FONT class="lt5">Contas a Receber (Liquidação de título)</FONT>
<?
$cp = array();
array_push($cp,array('$H4','id_cr','cod',False,True,''));
array_push($cp,array('$H8','cr_valor_original','valor pago',True,True,''));
array_push($cp,array('$N10','cr_valor','valor pago',True,True,''));
array_push($cp,array('$D8','cr_dt_quitacao','data pagamento',True,True,''));
array_push($cp,array('$H1','cr_status','A',False,True,''));
array_push($cp,array('$H1','cr_previsao','A',False,True,''));
array_push($cp,array('$S10','cr_doc','nr. doc.',False,True,''));
array_push($cp,array('$Q e_nome:e_codigo:select * from empresa where e_ativo=1 order by id_e','cr_empresa','Empresa',False,True,''));
array_push($cp,array('$Q ct_descricao:ct_codigo:select * from contas_tipo where ct_ativo=1 and ct_tipo=1','cr_conta','Conta',False,True,''));
array_push($cp,array('$Q dt_descricao:dt_codigo:select * from documento_tipo where dt_ativo=1 order by dt_descricao','cr_tipo','Tipo documento',False,True,''));
array_push($cp,array('$Q cc_descricao:cc_codigo:select * from cc where cc_ativo=1 order by cc_descricao','cr_cc','Recebido',False,True,''));

if (cp2_gravar())
	{
	?><script> close(); </script><?
	}
if (strlen($acao) == 0) 
	{ 
	$dd[1] = $dd[2]; 
	$dd[3] = date("d/m/Y"); 
	$dd[4] = 'B';
	$dd[5] = '0';
	}
?>
<TABLE class="lt1" border="0">
<TR valign="top"><TD><form method="post" action="finan_receber_fechar.php">
<TABLE class="lt1">
<TR><TD align="right">valor original</TD><TD class="lt4"><B><?=numberformat_br($dd[1],2)?></B></TD></TR>
<?
	for ($k=0;$k<99;$k++)
		{
		if (isset($cp[$k]))
			{
			$tt=$tt."<TR ".coluna().">";
		    $tt=$tt.gets('dd'.$k,$dd[$k],$cp[$k][0],CharE($cp[$k][2]),$cp[$k][3],$cp[$k][4]);
			$tt=$tt."</TR>";
			}
		}
echo $tt;	
echo '<TR><TD colspan="2" align="center"><input type="submit" name="acao" value=" g r a v a r "></TD></TR>';
?></TABLE>
</TD>
<TD>&nbsp;&nbsp;</TD>

</TABLE>
<CENTER><?=$nerro?></CENTER>