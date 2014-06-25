<?
$tabela = "contrato_field";

$cp = array();
array_push($cp,array('$H8','id_sub','id_sa',False,True,''));
array_push($cp,array('$H10','sub_codigo','codigo',False,True,''));
array_push($cp,array('$S50','sub_descricao','Título',True,True,''));
array_push($cp,array('$O 1:1&2:2&3:3&4:4&5:5&6:6&7:7&8:8&9:9&10:10&11:11&12:12&13:13&14:14','sub_pos','Página',True,True,''));
array_push($cp,array('$O 1:1&2:2&3:3&4:4&5:5&6:6&7:7&8:8&9:9&10:10&11:11&12:12&13:13&14:14','sub_ordem','Ordem',True,True,''));
array_push($cp,array('$Q sp_descricao:sp_codigo:select * from submit_manuscrito_ceua_tipo where sp_ativo = 1	','sub_projeto_tipo','Tipo do projeto',False,True,''));
array_push($cp,array('$T50:4','sub_field','Tipo do campo',True,True,''));
array_push($cp,array('$T50:4','sub_caption','Informativo',False,True,''));
array_push($cp,array('$I8','sub_limite','Limite de palavras',False,True,''));
array_push($cp,array('$T50:4','sub_informacao','Informações (i)',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','sub_ativo','Ativo',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','sub_obrigatorio','Obrigatório',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','sub_editavel','Editavel',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','sub_pdf_mostra','Ativo no PDF',False,True,''));
array_push($cp,array('$S60','sub_pdf_title','Título no PDF',False,True,''));
array_push($cp,array('$O L:Esquerda&D:Direita&J:Justificado&C:Centralizado','sub_pdf_align','Alinhamento',False,True,''));
array_push($cp,array('$O 12:12&8:8&10:10&6:6&4:4','sub_pdf_font_size','Size',False,True,''));
array_push($cp,array('$O 6:6&5:5 (referencia)&8:8&10:10&12:12&4:4&2:2&1:1&0:0','sub_pdf_space','Size space',False,True,''));
/// Gerado pelo sistem "base.php" versao 1.0.5
?>