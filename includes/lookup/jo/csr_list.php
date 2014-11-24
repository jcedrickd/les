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
<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/table_style.css" />

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
<!--center><b class="module">Job Order Entry</b></center-->
<!--br /><br /-->
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<form method="get">
<input type="hidden" name="id_name" value="<?php echo $_GET['id_name']; ?>" id="id_name" />
<input type="hidden" name="service_code" value="<?php echo $_GET['service_code']; ?>" />
 <label class="field">Shipper:</label> <input type="text" name="shipper_name" value="" class="input bigtxt" /> <input type="submit" value="Search" name="search" class="btn btn-danger css_button btn-xs" /><br /><br />
</form>
	</div>
</div>
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<thead>
<tr>
<th>CSR Reference</th>
<th>Service Code</th>
<th>Shipper</th>
<th>Agent</th>
<th>Consignee</th>
<th>Incoterm</th>
<th>Org</th>
<th>Dest</th>
</tr>
</thead>
<tbody>
<tr>
<?php
$_GET['service_code'] == 'OS' ? $or_service_code="OR a.service_code='WH'" : $or_service_code="";

if(strlen(@$_GET['shipper_name']) < 1 && (isset($_GET['search']) || !isset($_GET['search']))){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql="SELECT COUNT(a.csr_reference) FROM csr.service_record a LEFT JOIN partners.customer b on
a.agent_aaigoc_code = b.aaigoc_code LEFT JOIN partners.customer c on
a.consignee_aaigoc_code = c.aaigoc_code LEFT JOIN partners.customer d on
a.shipper_aaigoc_code = d.aaigoc_code LEFT JOIN airport e on
a.origin = e.airport_code LEFT JOIN airport f on
a.destination = f.airport_code WHERE  (a.expired_csr = false or a.expired_csr is null) AND (a.service_code='$_GET[service_code]' $or_service_code)";
$result = pg_query($con,$sql) or trigger_error("SQL", E_USER_ERROR);
$r = pg_fetch_row($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 20;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;
?>
<?php
$query1=pg_query($con,"SELECT a.csr_reference,a.stationid,a.service_code,a.country_code,a.incoterm,a.destination,a.origin,
isnull(b.aaigoc_code,'') as agent_code,isnull(b.company_name,'') as agent_name,isnull(c.aaigoc_code,'') as consignee_code,
isnull(c.company_name,'') as consignee_name,isnull(d.aaigoc_code,'') as shipper_code,isnull(d.company_name,'') as shipper_name,
csr_no,status_flag,isnull(e.country_code,'') as origin_country_code,isnull(f.country_code,'') as destination_country_code,
isnull(c.address,'') as c_address1,isnull(c.city,'') as c_address2,isnull(c.state_province,'') as c_address3,
isnull(d.address,'') as s_address1,isnull(d.city,'') as s_address2,isnull(d.state_province,'') as s_address3,
isnull(b.c_type, '') as c_type, a.note,a.nature,a.expired_csr
FROM csr.service_record a LEFT JOIN partners.customer b on
a.agent_aaigoc_code = b.aaigoc_code LEFT JOIN partners.customer c on
a.consignee_aaigoc_code = c.aaigoc_code LEFT JOIN partners.customer d on
a.shipper_aaigoc_code = d.aaigoc_code LEFT JOIN airport e on
a.origin = e.airport_code LEFT JOIN airport f on
a.destination = f.airport_code 
WHERE  (a.expired_csr = false or a.expired_csr is null) AND (a.service_code='$_GET[service_code]' $or_service_code) ORDER BY csr_reference ASC LIMIT $rowsperpage OFFSET $offset");
while($row1=pg_fetch_array($query1)){
?>
<td><input type="text" value="<?php echo $row1['csr_reference']; ?>" style="cursor:pointer" readonly="readonly" class="input bigtxt" onClick="changeParent(id_name.value,this.value);" /></td>
<td><?php echo $row1['service_code']; ?></td>
<td><?php echo $row1['shipper_name']; ?></td>
<td><?php echo $row1['agent_name']; ?></td>
<td><?php echo $row1['consignee_name']; ?></td>
<td><?php echo $row1['incoterm']; ?></td>
<td><?php echo $row1['origin']; ?></td>
<td><?php echo $row1['destination']; ?></td>
</tr>
<?php 
}
pg_free_result($query1);
pg_close($con);
}elseif(strlen($_GET['shipper_name']) > 0 && isset($_GET['search'])){
$shipper_name=trim(strtoupper(pg_escape_string($_GET['shipper_name'])));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql="SELECT COUNT(a.csr_reference) FROM csr.service_record a LEFT JOIN partners.customer b on
a.agent_aaigoc_code = b.aaigoc_code LEFT JOIN partners.customer c on
a.consignee_aaigoc_code = c.aaigoc_code LEFT JOIN partners.customer d on
a.shipper_aaigoc_code = d.aaigoc_code LEFT JOIN airport e on
a.origin = e.airport_code LEFT JOIN airport f on
a.destination = f.airport_code WHERE  (a.expired_csr = false or a.expired_csr is null) 
AND (a.service_code='$_GET[service_code]' $or_service_code)
AND d.company_name LIKE '%$shipper_name%'";
$result = pg_query($con,$sql) or trigger_error("SQL", E_USER_ERROR);
$r = pg_fetch_row($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 20;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

?>
<?php
$query1=pg_query($con,"SELECT a.csr_reference,a.stationid,a.service_code,a.country_code,a.incoterm,a.destination,a.origin,
isnull(b.aaigoc_code,'') as agent_code,isnull(b.company_name,'') as agent_name,isnull(c.aaigoc_code,'') as consignee_code,
isnull(c.company_name,'') as consignee_name,isnull(d.aaigoc_code,'') as shipper_code,isnull(d.company_name,'') as shipper_name,
csr_no,status_flag,isnull(e.country_code,'') as origin_country_code,isnull(f.country_code,'') as destination_country_code,
isnull(c.address,'') as c_address1,isnull(c.city,'') as c_address2,isnull(c.state_province,'') as c_address3,
isnull(d.address,'') as s_address1,isnull(d.city,'') as s_address2,isnull(d.state_province,'') as s_address3,
isnull(b.c_type, '') as c_type, a.note,a.nature,a.expired_csr
FROM csr.service_record a LEFT JOIN partners.customer b on
a.agent_aaigoc_code = b.aaigoc_code LEFT JOIN partners.customer c on
a.consignee_aaigoc_code = c.aaigoc_code LEFT JOIN partners.customer d on
a.shipper_aaigoc_code = d.aaigoc_code LEFT JOIN airport e on
a.origin = e.airport_code LEFT JOIN airport f on
a.destination = f.airport_code 
WHERE  (a.expired_csr = false or a.expired_csr is null) 
AND (a.service_code='$_GET[service_code]' $or_service_code)
AND d.company_name LIKE '%$shipper_name%' ORDER BY csr_reference ASC LIMIT $rowsperpage OFFSET $offset");
while($row1=pg_fetch_array($query1)){
?>
<td><input type="text" value="<?php echo $row1['csr_reference']; ?>" style="cursor:pointer" readonly="readonly" class="input bigtxt" onClick="changeParent(id_name.value,this.value);" /></td>
<td><?php echo $row1['service_code']; ?></td>
<td><?php echo $row1['shipper_name']; ?></td>
<td><?php echo $row1['agent_name']; ?></td>
<td><?php echo $row1['consignee_name']; ?></td>
<td><?php echo $row1['incoterm']; ?></td>
<td><?php echo $row1['origin']; ?></td>
<td><?php echo $row1['destination']; ?></td>
</tr>
<?php 
}
pg_free_result($query1);
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
<?php
if(strlen(@$_GET['shipper_name']) < 1 && (isset($_GET['search']) || !isset($_GET['search']))){
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=1&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."&service_code=".trim(urlencode($_GET['service_code']))."'>First</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."'>Previous</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b id='currentpage'>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."'>Next</a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."'>Last</a> ";
    } // end if
/****** end build pagination links ******/
//http://www.phpfreaks.com/tutorial/basic-pagination
}elseif(strlen($_GET['shipper_name']) > 0 && isset($_GET['search'])){
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."&shipper_name=".trim(urlencode($shipper_name))."&search=Search'>First</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."&shipper_name=".trim(urlencode($shipper_name))."&search=Search'>Previous</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b id='currentpage'>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."&shipper_name=".trim(urlencode($shipper_name))."&search=Search'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."&shipper_name=".trim(urlencode($shipper_name))."&search=Search'>Next</a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages&id_name=".trim(urlencode($_GET['id_name']))."&service_code=".trim(urlencode($_GET['service_code']))."&shipper_name=".trim(urlencode($shipper_name))."&search=Search'>Last</a> ";
    } // end if
/****** end build pagination links ******/
//http://www.phpfreaks.com/tutorial/basic-pagination
}
?>
</div> <!-- End #wrapper -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>
