<?
require("cab.php");
require($include.'sisdoc_email.php');
$ema = new email;
$rlt = $ema->resumo();
echo '<font class="lt5">';
$tot = round($ema->resumo_email_enviar());
echo 'Total de '.$tot.' email(s) para enviar';
if ($tot > 0) { 
	echo '<META HTTP-EQUIV=Refresh CONTENT="60; URL=http:email.php?'.date("Ymdhis").'">'; 
	echo $ema->enviar_proximo();
	echo '<BR>Enviado '.date("H:i:s");
	} else 
	{
	echo '<H5>Fim do envio</H5>';
	exit;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<script type="text/javascript">
var HH = 23;
var MI = 59;
var SS = 59;
var tm = 61;
function atualizaContador() {
	var hoje = new Date();
	var todayd= hoje.getDate();
	var todaym= hoje.getMonth();
	var todayy= hoje.getFullYear();
	var futuro = new Date(todayy,todaym+1,todayd,HH,MI,SS);
	var ss = parseInt((futuro - hoje) / 1000);
	var mm = parseInt(ss / 60);
	var hh = parseInt(mm / 60);
	var dd = parseInt(hh / 24);
	ss = ss - (mm * 60);
	mm = mm - (hh * 60);
	hh = hh - (dd * 24);
	var faltam = '';
	tm = tm - 1;
	faltam += tm+' seg';
	if (dd+hh+mm+ss > 0) {
	document.getElementById('contador').innerHTML = faltam;
	setTimeout(atualizaContador,1000);
	} else {
	document.getElementById('contador').innerHTML = 'RESTART....';
	setTimeout(atualizaContador,1000);
	}
}
</script>
<body onload="atualizaContador()">
<br />
</h1>
<BR><BR>
</font><font class="lt2">
Novo envio em <span id="contador"></span>
</font>


</html>