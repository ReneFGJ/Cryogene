<?
require("db.php");
require($include.'sisdoc_data.php');
$sql = "select * from recibo ";
$sql .= " where id_rb = 0".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$valor = 'R$ '.numberformat_br($line['rb_valor'],2);
	$referente = $line['rb_descricao'];
	$nome = $line['rb_nome'];
	$data = $line['rb_data'];
	}
?>
<head>
<title>::Recibo::</title>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>

<body topmargin="0" leftmargin="0" rightmargin="0">
<TABLE width="100%">
<TR>
	<TD width="181" rowspan="2" ><img src="img/logo_tipo.png" alt="" width="181" height="79" border="0"></TD>
	<TD colspan="4" align="center"><font class="lt5">RECIBO</font></TD>
</TR>
<TR><TD align="right" class="lt5"><?=$valor;?></TD></TR>

<TR><TD colspan="5" class="lt2"><P>Estamos recebendo de <B><?=$nome;?></B> o valor acima supracitado referente a <?=$referente;?>.</P></TD></TR>

<TR><TD><P>Curitiba, <?=substr($data,6,2);?> de <?=nomemes(intval(substr($data,4,2)));?> de <?=substr($data,0,4);?>.</P></TD></TR>
</TABLE>
</body>