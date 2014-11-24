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
  window.close();
} 
</script>        
<title>Logistics Enterprise System</title>

    </head>
    <body>
		<div id="wrapper_lookup">
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<form method="get">
<input type="hidden" name="id_name" value="<?php echo $_GET['id_name']; ?>" id="id_name" />
<label class="field">User Name:</label> <input type="text" name="user1" value="" class="input" /> <input type="submit" value="Search" name="search" class="btn btn-danger css_button btn-xs" /><br /><br />
</form>
	</div>
</div>

<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<thead>
<tr>
<th>Department</th>
<th>User</th>
<th>Last Name</th>
<th>First Name</th>
<th>Satellite Group</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
if((isset($_GET['search']) || !isset($_GET['search'])) && strlen(@$_GET['user1']) < 1){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT dept,user1,last_name,first_name,sat_group,fullname FROM useracc ORDER BY dept,last_name ASC");
$numrows=sybase_num_rows($query1);
while($row=sybase_fetch_array($query1)){
?> 
<td><?php echo $row['dept']; ?></td>
<td><input type="text" name="user1" value="<?php echo $row['user1']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(id_name.value,this.value);" /></td>
<td><?php echo $row['last_name']; ?></td>
<td><?php echo $row['first_name']; ?></td>
<td><?php echo $row['sat_group']; ?></td>
</tr>
<?php 
}
sybase_free_result($query1);
sybase_close($link);
}
elseif(isset($_GET['search']) && strlen($_GET['user1']) > 0){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$user1=trim(strtoupper($_GET['user1']));
$query2=sybase_query("SELECT dept,user1,last_name,first_name,sat_group,fullname FROM useracc WHERE user1 LIKE '%$user1%' ORDER BY dept,last_name ASC");
$numrows=sybase_num_rows($query2);
while($row2=sybase_fetch_array($query2)){
?>
<td><?php echo $row2['dept']; ?></td>
<td><input type="text" name="user1" value="<?php echo $row2['user1']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(id_name.value,this.value);" /></td>
<td><?php echo $row2['last_name']; ?></td>
<td><?php echo $row2['first_name']; ?></td>
<td><?php echo $row2['sat_group']; ?></td>
</tr>
<?php
}
sybase_free_result($query2);
sybase_close($link);
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

    </body>
</html>
