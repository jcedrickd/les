<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$csr_value=  validate_input(strtoupper($_GET['csr_value']));
if($_GET['type'] == 'attached_csr'){
	$row_num = $_GET['row_num'];
	$result = pg_query($con,"select a.csr_level
from csr.service_record a left join partners.customer b on
a.shipper_aaigoc_code = b.aaigoc_code left join csr.freight_header e on
a.csr_no = e.csr_no  
where csr_reference = '$csr_value' and service_code in ('OS','WH','CR') 
and a.approved = true
and (a.expired_csr = false or a.expired_csr is null)
and isnull(a.sp_service_no,0) not in (
select ss.service_no
from sp.services ss join sp.statuses sss on
ss.header_no = sss.header_no
where sss.status_code in('SC'))");	
	$data = array();
	if(pg_num_rows($result) < 1){
	$name = $csr_value.'|'.'0'.'|'.$row_num;//csr not found
	array_push($data, $name);	
	}else{
		while ($row = pg_fetch_array($result)){
		$name = $csr_value.'|'.$row['csr_level'].'|'.$row_num;
		array_push($data, $name);	
		}
	}
	echo json_encode($data);
pg_free_result($result);
pg_close($con);
}
?>