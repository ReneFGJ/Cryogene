<?
class log
	{
		function structure()
			{
				$sql = "CREATE TABLE log
					( 
					id_log serial NOT NULL, 
					log_data int4, 
					log_hora char(5), 
					log_pagina int4, 
					log_origem int4, 
					log_ip char(15), 
					log_dd1 char(10), 
					log_dd2 char(10), 
					journal_id int8 
					);";
				$rlt = db_query($sql);
									
				/* Indices */
				$sql = "CREATE INDEX id_log_data ON log (log_data)";
				$rlt = db_query($sql);

				$sql = "CREATE TABLE log_pagina
						( 
						id_logpg serial NOT NULL, 
						logpg_http char(150), 
						logpg_nome char(50) 
						);";
				//$rlt = db_query($sql);
				
				/* Indices */
				$sql = "CREATE INDEX logpg_http ON log_pagina (logpg_http)";
				//$rlt = db_query($sql);
			}
	}
