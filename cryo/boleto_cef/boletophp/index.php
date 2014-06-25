<?php
// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto CEF: Elizeu Alcantara         		          |
// +----------------------------------------------------------------------+

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 0.0;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = troca($valor,',',''); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$nosso = $nossonumero;
$nosso = 400000 + intval("0".$nosso);
$dadosboleto["nosso_numero"] = "00".$nosso;  // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!


$dadosboleto["inicio_nosso_numero"] = "80";  // Carteira SR: 80, 81 ou 82  -  Carteira CR: 90 (Confirmar com gerente qual usar)
//$dadosboleto["nosso_numero"] = "39525086";  // Nosso numero sem o DV - REGRA: Máximo de 8 caracteres!
//$dadosboleto["numero_documento"] = $nossonumero.'-'.$dadosboleto["nosso_numero"];	// Num do pedido ou do documento
$dadosboleto["numero_documento"] = $numero_documento;
$dadosboleto["data_vencimento"] = $vencimento; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = $data; // Data de emissão do Boleto
$dadosboleto["data_processamento"] = $data; // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $sacado;
$dadosboleto["endereco1"] = $endereco_sacado;
$dadosboleto["endereco2"] = $cidade;

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Contrato de Armazenamento";
if ($txbc > 0) { $dadosboleto["demonstrativo2"] = "Valor Unitário<br>Taxa bancária - R$ ".$taxa_boleto; } else { $dadosboleto["demonstrativo2"] = '<BR>&nbsp;'; } 
$dadosboleto["demonstrativo3"] = "http://www.cryogene.inf.br";

// INSTRUÇÕES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = "- Receber até 10 dias após o vencimento";
$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: info@cryogene.com.br";
$dadosboleto["instrucoes4"] = $obs;

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - CEF
//$dadosboleto["agencia"] = "1565"; // Num da agencia, sem digito
$dadosboleto["agencia"] = "0368"; // Num da agencia, sem digito

//$dadosboleto["conta"] = "13877"; 	// Num da conta, sem digito
//$dadosboleto["conta_dv"] = "4"; 	// Digito do Num da conta

$dadosboleto["conta"] = "22222"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "2"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - CEF
//$dadosboleto["conta_cedente"] = "87000000414"; // ContaCedente do Cliente, sem digito (Somente Números)
$dadosboleto["conta_cedente"] = "87000000380"; // ContaCedente do Cliente, sem digito (Somente Números)

//$dadosboleto["conta_cedente_dv"] = "3"; // Digito da ContaCedente do Cliente
$dadosboleto["conta_cedente_dv"] = "1"; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "SR";  // Código da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

// SEUS DADOS
$dadosboleto["identificacao"] = "Cryogene® - Criogenia Biológica Ltda.";
$dadosboleto["cpf_cnpj"] = "05.438.607/0001-71";
$dadosboleto["endereco"] = "Rua Olavo Bilac, 524 - Batel - ";
$dadosboleto["cidade_uf"] = "Curitiba - PR - CEP 80440-040";
$dadosboleto["cedente"] = "Cryogene - Criogenia Biológica Ltda";

// NÃO ALTERAR!
include("include/funcoes_cef.php"); 
include("include/layout_cef.php");
?>
