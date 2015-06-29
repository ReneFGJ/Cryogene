<?php
require("db.php");

require('_class/_class_documentos.php');
$doc = new documento;

$txt = '
<style>
body
	{
		font-family: Arial, Tahoma, Verdana;
		font-size: 12px;
	}
</style>
<body>
<B>Assinam o presente Instrumento</B>:
(a) de um lado, CRYOGENE - Criogenia Biológica Ltda., sociedade limitada, com sede na Rua José Czaki, 292, Thomas Coelho, na Cidade de Araucária, PR, inscrita no CNPJ/MF sob o n° 05.438.607/0001-71, e filial na Rua Olavo Bilac, 524, Batel, na cidade de Curitiba, PR, inscrita no CNPJ/MF sob o n° 05.438.607/0002-52 neste ato representada na forma de seu contrato social, doravante denominada CRYOGENE; e
(b) de outro lado,
<table>
<TR><TD>
Nome do Pai: Marcio Kuzmicz
<TR><TD>
Estado Civil: Casado	Nacionalidade: Brasileira	Profissão: Médico
<TR><TD>
RG n°: 5.197.669-0	CPF/MF n.: 888.840.079-68
<TR><TD>
Endereço: Rua Jacob Wellner, 215
<TR><TD>
Bairro: Vista Alegre	Município: Curitiba	Estado: PR
<TR><TD>
E-mail: marciokuzmicz@hotmail.com
<TR><TD>
Telefones
<TR><TD>
Fixo: (41) 3019-5009
<TR><TD>	
Celular: (41) 9619-8033
<TR><TD>	
Comercial:
<TR><TD>
</table> 

Outra referência para contato:
Nome: Antonio Kuzmicz	Telefone: (41) 3335-6126
Endereço: Rua Elias João Zaruch, 110
Bairro: Pilarzinho	Município: Curitiba	Estado: PR

e
Nome da Mãe: Renata Becker Damiani Kuzmicz
Estado Civil: Casada	Nacionalidade: Brasileira	Profissão: Fisioterapeuta
RG n°: 6.628.298-8	CPF/MF n.: 027.088.639-75
Endereço: Rua Jacob Wellner, 215
Bairro: Vista Alegre	Município: Curitiba	Estado: PR
E-mail: renatadamiani@bol.com.br
Telefones
Fixo: (41) 3019-5009	
Celular: (41) 9196-9905	
Comercial: 

Outra referência para contato:
Nome: José Carlos Nolf Damiani	Telefone: (41) 3257-3786
Endereço: Rua Lodovico Geronazzo, 1945
Bairro: Boa Vista	Município: Curitiba	Estado: PR

doravante denominados, conjuntamente, CONTRATANTES, ambos integrando o presente, na qualidade de representantes legais do nascituro em gestação na segunda CONTRATANTE, o qual adiante será simplesmente denominado BENEFICIÁRIO, têm entre si pactuado, na melhor forma de direito, o presente Contrato, que se constitui nos termos e cláusulas a seguir.
CONSIDERANDO que se espera que o número limitado de células-tronco presentes no organismo de pessoas adultas possa ser suprido pela extração de cordões umbilicais de neonatos, armazenados sob regime de criopreservação deste material biológico;
CONSIDERANDO que a criopreservação é um método que pode armazenar células-tronco por período 
';

echo $doc->export_to_word(strlen($txt),'contrato_0001.docx');
echo $txt;
?>
