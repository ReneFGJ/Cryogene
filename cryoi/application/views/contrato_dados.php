<?php
$DadosResumo = '<h2>Resumo 1</h2>';
$DadosFinanceiro = '<h2>Resumo 2</h2>';
$DadosProcessamento = '<h2>Resumo 4</h2>';
$DadosColeta = '<h2>Resumo 5</h2>';
$DadosArmazenamento = '<h2>Resumo 6</h2>';
?>
<nav id="DadosMenu">
<ul>
	<li><a href="#" id="DR1">Resumo</a></li>
	<li><a href="#" id="DR2">Financeiro</a></li>
	<li><a href="#" id="DR3">Coleta</a></li>
	<li><a href="#" id="DR4">Processamento</a></li>
	<li><a href="#" id="DR5">Armazenamento</a></li>
</ul>
<div id="DadosContent">
	<div id="DR1a"><?php echo $DadosResumo; ?></div>
	<div id="DR2a" style="display: none;"><?php $this->view('contrato_financeiro'); ?></div>
	<div id="DR3a" style="display: none;"><?php $this->view('contrato_coleta'); ?></div>
	<div id="DR4a" style="display: none;"><?php $this->view('contrato_processamento'); ?></div>
	<div id="DR5a" style="display: none;"><?php echo $DadosArmazenamento; ?></div>
</div>
</nav>

<script>
	$("#DR1").click(function() {
		$("#DR1a").show();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
	});
	$("#DR2").click(function() {
		$("#DR1a").hide();
		$("#DR2a").show();
		$("#DR3a").hide();
		$("#DR4a").hide();
		$("#DR5a").hide();
	});
	$("#DR3").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").show();
		$("#DR4a").hide();
		$("#DR5a").hide();
	});
	$("#DR4").click(function() {
		$("#DR1a").hide();
		$("#DR2a").hide();
		$("#DR3a").hide();
		$("#DR4a").show();
		$("#DR5a").hide();
	});		 
</script>