<?php
$r= pg_escape_string(strtoupper($_GET["r"]));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql = "SELECT partners.customer.address,partners.customer.city,partners.customer.state_province,partners.customer.zipcode,public.country.country_desc 
		FROM partners.customer LEFT OUTER JOIN public.country ON partners.customer.country_code = public.country.country_code 
		WHERE partners.customer.aaigoc_code='$r'";
	//$sql = "select name from ".$db_table."";
	$result = pg_query($con,$sql) or die("Cannot execute query: $sql\n");
	if(pg_num_rows($result))
	{
		while($row = pg_fetch_array($result))
		{
			echo $row['address']." ".$row['city']." ".$row['state_province']." ".$row['country_desc']." ".$row['zipcode'];;
                }
		
	}
	else{
       // echo '<font color=red>No results found.</font>';
        }
        pg_free_result($result);
       pg_close($con);
?>