<?php
$link = array();
$link['01'] = base_url('client/contract');
$link['02'] = base_url('client/invoice');
$link['03'] = base_url('client/message');
?>
<div id="nav">
	<UL class="nav_ul_n0">
		<LI class="nav_li_n0">
			<b>Informações</b>
		</LI>
		<A href="<? echo $link['01'];?>" class="link01"><li id="menu01_01" class="nav_li_n2">Contrato</li></A>
		<A href="<? echo $link['02'];?>" class="link01"><li id="menu01_02" class="nav_li_n2">Pagamentos</li></A>
		<A href="<? echo $link['03'];?>" class="link01"><li id="menu01_02" class="nav_li_n2">Mensagens</li></A>

	</UL>
</div>

