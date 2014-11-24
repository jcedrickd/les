<!--?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php'); 
// Check connection
if (pg_connect_errno()) {
  echo "Failed to connect to Postgre: " . pg_connect_error();
}

$pg='DELETE FROM container_type WHERE id = \''.$_POST[container_type_code].'\';' 

pg_close($con);
?>