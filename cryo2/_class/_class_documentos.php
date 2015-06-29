<?php
class documento
	{
	
	function export_to_word($size,$name)
		{

			//Download header
			header('Content-Description: File Transfer');
			header('Content-Type: application/msword');
			header("Content-Disposition: attachment; filename=".$name);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			//header('Cache-Control: must-revalidate');
			//header('Pragma: public');
			header('Content-Length: ' . $size);
			
			echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.chr(13);
			echo '<html xmlns="http://www.w3.org/1999/xhtml">'.chr(13);
			echo '<head>'.chr(13);
		}
	}
?>
