<?
require("cab.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

if (($user_nivel) >=1) { 
	}
if (($user_nivel) >=9) { 	 
	array_push($menu,array('Financeiro','Cadastro de contas','conta_corrente.php')); 
	array_push($menu,array('Financeiro','Forma de pagamento','cobranca_forma.php')); 
	array_push($menu,array('Cadastros','Usuários','user.php')); 
	array_push($menu,array('Cadastros','Parceiros','ed_parceiros.php')); 
	array_push($menu,array('Cadastros','Cidades','cidade.php')); 
	array_push($menu,array('Cadastros','Sistema','sistema.php')); 
	array_push($menu,array('Cadastros','Serviços','servico.php')); 
	array_push($menu,array('Cadastros','Local de coleta','local_coleta.php')); 
	array_push($menu,array('Cadastros','Estado Civil','estado_civil.php')); 
	array_push($menu,array('Cadastros','Produto','produto.php')); 
	array_push($menu,array('Cadastros','Marca de Produto','produto_marca.php')); 
	array_push($menu,array('Cadastros','Agenda/tipo evento','cep_cal_evento.php')); 
	array_push($menu,array('Cadastros','Empresa','empresa.php')); 
	array_push($menu,array('Cadastros','Contas (tipos)','contas.php')); 
	array_push($menu,array('Cadastros','Documentos Check-List','ed_check_list.php')); 
	array_push($menu,array('Cadastros','Mensagens do sistema','ed_mensagem.php')); 
	array_push($menu,array('ISO','Pesquisa de satisfação','ed_iso_pesquisa_field.php')); 
	array_push($menu,array('Contrato','Tipos de contrato','ed_contrato_tipo.php')); 
	array_push($menu,array('Contrato','Clausulas do contrato','ed_contrato_field.php')); 
	array_push($menu,array('Tanques','Tanques de Armazenamento','ed_nitrogenio_tanque.php')); 

//	array_push($menu,array('Importação','Importar Antigo','importar.php'));
//	array_push($menu,array('Empresa','Empresas','empresa.php')); 
	 }
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
</FONT><FORM method="post" action="parametro.php">
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