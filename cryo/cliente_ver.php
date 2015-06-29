<?
require("cab.php");
require('include/sisdoc_colunas.php');
require('include/sisdoc_data.php');
require('include/sisdoc_windows.php');

$label = "Dados do clientes";
	echo '<TABLE width="'.$tab_max.'">';
	echo '<TR><TD>';
	echo '<font class=lt5>'.$label.'</font>';
	echo '</TD></TR>';
	echo '</TABLE>';
	
	$sql = "select * from cliente ";
	$sql = $sql . "inner join cidade on c_codigo = cl_cidade ";
	$sql = $sql . "where id_cl = ".$dd[0];
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$cod = $line['cl_codigo'];
		echo '<TABLE class="lt1" width="'.$tab_max.'" border="0">';
		echo '<TR><TD align="right">Nome completo';
		echo '<TD colspan="10"><B>'.$line['cl_nome'].'</B></TD>';

		echo '<TR><TD align="right">Endereço';
		echo '<TD colspan="10"><B>'.$line['cl_endereco'].'</B></TD>';

		echo '<TR>';
		echo '<TD align="right">Bairro';
		echo '<TD><B>'.$line['cl_bairro'].'</B></TD>';

		echo '<TD align="right">Cidade';
		$estado = trim($line['c_estado']);
		if (strlen($estado) > 0) { $estado = ' - '.$estado; }
		echo '<TD><B>'.$line['c_cidade'].$estado.'</B></TD>';
		
		echo '<TD align="right">CEP';
		echo '<TD><B>'.$line['cl_cep'].'</B></TD>';
		
		echo '<TR><TD colspan="10"><HR></TD></TR>';

		echo '<TR><TD align="right">CNPJ/CPF';
		echo '<TD><B>'.$line['cl_cpf'].'</B></TD>';
		echo '<TD align="right">IE/RG';
		echo '<TD><B>'.$line['cl_rg'].'</B></TD>';

		echo '<TR><TD align="right">e-mail';
		echo '<TD colspan="10"><B><A HREF="mailto:'.$line['cl_email'].'">'.$line['cl_email'].'</A></B></TD>';

		echo '<TR><TD align="right">e-mail (alternativo)';
		echo '<TD colspan="10"><B><A HREF="mailto:'.$line['cl_email_alt'].'">'.$line['cl_email_alt'].'</A></B></TD>';

		echo '<TR><TD align="right">Telefones';
		echo '<TD colspan="10"><B>';
		$ddd = $line['cl_fone_ddd'];
		$tel = $line['cl_fone_1'];
		$fax = $line['cl_fone_2'];
		$cel = $line['cl_fone_3'];
		echo "(".$ddd.") ".trim($tel).' '.trim($fax).' '.trim($cel);

		$sql = "select * from cliente_contato";
		$sql = $sql . " where clc_cliente='".$cod."'";
		$rll = db_query($sql);
		$sx='';
		while ($vline = db_read($rll))
			{
			$sx = $sx . '<TR><TD align="right">Nome</TD><TD><B>'.$vline['clc_nome'].'</B></TD>';
			$sx = $sx . '<TD align="right">Fone</TD><TD><B>'.$vline['clc_fone_1'].'</B></TD>';
			}
			
		if (strlen($sx) > 0)
			{
			echo '<TR><TD colspan="10" align="center" class="lt3"><HR><U>CONTATOS PESSOAIS</TD></TR>';
			echo $sx;
			}
		
		

if (($user_nivel) >=1) 
		{
		$link = '<a href="cliente_edit.php?dd0='.$line['id_cl'].'">';
		echo '<TR><TD colspan="10" align="right">'.$link.'<img src="img/icone_editar.gif" width="20" height="19" alt="" border="0">';
		}

		echo '</TABLE>';
		}
		
?>
<TABLE width="<?=$tab_max;?>">
<TR valign="top">
<TD>
<? 
$cliente_id = $cod;
require("cliente_contrato.php"); 

require("_class/_class_fatura.php");
$fta = new fatura;

require("_class/_class_boleto.php");
$bol = new boleto;
echo '<font class="lt5">Boleto(s) Bancário(s)</font>';

echo $bol->saldos_cliente($cod);

$pre_where = "and (bol_status ='A' or bol_status='B') ";
require("cliente_fatura_boleto_interno.php");
?>
</TD>
<TD>&nbsp;</TD>
<TD width="100">
<?
require("cliente_relacionamento_interno.php"); 
?>
</TD>
</TR>

</TABLE>
<?

for ($r=0;$r < count($contratos);$r++)
	{
		$fat = $contratos[$r];
		echo $fta->fatura($fat);		
	}
require("foot.php");
?>	