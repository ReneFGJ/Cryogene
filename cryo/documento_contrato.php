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
(a) de um lado, CRYOGENE - Criogenia Biol�gica Ltda., sociedade limitada, com sede na Rua Jos� Czaki, 292, Thomas Coelho, na Cidade de Arauc�ria, PR, inscrita no CNPJ/MF sob o n� 05.438.607/0001-71, e filial na Rua Olavo Bilac, 524, Batel, na cidade de Curitiba, PR, inscrita no CNPJ/MF sob o n� 05.438.607/0002-52 neste ato representada na forma de seu contrato social, doravante denominada CRYOGENE; e
(b) de outro lado,
<table>
<TR><TD>
Nome do Pai: Marcio Kuzmicz
<TR><TD>
Estado Civil: Casado	Nacionalidade: Brasileira	Profiss�o: M�dico
<TR><TD>
RG n�: 5.197.669-0	CPF/MF n.: 888.840.079-68
<TR><TD>
Endere�o: Rua Jacob Wellner, 215
<TR><TD>
Bairro: Vista Alegre	Munic�pio: Curitiba	Estado: PR
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

Outra refer�ncia para contato:
Nome: Antonio Kuzmicz	Telefone: (41) 3335-6126
Endere�o: Rua Elias Jo�o Zaruch, 110
Bairro: Pilarzinho	Munic�pio: Curitiba	Estado: PR

e
Nome da M�e: Renata Becker Damiani Kuzmicz
Estado Civil: Casada	Nacionalidade: Brasileira	Profiss�o: Fisioterapeuta
RG n�: 6.628.298-8	CPF/MF n.: 027.088.639-75
Endere�o: Rua Jacob Wellner, 215
Bairro: Vista Alegre	Munic�pio: Curitiba	Estado: PR
E-mail: renatadamiani@bol.com.br
Telefones
Fixo: (41) 3019-5009	
Celular: (41) 9196-9905	
Comercial: 

Outra refer�ncia para contato:
Nome: Jos� Carlos Nolf Damiani	Telefone: (41) 3257-3786
Endere�o: Rua Lodovico Geronazzo, 1945
Bairro: Boa Vista	Munic�pio: Curitiba	Estado: PR

doravante denominados, conjuntamente, CONTRATANTES, ambos integrando o presente, na qualidade de representantes legais do nascituro em gesta��o na segunda CONTRATANTE, o qual adiante ser� simplesmente denominado BENEFICI�RIO, t�m entre si pactuado, na melhor forma de direito, o presente Contrato, que se constitui nos termos e cl�usulas a seguir.
CONSIDERANDO que se espera que o n�mero limitado de c�lulas-tronco presentes no organismo de pessoas adultas possa ser suprido pela extra��o de cord�es umbilicais de neonatos, armazenados sob regime de criopreserva��o deste material biol�gico;
CONSIDERANDO que a criopreserva��o � um m�todo que pode armazenar c�lulas-tronco por per�odo 
';

echo $doc->export_to_word(strlen($txt),'contrato_0001.docx');
echo $txt;
?>
