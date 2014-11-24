<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
 
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="icon" href="http://wmsonline.aai.com.ph/favicon.ico" />

<meta name="description" content="" />
<meta name="keywords" content="" />

<meta name="author" content="" />
<!-- css of bootstrap-->
<link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

<!-- jQuery library -->
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<!-- css for table-->
<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/table_style.css?version=1" />

<!-- css for form-->
<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/form_style.css" />

<script language="javascript"> 
function changeParent(id_name,str){ 
  window.opener.document.getElementById(id_name).value= str;
  window.opener.document.getElementById('service_code').value="";
  window.opener.document.getElementById('service_description').value="";
  window.close();
} 
</script>        
<title>Logistics Enterprise System</title>

    </head>
    <body>
		<div id="wrapper_lookup">
<!--center><b class="module">Job Order Entry</b></center><br /><br /-->

<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<form method="get">
<input type="hidden" name="id_name" value="<?php echo $_GET['id_name']; ?>" id="id_name" />
<label class="field">Group Description:</label> <input type="text" name="charge_group_desc" value="" class="input bigtxt" />
<input type="submit" value="Search" name="search" class="btn btn-danger css_button btn-xs" /><br /><br />
</form>
	</div>
</div>
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<thead>
<tr>
<th>Group Code</th>
<th>Group Description</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
if((isset($_GET['search']) || !isset($_GET['search'])) && strlen(@$_GET['charge_group_desc']) < 1){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$query1=pg_query($con,"SELECT public.charge_group.charge_group_code,public.charge_group.charge_group_desc FROM public.charge_group 
ORDER BY public.charge_group.charge_group_code ASC,public.charge_group.charge_group_desc ASC");
$numrows=pg_num_rows($query1);
while($row=pg_fetch_array($query1)){
?> 
<td><input type="text" name="chg_grp" value="<?php echo $row['charge_group_code']; ?>" onClick="changeParent(id_name.value,this.value);" style="cursor:pointer" readonly="readonly" class="input" /></td>
<td><?php echo $row['charge_group_desc']; ?></td>
</tr>
<?php 
}
pg_free_result($query1);
pg_close($con);
}
elseif(isset($_GET['search']) && strlen($_GET['charge_group_desc']) > 0){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$charge_group_desc=trim(pg_escape_string(ucfirst($_GET['charge_group_desc'])));
$charge_group_desc1=trim(pg_escape_string(strtoupper($_GET['charge_group_desc'])));
pg_prepare($con,"select_charge_group","SELECT public.charge_group.charge_group_code,public.charge_group.charge_group_desc FROM public.charge_group 
WHERE charge_group_desc LIKE $1 OR charge_group_desc LIKE $2 ORDER BY public.charge_group.charge_group_code ASC,
public.charge_group.charge_group_desc ASC");
$query2=pg_execute($con,"select_charge_group",array("%".$charge_group_desc."%","%".$charge_group_desc1."%"));
$numrows=pg_num_rows($query2);
while($row2=pg_fetch_array($query2)){
?>
<td><input type="text" name="chg_grp" value="<?php echo $row['charge_group_code']; ?>" onClick="changeParent(id_name.value,this.value);" style="cursor:pointer" readonly="readonly" class="input" /></td>
<td><?php echo $row2['charge_group_desc']; ?></td>
</tr>
<?php
}
pg_free_result($query2);
pg_close($con);
}
?>
</tbody>
<tfoot>
<tr>
<p>Total No. of Records: <?php echo number_format($numrows); ?></p>
</tr>
</tfoot>
</table>
</div> <!-- End #wrapper -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>