<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
if($_GET['type'] == 'oth_services'){
	$row_num = $_GET['row_num'];
	$result = sybase_query("SELECT * FROM oth_services WHERE jo_numb = '".strtoupper($_GET['jo_numb_search'])."'");	
	$data = array();
	while ($row = sybase_fetch_array($result)) {
		$name = $row['jo_numb'].'|'.$row['c_code'].'|'.$row['client'].'|'.$row['doc_type'].'|'.$row['doc_ref'].'|'.$row['hawbno'].'|'.$row['mawbno']
		.'|'.$row['oth_reference'].'|'.$row['item_description'].'|'.$row['agent_code'].'|'.$row['agent_name'].'|'.$row['exrate'].'|'.$row['qnty'].'|'.$row['wt'].'|'.$row['cbm'].'|'.
		$row['jo_numb'].'|'.$row['status'].'|'.$row['trans_type'].'|'.$row['service_type'].'|'.$row['transaction_date'].'|'.$row['bill_to_dept'].'|'.
		$row['total_charges'].'|'.$row['bill_no'].'|'.$row['prepared_by'].'|'.$row['prepared_datetime'].'|'.
		$row['transmit_no'].'|'.$row['transmit_date'].'|'.$row['transmit_by'].'|'.$row['trucking_from'].'|'.$row['trucking_to'].'|'.$row['trucking_dr'].'|'.$row['instructions'].'|'.
		$row['foreign_recno_dbid'].'|'.$row['csr'].'|'.$row_num;
		array_push($data, $name);	
	}	
	echo json_encode($data);
sybase_close($link);
}
?>