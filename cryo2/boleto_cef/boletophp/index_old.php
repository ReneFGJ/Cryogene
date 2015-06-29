<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				  |
// | 																	  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto CEF: Elizeu Alcantara         		          |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 0.25;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = "1,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$nosso = $_GET['dd0'];
$nosso = 400004 + intval("0".$nosso);
$dadosboleto["nosso_numero"] = "00".$nosso;  // Nosso numero sem o DV - REGRA: M�ximo de 8 caracteres!


$dadosboleto["inicio_nosso_numero"] = "80";  // Carteira SR: 80, 81 ou 82  -  Carteira CR: 90 (Confirmar com gerente qual usar)
//$dadosboleto["nosso_numero"] = "39525086";  // Nosso numero sem o DV - REGRA: M�ximo de 8 caracteres!
$dadosboleto["numero_documento"] = "27.030195.10";	// Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = "Cryogene� - Criogenia Biol�gica Ltda.";
$dadosboleto["endereco1"] = "Endere�o do seu Cliente";
$dadosboleto["endereco2"] = "Cidade - Estado -  CEP: 00000-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Contrato de Armazenamento";
$dadosboleto["demonstrativo2"] = "Valor Unit�rio<br>Taxa banc�ria - R$ ".$taxa_boleto;
$dadosboleto["demonstrativo3"] = "http://www.cryogene.inf.br";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% ap�s o vencimento";
$dadosboleto["instrucoes2"] = "- Receber at� 10 dias ap�s o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de d�vidas entre em contato conosco: xxxx@xxxx.com.br";
$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - CEF
//$dadosboleto["agencia"] = "1565"; // Num da agencia, sem digito
$dadosboleto["agencia"] = "0368"; // Num da agencia, sem digito

//$dadosboleto["conta"] = "13877"; 	// Num da conta, sem digito
//$dadosboleto["conta_dv"] = "4"; 	// Digito do Num da conta

$dadosboleto["conta"] = "22222"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "2"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - CEF
//$dadosboleto["conta_cedente"] = "87000000414"; // ContaCedente do Cliente, sem digito (Somente N�meros)
  $dadosboleto["conta_cedente"] = "87000000380"; // ContaCedente do Cliente, sem digito (Somente N�meros)

//$dadosboleto["conta_cedente_dv"] = "3"; // Digito da ContaCedente do Cliente
  $dadosboleto["conta_cedente_dv"] = "1"; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "SR";  // C�digo da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

// SEUS DADOS
$dadosboleto["identificacao"] = "Cryogene� - Criogenia Biol�gica Ltda.";
$dadosboleto["cpf_cnpj"] = "";
$dadosboleto["endereco"] = "Rua Olavo Bilac, 524 - Batel - ";
$dadosboleto["cidade_uf"] = "Curitiba - PR - CEP 80440-040";
$dadosboleto["cedente"] = "Coloque a Raz�o Social da sua empresa aqui";

// N�O ALTERAR!
include("include/funcoes_cef.php"); 
include("include/layout_cef.php");
?>