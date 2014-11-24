<?php
	include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
	$csr_value=  validate_input(strtoupper($_GET['csr_reference']));
	include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	$count_csr=sybase_query("SELECT COUNT(jo_numb) AS ll_count FROM oth_services WHERE csr = '$csr_value' and (status = 'A' or status = 'X')");
	$count=sybase_fetch_array($count_csr);
	echo $count['ll_count'];
	sybase_free_result($count_csr);
	sybase_close($link);
?>