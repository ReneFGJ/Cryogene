<link rel="stylesheet" href="ic_letras.css" type="text/css" />
<?
function ic_contato_import($link)
	{
	$arq = fopen($link,'r');
	$ok = 1;
	$s = '';
	while ($ok == 1)
		{
		$sr = fread($arq,1024);
		$s .= $sr;
		if (strlen($sr)==0) { $ok = 0; }
		}
	$msg = array();
	
	while (strpos($s,'</>'.chr(13).chr(10)) > 0)
		{
		$lx = substr($s,0,strpos($s,'</>'.chr(13).chr(10)));
//		echo '<BR>==##==>'.$lx;
		$s = substr($s,strpos($s,'</')+2,strlen($s));
		$s = substr($s,strpos($s,chr(10))+1,strlen($s));
		if (substr($lx,0,8)=='<message')
			{ $ln = array('','','','','','','','','','',''); }
		////////////// e-mail
		$cp = substr($lx,0,strpos($lx,'>')+1);
		$ss = substr($lx,strlen($cp),strlen($lx));
		//echo chr(13).'<BR>['.$cp.']--'.$ss.chr(13);
		if ($cp=='<email>')
			{ 
			if (strpos($ss,' ') > 0) { $ss = substr($ss,0,strpos($ss,' ')); }
			$ln[0] = $ss;
			}
			
		if ($cp=='<nome>')
			{ $ln[1] = $ss; }
		if ($cp=='<destino>')
			{ $ln[2] = $ss; }
		if ($cp=='<content>')
			{ $ln[3] = $ss; }
		if ($cp=='<data>')
			{ $ln[9] = $ss; }
		if ($cp=='<hora>')
			{ $ln[10] = $ss; grava_contato($ln); }
		}
		return('');
	}
function grava_contato($ccp)
	{
	$sql = "select * from ic_contact where r_email='".$ccp[0]."' ";
	$sql .= " and r_data = ".$ccp[9]." ";
	$sql .= " and r_hora = '".$ccp[10]."' ";
	$rlt = db_query($sql);
	if (!($line = db_read($rlt)))
		{
		$sql = "insert into ic_contact ";
		$sql .= "(r_status,r_email,r_nome,";
		$sql .= "r_destino,r_texto,r_data,";
		$sql .= "r_hora) ";
		$sql .= " values ";
		$sql .= "('A','".$ccp[0]."','".$ccp[1]."',";
		$sql .= "'".$ccp[2]."','".$ccp[3]."',".$ccp[9].",";
		$sql .= "'".$ccp[10]."' ";
		$sql .= ")";
		$rlt = db_query($sql);
		}
//	echo '<BR>'.$sql.chr(13);
	}
	
function ic_contato_export($limit)
	{
	if (strlen($limit) == 0) { $limit = 30; }
	$sql = "select count(*) as total from ic_contact ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ $total = $line['total']; }

	$sql = "select * from ic_contact order by r_data desc limit ".$limit;
	$rlt = db_query($sql);
	$eof = chr(13).chr(10);
	$s = '<total>'.$total.'</total>'.$eof;
	while ($line = db_read($rlt))
		{
		$s .= '<message id="'.$line['id_r'].'">'.$eof;
		$s .= '<status>'.$line['r_status'].'</>'.$eof;
		$s .= '<email>'.$line['r_email'].'</>'.$eof;
		$s .= '<nome>'.$line['r_nome'].'</>'.$eof;
		$s .= '<destino>'.$line['r_destino'].'</>'.$eof;
		$s .= '<content>'.$line['r_texto'].'</>'.$eof;
		$s .= '<data>'.$line['r_data'].'</>'.$eof;
		$s .= '<hora>'.$line['r_hora'].'</>'.$eof;
		$s .= '</message>'.$eof;
		}
	return($s);
	}
function ic_contato($e2,$e1,$e3,$e4)
	{
	$sql = "insert into ic_contact ";
	$sql .= "(r_status,r_email,r_nome, r_destino, ";
	$sql .= 'r_texto,r_data,r_hora,rl_id ';
	$sql .= ') values (';
	$sql .= "'A','".$e1."','".$e2."','".substr($e3,0,5)."',";
	$sql .= "'".$e4."',".date("Ymd").",'".date("H:i")."',9 ";
	$sql .= ")";
	$rlt = db_query($sql);
	$link = "http://www.cryogene.inf.br/contato_auto.php?dd0=".$e1."&dd1=".$e2."&dd2=".$e3."&dd3=".$e4;
//	echo $link;
//	$fp = fopen($link,'r');
//	$rd = fread($fp,256);
//	echo $rd;
	return("e-Mail enviado com sucesso !");
	}

function ic_seccao($id_secao)
	{
	$sql = "select * from ic_noticia ";
	$sql = $sql . " left join ic_imagem on id_nw = img_evento ";
	$sql = $sql . " where (nw_ativo=1) and (nw_secao=".$id_secao.") ";
	$sql = $sql . "and (nw_dt_de <= ". date("Ymd") . ") ";
	$sql = $sql . "and (nw_dt_ate >= ". date("Ymd") . ") ";

	$ini=0;
	$rlt = db_query($sql);
	$rr = "";
	$idx = -1;
	while ($line = db_read($rlt))
		{
//		$link = '<A HREF="noticia.php?dd0='.$line['id_nw'].'">';
		$id = $line['id_nw'];
		if ($idx != $id) 
			{
			$idx = $id;
			$img = trim($line['img_arquivo']);
			$text = trim($line['nw_descricao']);
			if (strlen($img) > 0)
				{
				$img = substr($img,0,strlen($img)-4).'_mini.jpeg';
				$img = '<img src="/img/ic/'.$img.'">';
				}
			$rr = $rr . $link.'<h1>'.$line['nw_titulo'].'</h1>'.chr(13).chr(10).'<BR>';
			$rr = $rr . '<DIV align="justify" class="fp1">'.mst($text).'</DIV>';
			$rr = $rr . $img.'<BR>&nbsp;';
//			$rr = $rr . '<HR>';
			}
		}
	return($rr);
	}
function ic_titulo($ini,$fim)
	{
	global $ic_cab;
	$sql = "select * from ic_noticia ";
	$sql = $sql . "inner join ic_secao on nw_secao = id_s ";
	$sql = $sql . "where (s_ativo >= ".$ini.' and s_ativo <= '.$fim.') ';
	$sql = $sql . "and ((nw_dt_ate >= ".date("Ymd").') and (nw_dt_de <= '.date("Ymd").' )) ';
	$sql = $sql . " order by s_ativo, nw_dt_de desc ";
	$rlt = db_query($sql);
	$ss="<font class=lt0 >";
	$sc=-1;
	while ($line = db_read($rlt))
		{
		$link = '<A HREF="noticia.php?dd0='.$line['id_nw'].'">';
		$seccao = $line['id_s'];
		if ($seccao != $sc)
			{
			$ss = $ss . $ic_cab.' <font class="lt1"><B>'.$line['s_titulo'].'</B></font><BR>';
			$sc = $seccao;
			}
		$titulo = trim($line['nw_titulo']);
		if ($line['s_ativo'] >= 20)
			{
			$data = '&nbsp;';
			} else {
			if ($line['s_ativo'] >= 10)
				{
				$data = '<font color="#808080">'.substr(stodbr($line['nw_dt_ate']),0,5).'</font>&nbsp;';
				} else {
				$data = '<font color="#808080">'.substr(stodbr($line['nw_dt_de']),0,5).'</font>&nbsp;';
				}
			}
		$ss=$ss. $data.$link.'<font class=lt0 >'.$titulo.'</A></font>';
		$ss=$ss.'<BR>';
		}
	return($ss);
	}
	
function ic_destaque($ini,$fim)
	{
	$ss='';
	$sql = "select * from ic_noticia ";
	$sql = $sql . " inner join ic_imagem on img_evento = id_nw ";
	$sql = $sql . " where (nw_dt_de <= ".date("Ymd").') and (nw_dt_ate >= '.date("Ymd").' )';
	$sql = $sql . " order by nw_dt_ate ";
	$sql = $sql . " limit 1 ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$link = trim($line['nw_link']);
		if (strlen($link) > 0)
			{
			$link = '<A HREF="'.$link.'" target="new">';
			}
		$img = trim($line['img_arquivo']);
		$img = substr($img,0,strlen($img)-4).'_mini.jpeg';
		$img_title = $line['img_titulo'];
		$ss= $ss . '<TR valign="top">';
		$ss= $ss .  '<TD>'.$link.'<img src="img/ic/'.$img.'" width="200" alt="" border="0"></TD>';
		$ss= $ss .  '<TR  bgcolor="#C0C0C0"><TD height="10"></TD>';
		$ss= $ss .  '<TR  bgcolor="#C0C0C0">';
		$ss= $ss .  '<TD align="center">'.$link.$img_title.'</TD></TR>';
		$ss= $ss .  '<TR bgcolor="#C0C0C0"><TD height="10"></TD>';
		}
	return($ss);
	}
function ic_resumo($ini,$fim)
	{
	$sql = "select * from ic_noticia ";
	$sql = $sql . "inner join ic_secao on nw_secao = id_s ";
	$sql = $sql . "where (s_ativo >= ".$ini.' and s_ativo <= '.$fim.') ';
	$sql = $sql . "and ((nw_dt_ate >= ".date("Ymd").') and (nw_dt_de <= '.date("Ymd").' )) ';
	$sql = $sql . " order by nw_dt_de desc ";
	$rlt = db_query($sql);
	$ss="";
	while ($line = db_read($rlt))
		{
		$titulo = trim($line['nw_titulo']);
		$descricao = $line['nw_descricao'];
		$data = $line['nw_dt_de'];
		$ss=$ss. '<font class="h1">'.$titulo.'</font><BR>';
		$ss=$ss .'<font class=lt0><I>'.stodbr($data).'</I></font><P>';
		$ss=$ss .'<div align="justify" class="lt0">';
		$ss=$ss.mst($descricao);
		$ss=$ss.'</div>';
		$ss=$ss.'<P>';
		}
	return($ss);
	}

function ic_menu($ini,$fim)
	{
	$sql = "select * from ic_secao where ";
	$sql = $sql . "s_ativo >= ".$ini.' and s_ativo <= '.$fim.' order by s_ativo';
	$menu = array();
	$rlt = db_query($sql);
	while ($line = db_read($rlt))
		{
		array_push($menu,array(trim($line['s_titulo']),$line['id_s'],$line['s_ativo']));
		}
	return($menu);
	}
function ic_news($id_secao)
	{
	$sql = "select * from ic_noticia ";
	$sql = $sql . " left join ic_imagem on id_nw = img_evento ";
	$sql = $sql . " where (nw_ativo=1) and (nw_secao=".$id_secao.") ";
	$sql = $sql . "and (nw_dt_de <= ". date("Ymd") . ") ";
	$sql = $sql . "and (nw_dt_ate >= ". date("Ymd") . ") ";

	$ini=0;
	$rlt = db_query($sql);
	$rr = "";
	$idx = -1;
	while ($line = db_read($rlt))
		{
		$link = '<A HREF="noticia.php?dd0='.$line['id_nw'].'">';
		$id = $line['id_nw'];
		if ($idx != $id) 
			{
			$idx = $id;
			$img = trim($line['img_arquivo']);
			if (strlen($img) > 0)
				{
				$img = substr($img,0,strlen($img)-4).'_mini.jpeg';
				$img = '<img src="/img/ic/'.$img.'">';
				}
			$rr = $rr . $link.$line['nw_titulo'].chr(13).chr(10).'<BR>';
			$rr = $rr . $img;
//			$rr = $rr . '<HR>';
			}
		}
	return($rr);
	}
	
function ic_mst($id)
	{
	$sql = "select * from ic_noticia where id_nw = ".$id;
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt))
		{
		$titulo = $line['nw_titulo'];
		$descricao = $line['nw_descricao'];
		$thema     = $line['nw_thema'];
		$data     = $line['nw_dt_de'];
		$link     = trim($line['nw_link']);
		$fonte     = trim($line['nw_fonte']);
		}
		
	IF (strlen($thema) > 0)
		{
		$sql = "select * from ic_evento_tema where thema_codigo='".$thema."'";
		$rlt = db_query($sql);
		
		if ($line = db_read($rlt))
			{
			$thema_cab 			= $line['thema_cab'];
			$thema_foot			= $line['thema_foot'];
			$thema_img_top		= $line['thema_img_top'];
			$thema_img_botton	= $line['thema_img_botton'];
			$thema_table_start	= $line['thema_table_start'];
			$thema_table_end	= $line['thema_table_end'];
			$thema_table_tr		= $line['thema_table_tr'];
			$thema_ativo		= $line['thema_ativo'];
			$thema_img_col		= $line['thema_img_col'];
			}
		}
	$sql = "select * from ic_imagem where img_evento = ".$id;
	$rlt = db_query($sql);
	$rcol = 99;
	$rst = "";
	while ($line = db_read($rlt))
		{
		if ($rcol > $thema_img_col)
			{
			$rst = $rst . $thema_table_tr;
			$rcol = 0;
			}
		$rst = $rst . $thema_table_td;
		$img = trim($line['img_arquivo']);
		if (strlen($img) > 0)
			{
			$img = substr($img,0,strlen($img)-4).'_mini.jpeg';
			$img = '<img src="/img/ic/'.$img.'" align="left" class="img2">';
			}
		$rst = $rst . $img;
		}
	$rst = $rst . '<font class="lt4">'.$titulo.'</font>';
	$rst = $rst . '<BR><font class="lt0"><i>'.stodbr($data).'</i></font>';
	if (strlen($fonte) > 0)
		{ $rst = $rst . '&nbsp;&nbsp;<font class="lt0"><font color="#ff5300">fonte: '.$fonte.'</font></font><BR>'; }
	$rst = $rst . '<BR><div align="justify">'.mst($descricao).'</div>';
	if (strlen($link) > 0)
		{
		$rst = $rst . '<P>Link: <A HREF="'.$link.'" target="new">'.$link.'</A>';
		}
	return($rst);
	}
?>