<style>
	.navigation {
		width: 800px;
		height: 50px;
	}
	.nav {
		margin: 0px;
		padding: 0px;
		list-style: none;
	}

	.nav li {
		float: left;
		width: auto;
		position: relative;
		padding-right: 20px;
	}

	.nav li a {
		background: #1d4161;
		color: #ddd;
		display: block;
		padding: 7px 8px;
		text-decoration: none;
		border-top: 1px solid #069;
	}

	.nav li a:hover {
		color: #fff;
	}

	/*=== submenu ===*/

	.nav ul {
		display: none;
		position: absolute;
		margin-left: 0px;
		list-style: none;
		padding: 0px;
		background-color: #3d7191;
	}

	.nav ul li {
		width: 160px;
		float: left;
	}

	.nav ul a {
		display: block;
		height: 15px;
		padding: 7px 8px;
		color: #ddd;
		text-decoration: none;
		border-bottom: 1px solid #222;
	}

	.nav ul li a:hover {
		color: #fff;
	}
</style>
<div class='navigation'>
	<ul class="nav">
		<li>
			<a href="<?php echo base_url('index.php/main'); ?>">Home</a>
		</li>
		<li>
		<li>
			<A HREF="#">Clientes</A>
			<ul>
				<li>
					<a href="<?php echo base_url('index.php/cliente/busca'); ?>">Busca cliente</a>
				</li>
				<li>
					<a href="<?php echo base_url('index.php/cliente/row'); ?>">Cadastro do cliente</a>
				</li>
				<li>
					<a href="<?php echo base_url('index.php/cliente/row_limbo'); ?>">Cliente (autocadastro)</a>
				</li>				
			</ul>
		</li>
		<li>
			<A HREF="#">Contratos</A>
			<ul>
				<li>
					<a href="<?php echo base_url('index.php/contrato'); ?>">Contratos</a>
				</li>
				<li>
					<a href="<?php echo base_url('index.php/contrato/resumo'); ?>">Situa��o</a>
				</li>
			</ul>			
		</li>
		<li>
			<A HREF="#">Relacionamento Cliente</A>
			<ul>
				<li>
					<a href="<?php echo base_url('index.php/contas_receber/boletos_atrasados'); ?>">Boletos atrasados</a>
				</li>
			</ul>

		</li>
		<li>
			<A HREF="#">Contas a receber</A>
			<ul>
				<li>
					<a href="<?php echo base_url('index.php/contas_receber/razao_boleto'); ?>">Raz�o Boletos</a>
				</li>
				<li>
					<a href="<?php echo base_url('index.php/contas_receber/boletos'); ?>">Boletos</a>
				</li>
				<li>
					<a href="<?php echo base_url('index.php/contas_receber/gerar_faturamento'); ?>">Gerar Faturamento</a>
				</li>
				<li>
					<a href="<?php echo base_url('index.php/ic/row'); ?>">Enviar e-mail</a>
				</li>
			</ul>
		</li>
		<li>
			<A HREF="#">Admin</A>
			<ul>
				<li>
					<a href="<?php echo base_url('index.php/contas_receber/taxa_negociacao'); ?>">Tipos de Negocia��o</a>
				</li>
			</ul>
		</li>		
		<li>
			<a href="<?php echo base_url('index.php/main/logout'); ?>">Sair</a>
		</li>
	</ul>
</div>

<script type="text/javascript">
	$(document).ready(
	/* This is the function that will get executed after the DOM is fully loaded */
	function() {
		/* Next part of code handles hovering effect and submenu appearing */
		$('.nav li').hover(function() {//appearing on hover
			$('ul', this).fadeIn();
		}, function() {//disappearing on hover
			$('ul', this).fadeOut();
		});
	}); 
</script>
