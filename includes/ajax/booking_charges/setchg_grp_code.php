<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$chg_code=validate_input(strtoupper($_GET['chg_code']));
$trans_type=validate_input(strtoupper($_GET['trans_type']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$query1=pg_query($con,"SELECT public.charge_list.charge_group_code  
FROM public.charge LEFT OUTER JOIN public.charge_list ON public.charge.charge_code = public.charge_list.charge_code     
WHERE public.charge.charge_code='$chg_code' AND public.charge_list.service_code = '$trans_type'");
$grp=pg_fetch_array($query1);
echo $grp['charge_group_code'];
pg_free_result($query1);
pg_close($con);
?>