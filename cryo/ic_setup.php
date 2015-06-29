<?
//-------------------------------------- Paramentros para DEBUG
ini_set('display_errors', 2047);
//ini_set('error_reporting', 2047);
$debug = false;
//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{	
	$varf='dd'.$k; $varf=$vars[$varf]; 
	$dd[$k] = troca($varf,"'","´");	}
$acao = $vars['acao'];
?><style> BODY, A, TABLE { font-family : Verdana, Geneva, Arial, Helvetica, sans-serif; font-size : 12px; color : Gray; text-decoration : none; } </style><?
if (strlen($dd[50]) ==0)
	{
		echo '<TITLE>iC - Configurações & Instalação</TITLE>';
		echo ic_menu();
	} else {
		if (trim($dd[50]) == trim("Importar_XML")) { xml_news_inport(); }
		if (trim($dd[50]) == trim("Instalar DB")) { ic_db_install(); }
		if (trim($dd[50]) == trim("Create_db")) { create_db(); }
		if (trim($dd[50]) == trim("Teste_db")) { teste_db(); }
	}
//-------------------------------------- Recuperar dados de GET / POST
function getServerHost() {
return isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST']
		: (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
		: (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
		: 'localhost'));
}
////////////////////////////// XML
function teste_db()
	{
	global $dd,$acao;
	$debug = true;
	require('ic_db.php');
	}
	
function db_erro() { global $base,$rlt; if ($base=='pgsql') { return(pg_error() . '<BR>'.$rlt); } }

function db_connect()
	{
	global $base;
	global $base_host;
	global $base_port;
	global $base_name;
	global $base_user;
	global $base_pass;
	global $debug;
	if ($base=='pgsql')
		{
		$conn = "host=".$base_host." port=".$base_port." dbname=".$base_name." user=".$base_user." password=".$base_pass."";
		$db = pg_connect($conn);
		}
	if ($base=='mysql')
		{
		$db = mysql_connect('localhost',$base_user,$base_pass);
		if (!(mysql_select_db(trim($base_name))))
			{ echo 'error'; echo mysql_error(); };
		}
	if ($debug == true)
		{ echo '<DIV align="400">'.$sql.'</DIV>'; }
	}
////////////////////////////////////////////////////////////	
		
function create_db()
	{
	global $dd,$acao;
	
	if (strlen($dd[50]) > 0)
		{
		$db_tipo = 'pgsql';
		$db_nome = 'abpr_mysql';
		$db_host = 'localhost:3306';
		$db_pass = '448545ct';
		$db_user = "";
		$db_port = '5432';
		
/////////////// pg sql
		$db_tipo = 'pgsql';
		$base_port = '5432';
		$base_host="10.1.1.210";
		$base_name="ic";
		$base_user="postgres";
		$base_pass="";		
///////////////////////////////////////////
		$base_user="fonzaghi";
		$base_port = '5432';
		$base_host="localhost";
		$base_name="fonzaghi";
		$base_pass="wqg761";
	
		$dir = $_SERVER['DOCUMENT_ROOT'];
		$ft = $dir."/ic_db.php";
		$fh = fopen($ft, 'w') or die("erro ao criar arquivo");
		fwrite($fh,'<?'.chr(13).chr(10));
		fwrite($fh,'$base = "'.    $db_tipo  .'";'.chr(13).chr(10));
		fwrite($fh,'$base_user ="'.$base_user.'";'.chr(13).chr(10));
		fwrite($fh,'$base_port ="'.$base_port  .'";'.chr(13).chr(10));
		fwrite($fh,'$base_host ="'.$base_host .'";'.chr(13).chr(10));
		fwrite($fh,'$base_name ="'.$base_name .'";'.chr(13).chr(10));
		fwrite($fh,'$base_pass ="'.$base_pass .'";'.chr(13).chr(10));
		fwrite($fh,'$ok = db_connect();'.chr(13).chr(10));
		fwrite($fh,'?>'.chr(13).chr(10));
		fclose($fh);
		} else {
		?>
		<TABLE>
		<TR><TD>####</TD></TR>
		</TABLE>
		<?
		}
	
	}
/////////////////////// Import NEWS
function xml_news_inport()
	{
	global $dd;
	global $verbs,$campo,$vlr,$tabela;	
	$verbs = array(	"IC_ID"=>0,"IC_TITULO"=>1,"IC_INCLUSAO"=>2,"IC_TIPO"=>3,"IC_VALIDADE"=>4,"IC"=>99,"IC_CONTENT"=>6);
	$campo = array( "nw_ref","nw_titulo","nw_dt_de","nw_secao","nw_dt_ate","id_nw","nw_descricao");
	$crnf = chr(13).chr(10);
	$vlr  = array(); for ($r=0; $r < 50; $r++) { array_push($vlr,""); }
	$tabela = "ic_noticia";
	
	if (strlen($dd[1]) == 0)
		{
			echo '<TABLE align="center" width="704">';
			echo '<TR><TD><FORM method="post"></TD></TR>';
			echo '<TR><TD><textarea cols="60" rows="5" name="dd1">'.$dd[1].'</textarea></TD></TR>';
			echo '<TR><TD align="center"><input type="submit" name="dd50" value="Importar_XML"></TD></TR>';
			echo '<TR><TD></form></TD></TR>';
		} else {
			$xml = xml_parser_create();
			xml_set_element_handler($xml,"taginicial","tagfinal");
			xml_set_character_data_handler($xml,"tratacaracter");
			$dd[1] = troca($dd[1],'\"','"');
			
//			header('Content-type: text/xml');
//			echo $dd[1];
			if (!xml_parse($xml,$dd[1],false))
				{
				die(sprintf("Erro XML - %s na linha %d",
				xml_error_string(xml_get_error_code($xml)),
				xml_get_current_line_number($xml)));
				}
			echo "FIM";
			}
		exit;
		}
	
//////////////////////////////////////////// funcoes XML
function tratacaracter($parser,$ddd)
{
	global $valor;
	$valor=$valor.$ddd;
//	echo '<HR>'.$valor;
}
		
function taginicial($parser,$elemento,$attrs)
{

}

function tagfinal($parser,$elemento)
{
	global $valor,$vlr,$verbs,$campo,$tabela;
	
	
	if (isset($verbs[$elemento]))
		{
		$ii = $verbs[$elemento];
		$vlr[$ii] = trim($valor);
		echo "<BR>x=".$elemento.'==['.$ii.']=='.$valor.'=='.$verbs[0];;
		}

	if ($verbs[$elemento] == 99)
		{
		$sql = "select * from ".$tabela . ' where '.$campo[0]." = '".$vlr[0]."'";
		echo '<HR>'.$sql.'<HR>';
		$rlt = db_query($sql);
		if (!($line = db_read($rlt)))
			{
			$sql = "insert into ".$tabela." (".$campo[0].",nw_ativo) values ('".$vlr[0]."',1); ";
			echo $sql.'<HR>';
			$rlt = db_query($sql);
			}
		$sql = "update ".$tabela." set ";
		$ini = 0;
		for ($r = 1; $r < count($verbs);$r ++)
			{
			if (strlen($vlr[$r]) > 0)
				{
				if ($ini > 0) { $sql = $sql . ','; }
				$sql = $sql . $campo[$r] . " = '".$vlr[$r]."' ";
				$ini ++;
				}
			}
		$sql = $sql . ", nw_ativo = 1 ";
		$sql = $sql . ' where '.$campo[0].' = '.$vlr[0];
		echo $sql.'<HR>';
		$rlt = db_query($sql);
		$vlr  = array(); for ($r=0; $r < 50; $r++) { array_push($vlr,""); }
		}
		ob_flush();
		flush;
		$valor = '';
}
///////////////////////////////////////////////////////
function db_query($rlt)
	{
	global $base,$debug;	
	$xxx='';
	$err = 1;
	if ($base=='pgsql')
		{
		if (strlen($debug) > 0) { echo '<HR>'.$rlt; }
		$xxx = pg_query($rlt) or die(pg_error() . '<BR>'.$rlt);
		$err = 0;
		}
	if ($base=='mysql')
		{
		if (strlen($debug) > 0) { echo '<HR>'.$rlt; }
		$xxx = mysql_query($rlt) or die(mysql_error() . '<BR>'.$rlt);
		$err = 0;
		}
		
	if ($err > 0)
		{ echo '<CENTER><FONT COLOR=RED>nao selecionado o tipo de base </B>'.$base.'</B></CENTER>'; } 
	return $xxx;
	}
//////////////////////////////////////////////////////	
function ic_db_install()
	{
	global $dd,$base;
	global $base;
	global $base_host;
	global $base_port;
	global $base_name;
	global $base_user;
	global $base_pass;
		
	require('ic_db.php');
	require('ic_setup_sql.php');
	}
	
function ic_menu()
	{
	$menu = array();
	array_push($menu,"Instalar DB");
	array_push($menu,"Importar_XML");
	array_push($menu,"Create_db");
	if (file_exists('ic_db.php'))
		{
		array_push($menu,"Teste_db");
		}
	echo '<TABLE align="center" width="704">';
	echo '<TR><TD><FORM method="post"></TD></TR>';
	$ini = 99;
	for ($r = 0; $r < count($menu); $r++)
		{
		if ($ini > 3) { echo '<TR>'; $ini = 0; }
		echo '<TD><input type="submit" name="dd50" value="'.$menu[$r].'" style="width=120"></TD>';
		$ini++;
		}
	echo '<TR><TD colspan="3" align="center">MENU PRINCIPAL</TD></TR>';
	echo '</TABLE>';
	
	$dir = $_SERVER['DOCUMENT_ROOT'];
	$dir_public = $dir . '/ic/';
	echo '<TABLE align="center" width="704">';
	echo '<TR><TD>';
	echo $dir;
	echo '</TABLE>';
	echo ic_foot();
	}

function ic_foot()
	{
	echo '<center>by sisDOC &copy 2007</center>';
	}
	
function troca($qutf,$qc,$qt)
	{
	return(str_replace(array($qc), array($qt),$qutf));
	}	
?>