<?php
include 'summon_functions.php';
$prepared_by=$_SESSION['username'];
$date_prepared=date("m/d/Y H:i");

if(!isset($_GET['recno']) && !isset($_POST['save'])){
$selling_currency="PHP";
}
if(isset($_POST['back'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/jo_entry.php?foreign_recno_dbid=".$_POST['foreign_recno_dbid']);
}
if(isset($_POST['save']) && validate_override_booking_charges($chg_grp,$service_code,$selling_rate,$selling_currency,$collect_tag,$bill_to_code)!=1){
    if(strlen($recno) < 1){
    //insert    
    insert_booking_charges($foreign_recno_dbid,$selling_rate,$selling_currency,$collect_tag,$bill_to_code,$bill_to_name,$override_by,$date_override,$chg_grp,$chg_grp_desc,$service_code,$service_description,$prepared_by);
    //below is update the total_charges
    $tot_selling_rate=select_tot_selling_rate($_POST['foreign_recno_dbid']);
    update_tot_chgs($tot_selling_rate,$_POST['foreign_recno_dbid']);
    }else{
	//update
    override_booking_charges($selling_rate,$selling_currency,$collect_tag,$bill_to_code,$bill_to_name,$override_by,$date_override,$_POST['recno']);
    //below is update the total_charges
    $tot_selling_rate=select_tot_selling_rate($_POST['foreign_recno_dbid']);
    update_tot_chgs($tot_selling_rate,$_POST['foreign_recno_dbid']);
    }
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/jo_entry.php?foreign_recno_dbid=".$_POST['foreign_recno_dbid']);
}
//for override
if(isset($_GET['recno']) && !isset($_POST['save'])){
	$charge=select_a_booking_charge($_GET['recno']);
	$service_code=$charge['service_code'];
	$service_description=$charge['service_description'];
	$chg_grp=$charge['chg_grp'];
	$chg_grp_desc=$charge['chg_grp_desc'];
	$selling_rate=$charge['selling_rate'];
	$selling_currency=$charge['selling_currency'];
	$collect_tag=$charge['collect_tag'];
	$bill_to_code=$charge['bill_to_code'];
	$bill_to_name=$charge['bill_to_name'];
	$prepared_by=$charge['prepared_by'];
	$date_prepared=$charge['date_prepared'];
	$override_by=$_SESSION['username'];
	$date_override=date("m/d/Y H:i");
}
/*if(isset($_POST['add']) && validate_override_booking_charges($chg_grp,$service_code,$selling_rate,$selling_currency,$collect_tag,$bill_to_code)!=1){
insert_booking_charges($foreign_recno_dbid,$selling_rate,$selling_currency,$collect_tag,$bill_to_code,$bill_to_name,$override_by,$date_override,$chg_grp,$chg_grp_desc,$service_code,$service_description,$prepared_by);
//below is update the total_charges
$tot_selling_rate=select_tot_selling_rate($_POST['foreign_recno_dbid']);
update_tot_chgs($tot_selling_rate,$_POST['foreign_recno_dbid']);
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/jo_entry.php?foreign_recno_dbid=".$_POST['foreign_recno_dbid']);
}*/
?>