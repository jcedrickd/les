<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$chg_grp=validate_input(strtoupper($_GET['chg_grp']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$query1=pg_query($con,"SELECT public.charge_group.charge_group_desc FROM public.charge_group WHERE public.charge_group.charge_group_code='$chg_grp'");
$grp=pg_fetch_array($query1);
echo $grp['charge_group_desc'];
pg_free_result($query1);
pg_close($con);
?>