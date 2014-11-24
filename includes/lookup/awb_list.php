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

<title>Logistics Enterprise System</title>

    </head>
    <body>
		<div id="wrapper_lookup">
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<thead>
<tr>
<th>Stock No.</th>
<th>Airline Code</th>
<th>AWB No. From</th>
<th>AWB No. To</th>
<th>AWB Count</th>
<th>Remaining</th>
</tr>
</thead>
<tbody>
<tr>
<td><?php //echo $row['dept']; ?></td>
<td><?php ?></td>
<td><?php //echo $row['last_name']; ?></td>
<td><?php //echo $row['first_name']; ?></td>
<td><?php //echo $row['sat_group']; ?></td>
<td></td>
</tr>
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
