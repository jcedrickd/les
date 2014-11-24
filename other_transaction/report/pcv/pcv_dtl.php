<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT pcv_date FROM pcv_hdr");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){
?>
<tr>
	<td><?php echo @$row['pcv_date']; ?></td>
	<td><?php echo @$row['pcv_no']; ?></td>
	<td><?php echo @$row['pcv_type']; ?></td>
	<td><?php echo @$row['job_order_no']; ?></td>
	<td><?php echo @$row['cust_name']; ?></td>
	<td><?php echo @$row['mawb']; ?></td>
	<td><?php echo @$row['hawb']; ?></td>
	<td><?php echo @$row['payee_name']; ?></td>
	<td><?php echo @$row['dept_desc']; ?></td>
	<td><?php echo @$row['dept_desc']; ?></td>
	<td><?php echo @$row['pcv_stat']; ?></td>
	<td><?php echo @$row['validate_by']; ?></td>
</tr>
<?php 
	}
sybase_free_result($query);
sybase_close($link);
?>