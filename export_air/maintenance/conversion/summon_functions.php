<?php
function insert_conversion($curr_code,$curr_desc,$curr_usd,$curr_usdx,$usd_php,$effect_date,$effect_date_to,$curr_apply,$add_edit){
//include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
@$db = @sybase_select_db("BOSS");	
$insert_conversion=  sybase_query("INSERT INTO conversion_table    
(curr_code,curr_desc,curr_usd,curr_usdx,usd_php,effect_date,effect_date_to,curr_apply,add_edit,add_date,add_time)
VALUES
('$curr_code','$curr_desc',$curr_usd,$curr_usdx,$usd_php,'$effect_date','$effect_date_to','$curr_apply','$add_edit',GETDATE(),GETDATE())");
@sybase_free_result($insert_conversion);
sybase_close($link);
}
function update_conversion($curr_code,$curr_desc,$curr_usd,$curr_usdx,$usd_php,$effect_date,$effect_date_to,$curr_apply,$add_edit,$convtable_ctrlno){
//include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
@$db = @sybase_select_db("BOSS");	
$update_conversion=  sybase_query("UPDATE conversion_table SET curr_code='$curr_code',curr_desc='$curr_desc',
curr_usd=$curr_usd,curr_usdx=$curr_usdx,usd_php=$usd_php,effect_date='$effect_date',effect_date_to='$effect_date_to',
curr_apply='$curr_apply',add_edit='$add_edit',add_date=GETDATE(),add_time=GETDATE()
WHERE convtable_ctrlno=$convtable_ctrlno");
@sybase_free_result($update_conversion);
sybase_close($link);    
}

include_once($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$curr_code =		isset($_POST['curr_code']) ? validate_input($_POST['curr_code']) : "";
$curr_desc =		isset($_POST['curr_code']) ? validate_input($_POST['curr_desc']) : "";
$curr_usd =			isset($_POST['curr_code']) ? validate_input($_POST['curr_usd']) : "";
$curr_usdx =		isset($_POST['curr_code']) ? validate_input($_POST['curr_usdx']) : "";
$usd_php =			isset($_POST['curr_code']) ? validate_input($_POST['usd_php']) : "";
$effect_date =		isset($_POST['curr_code']) ? validate_input($_POST['effect_date']) : "";
$effect_date_to =	isset($_POST['curr_code']) ? validate_input($_POST['effect_date_to']) : "";
$curr_apply =		isset($_POST['curr_code']) ? validate_input($_POST['curr_apply']) : "";
$add_edit =			isset($_POST['curr_code']) ? validate_input($_POST['add_edit']) : "";
$convtable_ctrlno =	isset($_POST['curr_code']) ? validate_input($_GET['convtable_ctrlno']) : "";
?>