<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
@$db = @sybase_select_db("BOSS");
$curr_code=validate_input($_GET['curr_code']);
$result_curr_desc=sybase_query("SELECT curr_desc FROM cur_tabl WHERE curr_code='$curr_code'");
$desc=  sybase_fetch_array($result_curr_desc);
echo $desc['curr_desc'];
sybase_free_result($result_curr_desc);
sybase_close($link);
?>