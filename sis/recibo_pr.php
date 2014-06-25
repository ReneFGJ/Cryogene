<?
$rec_nr = "0329";
$rec_data = date("Ymd");
$rec_valor = 123.21;
$rec_nome = $tit1;
$dim = extenso($rec_valor,false);
$dim = ereg_replace(" E "," e ",ucwords($dim));
$valor = numberformat_br($valor, 2, ",", ".");
?>
<head>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>

<TABLE width="<?=$tab_max;?>" class="lt1" cellpadding="0" cellspacing="0" align="center">
<TR>
<TD><img src="img/logo_tipo.png" alt="" border="0">
<TD align="center"><font class="lt4"><?=$tit1;?></font>
<BR><?=$tit2;?>
<BR><?=$tit3;?>
<BR><?=$tit4;?>
<TR><TD bgcolor="#808080" height="1" colspan="2">
</TABLE><TABLE width="<?=$tab_max;?>" class="lt1" cellpadding="0" cellspacing="10" border="0" align="center">
<TR><TD class="lt5" width="80">RECIBO
	<TD class="lt5"><font color="red">N. <?=$rec_nr;?>
	<TD class="lt5" align="right"><font face="ARIAL"><B> R$ <?=numberformat_br($rec_valor,2);?>
	
<TR class="lt3"><TD colspan="3"><BR>Recebemos de <B><?=$rec_nome;?></B>
<TR class="lt3"><TD colspan="3"><BR>a importância de <B><?=$dim;?>

<TR valign="top"><TD class="lt3" colspan="2">
<BR><BR>
<?=$tit_cidade;?>, <?=substr($rec_data,6,2);?> de <?=nomemes(intval(substr($rec_data,4,2)));?> de <?=substr($rec_data,0,4);?>.
<TD class="lt3" align="right" colspan="1"><BR><BR>Para clareza firmamos o presente recibo.
<BR><BR><BR>
<DIV><CENTER>
<HR>
<?=$tit1;?>
</DIV>

</TABLE>


