<?php
class header
	{
	var $titulo = ':: Cryogene - Cobrança ::';
	
	function topmenu()
		{
			$sx = '<div id="topmenu" class="menu">
						<UL class="menu_ul">
							<LI class="menu_il">
								<A HREF="#"><img src="img/favicon.ico"></A>
							</LI>
				';
			$sx .= '
							<LI class="menu_il"><A HREF="main.php" class="link_menu">HOME</A></LI>
							<LI class="menu_il"><A HREF="contrato.php" class="link_menu">CONTRATOS</A></LI>
							<LI class="menu_il"><A HREF="financeiro.php" class="link_menu">FINANCEIRO</A></LI>
							<LI class="menu_il"><A HREF="parametro.php" class="link_menu">PARAMETROS</A></LI>
							<LI class="menu_il"><A HREF="iso.php" class="link_menu">ISO 9000</A></LI>
					';
			$sx .= '
						</UL>
				   </div>
			';
			return($sx);
		}
	
	function cab()
		{
			global $http,$login;
			header('Content-Type: text/html; charset=ISO-8859-9');
			$sx ='';
			$sx .= '<head>
						<title>'.$this->titulo.'</title>
						<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
						<link rel="stylesheet" href="css/style_main.css" type="text/css" media="screen" />
						<link rel="stylesheet" href="css/style_font.css" type="text/css" media="screen" />
						<link rel="stylesheet" href="css/style_menu.css" type="text/css" media="screen" />
						<script  rel="text/javascript" src="js/jquery.js"></script>												
					</head>
			<body>';
			$sx .= '<div id="cabs">';
			$sx .= '<div id="logo">
					</div>';
			
			$sx .= $this->topmenu();
			$sx .= '</div>';			
			if ($login != 1)
				{
					$sx .= $this->cab_user();
				}
			$sx .= '
			<div id="content">
			';
			return($sx);
		}	
		function cab_user()
			{
				$nome = $_SESSION['us_nome'];
				$login = $_SESSION['us_login'];
				$nivel = $_SESSION['us_nivel'];
				$sx = '';
				$sx .= '<div id="cab_user">';
				$sx .= '<div id="cab_user_name">'.$nome;
				$sx .= ' ('.$login.')';
				$sx .= '</div>';
				//$sx .= '	<div id="cab_user_nivel">'.$nivel.'</div>';
				$sx .= '</div>';
				return($sx);
			}
		function foot()
			{
				
			}
	}
?>
