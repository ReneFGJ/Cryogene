<?php
function contrato_link($contrato)
	{
		$contrato = trim($contrato);
		$sx = base_url('index.php/contrato/view/'.$contrato.'/'.checkpost_link($contrato));
		$sx = '<a href="'.$sx.'" class="contrato">';
		return($sx);
	}
function cliente_link($cliente)
	{
		$cliente = trim($cliente);
		$sx = base_url('index.php/cliente/view/'.$cliente.'/'.checkpost_link($cliente));
		$sx = '<a href="'.$sx.'" class="contrato">';
		return($sx);
	}	
function boleto_link($boleto)
	{
		$cliente = trim($boleto);
		$sx = base_url('index.php/boleto/view/'.$boleto.'/'.checkpost_link($boleto));
		$sx = '<a href="'.$sx.'" class="boleto" target="_new">';
		return($sx);
	}	
?>