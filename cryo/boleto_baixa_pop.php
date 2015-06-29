<?
require("db.php");
require("include/sisdoc_form2.php");
require("include/cp2_gravar.php");


$jid = 1;
$user_id = $HTTP_COOKIE_VARS['nw_user'];
$user_nome = $HTTP_COOKIE_VARS['nw_user_nome'];
$user_nivel = $HTTP_COOKIE_VARS['nw_nivel'];
$user_log = $HTTP_COOKIE_VARS['nw_log'];

$tab_max = "95%";
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');

if (strlen($dd[0]) == 0) { exit; }
$tabela = "cr_boleto";
$cp = array();
array_push($cp,array('$H8','id_bol','id_bol',False,True,''));
array_push($cp,array('$O A:Aberto&B:Quitar&X:Cancelar','bol_status','status',True,True,''));
array_push($cp,array('$D8','bol_data_pago','Data pagamento',True,True,''));
array_push($cp,array('$N8','bol_valor_pago','Valor pago',True,True,''));
array_push($cp,array('$H8','bol_data_vencimento','Valor pago',True,True,''));
array_push($cp,array('$H8','bol_valor_boleto','Valor pago',True,True,''));
array_push($cp,array('$S8','bol_nosso_numero','Nr.boleto',True,True,''));
array_push($cp,array('$B8','','Gravar',False,True,''));
if (cp2_gravar() > 0)
	{
	?>
	<script>
		close();
	</script>
	<?
	exit;
	}
if (strlen($dd[2]) < 5) { $dd[2] = date("d/m/Y"); }
?>
<link rel="stylesheet" href="letras.css" type="text/css" />
<font class="lt5">Baixa de boleto</font>
<TABLE border=1 class="lt1" cellpadding="0" cellspacing="1">
<TR valign="top"><TD>
	<TABLE border="1"  class="lt1" cellpadding="0" cellspacing="1">
	<TR><TD><form method="post" action="boleto_baixa_pop.php"></TD></TR>
		<TR><TD><? echo gets_fld(); ?>
		<TR><TD></form></TD></TR>
	</TABLE>
	<TD>
	<TABLE  class="lt1" cellpadding="0" cellspacing="1">
		<TR><TD>Boleto nº </TD><TD><B><?=$dd[6]?></TD>
		<TR><TD>Valor emitido</TD><TD><B><?=numberformat_br($dd[5],2)?></TD></TR>
		<TR><TD>Vencimento</TD><TD><B><?=stodbr($dd[4]);?></TD></TR>
		</TABLE>
	</TD>
</TABLE>