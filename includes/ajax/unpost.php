<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$unpost_reason=validate_input($_POST['recall_reason']);
$unpost_jo_numb=validate_input($_POST['recall_jo_numb']);
$unpost_doc_ref=validate_input($_POST['recall_doc_ref']);
$user=$_SESSION['username'];
$recall_type=$_POST['recall_type'];
$recall_module_no=$_POST['recall_module_no'];
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$unpost=sybase_query("UPDATE oth_services SET status = 'A',unpost_reason='$unpost_reason' WHERE jo_numb='$unpost_jo_numb'");
sybase_free_result($unpost);
$log=sybase_query("INSERT INTO action_log(trans_ref,action_ref,exec_by,exec_datetime,action_reason,mmain_ctrlno)VALUES('$unpost_doc_ref','$recall_type','$user',GETDATE(),'$unpost_reason',$recall_module_no)");
sybase_free_result($log);
sybase_close($link);
?>