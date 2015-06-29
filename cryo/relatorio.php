<?
require("cab.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Relatorio','Checklist documentos','rel_checklist.php')); 
array_push($menu,array('Cliente','Dt.nasc/Mãe','rel_dtnasc_mae.php')); 
array_push($menu,array('Cliente','Clientes/Contato','rel_cliente_vendedor.php')); 
array_push($menu,array('Cliente','Contratos Inativo','rel_inativos.php')); 
array_push($menu,array('Parceiros','Agenda de visitas','rel_agentes_visitas.php')); 
array_push($menu,array('Parceiros','Tanques de armazenamento','ed_nitrogenio_tanque.php')); 
array_push($menu,array('Relacionamento','Contato de cliente','contatos.php')); 
//array_push($menu,array('Produto','Peças Imagem','rel_produto_peca.php')); 
//array_push($menu,array('Produto','Codigo / Imagem','rel_produto_peca_codigo.php')); 
array_push($menu,array('Médicos','Consentimento','rel_medico_consentimento.php')); 

//array_push($menu,array('Representante','Vendedores','vendedor.php')); 

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
</FONT><FORM method="post" action="relatorio.php">
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