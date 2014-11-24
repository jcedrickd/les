<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
$csr_value= validate_input(strtoupper($_GET['csr_oth_services']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$query1=pg_query($con,"select b.aaigoc_code as c_code,
b.company_name as c_name,
isnull(prepaid, 'N'),
a.csr_level
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
$csr=pg_fetch_array($query1);
?>
<div><label class="field">Customer:</label> <input type="text" name="c_code" value="<?php echo @$csr['c_code']; ?>" class="input" placeholder="Code" onFocus="showCust(this.value);" onKeyUp="showCust(this.value);" id="c_code" /> <input type="text" name="client" value="<?php echo @$csr['c_name']; ?>" class="input second_input bigtxt" readonly="readonly" id="client" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('c_code');return false;" /></div>
<?php 	
pg_free_result($query1);
pg_close($con);
?>