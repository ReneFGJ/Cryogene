<div style="text-align: left;">
<?php
echo form_open();
echo form_label('busca informações');
echo '<BR>';
$data = array('name'=>'dd1','value'=>'','class'=>'lt4 fullscreen','value'=>get("dd1"));
echo form_input($data);
$data = array('name'=>'acao','value'=>'BUSCA >>');
echo form_submit($data);
echo form_close();
?>
</div>