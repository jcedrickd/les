<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$service_code=validate_input(strtoupper($_GET['service_code']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$query1=pg_query($con,"SELECT public.charge.charge_desc FROM public.charge WHERE public.charge.charge_code='$service_code'");
$chg=pg_fetch_array($query1);
echo $chg['charge_desc'];
pg_free_result($query1);
pg_close($con);
?>