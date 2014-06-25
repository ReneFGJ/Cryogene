<?php
$debug = true;
require("db.php");

$data_submit = date("d/m/Y");
$versao_pdf = '0.0a';
$nr_submit = strzero(54,7);

$cpfp = "729.521.059-87";
$endep="Rua Padre Agostinho, 2885 ap.1203B";
$cidap="Curitiba";
$estap="PR";
$nascp="Brasileiro";
$profp="Tec. eletrônico";
$rgp="3.825.355.7-PR";
$estap="casado";
$emaip="rene@sisdoc.com.br";

require("emite_contrato_modelo_pdf_2.php");
?>
