<?php
$doc_ref=trim($_GET['doc_ref']);
if(strlen($doc_ref) > 0){
	include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	$check_billed=sybase_query("SELECT COUNT(bill_no) AS ll_tot_bill FROM c_bill_hdr WHERE (c_bill_hdr.doc_ref='$doc_ref') AND (c_bill_hdr.status='X')");
	$billed=sybase_fetch_array($check_billed);
		/*if($billed['ll_tot_bill'] > 0){
		echo '<span style="color:red">Error: Failed to Recall/Cancel. Job Order No. '.$jo_numb.' already billed.</span>';
		}*/
	echo $billed['ll_tot_bill'];
	sybase_free_result($check_billed);
	sybase_close($link);
}
?>