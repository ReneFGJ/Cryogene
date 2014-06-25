<?
$include = "include/";
global $nocab;
require('db.php');
require('security.php');
$chave = md5($dd[0].date("YmdH").'1234');

$uploaddir_iso = $_SERVER['DOCUMENT_ROOT'].'/upload/arquivos/';

if ($chave == $dd[2])
	{
	$sql = "select * from iso_files ";
	$sql .= " where pl_codigo= '".$dd[0]."' ";
	$sql .= " order by id_pl desc ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		$file_nome = trim($line['pl_texto']);
		$filename = trim($line['pl_filename']);
		$dir = $uploaddir_iso;
		$type = strtolower(substr($file_nome,strlen($file_nome)-2,3));
		$arq = $dir.'/iso/'.$filename;

	if (!(file_exists($arq)))
		{
		echo 'Arquivo não localizado '.$arq;
		exit;
		}
		header("Expires: 0");
		//header('Content-Length: $len');
		header('Content-Transfer-Encoding: none');
		$file_extension = strtolower(substr($file_nome,strlen($file_nome)-3,3));
		switch( $file_extension ) {
		      case "pdf": $ctype="application/pdf"; break;
	    	  case "exe": $ctype="application/octet-stream"; break;
		      case "zip": $ctype="application/zip"; break;
		      case "doc": $ctype="application/msword"; break;
		      case "xls": $ctype="application/vnd.ms-excel"; break;
		      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
		      case "gif": $ctype="image/gif"; break;
		      case "png": $ctype="image/png"; break;
		      case "jpeg":
		      case "jpg": $ctype="image/jpg"; break;
		      case "mp3": $ctype="audio/mpeg"; break;
		      case "wav": $ctype="audio/x-wav"; break;
		      case "mpeg":
		      case "mpg":
		      case "mpe": $ctype="video/mpeg"; break;
		      case "mov": $ctype="video/quicktime"; break;
		      case "avi": $ctype="video/x-msvideo"; break;
			}
		header("Content-Type: $ctype");
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		print file_get_contents($arq);		
//		readfile($arq);
	
		} else {
			echo 'erro no download';
		}
	} else {
		echo "Chave incorreta";
	}
?>