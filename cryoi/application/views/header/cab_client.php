<?php
$this -> load -> view("header/header");
//$this -> load -> view('header/analytics.google.php');
$this -> load -> view('header/cab_ajax_loading');

/* */
$contrato = '';
if (isset($_SESSION['contrato'])) {
	$contrato = $_SESSION['contrato'];
	$cliente = $_SESSION['contrato_nome'];
	$chk = $_SESSION['ctr'];
} else {
	$contrato = '';
	$cliente = '';
}
?>
<div class="cab">
	<div class="menu_left">
		<img src="<?php echo base_url('img/logo_cryo.png'); ?>" id="logotype" >
		<UL class="nav_menu">
			<LI>
				<a href="<?php echo base_url('index.php/'); ?>"> <img src="<?php echo base_url('/img/icone_menu.png'); ?>" border=0 height="20" title="main menu"> </a>
			</LI>
		</UL>
	</div>
	<?php  if (strlen($contrato) > 0) { ?>}
	<div class="geral">
		<div id="div1">
			&nbsp;&nbsp;<a href="<?php echo base_url('pt_BR'); ?>"><img src="<?php echo base_url('img/ididoma_br.png'); ?>" border=0 title="Portugues" alt="Portugues"></A>
			| <?php echo $cliente . ' | ' . $contrato; ?>
			<BR>
			<BR>
		</div>
		<br>
		<br>
		<?php
		$this -> load -> view("header/cab_nav_client");
		?>
	</div>
	<?php } ?>
</div>
<div class="versao">
	v0.15.45
</div>
<BR>
<BR>
<div id="content">