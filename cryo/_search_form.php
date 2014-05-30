<style>
#form_search
	{
		font-size: 20px;
		width: 500px;
	}
#form_submit
	{
		font-size: 20px;
	}
.form_type
	{
		padding: 4px;
		margin: 0px;
	}
</style>

<?
$chk = array('','','','','','');
$ck = round($dd[1]);
$chk[$ck] = ' checked ';
?>

<form method="post" action="<?=page();?>">
<input type="text" id="form_search" name="dd2" value="<?=$dd[2];?>">
<input type="submit" id="form_submit" name="acao" value="buscar>>">
<BR>
<table border=0 width="300"><TR>
<TD width="10" class="form_type"><input name="dd1" type="radio" value="0" <?=$chk[0]; ?></TD>
<TD>Todos&nbsp;&nbsp;&nbsp;</TD>

<TD width="10" class="form_type"><input name="dd1"  type="radio" value="1" <?=$chk[1]; ?>></TD>
<TD>Clientes&nbsp;&nbsp;&nbsp;</TD>
	
<TD width="10" class="form_type"><input name="dd1"  type="radio" value="2" <?=$chk[2]; ?>></TD>
<TD>Contratos&nbsp;&nbsp;&nbsp;</TD>
</TD></TR></table>
</form>


<?
/* Busca informação */
$tb = array();
$fd = array();

array_push($tb,array('cliente','cl_nome','cl_codigo','cliente_ver.php'));
/* Insere informações da busca */


/* Realiza busca */
if ((strlen($acao) > 0) and (strlen($dd[1]) > 0))
	{
		echo 'RECUPERA';
		for ($r=0;$r < count($tb);$r++)
			{
				$sql = "select * from ".$tb[$r][0].' where ';
				$sql .= $tb[$r][1]." like '%".$dd[2]."%' 
						order by ".$tb[$r][1];

				$rlt = db_query($sql);
				while ($line = db_read($rlt))
				{
					echo '<BR>';
					$field = $tb[$r][1];
					$field_id = $tb[$r][2];
					$link = '<A HREF="'.$tb[$r][3].'?dd0='.$line[$field_id].'&dd90='.checkpost($line[$field_id]).'">';
					echo $link;
					echo $line[$tb[$r][1]];
					echo '</A>';
					
				}
			}
	}
?>
