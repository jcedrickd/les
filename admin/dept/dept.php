<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- css of bootstrap-->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">
	
    <!-- css for forms-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />	
	
    <!-- jQuery library -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>	
	
	<!-- css for table-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
	
	<!-- jQuery hover table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
	
    <!-- jQuery highlight table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script>	
	<script>
	function VerifyDeletingItem(){
	var alertmsg = confirm ('Are your want to Delete this Container Type?');
	if (!alertmsg){
	return false;
	}
	else{
	}
}
</script>
</head>
<body>		
<div id="wrapper">
<?php
//FOR DELETE QUERY
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 

if (isset($_POST['delete'])){
$DelItem=@$_POST['checkbox'];
if(!$DelItem){
}
else{
foreach ($DelItem as $key=>$val){
	$DelEach="DELETE FROM department WHERE dept_code='$val'";
	$delQuery = @sybase_query($DelEach);
	if(!$delQuery){
	
	}
	else{
		$errMsg = " Record(s) has been successfully Deleted!";
	}
}
}
}
?>

<b class="module">Department List</b>
<span id="inputError"><b style="text-indent:10px;"><?php echo @$errMsg;?></b></span>
<form method="post" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
	<input type="button" class="btn btn-danger css_button btn-xs" value="Add" onClick="window.location.href='insert.php'">
	</div><!--div class="form-group"-->
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="delete" onClick="return VerifyDeletingItem();" value="Delete" />
	</div><!--div class="form-group"-->
</div><!--div class="form-inline col-xs-12 inline_elements"-->
<div style="height:25px;width:inherit;"> </div>
<div style="float:left;"><table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">

<thead>
	<tr>
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>">Edit</th>
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_delete; ?>">Delete</th>
	<th>Code</th>
	<th>Description</th>
	<th>SAP Code</th>
	</tr>
</thead>	

<tbody>

<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT * FROM department");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){
?>
<tr>
	<td style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>"><a class="hover_row" href="edit.php?getValiD=<?php echo @$row['dept_code'];?>">Edit</td>
	<td style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_delete; ?>"><input type="checkbox" value="<?php echo @$row['dept_code']; ?>" name="checkbox[]" class="highlight_row" /></td>
	<td><?php echo @$row['dept_code']; ?></td>
	<td><?php echo @$row['dept_desc']; ?></td>
	<td><?php echo @$row['sap_code']; ?></td>
</tr>
<?php 
	}
sybase_free_result($query);
sybase_close($link);
?>
</tbody>
<!--tfoot><tr><td colspan="13"><div id="paging"><ul>
	<li><a href="#"><span>Previous</span></a></li>
	<li><a href="#" class="active"><span>1</span></a></li>
	<li><a href="#"><span>2</span></a></li>
	<li><a href="#"><span>3</span></a></li>
	<li><a href="#"><span>4</span></a></li>
	<li><a href="#"><span>5</span></a></li>
	<li><a href="#"><span>Next</span></a></li>
</ul></div></tr></tfoot-->
</table>
<p>Total No. of Records: <?php echo number_format($numrows); ?></p>
</div>
</form>
</div>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
</body>
</html>