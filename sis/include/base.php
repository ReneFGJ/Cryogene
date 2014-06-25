<?
require("sisdoc_char.php");
//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{
	$varf='dd'.$k;
	$varf=$vars[$varf];
	//if (isset($varf) and ($k > 1)) {	//$varf = str_replace($varf,"A","´"); }
	$dd[$k] = troca($varf,"'","´");
	}
$acao = $vars['acao'];
$nocab = $vars['nocab'];
$base = 'pgsql';
?>
<form method="post" action="base.php">
<textarea cols="70" rows="20" name="dd1">
 
</textarea><P>

<input type="submit" name="gerar">
</form>

<?
if (strlen($dd[1]) > 0)
	{
	$ln = array();
	$txt = troca($dd[1],chr(10),'#').'#';
	while ((strpos($txt,'#') >= 0) and (strlen($txt) > 10))
		{
		$tt = substr($txt,0,strpos($txt,'#')+1);
		$txt = substr($txt,strlen($tt),strlen($txt));
		array_push($ln,substr($tt,0,trim(strlen($tt)-1)));
		}
	}
	echo '<HR>'.count($ln).'<HR>';

	$tabela = '';
	$cpo = '';
	for ($k = 0; $k < count($ln); $k++)
		{
		$tt = $ln[$k];
		if (strpos($tt,'ATE TABLE') > 0)
			{
			$tabela = substr($tt,12,100);
			}
		/////////////////// CHAR
		if (strpos($tt,'char(') > 0)
			{
			$size = trim(substr($tt,strpos($tt,'char(')+5),3);
			$size = substr($size,0,strpos($size,')'));
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			if ($size == '1')
				{
				$cpo = $cpo . '$O : &S:Sim&N:Não';
				} else {
				$cpo = $cpo . '$S'.$size;
				}
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,'char(')-1));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,'char(')-1));
			$cpo = $cpo . "',False,True,''));";
			}
		/////////////////// CHAR
		if (strpos($tt,'character(') > 0)
			{
			$size = trim(substr($tt,strpos($tt,'character(')+10),3);
			$size = substr($size,0,strpos($size,')'));
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			if ($size == '1')
				{
				$cpo = $cpo . '$O : &S:Sim&N:Não';
				} else {
				$cpo = $cpo . '$S'.$size;
				}
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,'character(')-1));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,'character(')-1));
			$cpo = $cpo . "',False,True,''));";
			}
		/////////////////// text
		if (strpos($tt,' text') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$T70:7';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' text')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' text')));
			$cpo = $cpo . "',False,True,''));";
			}		
		/////////////////// int2
		if (strpos($tt,' int2') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$I2';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' int2')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' int2')));
			$cpo = $cpo . "',False,True,''));";
			}	
							
		/////////////////// int4
		if (strpos($tt,' int4') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$I4';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' int4')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' int4')));
			$cpo = $cpo . "',False,True,''));";
			}			

		/////////////////// int8
		if (strpos($tt,' int8') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$I8';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' int8')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' int8')));
			$cpo = $cpo . "',False,True,''));";
			}		
		/////////////////// float
		if (strpos($tt,' float2') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$N2';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' float2')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' float2')));
			$cpo = $cpo . "',False,True,''));";
			}	
							
		/////////////////// float4
		if (strpos($tt,' float4') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$N4';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' float4')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' float4')));
			$cpo = $cpo . "',False,True,''));";
			}			

		/////////////////// float8
		if (strpos($tt,' float8') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$N8';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' float8')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' float8')));
			$cpo = $cpo . "',False,True,''));";
			}				

		/////////////////// float8
		if (strpos($tt,' serial') > 0)
			{
			$cpo = $cpo . "<BR>array_push(\$cp,array('";
			$cpo = $cpo . '$H8';
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' serial')));
			$cpo = $cpo . "','";
			$cpo = $cpo . trim(substr($tt,0,strpos($tt,' serial')));
			$cpo = $cpo . "',False,True,''));";
			}
	}
echo '<HR>';
echo '<BR>';
echo '&lt;?';
echo '<BR>$tabela = "'.trim($tabela).'";';
echo '<BR>$cp = array();';
echo $cpo;
echo '<BR>';
echo '<BR>';
echo '<BR>/// Gerado pelo sistem "base.php" versao 1.0.5';
echo '<BR>';
echo '?>';

?>