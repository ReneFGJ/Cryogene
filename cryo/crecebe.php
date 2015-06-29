<?
require("cab.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Contas a receber','Caixa diário','boleto.php')); 
array_push($menu,array('Caixa','Resumo diário','finan_receber.php')); 
array_push($menu,array('Faturamento','Gerar uma Fatura','fat_faturamento.php')); 
array_push($menu,array('Faturamento','Consultar obrigações','fat_faturamento_bol.php')); 
array_push($menu,array('Contas a receber','Boleto bancário','boleto.php')); 
array_push($menu,array('Contas a receber','Boleto por vencimento','boleto_vencimento.php')); 
array_push($menu,array('Contas a receber','Acompanhamento boletos','boleto_vencimento_status.php')); 
array_push($menu,array('Contas a receber','Gerar Boleto Individual','boleto_emitir.php')); 
array_push($menu,array('Contas a receber','Gerar Boleto Mensalidade','boleto_emitir_auto.php')); 
array_push($menu,array('Contas a receber','Preparar e-mail para enviar','boleto_emitir_email.php')); 
array_push($menu,array('Contas a receber','Disparar e-mail para destinatário','email.php')); 
array_push($menu,array('Contas a receber','Baixas Boleto bancário','boleto_baixa.php')); 
array_push($menu,array('Contas a receber','Boletos Abertos','boleto_abertos.php')); 
array_push($menu,array('Contas a receber','Emitir Recibo','ed_recibo.php')); 
array_push($menu,array('Contas a receber','XXXX','ed_recibo_2.php')); 
array_push($menu,array('Relatório','Boleto quitados','boleto_quitado.php')); 
array_push($menu,array('Relatório','Boleto cancelados','boleto_cancelado.php')); 
array_push($menu,array('Relatório','Resumo Boletos Quitados','boleto_grafico.php')); 
array_push($menu,array('Relatório','Resumo Boletos Abertos','boleto_grafico_abertos.php')); 
array_push($menu,array('Relatório','Resumo Boletos Suspensos','boleto_grafico_suspensos.php')); 
array_push($menu,array('Relatório','Resumo Boletos Geral','boleto_grafico_geral.php')); 
array_push($menu,array('Relatório','Calendário financeiro','finan_calendario.php?dd0='.date("Ymd")));

array_push($menu,array('Relatório','Razão - Boletos Bancários','boletos_razao.php'));  

array_push($menu,array('Cadastro','Conta Corrente','conta_corrente.php'));

array_push($menu,array('Fatura','Faturas','fatura_razao.php')); 

//array_push($menu,array('Representante','Vendedores','vendedor.php')); 

require($include."sisdoc_menus.php");
menus($menu,3);
exit;

///////////////////////////////////////////////////// redirecionamento
if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}
?>
<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="crecebe.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?
$xcol=0;
$seto = "X";
for ($x=0;$x <= count($menu); $x++)
	{
	if (isset($menu[$x][2]))
		{
			
			{
			$xseto = $menu[$x][0];
			if (!($seto == $xseto))
				{
				echo '<TR><TD colspan="10">';
				echo '<TABLE width="100%" cellpadding="0" cellspacing="0">';
				echo '<TR><TD class="lt3" width="1%"><NOBR><B><font color="#C0C0C0">'.$xseto.'&nbsp;</TD>';
				echo '<TD><HR width="100%" size="2"></TD></TR>';
				echo '</TABLE>';
				echo '<TR class="lt3">';
				$seto = $xseto;
				$xcol=0;
				}
			}
		if ($xcol >= 3) { echo '<TR><TD><img src="'.$img_dir.'nada.gif" width="1" height="5" alt="" border="0"></TD><TR>'; $xcol=0; }
		echo '<TD align="center">';
		echo '<input type="submit" name="dd1" value="'.CharE($menu[$x][1]).'" '.$estilo_admin.'>';
		echo '</TD>';
		$xcol = $xcol + 1;
		}
	}
?>
</TABLE></FORM>
<? require("foot.php");	?>