<?
require('wb_cab.php');
set_time_limit(600);
require('include/sisdoc_data.php');
//$debug = true;
$email_bom = array();
$email_ruim = array();
$dd[1] = $dd[1] . chr(13) . $dd[2];

//$sql = "delete from mailing ";
//$rlt = db_query($sql);

$bb1 = 'confirmar importação';

if (strlen($dd[1]) > 2)
	{
	$zz = $dd[1].chr(13).chr(10);
	$lista = array();
	}
	$pos = strpos($zz,chr(13));
	
	while (!($pos === false))
		{
		$email = trim(substr($zz,0,$pos));
		$xmail = checaemail($email);
		if ($xmail == true)
			{ array_push($email_bom,$email); }
			else
			{ 
			if (strlen(trim($email)) > 3) {	array_push($email_ruim,$email); } 
			}
			
		$zz = substr($zz,$pos+1,strlen($zz));
		$pos = strpos($zz,chr(13));
		}


if ((count($email_bom) >0) and (count($email_ruim) ==0))
	{
	if ($acao == $bb1)
		{
		echo '<TABLE width="710" align="center" border="1" class="lt1">';
		for ($kkk=0;$kkk < count($email_bom); $kkk++)
			{
			$email = $email_bom[$kkk];
			$sql = "select * from mailing where ml_email='".trim($email)."'";
			$result = db_query($sql);
			if (!($line = db_read($result)))
				{
				$nome = substr($email,0,strpos($email,'@'));
				$sql = "insert into mailing (";
				$sql = $sql . 'ml_data,ml_email,ml_valido,ml_ativo,ml_nome';
				$sql = $sql . ') values (';
				$sql = $sql . "'".date("Ymd")."','".$email."',1,1,'".$nome."'";
				$sql .= ")";
				$result = db_query($sql);
				echo "<BR>".$email.' gravado';				
				}
			}
		echo '</TABLE>';
		exit;
		}
	}

?>
<CENTER>
<TABLE width="710" align="center" border="1" class="lt1">
<TR><TD><form method="post" action="<?=$path?>"></TD>
<input type="hidden" name="dd99" value="admin">
<input type="hidden" name="dd98" value="email"></TR>
<TR valign="top"><TD><?=CharE('Importação de e-mail');?></TD>
<?
?>
<TD>
<?=count($email_ruim)?> e-mail incorretos<BR>
<textarea cols="55" rows="6" name="dd1" wrap="off"><?
	for ($kkk=0;$kkk < count($email_ruim); $kkk++)
	{
	echo $email_ruim[$kkk].chr(13);
	}
	?>
</textarea>
<P><?=count($email_bom)?> e-mail aprovados<BR>
<textarea cols="55" rows="4" name="dd2" wrap="off" readonly><?
	for ($kkk=0;$kkk < count($email_bom); $kkk++)
	{
	echo $email_bom[$kkk].chr(13);
	}
	?>
</textarea>
<TR>
<TD>&nbsp;<TD>
<input type="submit" name="acao" value="importar lista">
&nbsp;
<?
if ((count($email_bom) >0) and (count($email_ruim) ==0))
	{
	echo '<input type="submit" name="acao" value="'.$bb1.'">';
	}
?>
</TD>
<TD></form></TD>
</TR>
</TABLE>

<?
function checaemail($chemail)
	{
	$result = count_chars($chemail, 0);
	
	if (($result[64] == 1) and ($result[32] == 0) and ($result[13] == 0) and ($result[10] == 0))
		{$xerr = True; }
	else
		{$xerr = False; }
		
	if ($chemail[strlen($chemail)-1] < 'a') { $xerr = false; }
	return($xerr);
	}
	?>
