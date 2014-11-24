<?php
/*contains user access*/
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query_access=sybase_query("SELECT user_access_mod.mod_stat_code
FROM menu_main INNER JOIN user_access_mod ON menu_main.mmain_ctrlno=user_access_mod.mmain_ctrlno
WHERE user_access_mod.user_code='$_SESSION[username]' AND menu_main.mmain_ctrlno=134
ORDER BY mmain_name ASC");
$access=array();
while ($row = sybase_fetch_array($query_access)){
$access[]=$row['mod_stat_code'];
}
sybase_free_result($query_access);
sybase_close($link);

if(!in_array("S0002", $access))	$access_update='hide';
	
if(!in_array("S0003", $access))	$access_insert='hide';

if(!in_array("S0004", $access))	$access_delete='hide';

if(!in_array("S0005", $access))	$access_post='hide';

if(!in_array("S0006", $access))	$access_unpost='hide';

if(!in_array("S0007", $access))	$access_cancel='hide';

if(!in_array("S0009", $access))	$access_force_post='hide';

if(!in_array("S0018", $access))	$access_force_recall='hide';

if(!in_array("S0019", $access))	$access_validate='hide';

if(!in_array("S0020", $access))	$access_unvalidate='hide';

?>