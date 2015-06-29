<? require("db.php"); ?>
<? require("ic_db.php"); ?>
<? require("include/sisdoc_colunas.php"); ?>
<? require("include/sisdoc_form2.php"); ?>
<? require("include/sisdoc_data.php"); ?>
<?
$id_msg = $dd[98];
if (strlen($dd[98]) == 0) { $id_msg = "IC-CONF"; }
$sql = "select * from ic_noticia ";
$sql = $sql . " where nw_ref='".$id_msg."'";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{ $texto2 = mst($line['nw_descricao']); }
	
$id_msg = $dd[97];
if (strlen($dd[97]) == 0) { $id_msg = "IC-EMAIL"; }
$sql = "select * from ic_noticia ";
$sql = $sql . " where nw_ref='".$id_msg."'";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{ $texto = mst($line['nw_descricao']); $titulo_mst = $line['nw_titulo']; }

if (strlen($dd[96]) > 0) { $email_adm = $dd[96]; }
if (strlen($email_adm) ==0) { $email_adm = 'reol@sisdoc.com.br'; }
if (strlen($email_adm_nome) ==0) { $email_adm_nome = $email_adm; }

send_mail($dd[1], $texto, $titulo_mst, $email_adm, $email_adm_nome, $attachments=false);
send_mail('rene@fonzaghi.com.br', $dd[3], $dd[4], $dd[2], $dd[1], $attachments=false);

if (strlen(trim($dd[99])) == 0)	{ $dd[99] = 'index.php'; }
redirect($dd[99]);
?>

<?php
function send_mail($to, $body, $subject, $fromaddress, $fromname, $attachments=false)
{
	global $dd;
  $eol="\r\n";
  $mime_boundary=md5(time());

  # Common Headers
  $headers .= "From: ".$fromname."<".$fromaddress.">".$eol;
//  $headers .= "Reply-To: ".$fromname."<".$fromaddress.">".$eol;
  $headers .= "Return-Path: ".$fromname."<".$fromaddress.">".$eol;    // these two to set reply address
//  $headers .= "Message-ID: <".time()."-".$fromaddress.">".$eol;
  
  $msg .= 'De :'.$fromname.' <'.$fromaddress.'>'.$eol;
  $msg .= 'Assunto :'.$subject.$eol;

  $msg .= ''.$eol;
  for ($kk=0;$kk < 40;$kk++)
  	{
	if (strlen($dd[$kk]) > 0)
		{ $msg .= $dd[$kk+50].'==>'.$dd[$kk].$eol.$eol; }
	}
  
  
//  $headers .= "X-Mailer: PHP v".phpversion().$eol;          // These two to help avoid spam-filters
//  $headers .= "Content-Type: text/html; charset=iso-8859-1".$eol;
  # Boundry for marking the split & Multitype Headers
//  $headers .= 'MIME-Version: 1.0'.$eol.$eol;
//  $headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\"".$eol.$eol;

  # Open the first part of the mail
//  $msg = "--".$mime_boundary.$eol;
 
//  $htmlalt_mime_boundary = $mime_boundary."_htmlalt"; //we must define a different MIME boundary for this section
  # Setup for text OR html -
//  $msg .= "Content-Type: multipart/alternative; boundary=\"".$htmlalt_mime_boundary."\"".$eol.$eol;

  # Text Version
//  $msg .= "--".$htmlalt_mime_boundary.$eol;
//  $msg .= "Content-Type: text/plain; charset=iso-8859-1".$eol;
//  $msg .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
//  $msg .= strip_tags(str_replace("<br>", "\n", substr($body, (strpos($body, "<body>")+6)))).$eol.$eol;

  # HTML Version
//  $msg .= "--".$htmlalt_mime_boundary.$eol;
//  $msg .= "Content-Type: text/html; charset=iso-8859-1".$eol;
//  $msg .= "Content-Transfer-Encoding: 8bit".$eol.$eol;

  //close the html/plain text alternate portion
//  $msg .= "--".$htmlalt_mime_boundary."--".$eol.$eol;

//  if ($attachments !== false)
//  {
//    for($i=0; $i < count($attachments); $i++)
//    {
//      if (is_file($attachments[$i]["file"]))
//      {  
//        # File for Attachment
//        $file_name = substr($attachments[$i]["file"], (strrpos($attachments[$i]["file"], "/")+1));
//       
//        $handle=fopen($attachments[$i]["file"], 'rb');
//        $f_contents=fread($handle, filesize($attachments[$i]["file"]));
//        $f_contents=chunk_split(base64_encode($f_contents));    //Encode The Data For Transition using base64_encode();
//        $f_type=filetype($attachments[$i]["file"]);
//        fclose($handle);
//       
//        # Attachment
//        $msg .= "--".$mime_boundary.$eol;
//        $msg .= "Content-Type: ".$attachments[$i]["content_type"]."; name=\"".$file_name."\"".$eol;  // sometimes i have to send MS Word, use 'msword' instead of 'pdf'
//        $msg .= "Content-Transfer-Encoding: base64".$eol;
//        $msg .= "Content-Description: ".$file_name.$eol;
//        $msg .= "Content-Disposition: attachment; filename=\"".$file_name."\"".$eol.$eol; // !! This line needs TWO end of lines !! IMPORTANT !!
//        $msg .= $f_contents.$eol.$eol;
//      }
//    }
//  }

//  # Finished
//  $msg .= "--".$mime_boundary."--".$eol.$eol;  // finish with two eol's for better security. see Injection.
// 
//  # SEND THE EMAIL
  ini_set(sendmail_from,$fromaddress);  // the INI lines are to force the From Address to be used !
  $mail_sent = mail($to, $subject, $msg, $headers);
 
  ini_restore(sendmail_from);
 
  return $mail_sent;
}
?>