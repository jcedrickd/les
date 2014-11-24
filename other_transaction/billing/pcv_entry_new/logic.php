<?php
include 'summon_functions.php'; 
$service_type='OS';
$company_code='AAI';
//for viewing purposes
if(!isset($_POST['save']) && !isset($_POST['post']) && !isset($_POST['force_post']) && !isset($_POST['validate']) && !isset($_POST['force_validate']) && !isset($_POST['cancel']) && !isset($_POST['unvalidate'])){
$payee_code=$_SESSION['username'];
$payee_name=$_SESSION['fullname'];
$arrival_date=date("m/d/Y");
$pcv_date=date("m/d/Y H:i");   
$type_by=$_SESSION['username'];
$type_datetime=date("m/d/Y H:i");//prepared_by
$act_wt=0;
$chg_wt=0;
$nopcs=0;
$exrate=0;
}
//when button is click,remove comma in a digit of thousand
if(isset($_POST['save']) || isset($_POST['post']) || isset($_POST['force_post']) || isset($_POST['validate']) || isset($_POST['force_validate']) || isset($_POST['cancel']) || isset($_POST['unvalidate'])){
$tot_cash=str_replace(",","", $tot_cash);
$tot_cheque=str_replace(",","", $tot_cheque);
$grand_total=str_replace(",","", $grand_total);
$tot_rcpt_cost=str_replace(",","", $tot_rcpt_cost);
$tot_urcpt_cost=str_replace(",","", $tot_urcpt_cost);
$act_wt=str_replace(",","", $act_wt);
$chg_wt=str_replace(",","", $chg_wt);
$nopcs=str_replace(",","", $nopcs);
$exrate=str_replace(",","", $exrate);
}
//this is for the buttons when no status
if($pcv_stat==''){
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_no_status.php'); 
}
elseif($pcv_stat=='Active'){
$pcv_stat=='A';
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_active.php');    
}
elseif(($pcv_stat=='Posted' && $validate_stat <> "Validated")){
$pcv_stat='X';
$validate_stat="A";
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_posted.php'); 
}
elseif(($pcv_stat=='Posted' && $validate_stat=="Validated")){
$pcv_stat='X';
$validate_stat="X";
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_posted_validated.php');   
}

if(isset($_POST['reset'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_entry_new.php");
}
//for insert
if(isset($_POST['save']) && $pcv_stat=='No status' && wf_check($payee_code,$pcv_type,$petty_cash_replenish,$cust_name,$cust_code,$service_type,$miscellaneous_pcv,$job_order_no,$arrival_date,$station_id)!=1 && $_POST['access_insert'] <> 'hide'){
$pcv_stat='A';
$pcv_no=new_pcv_series("OS");
insert_pcv_hdr($payee_code,$payee_name,$cust_code,$cust_name,$instruction,$release_type,$fd_bd,
$miscellaneous_pcv,$pcv_no,$company_code,$type_by,$validate_by,$approved_by,$service_type,$transmit_no,
$fin_transmit_no,$petty_cash_replenish,$pcv_stat,$pcv_date,$station_id,$type_datetime,$validate_datetime,
$pcv_type,$job_order_no,$mcarref,$hcarref,$dr_no,$shipper_code,
$shipper_name,$arrival_date,$commodity,$rcv_by,$act_wt,$chg_wt,$nopcs,$exrate,$other_ref,$validate_stat);
wf_insert_to_hdrx($service_type,$job_order_no,$hcarref,$dr_no,$pcv_no);
echo '<span style="color:green"><b>'.$pcv_no.' Inserted Successfully</b></span>';
}
//for update
if(isset($_POST['save']) && $pcv_stat=='Active' && wf_check($payee_code,$pcv_type,$petty_cash_replenish,$cust_name,$cust_code,$service_type,$miscellaneous_pcv,$job_order_no,$arrival_date,$station_id)!=1 && $_POST['access_update'] <> 'hide'){
	switch(trim($_POST['pcv_stat'])){
	case 'Posted':
	$pcv_stat='X';
	break;
	case 'Active':
	$pcv_stat='A';
	break;
	case 'Cancel':
	$pcv_stat='C';
	break;
	default:
	$pcv_stat='';
	}
update_pcv_hdr($instruction,$release_type,$fd_bd,$miscellaneous_pcv,$company_code,$type_by,$validate_by,
$approved_by,$service_type,$transmit_no,$fin_transmit_no,$petty_cash_replenish,$pcv_date,$station_id,
$type_datetime,$validate_datetime,$job_order_no,$mcarref,$hcarref,$dr_no,$shipper_code,$shipper_name,
$arrival_date,$commodity,$rcv_by,$act_wt,$chg_wt,$nopcs,$exrate,$other_ref,$pcv_no,$payee_code,$payee_name,
$cust_code,$cust_name,$pcv_type,$verified_by);
echo '<span style="color:green"><b>'.$pcv_no.' Updated Successfully</b></span>';
}
//post
if(isset($_POST['post'])){
    if(wf_check_double_chg($miscellaneous_pcv,$job_order_no,$pcv_no)!=1 && wf_check_bp($pcv_no)!=1 && 
    wf_check($payee_code,$pcv_type,$petty_cash_replenish,$cust_name,$cust_code,$service_type,$miscellaneous_pcv,$job_order_no,$arrival_date,$station_id)!=1
    && wf_check_if_billed($miscellaneous_pcv,$job_order_no,$service_type,$hcarref)!=1){
    post($pcv_no);
    echo '<span style="color:green"><b>'.$pcv_no.' Posted</b></span>';
    include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_posted.php');
	$pcv_stat="X";
    }else{
	$pcv_stat="A";
	}
}
if(isset($_POST['force_post'])){
post($pcv_no);
echo '<span style="color:green"><b>'.$pcv_no.' Posted</b></span>';
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_posted.php');
$pcv_stat="X";
}
//activate validate after post
if(isset($_POST['validate'])){
    if(wf_check_validate2($validate_by,$type_by)!=1 && wf_check_bp($pcv_no)!=1 && wf_check_validate($job_order_no,$pcv_no)!=1){
    validate($validate_by,$pcv_no);
    echo '<span style="color:green"><b>'.$pcv_no.' Validated</b></span>';
    include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_posted_validated.php');
	$pcv_stat="X";
	$validate_stat="X";
    }else{
	$pcv_stat="X";
	$validate_stat="A";
	}
}
//unvalidate
if(isset($_POST['unvalidate'])){
    if(wf_check_if_billed($miscellaneous_pcv,$job_order_no,$service_type,$hcarref)!=1){
    unvalidate($pcv_no);
    echo '<span style="color:green"><b>'.$pcv_no.' Unvalidated</b></span>';
    //echo '<span style="color:green"><b>'.$pcv_no.' Posted</b></span>';
    include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_posted.php');
	$pcv_stat="X";
	$validate_stat="A";
    }else{
	$pcv_stat="X";
	$validate_stat="X";
	}
}
if(isset($_POST['force_validate'])){
validate($validate_by,$pcv_no); 
echo '<span style="color:green"><b>'.$pcv_no.' Validated</b></span>';
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_posted_validated.php');
$pcv_stat="X";
$validate_stat="X";
}
if(isset($_POST['add_jo'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_hdrx.php?pcv_no=".$_POST['pcv_no']);
}
//for pcv_dtl
//add
if(isset($_POST['add'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcvdtl_ctrlno.php?pcv_no=".$pcv_no);
}
//delete
if(isset($_POST['delete']) && isset($_POST['checkbox'])){
delete_pcv_dtl($_POST['checkbox']);
$tot_cash=show_total_cash($pcv_no);
$tot_cheque=show_total_cheque($pcv_no);
$tot_rcpt_cost=show_total_receipted($pcv_no);
$tot_urcpt_cost=show_total_unreceipted($pcv_no);
$tot_cash < 1 || $tot_cash=="" ? $tot_cash=0 : $tot_cash;
$tot_cheque < 1 || $tot_cheque=="" ? $tot_cheque=0 : $tot_cheque;
$tot_rcpt_cost < 1 || $tot_rcpt_cost=="" ? $tot_rcpt_cost=0 : $tot_rcpt_cost;
$tot_urcpt_cost < 1 || $tot_urcpt_cost=="" ? $tot_urcpt_cost=0 : $tot_urcpt_cost;
update_hdr_charge_cost($tot_cash, $tot_cheque, $tot_rcpt_cost, $tot_urcpt_cost, $pcv_no);    
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_entry_new.php?pcv_no=".$pcv_no);
}
//go back to previous header
if(isset($_GET['pcv_no']) && !isset($_POST['save']) && !isset($_POST['post']) && !isset($_POST['force_post']) && !isset($_POST['validate']) && !isset($_POST['force_validate']) && !isset($_POST['cancel']) && !isset($_POST['unvalidate'])){
$pcv=  fill_pcv_hdr($_GET['pcv_no']);
$payee_code=$pcv['payee_code'];
$payee_name=$pcv['payee_name'];
$cust_code=$pcv['cust_code'];
$cust_name=$pcv['cust_name'];
$cust_address=select_address($pcv['cust_code']);
$instruction=$pcv['instruction'];
$release_type=$pcv['release_type'];
$fd_bd=$pcv['fd_bd'];
$miscellaneous_pcv=$pcv['miscellaneous_pcv'];
$pcv_no=$_GET['pcv_no'];
//$company_code'=>$result['company_code']
$type_by=$pcv['type_by'];
$validate_by=$pcv['validate_by'];
$approved_by=$pcv['approved_by'];
$service_type=$pcv['service_type'];
$transmit_no=$pcv['transmit_no'];
$fin_transmit_no=$pcv['fin_transmit_no'];
$petty_cash_replenish=$pcv['petty_cash_replenish'];
$pcv_stat=$pcv['pcv_stat'];
$pcv_date=$pcv['pcv_date'];
$station_id=$pcv['station_id'];
$type_datetime=$pcv['type_datetime'];
$validate_datetime=$pcv['validate_datetime'];
$tot_rcpt_cost=$pcv['tot_rcpt_cost'];
$tot_urcpt_cost=$pcv['tot_urcpt_cost'];
$tot_cash=$pcv['tot_cash'];
$tot_cheque=$pcv['tot_cheque'];
$pcv_type=$pcv['pcv_type'];
$job_order_no=$pcv['job_order_no'];
$mcarref=$pcv['mcarref'];
$hcarref=$pcv['hcarref'];
$dr_no=$pcv['dr_no'];
$shipper_code=$pcv['shipper_code'];
$shipper_name=$pcv['shipper_name'];
$arrival_date=$pcv['arrival_date'];
$commodity=$pcv['commodity'];
$rcv_by=$pcv['rcv_by'];
$act_wt=$pcv['act_wt'];
$chg_wt=$pcv['chg_wt'];
$nopcs=$pcv['nopcs'];
$exrate=$pcv['exrate'];
$other_ref=$pcv['other_ref'];
$validate_stat=$pcv['validate_stat'];
$verified_by=$pcv['verified_by'];
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/buttons/button_active.php');
$save_disabled="";
}

include 'access.php';
?>