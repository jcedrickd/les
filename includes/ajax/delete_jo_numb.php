<?php
$foreign_recno_dbid=$_POST['foreign_recno_dbid'];
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$result=sybase_query("DELETE FROM oth_services 
INNER JOIN booking_charges ON booking_charges.foreign_recno_dbid=oth_services.foreign_recno_dbid
WHERE booking_charges.foreign_recno_dbid=$foreign_recno_dbid");
sybase_free_result($result);
sybase_close($link);    
?>
