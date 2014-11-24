<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
$pcv_no=  validate_input(strtoupper($_POST['pcv_no']));
$username=$_SESSION['username'];
$vc_reason=  validate_input($_POST['vc_reason']);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$cancel=  sybase_query("UPDATE pcv_hdr SET pcv_stat = 'C',vc_reason ='$vc_reason',vc_by ='$username',vc_datetime = GETDATE() WHERE pcv_hdr.pcv_no='$pcv_no'");
sybase_free_result($cancel);
sybase_close($link);
?>