<?php
$DadosResumo = '<h2>Resumo 1</h2>';
$DadosFinanceiro = '<h2>Resumo 2</h2>';
$DadosProcessamento = '<h2>Resumo 4</h2>';
$DadosColeta = '<h2>Resumo 5</h2>';
$DadosArmazenamento = '<h2>Resumo 6</h2>';

$data = array();
$DR9_style = 'display: none;';
if ($boleto_aberto > 0) {
	$DR9_style = '';
}
?>
<nav id="DadosMenu">
<ul>
	<li><a href="#" id="DR1">Resumo</a></li>
	<li><a href="#" id="DR2">Financeiro</a></li>
	<li><a href="#" id="DR3">Coleta</a></li>
	<li><a href="#" id="DR4">Processamento</a></li>
	<li><a href="#" id="DR5">Armazenamento</a></li>
	<li><a href="#" id="DR6">Mensagens</a></li>
	<li><a href="#" id="DR7">Acompanhamento</a></li>
	<li><a href="#" id="DR8">Dados dos Responsáveis</a></li>
	<li><a href="#" id="DR9" style="background-color: #ffc0c0; <?php echo $DR9_style; ?>">Negociação</a></li>
</ul>
<div id="DadosContent">
	<div id="DR1a"><?php echo $DadosResumo; ?></div>
	<div id="DR2a" style="display: none;"><?php $this -> view('contrato_financeiro'); ?></div>
	<div id="DR3a" style="display: none;"><?php $this -> view('contrato_coleta'); ?></div>
	<div id="DR4a" style="display: none;"><?php $this -> view('contrato_processamento'); ?></div>
	<div id="DR5a" style="display: none;"><?php echo $DadosArmazenamento; ?></div>
	<div id="DR6a" style="display: none;"><?php $this -> load -> view('contrato_message'); ?></div>
	<div id="DR7a" style="display: none;"><?php $this -> load -> view('contrato_rp'); ?></div>
	<div id="DR8a" style="display: none;"><?php echo $DadosContatos; ?></div>
	<div id="DR9a" style="display: none;">Negociação</div>
</div>
</nav>

<script>
	$("#DR1").click(function() {
		$("#DR1a").show();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").hide();
		$("#DR8a").hide();
		$("#DR9a").hide();
	});
	$("#DR2").click(function() {
		$("#DR1a").hide();
		$("#DR2a").show();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").hide();
		$("#DR8a").hide();
		$("#DR9a").hide();
	});
	$("#DR3").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").show();
		$("#DR4a").hide();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").hide();
		$("#DR8a").hide();
		$("#DR9a").hide();
	});
	$("#DR4").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").show();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").hide();
		$("#DR8a").hide();
		$("#DR9a").hide();
	});
	$("#DR5").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").show();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").hide();
		$("#DR8a").hide();
		$("#DR9a").hide();
	});
	$("#DR6").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
		$("#DR6a").show();
		$("#DR7a").hide();
		$("#DR8a").hide();
		$("#DR9a").hide();
	});
	$("#DR7").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").show();
		$("#DR8a").hide();
		$("#DR9a").hide();
	});
	$("#DR8").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").hide();
		$("#DR8a").show();
		$("#DR9a").hide();
	});
	$("#DR9").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
		$("#DR6a").hide();
		$("#DR7a").hide();
		$("#DR8a").hide();
		$("#DR9a").show();
	});
<?php
$pag = get("dd3");
if (strlen($pag) > 0) {
	echo '$("#DR1a").hide();' . cr();
	echo '$("#DR' . $pag . 'a").show();' . cr();
}
?></script>