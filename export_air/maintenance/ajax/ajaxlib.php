<?php
$type	= isset($_POST['type']) ? $_POST['type'] : "";
require_once("../../../includes/db_connect.php");
$cond	= isset($_POST['condition']) ? $_POST['condition'] : NULL;
$sybase	= new db_connect('boss');
switch($type)
{
	case 'listData':
		$code	= isset($_POST['code']) ? $_POST['code'] : "";
		$table	= isset($_POST['table']) ? $_POST['table'] : "";
		$result	= $sybase->get_records($table,NULL,$cond);
		$arrayVal	= array();
		foreach($result as $resultVal)
		{
			foreach ($sybase->tablefields as $fields)
			{
				$arrayVal[]	= $resultVal->$fields;
			}
		}
	
		echo implode('|',$arrayVal);
	break;
}
?>