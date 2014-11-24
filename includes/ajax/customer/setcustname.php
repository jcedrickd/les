<?php
$q= pg_escape_string(strtoupper($_GET["q"]));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql = "SELECT partners.customer.company_name FROM partners.customer WHERE aaigoc_code='$q'";
	//$sql = "select name from ".$db_table."";
	$result = pg_query($con,$sql) or die("Cannot execute query: $sql\n");
	if(pg_num_rows($result))
	{
		while($row = pg_fetch_array($result))
		{
			echo $row['company_name'];
                }
		
	}
	else{
       // echo '<font color=red>No results found.</font>';
        }
        pg_free_result($result);
       pg_close($con);
?>