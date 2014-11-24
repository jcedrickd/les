<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$payee_code= validate_input(strtoupper($_GET["payee_code"]));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$result=  sybase_query("SELECT fullname FROM useracc WHERE user1='$payee_code'");
    if(sybase_num_rows($result) > 0){
    $useracc=  sybase_fetch_array($result);
    echo $useracc['fullname'];
    }else{
    include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
    $sql = "SELECT partners.customer.company_name FROM partners.customer WHERE aaigoc_code='$payee_code'";
    $result1 = pg_query($con,$sql) or die("Cannot execute query: $sql\n");
    $payee=  pg_fetch_array($result1);
    echo $payee['company_name'];
    pg_free_result($result1);
    pg_close($con);
    }
sybase_free_result($result);
sybase_close($link);
?>
