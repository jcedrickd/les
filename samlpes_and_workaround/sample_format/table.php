<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<!-- css of bootstrap-->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

        <!-- css for table-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
	
         <!-- css for forms-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />
	
	<!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	 
        <!-- jQuery hover table row-->
        <script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
        
        <!-- jQuery highlight table row-->
        <script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script>      
	
    </head>
    <body>
<div style="float:left" id="table">
<div style="height:5px;width:inherit;"></div>
<div class="form-inline col-xs-12">
<div style="height:5px;width:inherit;"></div>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_insert; ?>" name="add" value="Add" id="add" <?php //echo @$add_disabled; ?> /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_delete; ?>" name="delete" value="Delete" id="delete" <?php //echo @$delete_disabled; ?> /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs" name="view_tariff" value="View Tariff" id="view_tariff" <?php //echo @$view_tariff_disabled; ?> /></span>
</div>
<br />
<div style="height:25px;width:inherit;"> </div>
<div style="float:left;">   
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
    <tr>
	<th style="<?php //echo $hide_column; ?>" class="hidable_column <?php //echo @$access_update; ?>">Override</th>
	<th style="<?php //echo $hide_column; ?>" class="hidable_column <?php //echo @$access_delete; ?>">Delete</th>
	<th>Job Order No</th>
	<th>Code</th>
	<th>Description</th>
	<th>Grp Code</th>
	<th>Grp Description</th>
	<th>PHP Cost</th>
	<th>USD Cost</th>
	<th>Receipted</th>
	<th>PCV Type</th>
	<th>FMS Code</th>
    </tr>
</thead>
<tbody>
<!--tr id="booking_charges_from_csr"></tr-->
<tr>
	<td style="<?php //echo $hide_column; ?>" class="hidable_column <?php //echo @$access_update; ?>"><a href="http://<?php //echo $_SERVER['SERVER_NAME'];?>/les/other_transaction/billing/pcv_entry_new/pcvdtl_ctrlno.php?pcvdtl_ctrlno=<?php //echo @$row['pcvdtl_ctrlno']; ?>" class="hover_row">Override</a></td>
	<td style="<?php //echo $hide_column; ?>" class="hidable_column <?php //echo @$access_delete; ?>"><input type="checkbox" value="<?php //echo @$row['pcvdtl_ctrlno']; ?>" name="checkbox[]" class="highlight_row" /></td>
	<td><?php //echo @$row['job_order_no']; ?></td>
        <td><?php //echo @$row['chg_code']; ?></td>
        <td><?php //echo @$row['chg_desc']; ?></td>
        <td><?php //echo @$row['grp_code']; ?></td>
        <td><?php //echo @$row['grp_desc']; ?></td>
        <td><?php //echo number_format(@$row['php_cost'],2); ?></td>
        <td><?php //echo number_format(@$row['usd_cost'],2); ?></td>
        <td><input type="checkbox" name="receipted_exp" value="<?php //echo @$row['receipted_exp']; ?>" <?php //echo show_receipted_exp(@$row['receipted_exp']); ?> onclick="return false;"  /></td>
        <td><?php //echo show_pcv_type(@$row['cash']); ?></td>
        <td><?php //echo @$row['check_bp']; ?></td>
</tr>
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
</table></div>
<p>Total No. of Records: <?php //echo @$numrows; ?></p>
<p>Total Receipted: <?php //echo number_format(show_total_receipted($pcv_no),2); ?></p>
<p>Total Unreceipted: <?php //echo number_format(show_total_unreceipted($pcv_no),2); ?></p>
<p>Total Cheque: <?php //echo number_format(show_total_cheque($pcv_no),2); ?></p>
</div>
    </body>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
</html>
