<?php
if (!function_exists(('msg')))
	{
function msg($t)
	{
		$CI = &get_instance();
		if (strlen($CI->lang->line($t)) > 0)
			{
				return($CI->lang->line($t));
			} else {
				return($t);
			}
	}
	}

$lang['versao'] = 'v0.15.25';

/* Ciencia sem fronteiras */
$lang['csf_bt_cancelar'] = 'Cancelar processo';
$lang['csf_bt_homologar_no'] = 'Não homologado';
$lang['csf_bt_homologar'] = 'Homologado pela Instituição';
$lang['csf_bt_homologar_capes_no'] = 'Não homologado pela CAPES/CNPq';
$lang['csf_bt_homologar_capes'] = 'Homologação da CAPES/CNPq';
$lang['csf_bt_homologar_parceiro'] = 'Aceite do Parceiro';
$lang['csf_bt_desistente'] = 'Desistente';
$lang['csf_bt_viagem'] = 'Saída do Brasil';
$lang['csf_bt_fim_viagem'] = 'Retorno ao Brasil';
$lang['csf_bt_troca_universidade'] = 'Troca de Univerisdade';
$lang['csf_bt_troca_pais'] = 'Troca de país';
$lang['scf_historico'] = 'Histórico';
$lang['csf_bt_retorno'] = 'Retorno antecipado';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';


/*Fomento*/
$lang['fm_titulo'] 			= 'Nome da chamada';
$lang['fm_titulo_email'] 	= 'Titulo do e-mail(opcional)';
$lang['fm_agencia'] 		= 'Agência';
$lang['fm_idioma'] 			= 'Idioma';
$lang['fm_chamada'] 		= 'Chamada';
$lang['fm_status'] 			= 'Status';
$lang['fm_autor'] 			= 'Responsável (LOGIN)';
$lang['fm_corpo'] 			= 'Corpo';
$lang['fm_url_externa'] 	= 'Link da chamada';
$lang['fm_total_visualizacoes'] = 'Total de visualizações';
$lang['fm_local'] 			= 'Local';
$lang['fm_disseminador'] 	= 'Disseminador';
$lang['fm_tipo_edital'] 	= 'Tipo de edital';
$lang['fm_fluxo_continuo'] 	= 'Fluxo continuo';
$lang['fm_assinatura'] 		= 'Requer assinatura de documento';
$lang['fm_login'] 			= 'Responsável (LOGIN)';
$lang['fm_texto_1'] 		= 'Objetivo(s)';
$lang['fm_texto_2'] 		= 'Recursos';
$lang['fm_texto_3'] 		= 'Elegibilidade';
$lang['fm_texto_4'] 		= 'Contato';
$lang['fm_texto_5'] 		= '';
$lang['fm_texto_6'] 		= 'Áreas e categorias';
$lang['fm_texto_7'] 		= '';
$lang['fm_texto_8'] 		= '';
$lang['fm_texto_9'] 		= '';
$lang['fm_texto_10'] 		= '';
$lang['fm_texto_11'] 		= 'Submissão da proposta';
$lang['fm_texto_12'] 		= 'Contato na instituição';
$lang['fm_data_01'] 		= 'Deadline para submissão da proposta';
$lang['fm_data_02'] 		= 'Deadline (envio da documentação)';
$lang['fm_data_03'] 		= 'Previsão de divulgação dos resultados';
$lang['fm_data_04'] 		= '';


/* Formulário de consulta */
$lang['busca'] = 'BUSCA';

/* Nome do mes */
$lang['mes_01'] = 'Janeiro';
$lang['mes_02'] = 'Fevereiro';
$lang['mes_03'] = 'Março';
$lang['mes_04'] = 'Abril';
$lang['mes_05'] = 'Maio';
$lang['mes_06'] = 'Junho';
$lang['mes_07'] = 'Julho';
$lang['mes_08'] = 'Agosto';
$lang['mes_09'] = 'Setembro';
$lang['mes_10'] = 'Outubro';
$lang['mes_11'] = 'Novembro';
$lang['mes_12'] = 'Dezembro';
/* Nome do mes abreviados*/
$lang['mes_01a'] = 'JAN.';
$lang['mes_02a'] = 'FEV.';
$lang['mes_03a'] = 'MAR.';
$lang['mes_04a'] = 'ABR.';
$lang['mes_05a'] = 'MAIO';
$lang['mes_06a'] = 'JUN.';
$lang['mes_07a'] = 'JUL.';
$lang['mes_08a'] = 'AGO.';
$lang['mes_09a'] = 'SET.';
$lang['mes_10a'] = 'OUT.';
$lang['mes_11a'] = 'NOV.';
$lang['mes_12a'] = 'DEZ.';

/* Cabecalho */
$lang['cab_update'] = 'Atualizar dados';
$lang['cab_expediente_01'] = 'Pró-Reitoria de Pesquisa';
$lang['cab_expediente_02'] = 'Diretoria de Pós-Graduação Stricto Sensu';
$lang['cab_expediente_03'] = 'Diretoria de Pesquisa';
$lang['cab_expediente_04'] = 'Centro Integrado de Pesquisa';
$lang['cab_expediente_05'] = 'Observatório';
$lang['cab_expediente_06'] = 'Iniciação Científica';
$lang['cab_expediente_07'] = 'Fundo de Pesquisa';
$lang['cab_expediente_08'] = 'Comitê de Ética com Seres Humanos (CEP)';
$lang['cab_expediente_09'] = 'Comitê de Ética no Uso de Animais (CEUA)';
$lang['cab_expediente_10'] = 'Biotério';

/* Botoes */
$lang['bt_update'] = 'ATUALIZAR';
$lang['bt_salvar_continuar'] = 'Salvar e continuar >>>';

/*
 * Ciência sem fronteiras */
$lang['csf_title_novo'] = 'Novo registro de aluno - CSF';

/* Atores do sistema */
$lang['titulacao'] = 'titulação';
$lang['link_lattes'] = 'link para o Lattes';

/* Fomentos */
$lang['fomento_editais'] = 'Editais de fomento';
$lang['title_fomento_editais'] = 'Editais de fomento';



$lang['cab_admin'] = 'Administração';
$lang['cab_logout'] = 'Sair';

$lang['fast_search'] = 'Deseja fazer uma busca rápida?';
$lang['fast_search_place'] = 'Procure por assuntos, pesquisadores, pesquisas... ';

$lang['title_admin'] = 'Usuários do sistema';

$lang['about_expediente'] = 'Expediente';

/* LOGIN */
$lang['login_entrar'] = 'ENTRAR';
$lang['login_name'] = 'Login de rede';
$lang['login_password'] = 'Senha';
$lang['login_versao'] = 'versão';

$lang['login_erro_01'] = 'Login ou senha incorreta';

/* Rodape */
$lang['about_sistem'] = 'Sobre o CIP';
$lang['contact_sistem'] = 'Contato';
?>
