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
<!--center><b class="module">Job Order Entry</b></center><br /><br /-->

<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<form method="get">
<input type="hidden" name="id_name" value="<?php echo $_GET['id_name']; ?>" id="id_name" />
<input type="hidden" name="chg_grp" value="<?php echo $_GET['chg_grp']; ?>" />
<input type="hidden" name="trans_type" value="<?php echo $_GET['trans_type']; ?>" />
<label class="field">Service Description:</label> <input type="text" name="service_description" value="<?php echo @$_GET['service_description']; ?>" class="input bigtxt" />
<input type="submit" value="Search" name="search" class="btn btn-danger css_button btn-xs" /><br /><br />
</form>
	</div>
</div>
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<thead>
<tr>
<th>Charge Code</th>
<th>Charge Description</th>
<th>Group Code</th>
</tr>
</thead>
<tbody>
<tr>
<?php
$_GET['chg_grp'] == "" ? $and_chg_grp="" : $and_chg_grp="AND ( public.charge_list.charge_group_code LIKE '$_GET[chg_grp]')" ;
if((isset($_GET['search']) || !isset($_GET['search'])) && strlen(@$_GET['service_description']) < 1){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$query1=pg_query($con,"SELECT public.charge.charge_code,public.charge.charge_desc,public.charge_list.service_code,public.charge_list.charge_group_code  
FROM public.charge LEFT OUTER JOIN public.charge_list ON public.charge.charge_code = public.charge_list.charge_code     
WHERE ( public.charge_list.service_code = '$_GET[trans_type]' )  $and_chg_grp
ORDER BY public.charge.charge_code ASC,public.charge.charge_desc ASC");
$numrows=pg_num_rows($query1);
while($row=pg_fetch_array($query1)){
?> 
<td><input type="text" name="chg_grp" value="<?php echo $row['charge_code']; ?>" onClick="changeParent(id_name.value,this.value);" style="cursor:pointer" readonly="readonly" class="input" /></td>
<td><?php echo $row['charge_desc']; ?></td>
<td><?php echo $row['charge_group_code']; ?></td>
</tr>
<?php 
}
pg_free_result($query1);
pg_close($con);
}
elseif(isset($_GET['search']) && strlen($_GET['service_description']) > 0){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$service_description=validate_input($_GET['service_description']);
$query2=pg_query($con,"SELECT public.charge.charge_code,public.charge.charge_desc,public.charge_list.service_code,public.charge_list.charge_group_code  
FROM public.charge LEFT OUTER JOIN public.charge_list ON public.charge.charge_code = public.charge_list.charge_code     
WHERE ( public.charge_list.service_code = '$_GET[trans_type]' )  $and_chg_grp
AND public.charge.charge_desc LIKE '%$service_description%' ORDER BY public.charge.charge_code ASC,public.charge.charge_desc ASC");
$numrows=pg_num_rows($query2);
while($row2=pg_fetch_array($query2)){
?>
<td><input type="text" name="chg_grp" value="<?php echo $row2['charge_code']; ?>" onClick="changeParent(id_name.value,this.value);" style="cursor:pointer" readonly="readonly" class="input" /></td>
<td><?php echo $row2['charge_desc']; ?></td>
<td><?php echo $row2['charge_group_code']; ?></td>
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