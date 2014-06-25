<?
global $dd,$acao;
if (strlen($acao) > 0)
	{
	$ddd=command($acao);
	echo '<TABLE width="704" align="center"><TR><TD>';
	echo $ddd;
	echo '</TABLE>';
	$rlt = db_query($ddd);
	echo '<CENTER><HR width="704">Processado '.$acao.'<HR width="704">';
	}
?>
<TABLE align="center">
<TR><TD><FORM></TD></TR>
<TR><TD colspan="3">
<input type="hidden" name="base_user" value="<?=$base_user?>">
<input type="hidden" name="dd50" value="<?=$dd[50]?>">
<HR size="1">
Tabelas
<HR size="1">
</TD></TR>
<TR align="center">
<TD><input type="submit" name="acao" value="evento" style="width: 120"></TD>
<TD><input type="submit" name="acao" value="evento_tema" style="width: 120"></TD>
<TD><input type="submit" name="acao" value="imagem" style="width: 120"></TD>
</TR>

<TR align="center">
<TD><input type="submit" name="acao" value="secao" style="width: 120"></TD>
<TD><input type="submit" name="acao" value="noticia" style="width: 120"></TD>
<TD><input type="submit" name="acao" value="user" style="width: 120"></TD>
</TR>

<TR align="center">
<TD><input type="submit" name="acao" value="contador" style="width: 120"></TD>
<TD><input type="submit" name="acao" value="pagina" style="width: 120"></TD>
<TD><input type="submit" name="acao" value="evento_inscricao" style="width:120"></TD>

<TR align="center">
<TD><input type="submit" name="acao" value="mailing" style="width: 120"></TD>
<TD><input type="submit" name="acao" value="relacionamento" style="width: 120"></TD>

<TR><TD><HR></TD></TR>
<TR align="center">
<TD><input type="submit" name="acao" value="create_database" style="width: 120"></TD>


<TR align="center">
<TD><input type="submit" name="acao" value="alterar" style="width: 120"></TD>

<TR align="center">
<TD><input type="submit" name="acao" value="dropall" style="width: 120"></TD>
</TR>
<TR><TD></FORM></TD></TR>
</TABLE>

<?
function command($opc)
	{
	global $base;
	echo $opc,$base;
	if ($opc == 'user')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_user ( id_us serial NOT NULL, us_dt_cadastro int8, us_senha char(20), us_login char(10), us_nome char(120), us_email char(120), us_nivel int4 )";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_user ( id_us int(11) unsigned NOT NULL auto_increment, us_dt_cadastro int(11), us_senha varchar(20), us_login varchar(10), us_nome varchar(120), us_email varchar(120), us_nivel int(11), PRIMARY KEY  (`id_us`) )";	}
		}
		echo '======='.$base;
	if ($opc == 'secao')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_secao ( id_s serial NOT NULL, s_titulo char(120), s_ativo int2 )";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_secao ( id_s int(11) unsigned NOT NULL auto_increment, s_titulo char(120), s_ativo int(11) , PRIMARY KEY  (`id_s`) )";	}
		}
	if ($opc == 'noticia')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_noticia ( id_nw serial NOT NULL, nw_dt_cadastro int8, nw_secao int4, nw_link char(120),   nw_fonte char(120), nw_titulo char(120), nw_descricao text, nw_dt_de int8, nw_dt_ate int8, nw_log char(10), nw_ativo int2, nw_ref char(20), nw_thema char(7) )"; }
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_noticia ( id_nw int(11) unsigned NOT NULL auto_increment, nw_dt_cadastro int(11), nw_secao int(11), nw_link char(120),   nw_fonte varchar(120), nw_titulo varchar(120), nw_descricao text, nw_dt_de int(11), nw_dt_ate int(11), nw_log varchar(10), nw_ativo int(11), nw_ref varchar(20), nw_thema varchar(7), PRIMARY KEY  (`id_nw`) )"; }
		}
	if ($opc == 'evento_tema')
		{ $sql = "CREATE TABLE ic_evento_tema ( id_thema serial NOT NULL, thema_codigo char(7), thema_titulo char(100), thema_cab text, thema_foot text, thema_img_top text, thema_img_botton text, thema_table_start text, thema_table_end text, thema_table_tr text, thema_ativo int2, thema_img_col int2 DEFAULT 2 )";	}
	if ($opc == 'evento_tema')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_evento_tema ( id_thema serial NOT NULL, thema_codigo char(7), thema_titulo char(100), thema_cab text, thema_foot text, thema_img_top text, thema_img_botton text, thema_table_start text, thema_table_end text, thema_table_tr text, thema_ativo int2, thema_img_col int2 DEFAULT 2 )";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_evento_tema ( id_thema int(11) unsigned NOT NULL auto_increment, thema_codigo char(7), thema_titulo char(100), thema_cab text, thema_foot text, thema_img_top text, thema_img_botton text, thema_table_start text, thema_table_end text, thema_table_tr text, thema_ativo int2, thema_img_col int2 DEFAULT 2,  PRIMARY KEY  (`id_thema`))";	}
		}
	if ($opc == 'evento_inscricao')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_inscricao ( id_i serial NOT NULL, i_status char(1), i_evento int8, i_data int8, i_hora int8, i_nome_completo char(100), i_email char(100), i_nome_cracha char(40), i_instituicao char(100), i_tipo_inscricao char(1), i_vlr_inscricao int8, i_obs text, i_senha char(10), i_cpf char(20), i_rg char(20), i_endereco char(100), i_cidade char(25), i_bairro char(25), i_estado char(2), i_pais char(25))";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_inscricao ( id_i int(11) unsigned NOT NULL auto_increment, i_status char(1), i_evento int(11), i_data int(11), i_hora char(5), i_nome_completo char(100), i_email char(100), i_nome_cracha char(40), i_instituicao char(100), i_tipo_inscricao char(1), i_vlr_inscricao int(11), i_obs text, i_senha char(10), i_cpf char(20), i_rg char(20), i_endereco char(100), i_cidade char(25), i_bairro char(25), i_estado char(2), i_pais char(25),  PRIMARY KEY  (`id_i`))";	}
		}
	if ($opc == 'contador')
		{ 
		if ($base == 'pgsql') { $sql .= "CREATE TABLE log ( id_log serial NOT NULL,  log_data int4,  log_hora char(5),  log_pagina int4,  log_origem int4,  log_ip char(15),  log_dd1 char(10),  log_dd2 char(10),  journal_id int8 ); ";	}
		if ($base == 'mysql') { $sql .= "CREATE TABLE log ( id_log int(11) unsigned NOT NULL auto_increment, log_data int(11),  log_hora char(5),  log_pagina int(11),  log_origem int(11),  log_ip char(15),  log_dd1 char(10),  log_dd2 char(10),  journal_id int(11) , PRIMARY KEY  (`id_log`)); ";	}
		}

	if ($opc == 'pagina')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE log_pagina (id_logpg serial NOT NULL, logpg_http char(150), logpg_nome char(50)); ";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE log_pagina (id_logpg int(11) unsigned NOT NULL auto_increment, logpg_http char(150), logpg_nome char(50), PRIMARY KEY  (`id_logpg`)); ";	}
		}

	if ($opc == 'mailing')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_mailing (id_m serial NOT NULL, m_http char(150), m_nome char(80), m_email char(80), m_data int8, m_hora char(5), m_ativo int2, m_erros int8 ); ";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_mailing (id_m int(11) unsigned NOT NULL auto_increment, m_http char(150), m_nome char(80),m_email char(80), m_data int(11), m_hora char(5), m_ativo int(11), m_erros int(11), PRIMARY KEY  (`id_m`)); ";	}
		}
		
	if ($opc == 'relacionamento')
		{ 
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_contact (id_r serial NOT NULL, r_status char(1), r_texto text, r_destino char(5), r_email char(80), r_nome char(50), r_hora char(5), r_data int8, rl_id int8 ); ";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_contact (id_r int(11) unsigned NOT NULL auto_increment, r_status char(1), r_texto text, r_destino char(5), r_email char(80), r_nome char(80), r_data int(11), r_hora char(5), rl_id int(11), PRIMARY KEY  (`id_r`)); ";	}
		if ($base == 'pgsql') { $sql .= "CREATE TABLE ic_contact_local (id_rl serial NOT NULL, rl_nome char(50), rl_email text, rl_ativo int2 ); ";	}
		if ($base == 'mysql') { $sql .= "CREATE TABLE ic_contact_local (id_rl int(11) unsigned NOT NULL auto_increment, rl_nome char(50), r_email text, rl_ativo int(11) ,PRIMARY KEY  (`id_rl`)); ";	}

		}		

	if ($opc == 'evento')
		{ $sql = "CREATE TABLE ic_evento ( id_ev serial NOT NULL, ev_dt_cadastro int8, ev_titulo char(120), ev_descricao text, ev_dt_de int8, ev_dt_ate int8, ev_log char(10), ev_ativo int2, ev_thema char(7) )"; }
	if ($opc == 'dropall')
		{ $sql = "DROP TABLE ic_evento; DROP TABLE ic_evento_tema; DROP TABLE ic_imagem; DROP TABLE ic_noticia; DROP TABLE ic_secao; DROP TABLE ic_user;"; }
	if ($opc == 'create_database')
		{ $sql = "CREATE DATABASE ic WITH ENCODING='SQL_ASCII';"; }
	if ($opc == 'imagem')
		{
		if ($base == 'pgsql') { $sql = "CREATE TABLE ic_imagem ( id_img serial NOT NULL, img_arquivo char(40), img_titulo char(100), img_texto text, img_data int8, img_status char(1), img_size int8, img_type char(4), img_heigth int8, img_width int8, img_codigo char(7),  img_path int8,  img_evento int8, img_log char(10) ) ";	}
		if ($base == 'mysql') { $sql = "CREATE TABLE ic_imagem (id_img int(11) unsigned NOT NULL auto_increment, logpg_http char(150), logpg_nome char(50), PRIMARY KEY  (`id_img`)); ";	}
		}
	return($sql);
	}