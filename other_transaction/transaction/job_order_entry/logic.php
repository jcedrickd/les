<?php
include 'summon_functions.php'; 
$service_type='OS';
$prepared_by=$_SESSION['fullname'];
$prepared_datetime=date("m/d/Y H:i");
$transaction_date=date("m/d/Y H:i");
$transmit_date=date("m/d/Y H:i");
$bill_to_dept="FAD";
$disabled='disabled="disabled"';
if(isset($_POST['refresh'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/jo_entry.php");
}
//for insert
if(isset($_POST['save']) && strlen($foreign_recno_dbid) < 1 && wf_check($c_code,$client,$jo_numb,$service_type,$transaction_date,$exrate,$trans_type)!=1 && $_POST['access_insert'] <> 'hide'){
$new_jo=new_jo_num();
$jo_numb="OS-".sprintf('%06d',$new_jo);
$status='A';
	if(strlen($doc_ref) < 1){
	$doc_type="Job Order No";
	$doc_ref=$jo_numb;
	}
strlen($exrate) < 1 ? $exrate == 0 : $exrate; 
strlen($qnty) < 1 ? $qnty == 0 : $qnty; 
strlen($wt) < 1 ? $wt == 0 : $wt; 
strlen($cbm) < 1 ? $cbm == 0 : $cbm; 
strlen($total_charges) < 1 ? $total_charges == 0 : $total_charges; 

$exrate=  str_replace(",","", $exrate);
$qnty=  str_replace(",","", $qnty);
$wt=  str_replace(",","", $wt);
$cbm=  str_replace(",","", $cbm);
$total_charges=  str_replace(",","", $total_charges);
//below,enable insert_oth_services to perform insert in database
insert_oth_services($csr,$c_code,$client,$doc_type,$doc_ref,$hawbno,$mawbno,$oth_reference,$item_description,$agent_code,
$agent_name,$qnty,$wt,$cbm,$instructions,$jo_numb,$status,$trans_type,$service_type,$transaction_date,$bill_to_dept,$total_charges,
$bill_no,$prepared_by,$prepared_datetime,$transmit_no,$transmit_date,$transmit_by,$trucking_from,$trucking_to,$trucking_dr,$exrate);
update_dbcentral_series($new_jo);
//booking charges from csr ... select and insert
$jo=fill_jo_numb($jo_numb);//select the foreign_recno_dbid
insert_wf_charges($csr,$jo['foreign_recno_dbid'],$_SESSION['username']);
$insert_disabled=' disabled="disabled" ';
echo '<span style="color:green"><b>'.$jo_numb.' Inserted Successfully</b></span>';
}
//for update
if(isset($_POST['save']) && strlen($foreign_recno_dbid) > 0 && $_POST['access_update'] <> 'hide'){
	switch(trim($_POST['status'])){
	case 'Posted':
	$status='X';
	break;
	case 'Active':
	$status='A';
	break;
	case 'Cancel':
	$status='C';
	break;
	default:
	$status='';
	}
	
	if(strlen($doc_ref) < 1){
	$doc_type="Job Order No";
	$doc_ref=$jo_numb;
	}
	
	if(wf_check($c_code,$client,$jo_numb,$service_type,$transaction_date,$exrate,$trans_type)!=1){
        
        strlen($exrate) < 1 ? $exrate == 0 : $exrate; 
        strlen($qnty) < 1 ? $qnty == 0 : $qnty; 
        strlen($wt) < 1 ? $wt == 0 : $wt; 
        strlen($cbm) < 1 ? $cbm == 0 : $cbm; 
        strlen($total_charges) < 1 ? $total_charges == 0 : $total_charges; 

        $exrate=  str_replace(",","", $exrate);
        $qnty=  str_replace(",","", $qnty);
        $wt=  str_replace(",","", $wt);
        $cbm=  str_replace(",","", $cbm);
        $total_charges=  str_replace(",","", $total_charges);
	//below,enable update_oth_services to perform update in database
	update_oth_services($foreign_recno_dbid,$doc_type,$doc_ref,$hawbno,$mawbno,$oth_reference,$item_description,$agent_code,$agent_name,
	$qnty,$wt,$cbm,$instructions,$trans_type,$transaction_date,$bill_to_dept,$total_charges,$bill_no,$prepared_by,$prepared_datetime
	,$transmit_no,$transmit_date,$transmit_by,$trucking_from,$trucking_to,$trucking_dr,$exrate);
    $jo=fill_jo_numb($jo_numb);
            if(trim($jo['csr'])=="" && strlen($csr) > 0){//if there is no csr in db, insert into booking charges
            insert_wf_charges($csr,$foreign_recno_dbid,$_SESSION['username']);    
            }else{
            echo '<span style="color:orange"><b>Warning: There is a CSR already.</b></span>';
            }
	$update_disabled=' disabled="disabled" ';
	echo '<span style="color:green"><b> '.$jo_numb.' Updated Successfully</b></span>';
	}
}
//post
if(isset($_POST['post']) && wf_check_post($foreign_recno_dbid,$trans_type)!=1){
post($jo_numb);  
$status='X';  
$post_disabled=' disabled="disabled" ';
$posted_table='display:none;';
echo '<span style="color:green"><b>'.$jo_numb.' Posted</b></span>';
}
//cancel
if(isset($_POST['cancel'])){
cancel($jo_numb);
$status='C';
$cancel_disabled=' disabled="disabled" ';
$cancelled_table='display:none;';
echo '<span style="color:green"><b>'.$jo_numb.' Cancelled</b></span>';
}
//for booking_charges
//add
if(isset($_POST['add']) && strlen($foreign_recno_dbid) > 0){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/recno.php?foreign_recno_dbid=".$foreign_recno_dbid);
}
//delete
if(isset($_POST['delete']) && isset($_POST['checkbox'])){
delete_booking_charge($_POST['checkbox']);
//below is update the total_charges
$tot_selling_rate=select_tot_selling_rate($foreign_recno_dbid);
update_tot_chgs($tot_selling_rate,$foreign_recno_dbid);
//redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/recno.php?foreign_recno_dbid=".$foreign_recno_dbid);
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/transaction/job_order_entry/jo_entry.php?foreign_recno_dbid=".$_POST['foreign_recno_dbid']);
}
//delete job order
if(isset($_POST['delete_jo']) && strlen($foreign_recno_dbid) > 0){
delete_jo($foreign_recno_dbid);    
}
//go back to previous header
if(isset($_GET['foreign_recno_dbid']) && !isset($_POST['save']) && !isset($_POST['post']) && !isset($_POST['cancel'])){
$jo=fill_foreign_recno_dbid($_GET['foreign_recno_dbid']);
$jo_numb=$jo['jo_numb'];
$c_code=$jo['c_code'];
$client=$jo['client'];
$doc_ref=$jo['doc_ref'];
$qnty=$jo['qnty'];
$wt=$jo['wt'];
$trucking_from=$jo['trucking_from'];
$trucking_to=$jo['trucking_to'];
$trucking_dr=$jo['trucking_dr'];
$payment_mode=$jo['payment_mode'];
$total_charges=$jo['total_charges'];
$prepared_by=$jo['prepared_by'];
$prepared_datetime=$jo['prepared_datetime'];
$status=$jo['status'];
$foreign_recno_dbid=$jo['foreign_recno_dbid'];
$csr=$jo['csr'];
$service_type=$jo['service_type'];
$instructions=$jo['instructions'];
$trans_type=$jo['trans_type'];
$transaction_date=$jo['transaction_date'];
$doc_type=$jo['doc_type'];
$bill_to_dept=$jo['bill_to_dept'];
$hawbno=$jo['hawbno'];
$mawbno=$jo['mawbno'];
$agent_code=$jo['agent_code'];
$agent_name=$jo['agent_name'];
$bill_no=$jo['bill_no'];
$transmit_by=$jo['transmit_by'];
$transmit_no=$jo['transmit_no'];
$transmit_date=$jo['transmit_date'];
$item_description=$jo['item_description'];
$cbm=$jo['cbm'];
$dest_code=$jo['dest_code'];
$pick_datetime=$jo['pick_datetime'];
$sadd2=$jo['sadd2'];
$sadd3=$jo['sadd3'];
$peza=$jo['peza'];
$cne_code=$jo['cne_code'];
$cne_name=$jo['cne_name'];
$cne_add1=$jo['cne_add1'];
$cne_add2=$jo['cne_add2'];
$cne_add3=$jo['cne_add3'];
$inv_value=$jo['inv_value'];
$ea_trans_cut_by=$jo['ea_trans_cut_by']; 
$act_wt=$jo['act_wt'];
$est_pick_datetime=$jo['est_pick_datetime'];
$pick_email_sent=$jo['pick_email_sent'];
$pick_email_datetime=$jo['pick_email_datetime']; 
$pick_email_by=$jo['pick_email_by'];
$oth_reference=$jo['oth_reference'];
$transmit_remarks=$jo['transmit_remarks'];
$exrate=$jo['exrate'];
$disabled="";
}

include 'access.php';
?>