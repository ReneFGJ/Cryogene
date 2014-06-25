<?php
class usuario
	{
		function structure()
			{
				$sql = "CREATE TABLE usuario
					( 
					id_us serial NOT NULL, 
					us_nome char(120), 
					us_login char(15), 
					us_senha char(100), 
					us_ativo int2, 
					us_lastupdate int8, 
					us_lembrete char(100), 
					us_nivel int2, 
					us_niver int8, 
					us_cpf char(20), 
					us_rg char(20), 
					us_fone_1 char(15), 
					us_fone_2 char(15), 
					us_fone_3 char(15), 
					us_nome_pai char(100), 
					us_nome_mae char(100), 
					us_dt_admissao int8, 
					us_dt_demissao int8, 
					us_vt char(20), 
					us_vr char(20), 
					us_cracha char(15), 
					us_endereco text, 
					us_email char(120) 
				); ";
				$rlt = db_query($sql);				
								
				/* Indices */
				$sql = "CREATE INDEX id_us_login ON usuario (us_login)";
				$rlt = db_query($sql);				
				
			}
	}
