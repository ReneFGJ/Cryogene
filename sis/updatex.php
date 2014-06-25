<?php
require("cab.php");
$dr = $dd[50];

if ($dd[0] == 'recibo')
    {$dx1 = "rb_numero";    $dx2 = "rb";     $dx3 = "7";    $dr = "ed_recibo.php"; }


/////////// Contrato modelo
if ($dd[0] == 'mail')
    {$dx1 = "mail_codigo";    $dx2 = "mail";     $dx3 = "5";    $dr = "ed_mail.php"; }
if ($dd[0] == 'mail_pg')
    {$dx1 = "mpg_codigo";    $dx2 = "mpg";     $dx3 = "5";    $dr = 'ed_mail_pg.php'; $dd[0] = "mail_pg"; }

/////////// Contrato modelo
if ($dd[0] == 'proposta_contrato')
    {$dx1 = "ppc_codigo";    $dx2 = "ppc";     $dx3 = "7";    $dr = "emite_contrato.php"; }

if ($dd[0] == 'contrato_tipo')
    {$dx1 = "sp_codigo";    $dx2 = "sp";     $dx3 = "5";    $dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'contrato_field')
    {$dx1 = "sub_codigo";    $dx2 = "sub";     $dx3 = "5";    $dr = "ed_".$dd[0].".php"; }


if ($dd[0] == 'mailing')
    {$dx1 = "ml_codigo";    $dx2 = "ml";     $dx3 = "7";    $dr = "ed_mailing.php"; }

if ($dd[0] == 'iso_pesquisa_field')
    {$dx1 = "";    $dx2 = "";     $dx3 = "";    $dr = "ed_iso_pesquisa_field.php"; }

if ($dd[0] == 'noticia')
    {$dx1 = "";    $dx2 = "";     $dx3 = "";    $dr = "ed_mensagem.php"; }

if ($dd[0] == 'nitro_entrada')
    {$dx1 = "";    $dx2 = "";     $dx3 = "";    $dr = "ed_nitrogenio_tanque.php"; }

if ($dd[0] == 'nitrogenio_tanque')
    {$dx1 = "tq_codigo";    $dx2 = "tq";     $dx3 = "3";    $dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'check_list')
    {$dx1 = "chk_codigo";    $dx2 = "chk";     $dx3 = "5";    $dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'parceiros')
    {$dx1 = "us_cracha";    $dx2 = "us";     $dx3 = "5";    $dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'medico')
    {$dx1 = "md_codigo";    $dx2 = "md";     $dx3 = "7";    $dr = "par_medicos.php"; }

if ($dd[0] == 'medicos')
    {$dx1 = "md_codigo";    $dx2 = "md";     $dx3 = "7";    $dr = "ed_medico.php"; $dd[0] = 'medico'; }

if ($dd[0] == 'cliente')
    {$dx1 = "cl_codigo";    $dx2 = "cl";     $dx3 = "7";    $dr = "cliente.php"; }
   
require("updatex_iso.php");   

if ($dd[0] == 'contrato_check_list')
    { ?><script> close(); </script><? $dr = ''; }

if ($dd[0] == 'contrato_medico')
    { $dx1 = ''; $dr = "par_contrato.php"; }
   
if (strlen($dx1) > 0)
    {   
    $sql = "update ".$dd[0]." set ".$dx1."=trim(to_char(id_".$dx2.",'".strzero(0,$dx3)."')) where (length(trim(".$dx1.")) < ".$dx3.") or (".$dx1." isnull);";
    $sql = "update ".$dd[0]." set ".$dx1."=lpad(id_".$dx2.",$dx3,0) where (length(trim(".$dx1.")) < ".$dx3.");";
    echo $sql;
    $rlt = db_query($sql);
    }
if (strlen($dr) > 0)
    {
    header("Location: ".$dr);   
    echo 'Stoped'; exit;
    }
?>