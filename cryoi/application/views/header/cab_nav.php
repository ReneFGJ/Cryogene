<?php
$link = array();
$link['01'] = base_url('index.php/contas_receber/boletos');
$link['03'] = base_url('index.php/contas_receber/gerar_faturamento');
$link['04'] = base_url('index.php/contas_receber/razao_boleto');
?>
<div id="nav">
<div id="navleft">

	<ul>

		<li class="nav_li_n0">
			<b>menu principal</b>
		</li>

		<li>
			<a href="#" id="menu01">Contas a receber</a>
		</li>
		<A href="#" class="link01">
		<li style="display: none" id="menu01_01" class="nav_li_n2">
			Faturas
		</li></A>
		<A href="<? echo $link['01']; ?>" class="link01">
		<li style="display: none" id="menu01_02" class="nav_li_n2">
			Boleto Bancário
		</li></A>
		<A href="<? echo $link['03']; ?>" class="link01">
		<li style="display: none" id="menu01_03" class="nav_li_n2">
			Gerar Faturamento
		</li></A>
		<A href="<? echo $link['04']; ?>" class="link01">
		<li style="display: none" id="menu01_04" class="nav_li_n2">
			Gerencial
		</li></A>
		<li>
			<a href="#">ISO-9001</a>
		</li>

		<li>
			<a href="#">Armazenamento</a>
		</li>

		<li>
			<a href="#">Templates</a>
		</li>

		<li>
			<a href="#">About</a>
		</li>
		<li>
			<a href="<?php echo base_url('index.php/ic/sendmail');?>">Enviar e-mail</a>
		</li>

	</ul>

</div>
	<UL class="nav_ul_n0">
		<LI class="nav_li_n0">
			<b>menu principal</b>
		</LI>
		<LI class="nav_li_n1" >
			
		</LI>


		<LI class="nav_li_n1" id="menu02">
			Contratos
		</LI>
		<A href="#" class="link01">
		<li style="display: none" id="menu02_01" class="nav_li_n2">
			Todos do contratosuras
		</li></A>
		<A href="#" class="link01">
		<li style="display: none" id="menu02_02" class="nav_li_n2">
			Propostas de contrato
		</li></A>

		<LI class="nav_li_n1" id="menu03">
			Armazenamento
		</LI>
		<A href="#" class="link01">
		<li style="display: none" id="menu03_01" class="nav_li_n2">
			Faturas
		</li></A>
		<A href="#" class="link01">
		<li style="display: none" id="menu03_02" class="nav_li_n2">
			Boleto Bancï¿½rio
		</li></A>
		<A href="#" class="link01">
		<li style="display: none" id="menu03_03" class="nav_li_n2">
			Gerar Faturamento
		</li></A>

		<LI class="nav_li_n1" id="menu04">
			ISO-9001
		</LI>
		<A href="#" class="link01">
		<li style="display: none" id="menu04_01" class="nav_li_n2">
			Faturas
		</li></A>
		<A href="#" class="link01">
		<li style="display: none" id="menu04_02" class="nav_li_n2">
			Boleto Bancï¿½rio
		</li></A>
		<A href="#" class="link01">
		<li style="display: none" id="menu04_03" class="nav_li_n2">
			Gerar Faturamento
		</li></A>

	</UL>
</div>

<script>
	$("#menu01").click(function() {
		$("#menu01_01").fadeToggle(200);
		$("#menu01_02").fadeToggle(400);
		$("#menu01_03").fadeToggle(800);
		$("#menu01_04").fadeToggle(1200);
	});
	$("#menu02").click(function() {
		$("#menu02_01").fadeToggle(200);
		$("#menu02_02").fadeToggle(400);
	});
	$("#menu03").click(function() {
		$("#menu03_01").fadeToggle(400);
		$("#menu03_02").fadeToggle(800);
		$("#menu03_03").fadeToggle(1600);
	});
	$("#menu04").click(function() {
		$("#menu04_01").fadeToggle(400);
		$("#menu04_02").fadeToggle(600);
		$("#menu04_03").fadeToggle(800);
	}); 
</script>