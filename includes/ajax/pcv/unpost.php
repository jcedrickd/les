<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
$pcv_no=  validate_input(strtoupper($_POST['pcv_no']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$check_unpost=  sybase_query("SELECT pcv_stat,validate_stat FROM pcv_hdr WHERE pcv_no='$pcv_no'");
$stat=  sybase_fetch_array($check_unpost);
if($stat['pcv_stat'] == "A"){
echo '<b>Error: PCV No.: '.$pcv_no.' already active.</b>';    
}
elseif($stat['pcv_stat'] == "C" || $stat['pcv_stat'] == "V"){
echo '<b>Error: Failed to active PCV No.: '.$pcv_no.'. It was already cancelled/void!</b>';            
}
elseif($stat['pcv_stat'] == "X" && ($stat['validate_stat'] == "A" || $stat['validate_stat'] == "")){
$unpost=  sybase_query("UPDATE pcv_hdr SET pcv_stat = 'A' WHERE pcv_hdr.pcv_no = '$pcv_no'");
@sybase_free_result($unpost);
echo 'Unposted';
}
@sybase_free_result($check_unpost);
sybase_close($link);
?>
