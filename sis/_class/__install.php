<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_debug.php');
require("_class_log.php");
$nw = new log;
//$nw->structure();

require("_class_usuario.php");
$nw = new usuario;
$nw->structure();


echo "OK ".date("Y-m-d H:i:s");
