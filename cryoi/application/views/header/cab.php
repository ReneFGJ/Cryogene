<?php
$this -> load -> view("header/header");
//$this -> load -> view('header/analytics.google.php');
$this -> load -> view('header/cab_ajax_loading');
?>
<div class="cab">
	<div class="menu_left">
		<img src="<?php echo base_url('img/logo_cryo.png');?>" id="logotype" >
		<UL class="nav_menu">
			<LI>
				<a href="<?php echo base_url('');?>">
					<img src="<?php echo base_url('/img/icone_menu.png');?>" border=0 height="20" title="main menu">
			</LI>
		</UL>
	</div>
	<div class="geral">
		<div id="div1">
			&nbsp;&nbsp;<a href="<?php echo base_url('pt_BR');?>"><img src="<?php echo base_url('img/ididoma_br.png');?>" border=0 title="Portugues" alt="Portugues"></A>
				| <?php echo $this->session->userdata('name');?>
			<BR>
			<BR>
		</div>

	</div>
</div>
<div class="versao">v0.15.22</div>
<BR><BR>
<div id="content">
