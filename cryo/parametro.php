<?
require("cab.php");
require($include.'sisdoc_menus.php');
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

 array_push($menu,array('SMS','Envio de SMS','sms_envio.php'));
 array_push($menu,array('E-mail e Mensagens','Mensagens do sistema','mensagem.php'));  
 
if (($user_nivel) >=9) { 	 
	array_push($menu,array('Financeiro','Cadastro de contas','conta_corrente.php')); 
	array_push($menu,array('Financeiro','Forma de pagamento','cobranca_forma.php')); 
	array_push($menu,array('Cadastros','Usuсrios','user.php')); 
	array_push($menu,array('Cadastros','Parceiros','ed_parceiros.php')); 
	array_push($menu,array('Cadastros','Cidades','cidade.php')); 
	array_push($menu,array('Cadastros','Sistema','sistema.php')); 
	array_push($menu,array('Cadastros','Serviчos','servico.php')); 
	array_push($menu,array('Cadastros','Local de coleta','local_coleta.php')); 
	array_push($menu,array('Cadastros','Estado Civil','estado_civil.php')); 
	array_push($menu,array('Cadastros','Produto','produto.php')); 
	array_push($menu,array('Cadastros','Marca de Produto','produto_marca.php')); 
	array_push($menu,array('Cadastros','Agenda/tipo evento','cep_cal_evento.php')); 
	array_push($menu,array('Cadastros','Empresa','empresa.php')); 
	array_push($menu,array('Cadastros','Contas (tipos)','contas.php')); 
	array_push($menu,array('Cadastros','Documentos Check-List','ed_check_list.php')); 
	
	array_push($menu,array('ISO','Pesquisa de satisfaчуo','ed_iso_pesquisa_field.php')); 
	array_push($menu,array('Contrato','Tipos de contrato','ed_contrato_tipo.php')); 
	array_push($menu,array('Contrato','Clausulas do contrato','ed_contrato_field.php')); 
	array_push($menu,array('Tanques','Tanques de Armazenamento','ed_nitrogenio_tanque.php')); 
	}
$tipo = 3;
menus($menu,$tipo);
//	array_push($menu,array('Importaчуo','Importar Antigo','importar.php'));
//	array_push($menu,array('Empresa','Empresas','empresa.php')); 
	 
///////////////////////////////////////////////////// redirecionamento
echo $hd->foot();
?>