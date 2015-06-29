<?php
    function Modulo11($valor) {
            $multiplicador = '4329876543298765432987654329876543298765432';
            for ($i = 0; $i<=42; $i++ ) {
                 $parcial = $valor[$i] * $multiplicador[$i];
		         $total += $parcial;
            }
            $resultado = 11-($total%11);
            if (($resultado >= 10)||($resultado == 0)) {
                 $resultado = 1;
            }

            return $resultado;
    }


    function calculaDAC ($CalculaDAC) {
            $tamanho = strlen($CalculaDAC);
            for ($i = $tamanho-1; $i>=0; $i--) {
                if ($multiplicador !== 2) {
                    $multiplicador = 2;
                }
                else {
                    $multiplicador = 1;
                }
                $parcial = strval($CalculaDAC[$i] * $multiplicador);

                if ($parcial >= 10) {
                    $parcial = $parcial[0] + $parcial[1];
                }
                $total += $parcial;
            }
            $total = 10-($total%10);
            if ($total >= 10) {
            	$total = 0;
            }
            return $total;
    }

    function calculaValor ($valor) {
            $valor = str_replace('.','',$valor);
            return str_repeat('0',(10-strlen($valor))).$valor;
    }

    function calculaNossoNumero ($valor) {
            return str_repeat('0',(8-strlen($valor))).$valor;
    }

    function calculaFatorVencimento ($dia,$mes,$ano) {
             $vencimento = mktime(0,0,0,intval($mes),intval($dia),intval($ano))-mktime(0,0,0,07,03,2000);
             return (intval($vencimento/86400)+1)+1000;
    }

// CALCULO DO CODIGO DE BARRAS (SEM O DAC VERIFICADOR)
    $codigo_barras = $codigobanco.$moeda.calculaFatorVencimento(substr($vencimento,0,2),substr($vencimento,3,2),substr($vencimento,6,4));
    $codigo_barras .= calculaValor($valor).$carteira.calculaNossoNumero($nossonumero).calculaDAC($agencia.$conta.$carteira.calculaNossoNumero($nossonumero)).$agencia.$conta.calculaDAC($agencia.$conta).'000';

// CALCULO DA LINHA DIGITÁVEL
    $parte1 = $codigobanco.$moeda.substr($carteira,0,1).substr($carteira,1,2).substr(calculaNossoNumero($nossonumero),0,2);
    $parte1 = substr($parte1,0,5).'.'.substr($parte1,5,4).calculaDAC($parte1);

    $parte2 = substr(calculaNossoNumero($nossonumero),2,5).substr(calculaNossoNumero($nossonumero),7,1).calculaDAC($agencia.$conta.$carteira.calculaNossoNumero($nossonumero)).substr($agencia,0,3);
    $parte2 = substr($parte2,0,5).'.'.substr($parte2,5,5).calculaDAC($parte2);

    $parte3 = substr($agencia,3,1).$conta.calculaDAC($agencia.$conta).'000';
    $parte3 = substr($parte3,0,5).'.'.substr($parte3,5,8).calculaDAC($parte3);

    $parte5 = calculaFatorVencimento(substr($vencimento,0,2),substr($vencimento,3,2),substr($vencimento,6,4)).calculaValor($valor);

    $numero_boleto = $parte1.' '.$parte2.' '.$parte3.' '.Modulo11($codigo_barras).' '.$parte5;

// INSERÇÃO DO DAC NO CODIGO DE BARRAS

   $codigo_barras = substr($codigo_barras,0,4).Modulo11($codigo_barras).substr($codigo_barras,4,43);
//   print Modulo11($codigo_barras);
//   exit;

// IMPRESSÃO DOS RESULTADOS OBTIDOS

?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<HTML>
<HEAD>
<TITLE>Boleto Bancário - Cryogene</TITLE>
<META http-equiv=Content-Type content=text/html; charset=windows-1252><meta name=GENERATOR content=NetDinamica><style type=text/css><!--.cp {  font: bold 10px Arial; color: black}
<!--.ti {  font: 9px Arial, Helvetica, sans-serif}
<!--.ld { font: bold 15px Arial; color: #000000}
<!--.ct { FONT: 9px "Arial Narrow"; COLOR: #000033}
<!--.cn { FONT: 9px Arial; COLOR: black }
<!--.bc { font: bold 22px Arial; color: #000000 }
--></style> 
<meta NAME="keywords" CONTENT="boleto boleta, boleto bancário em PHP ou ASP, ITAU, banco do brasil, bradesco, bbv, real, brb, nossa caixa, cef, unibanco, hsbc, bcn, santander, banerj com codigo fonte incluso em PHP ou ASP, banco cobrança boleto para o banco do brasil, com codigo fonte incluso em PHP ou AS, cobranca bancária bancaria ficha de compensação compensacao codigo código barras 2 de 5 barra pagamento cartao cartão de crédito credito debito cobrar conta corrente banco central fabrabam cnab ">
</head>

<BODY text=#000000 bgColor=#ffffff topMargin=0 rightMargin=0><CENTER>
<table width=666 cellspacing=0 cellpadding=0 border=0><tr><td valign=top class=cp><DIV ALIGN="CENTER">Instruções 
de Impressão</DIV></TD></TR><TR><TD valign=top class=ti><DIV ALIGN="CENTER">Imprimir 
em impressora jato de tinta (ink jet) ou laser em qualidade normal. (Não use modo 
econômico). <BR>Utilize folha A4 (210 x 297 mm) ou Carta (216 x 279 mm) - Corte 
na linha indicada<BR></DIV></td></tr></table><br><table cellspacing=0 cellpadding=0 width=666 border=0><TBODY><TR><TD class=ct width=666><img height=1 src=img/6.gif width=665 border=0></TD></TR><TR><TD class=ct width=666><div align=right><b class=cp>Recibo 
do Sacado</b></div></TD></tr></tbody></table><table width=666 cellspacing=5 cellpadding=0 border=0><tr><td width=41></TD></tr></table>
<table width=666 cellspacing=5 cellpadding=0 border=0 align=Default>
  <tr>
    <td><IMG SRC="img/logo_cryogene.jpg"></td>
	<TR>
    <td class=ti>  Cryogene® - Criogenia Biológica Ltda.<BR>
Rua Olavo Bilac, 524 - Batel - Curitiba - PR - CEP 80440-040<BR>
Fone: (41) 3014 - 3009<BR>
      <br>
    </td>
    <td align=RIGHT width=150 class=ti>&nbsp;</td>
  </tr>
</table>
<BR><table cellspacing=0 cellpadding=0 width=666 border=0><tr><td class=cp width=150> 
  <span class="campo"><IMG 
      src="img/logoitau.jpg" width="150" height="40" 
      border=0></span></td>
<td width=3 valign=bottom><img height=22 src=img/3.gif width=2 border=0></td><td class=cpt width=58 valign=bottom><div align=center><font class=bc><?=$codigobanco?></font></div></td><td width=3 valign=bottom><img height=22 src=img/3.gif width=2 border=0></td><td class=ld align=right width=453 valign=bottom><span class=ld> 
<span class="campotitulo">
<?=$dadosboleto["linha_digitavel"]?>
</span></span></td>
</tr><tbody><tr><td colspan=5><img height=2 src=img/2.gif width=666 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=298 height=13>Cedente</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=126 height=13>Agência/Código 
do Cedente</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=2 border=0></td><td class=ct valign=top width=34 height=13>Espécie</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=53 height=13>Quantidade</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=120 height=13>Nosso 
número</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=298 height=12> 
  <span class="campo"><? echo $dadosboleto["cedente"]; ?></span></td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=126 height=12> 
  <span class="campo">
  <?=$agencia?> / <?=$conta?>-<?=$conta_dv ?>
  </span></td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=34 height=12><span class="campo">
  <?='R$'?>
</span> 
 </td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=53 height=12><span class="campo">
  <?='-'?>
</span> 
 </td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=120 height=12> 
  <span class="campo">
  <?=$carteira.' / '.$nossonumero?>
  </span></td>
</tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=298 height=1><img height=1 src=img/2.gif width=298 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=126 height=1><img height=1 src=img/2.gif width=126 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=34 height=1><img height=1 src=img/2.gif width=34 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=53 height=1><img height=1 src=img/2.gif width=53 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=120 height=1><img height=1 src=img/2.gif width=120 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top colspan=3 height=13>Número 
do documento</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=132 height=13>CPF/CNPJ do CEDENTE</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=134 height=13>Vencimento</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>Valor 
documento</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top colspan=3 height=12> 
  <span class="campo">
  <?=$numero_documento?>
  </span></td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=132 height=12> 
  <span class="campo">
  05.438.607/0001-71
  </span></td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=134 height=12> 
  <span class="campo">
  <?=$vencimento?>
  </span></td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12> 
  <span class="campo">
  <?=$valor?>
  </span></td>
</tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=113 height=1><img height=1 src=img/2.gif width=113 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=72 height=1><img height=1 src=img/2.gif width=72 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=132 height=1><img height=1 src=img/2.gif width=132 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=134 height=1><img height=1 src=img/2.gif width=134 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=113 height=13>(-) 
Desconto / Abatimentos</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=112 height=13>(-) 
Outras deduções</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=113 height=13>(+) 
Mora / Multa</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=113 height=13>(+) 
Outros acréscimos</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>(=) 
Valor cobrado</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=113 height=12></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=112 height=12></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=113 height=12></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=113 height=12></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12></td></tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=113 height=1><img height=1 src=img/2.gif width=113 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=112 height=1><img height=1 src=img/2.gif width=112 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=113 height=1><img height=1 src=img/2.gif width=113 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=113 height=1><img height=1 src=img/2.gif width=113 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=659 height=13>Sacado</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=659 height=12> 
  <span class="campo">
  <?=$sacado?>
  </span></td>
</tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=659 height=1><img height=1 src=img/2.gif width=659 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct  width=7 height=12></td><td class=ct  width=564 >Instruções</td><td class=ct  width=7 height=12></td><td class=ct  width=88 >Autenticação 
mecânica</td></tr><tr><td  width=7 ></td><td  width=564 ></td><td  width=7 ></td><td  width=88 ></td></tr></tbody></table><table cellspacing=0 cellpadding=0 width=666 border=0><tbody><tr><td width=7></td><td  width=500 class=cp> 
<br><br><br><br> 
</td><td width=159></td></tr></tbody></table><table cellspacing=0 cellpadding=0 width=666 border=0><tr><td class=ct width=666></td></tr><tbody><tr><td class=ct width=666> 
<div align=right>Corte na linha pontilhada</div></td></tr><tr><td class=ct width=666><img height=1 src=img/6.gif width=665 border=0></td></tr></tbody></table><br><br><table cellspacing=0 cellpadding=0 width=666 border=0><tr><td class=cp width=150> 
  <span class="campo"><IMG 
      src="img/logoitau.jpg" width="150" height="40" 
      border=0></span></td>
<td width=3 valign=bottom><img height=22 src=img/3.gif width=2 border=0></td><td class=cpt width=58 valign=bottom><div align=center><font class=bc><?=$codigobanco?></font></div></td><td width=3 valign=bottom><img height=22 src=img/3.gif width=2 border=0></td><td class=ld align=right width=453 valign=bottom><span class=ld> 
<span class="campotitulo">
<?=$numero_boleto;?>
</span></span></td>
</tr><tbody><tr><td colspan=5><img height=2 src=img/2.gif width=666 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=472 height=13>Local 
de pagamento</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>Vencimento</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=472 height=12>Pagável 
em qualquer Banco até o vencimento</td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12> 
  <span class="campo">
  <?=$vencimento?>
  </span></td>
</tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=472 height=1><img height=1 src=img/2.gif width=472 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=472 height=13>Cedente</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>Agência/Código 
cedente</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=472 height=12> 
  <span class="campo">
  <?=$cedente?>
  </span></td>
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12> 
  <span class="campo">
  <?=$agencia?> / <?=$conta?>-<?=$conta_dv ?>
  </span></td>
</tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=472 height=1><img height=1 src=img/2.gif width=472 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13> 
<img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=113 height=13>Data 
do documento</td><td class=ct valign=top width=7 height=13> <img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=163 height=13>N<u>o</u> 
documento</td><td class=ct valign=top width=7 height=13> <img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=62 height=13>Espécie 
doc.</td><td class=ct valign=top width=7 height=13> <img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=34 height=13>Aceite</td><td class=ct valign=top width=7 height=13> 
<img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=72 height=13>Data 
processamento</td><td class=ct valign=top width=7 height=13> <img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>Nosso 
número</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=113 height=12><div align=left> 
  <span class="campo">
  <?=$data?>
  </span></div></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=163 height=12> 
    <span class="campo">
    <?=$numero_documento?>
    </span></td>
  <td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=62 height=12><div align=left><span class="campo">
    <?='R$'?>
  </span> 
 </div></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=34 height=12><div align=left><span class="campo">
 <?=$aceite?>
 </span> 
 </div></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=72 height=12><div align=left> 
   <span class="campo">
   <?=$data?>
   </span></div></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12> 
     <span class="campo">
     <?=$carteira.' / '.$nossonumero?>
     </span></td>
</tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=113 height=1><img height=1 src=img/2.gif width=113 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=163 height=1><img height=1 src=img/2.gif width=163 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=62 height=1><img height=1 src=img/2.gif width=62 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=34 height=1><img height=1 src=img/2.gif width=34 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=72 height=1><img height=1 src=img/2.gif width=72 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1> 
<img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr> 
<td class=ct valign=top width=7 height=13> <img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top COLSPAN="3" height=13>Uso 
do banco</td><td class=ct valign=top height=13 width=7> <img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=83 height=13>Carteira</td><td class=ct valign=top height=13 width=7> 
<img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=53 height=13>Espécie</td><td class=ct valign=top height=13 width=7> 
<img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=123 height=13>Quantidade</td><td class=ct valign=top height=13 width=7> 
<img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=72 height=13> 
Valor Documento</td><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>(=) 
Valor documento</td></tr><tr> <td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td valign=top class=cp height=12 COLSPAN="3"><div align=left> 
 </div></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=83> 
<div align=left> <span class="campo">
  <?=$carteira?>
  <?=$variacao_carteira?>
</span></div></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=53><div align=left><span class="campo">
<?='R$'?>
</span> 
 </div></td><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=123><span class="campo">
 <?=''?>
 </span> 
 </td>
 <td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top  width=72> 
   <span class="campo">
   <?=''?>
   </span></td>
 <td class=cp valign=top width=7 height=12> <img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12> 
   <span class="campo">
   <?=$valor?>
   </span></td>
</tr><tr><td valign=top width=7 height=1> <img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=75 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=31 height=1><img height=1 src=img/2.gif width=31 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=83 height=1><img height=1 src=img/2.gif width=83 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=53 height=1><img height=1 src=img/2.gif width=53 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=123 height=1><img height=1 src=img/2.gif width=123 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=72 height=1><img height=1 src=img/2.gif width=72 border=0></td><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody> 
</table><table cellspacing=0 cellpadding=0 width=666 border=0><tbody><tr><td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left><tbody> 
<tr> <td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td></tr><tr> 
<td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td></tr><tr> 
<td valign=top width=7 height=1><img height=1 src=img/2.gif width=1 border=0></td></tr></tbody></table></td><td valign=top width=468 rowspan=5><font class=ct>Instruções 
(Texto de responsabilidade do cedente)</font><br><span class=cp> <FONT class=campo><? echo $dadosboleto["instrucoes"]; ?><br>
<? echo $instrucoes1; ?><br>
<? echo $instrucoes2; ?><br>
<? echo $instrucoes3; ?><br>
<? echo $instrucoes4; ?>
<? echo $obs; ?></FONT><br><br> 
</span></td>
<td align=right width=188><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>(-) 
Desconto / Abatimentos</td></tr><tr> <td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12></td></tr><tr> 
<td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table></td></tr><tr><td align=right width=10> 
<table cellspacing=0 cellpadding=0 border=0 align=left><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td></tr><tr><td valign=top width=7 height=1> 
<img height=1 src=img/2.gif width=1 border=0></td></tr></tbody></table></td><td align=right width=188><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>(-) 
Outras deduções</td></tr><tr><td class=cp valign=top width=7 height=12> <img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12></td></tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table></td></tr><tr><td align=right width=10> 
<table cellspacing=0 cellpadding=0 border=0 align=left><tbody><tr><td class=ct valign=top width=7 height=13> 
<img height=13 src=img/1.gif width=1 border=0></td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td></tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=1 border=0></td></tr></tbody></table></td><td align=right width=188> 
<table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>(+) 
Mora / Multa</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12></td></tr><tr> 
<td valign=top width=7 height=1> <img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1> 
<img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table></td></tr><tr><td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left><tbody><tr> 
<td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td></tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=1 border=0></td></tr></tbody></table></td><td align=right width=188> 
<table cellspacing=0 cellpadding=0 border=0><tbody><tr> <td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>(+) 
Outros acréscimos</td></tr><tr> <td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12></td></tr><tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table></td></tr><tr><td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td></tr></tbody></table></td><td align=right width=188><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>(=) 
Valor cobrado</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top align=right width=180 height=12></td></tr></tbody> 
</table></td></tr></tbody></table><table cellspacing=0 cellpadding=0 width=666 border=0><tbody><tr><td valign=top width=666 height=1><img height=1 src=img/2.gif width=666 border=0></td></tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=659 height=13>Sacado</td></tr><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=659 height=12><span class="campo">
<?=$sacado?>
</span> 
</td>
</tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=cp valign=top width=7 height=12><img height=12 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=659 height=12><span class="campo">
<?=$endereco_sacado?>
</span> 
</td>
</tr></tbody></table><table cellspacing=0 cellpadding=0 border=0><tbody><tr><td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=cp valign=top width=472 height=13> 
  <span class="campo">
  <?=$cidade.' '.$estado.' '.$cep?>
  <BR>
  <?=$cpf_cnpj?>
  </span></td>
<td class=ct valign=top width=7 height=13><img height=13 src=img/1.gif width=1 border=0></td><td class=ct valign=top width=180 height=13>Cód. 
baixa</td></tr>
<tr><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=472 height=1><img height=1 src=img/2.gif width=472 border=0></td><td valign=top width=7 height=1><img height=1 src=img/2.gif width=7 border=0></td><td valign=top width=180 height=1><img height=1 src=img/2.gif width=180 border=0></td></tr></tbody></table>
<TABLE cellSpacing=0 cellPadding=0 border=0 width=666><TBODY><TR><TD class=ct  width=7 height=12></TD><TD class=ct  width=409 >Sacador/Avalista</TD><TD class=ct  width=250 ><div align=right>Autenticação 
mecânica - <b class=cp>Ficha de Compensação</b></div></TD></TR>
<TR><TD class=ct  colspan=3 ></TD></tr></tbody></table><TABLE cellSpacing=0 cellPadding=0 width=666 border=0><TBODY><TR><TD vAlign=bottom align=left height=50>
<img src="boleto_itau/codigodebarra.php?valor=<? print $codigo_barras; ?>">
 </TD>
</tr></tbody></table>
</BODY></HTML>
