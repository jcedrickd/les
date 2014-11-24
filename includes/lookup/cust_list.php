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
<label class="field">Name:</label> <input type="text" name="company_name" value="" class="input" /> <input type="submit" value="Search" name="search" class="btn btn-danger css_button btn-xs" /><br /><br />
</form>
	</div>
</div>
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<tr>
<th>Code</th>
<th>Name</th>
<th>Address</th>
</tr>
<tr>
<?php 
if(strlen(@$_GET['company_name']) < 1 && (isset($_GET['search']) || !isset($_GET['search']))){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql="SELECT COUNT(partners.customer.aaigoc_code) FROM partners.customer LEFT OUTER JOIN public.country ON 
partners.customer.country_code = public.country.country_code     
WHERE ( partners.customer.deleted is null ) OR ( partners.customer.deleted = '0' )";
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
$query1=pg_query($con,"SELECT partners.customer.address,partners.customer.city,partners.customer.state_province,partners.customer.zipcode,           
partners.customer.aaigoc_code,partners.customer.company_name,public.country.country_desc FROM partners.customer LEFT OUTER JOIN public.country ON 
partners.customer.country_code = public.country.country_code WHERE ( partners.customer.deleted is null ) OR ( partners.customer.deleted = '0' ) 
ORDER BY partners.customer.company_name ASC LIMIT $rowsperpage OFFSET $offset");
while($row1=pg_fetch_array($query1)){
?>
<td><input type="text" name="aaigoc_code" value="<?php echo $row1['aaigoc_code']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(id_name.value,this.value);" /></td>
<td><?php echo $row1['company_name']; ?></td>
<td><?php echo $row1['address']." ".$row1['city']." ".$row1['state_province']." ".$row1['country_desc']." ".$row1['zipcode']; ?></td>
</tr>
<?php 
}
pg_free_result($query1);
pg_close($con);
}elseif(strlen($_GET['company_name']) > 0 && isset($_GET['search'])){
$company_name=trim(strtoupper(pg_escape_string($_GET['company_name'])));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql="SELECT COUNT(partners.customer.aaigoc_code) FROM partners.customer LEFT OUTER JOIN public.country ON 
partners.customer.country_code = public.country.country_code     
WHERE ( partners.customer.deleted is null ) OR ( partners.customer.deleted = '0' ) AND company_name LIKE '%$company_name%'";
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
$query1=pg_query($con,"SELECT partners.customer.address,partners.customer.city,partners.customer.state_province,partners.customer.zipcode,           
partners.customer.aaigoc_code,partners.customer.company_name,public.country.country_desc FROM partners.customer LEFT OUTER JOIN public.country ON 
partners.customer.country_code = public.country.country_code WHERE ( partners.customer.deleted is null ) OR ( partners.customer.deleted = '0' ) 
AND company_name LIKE '%$company_name%' ORDER BY company_name ASC LIMIT $rowsperpage OFFSET $offset");
while($row1=pg_fetch_array($query1)){
?>
<td><input type="text" name="aaigoc_code" value="<?php echo $row1['aaigoc_code']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(id_name.value,this.value);" /></td>
<td><?php echo $row1['company_name']; ?></td>
<td><?php echo $row1['address']." ".$row1['city']." ".$row1['state_province']." ".$row1['country_desc']." ".$row1['zipcode']; ?></td>
</tr>
<?php 
}
pg_free_result($query1);
pg_close($con);
}
?>
<tfoot>
<tr>
<p>Total No. of Records: <?php echo number_format($numrows); ?></p>
</tr>
</tfoot>
</table>
<?php
if(strlen(@$_GET['company_name']) < 1 && (isset($_GET['search']) || !isset($_GET['search']))){
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1&id_name=".$_GET['id_name']."'>First</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage&id_name=".$_GET['id_name']."'>Previous</a> ";
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
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x&id_name=".$_GET['id_name']."'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage&id_name=".$_GET['id_name']."'>Next</a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages&id_name=".$_GET['id_name']."'>Last</a> ";
    } // end if
/****** end build pagination links ******/
//http://www.phpfreaks.com/tutorial/basic-pagination
}elseif(strlen($_GET['company_name']) > 0 && isset($_GET['search'])){
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1&id_name=".$_GET['id_name']."&company_name=".trim(urlencode($company_name))."&search=Search'>First</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage&id_name=".$_GET['id_name']."&company_name=".trim(urlencode($company_name))."&search=Search'>Previous</a> ";
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
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x&id_name=".$_GET['id_name']."&company_name=".trim(urlencode($company_name))."&search=Search'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage&id_name=".$_GET['id_name']."&company_name=".trim(urlencode($company_name))."&search=Search'>Next</a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages&id_name=".$_GET['id_name']."&company_name=".trim(urlencode($company_name))."&search=Search'>Last</a> ";
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