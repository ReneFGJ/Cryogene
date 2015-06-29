<?
require("cab.php");
require("include/sisdoc_colunas.php");
require("include/sisdoc_data.php");

$sql = "select * from medico";
$sql .= ' left join cidade on md_cidade = c_codigo ';
$sql .= " where id_md =".$dd[0];
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	}
// Laudo
?>
<table width="<?=$tab_max;?>">
<TR><TD align="right"><font class="lt1">Nome do médico</TD><TD class="lt2"><B><?=$line['md_nome'];?></TD></TR>
<TR><TD align="right" class="lt1">CRM</TD><TD class="lt2"><?=$line['md_cr'].' '.$line['md_cr_uf'];;?></TD></TR>
<TR><TD align="right" class="lt1">Sexo</TD><TD class="lt2"><?=$line['md_sexo'];?></TD></TR>
<TR><TD align="right" class="lt1">Estado civil</TD><TD class="lt2"><?=$line['md_est_civil'];?></TD></TR>
<TR><TD align="right" class="lt1">Nacionalidade</TD><TD class="lt2"><?=$line['md_nacionalidade'];?></TD></TR>
<TR><TD><HR></TD><TD>Contato</TD>
<TR><TD align="right" class="lt1">Nome secretária</TD><TD class="lt2"><?=$line['md_secretaria'];?></TD></TR>
<TR><TD align="right" class="lt1">telefones</TD><TD class="lt2"><B>(<?=$line['md_fone_ddd'];?>)<?=$line['md_fone_1'];?>&nbsp;<?=$line['md_fone_2'];?>&nbsp;<?=$line['md_fone_3'];?></TD></TR>
<TR><TD align="right" class="lt1">e-mail</TD><TD class="lt2"><?=$line['md_email'];?></TD></TR>
<TR><TD align="right" class="lt1">e-mail alternativo</TD><TD class="lt2"><?=$line['md_email_alt'];?></TD></TR>
<TR><TD><HR></TD><TD>Endereço</TD>
<TR><TD align="right" class="lt1">Endereço</TD><TD class="lt2"><?=$line['md_endereco'];?></TD></TR>
<TR><TD align="right" class="lt1">Bairro</TD><TD class="lt2"><?=$line['md_bairro'];?></TD></TR>
<TR><TD align="right" class="lt1">Cidade</TD><TD class="lt2"><?=$line['c_cidade'];?></TD></TR>
<TR><TD align="right" class="lt1">CEP</TD><TD class="lt2"><?=$line['md_cep'];?></TD></TR>
<TR><TD align="right" class="lt1">Data Nascimento</TD><TD class="lt2"><?=$line['md_dt_nasc'];?></TD></TR>
<TR><TD><HR></TD><TD>Dados para pagamento</TD>
<TR><TD align="right" class="lt1">CPF</TD><TD class="lt2"><?=$line['md_cpf'];?></TD></TR>
<TR><TD align="right" class="lt1">Banco</TD><TD class="lt2"><?=$line['md_at_banco'];?></TD></TR>
<TR><TD align="right" class="lt1">nº CC</TD><TD class="lt2"><?=$line['md_at_cc'];?></TD></TR>
<TR><TD align="right" class="lt1">Nome titular</TD><TD class="lt2"><?=$line['md_at_cc_titular'];?></TD></TR>
<TR><TD align="right" class="lt1">Forma</TD><TD class="lt2"><?=$line['md_at_fp'];?></TD></TR>
<TR><TD align="right" class="lt1">Local para doação</TD><TD class="lt2"><?=$line['md_at_local'];?></TD></TR>
<TR><TD><HR></TD><TD>Outras Informações</TD>
<TR><TD align="right" class="lt1">Especialidade</TD><TD class="lt2"><?=$line['md_profissao'];?></TD></TR>
<TR><TD align="right" class="lt1">Parceira</TD><TD class="lt2"><?=$line['md_parceira'];?></TD></TR>
<TR><TD align="right" class="lt1">Coleta</TD><TD class="lt2"><?=$line['md_coletas'];?></TD></TR>
</TABLE>
<?
require("foot.php");
?>