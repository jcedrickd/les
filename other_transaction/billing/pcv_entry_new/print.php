<?php
define('__CORE__',dirname(dirname(dirname(dirname(__FILE__)))) . '\includes\\');
require_once(__CORE__."db_connect.php");
$sybase	= new db_connect();

$getjo	= $sybase->get_records("pcv_hdr",array('job_order_no'),"pcv_no='OS-000034689'");
foreach($getjo as $getjoVal)
{
	foreach($sybase->tablefields as $tablefield)
	{
		$field			= $tablefield;
		$$tablefield	= $getjoVal->$tablefield;
	}
}

// ---- GET HEADER OF PRINT -------
$table		= "pcv_hdr";
$fields		= array('job_order_no','cust_name','mcarref','hcarref','service_type','chg_wt','release_type','fd_bd');
$condition	= "job_order_no = '$job_order_no'";
$result	= $sybase->get_records($table,$fields,$condition);
foreach($result as $resultVal)
{
	foreach($sybase->tablefields as $tablefield)
	{
		$field			= $tablefield;
		$$tablefield	= $resultVal->$tablefield;
	}
}

// ---- GET HEADER VALUES ----

$table		= "pcv_hdr b";
$fields		= array('a.chg_desc','a.php_cost','a.receipted_exp','b.payee_code','a.pcv_no','b.station_id','a.cash');
$condition	= "( a.job_order_no like '$job_order_no%' ) and  ( b.pcv_stat = 'X' ) AND ( b.validate_stat = 'X' )";
$tablejoin	= "LEFT OUTER JOIN pcv_dtl a ON b.pcv_no = a.pcv_no  ";
$result_dtl	= $sybase->get_records($table,$fields,$condition,$tablejoin);

$dtlRows	= "";
$totalLoc1	= 0;
$totalLoc2	= 0;
$totalLoc3	= 0;
$totalLoc4	= 0;
$totalLoc5	= 0;
foreach($result_dtl as $result_dtlVal)
{
	foreach($sybase->tablefields as $tablefield)
	{
		$field			= $tablefield;
		$$tablefield	= $result_dtlVal->$tablefield;
	}
	
	$dtlRows	.= "<tr>";
	$dtlRows	.= "<td>$chg_desc</td>";
	$dtlRows	.= "<td>$pcv_no</td>";
	$dtlRows	.= "<td>$payee_code</td>";
	
	$loc1		= "";
	$loc2		= "";
	$loc3		= "";
	$loc4		= "";
	$loc5		= "";
	if ($station_id == "000")
		{
		$loc1	= number_format($php_cost,2);
		$totalLoc1	= $totalLoc1	+ $php_cost;
		}
	elseif ($station_id	== 'CV1')
		{
		$loc2	= number_format($php_cost,2);
		$totalLoc1	= $totalLoc1	+ $php_cost;
		}
	elseif ($station_id	== 'CL1')
		{
		$loc4	= number_format($php_cost,2);
		$totalLoc4	= $totalLoc4	+ $php_cost;
		}
	elseif ($station_id	== 'SB1')
		{
		$loc5	= number_format($php_cost,2);
		$totalLoc5	= $totalLoc5	+ $php_cost;
		}
	else
		{
		$loc3	= number_format($php_cost,2);
		$totalLoc3	= $totalLoc3	+ $php_cost;
		}
		
		
	$dtlRows	.= "<td align='right'>$loc1</td>";
	$dtlRows	.= "<td align='right'>$loc2</td>";
	$dtlRows	.= "<td align='right'>$loc3</td>";
	$dtlRows	.= "<td align='right'>$loc4</td>";
	$dtlRows	.= "<td align='right'>$loc5</td>";
	
	$dtlRows	.= "</tr>";
}

?>

<html>
<head>
<style>
body
{
width: 100%;
margin: 0 auto;
font-family: arial;
}

body,table
{
font-size: 12px;
}

table
{
width: 100%;
}

#logo
{
margin: 10 100px;
}

.theader
{
border: 1px solid #000;
padding: 5px;
background: #ACF;
}

table td
{
padding: 5px;
}

@print
{
body
	{
		width: 100%;
	}
}
</style>
</head>
<body>
	<p align="center"><img id="logo" src="../../../images/general/aailogo.jpg"/></p>
	
	<h2 align="center">SHIPMENT EXPENSE REPORT</h2>

	<table cellpadding="5">
		<tr>
			<td width="15%"><b>Job Order No. :</b></td>
			<td width="35%"><?php echo $job_order_no?></td>
			
			<td width="15%"><b>Type of Service :</b></td>
			<td width="35%"><?php echo $service_type?></td>
		</tr>
		
		<tr>
			<td><b>Customer :</b></td>
			<td><?php echo $cust_name?></td>
			
			<td><b>Entry Type :</b></td>
			<td><?php echo $fd_bd?></td>
		</tr>
		
		<tr>
			<td><b>MAWB :</b></td>
			<td><?php echo $mcarref?></td>
			
			<td><b>Release Type :</b></td>
			<td><?php echo $release_type?></td>
		</tr>
		
		<tr>
			<td><b>HAWB :</b></td>
			<td><?php echo $hcarref?></td>
			
			<td><b>Chargeable WT .:</b></td>
			<td><?php echo $chg_wt?></td>
		</tr>
	</table>
	
	<table>
		<tr>
			<th></th>
			<th class="theader">PCV NO.</th>
			<th class="theader">PAYEE</th>
			<th class="theader">HEAD OFFICE</th>
			<th class="theader">CAVITE</th>
			<th class="theader">LAGUNA</th>
			<th class="theader">CLARK</th>
			<th class="theader">SUBIC</th>
		</tr>
		<tr>
			<td class="theader">OTHER EXPENSES<td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class="theader">RECEIPTED EXPENSES<td>
		</tr>
		<?php echo $dtlRows?>
		
		<tr>
			<td align="center"><b>TOTAL RECEIPTED EXPENSES</b></td>
			<td></td>
			<td></td>
			<td align="right"><?php echo number_format($totalLoc1,2);?></td>
			<td align="right"><?php echo number_format($totalLoc2,2);?></td>
			<td align="right"><?php echo number_format($totalLoc3,2);?></td>
			<td align="right"><?php echo number_format($totalLoc4,2);?></td>
			<td align="right"><?php echo number_format($totalLoc5,2);?></td>
		</tr>
	</table>
</body>
</html>