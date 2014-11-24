<?php
define('__CORE__',dirname(dirname(dirname(dirname(__FILE__)))) . '\includes\\');
require_once(__CORE__."sybase_connection.php");

$sybase	= new Sybase_connect();

$result	= $sybase->get_records('department');

?>
