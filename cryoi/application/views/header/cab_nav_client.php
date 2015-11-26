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
			<a href="<?php echo base_url('index.php/client'); ?>">Home</a>
		</li>
		<li>		
			<A HREF="<?php echo base_url('index.php/client/contrato'); ?>">Dados do Armazenamento</A>
		</li>		
		<li>
			<a href="<?php echo base_url('index.php/client/logout'); ?>">Sair</a>
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
