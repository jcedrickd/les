<!--?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
// Check connection
if (sybase_connect_errno()) {
  echo "Failed to connect to Sybase: " . sybase_connect_error();
}

$sql='DELETE FROM pcv_approver WHERE id = \''.$_POST[code].'\';' 

sybase_close($con);
?>