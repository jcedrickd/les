<?php
	include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
	$csr_value=  validate_input(strtoupper($_GET['csr_ref']));
	include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	$query_csr_jo=sybase_query("SELECT jo_numb FROM oth_services WHERE csr = '$csr_value' and (status = 'A' or status = 'X')");
	$csr_jo=sybase_fetch_array($query_csr_jo);
	echo $csr_jo['jo_numb'];
	sybase_free_result($query_csr_jo);
	sybase_close($link);
?>