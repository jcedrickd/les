<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
$pcv_numb_search=  validate_input(strtoupper($_GET['pcv_numb_search']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
if($_GET['type'] == 'pcv_entry'){
	$row_num = $_GET['row_num'];
	$result = sybase_query("SELECT * FROM pcv_hdr WHERE pcv_no='$pcv_numb_search'");	
	$data = array();
	while ($row = sybase_fetch_array($result)) {
		$name = $row['pcv_no'].'|'.$row['payee_code'].'|'.$row['payee_name'].'|'.$row['cust_code'].'|'.$row['cust_name'].'|'.$row['service_type'].'|'.$row['transmit_no']
		.'|'.$row['fin_transmit_no'].'|'.$row['petty_cash_replenish'].'|'.$row['tot_cash'].'|'.$row['tot_cheque'].'|'.$row['grand_total'].'|'.$row['job_order_no'].'|'.$row['mcarref'].'|'.$row['hcarref'].'|'.
		$row['dr_no'].'|'.$row['shipper_code'].'|'.$row['shipper_name'].'|'.$row['pcv_stat'].'|'.$row['pcv_type'].'|'.$row['pcv_date'].'|'.
		$row['miscellaneous_pcv'].'|'.$row['type_by'].'|'.$row['validate_by'].'|'.$row['verified_by'].'|'.
		$row['approved_by'].'|'.$row['station_id'].'|'.$row['tot_rcpt_cost'].'|'.$row['tot_urcpt_cost'].'|'.$row['arrival_date'].'|'.$row['commodity'].'|'.$row['rcv_by'].'|'.
		$row['act_wt'].'|'.$row['chg_wt'].'|'.$row['nopcs'].'|'.$row['exrate'].'|'.$row['other_ref'].'|'.
                $row['instruction'].'|'.$row['release_type'].'|'.$row['fd_bd'].'|'.$row_num;
		array_push($data, $name);	
	}	
	echo json_encode($data);
sybase_close($link);
}
?>