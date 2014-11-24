<?php
include 'summon_functions.php';
if(isset($_POST['back'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_entry_new.php?pcv_no=".$_POST['pcv_no']);
}
if(isset($_POST['save']) && validate_pcv_dtl($chg_code,$grp_code,$php_cost,$cash)!=1){
$receipted_exp == "Y" ? $receipted_exp="Y" : $receipted_exp="N";
    if(strlen($pcvdtl_ctrlno) < 1){
    //insert
    insert_pcv_dtl($pcv_no,$job_order_no,$chg_code,$chg_desc,$grp_code,$grp_desc,$php_cost,$usd_cost,$receipted_exp,$cash,$check_bp);
    }else{
    //update
    update_pcv_dtl($job_order_no,$chg_code,$chg_desc,$grp_code,$grp_desc,$php_cost,$usd_cost,$receipted_exp,$cash,$check_bp,$pcvdtl_ctrlno);    
    }
//after insert/update, select total cash,cheque,rcpt cash and unrcpt cash then update pcv_hdr
$tot_cash=show_total_cash($pcv_no);
$tot_cheque=show_total_cheque($pcv_no);
$tot_rcpt_cost=show_total_receipted($pcv_no);
$tot_urcpt_cost=show_total_unreceipted($pcv_no);
$tot_cash < 1 || $tot_cash=="" ? $tot_cash=0 : $tot_cash;
$tot_cheque < 1 || $tot_cheque=="" ? $tot_cheque=0 : $tot_cheque;
$tot_rcpt_cost < 1 || $tot_rcpt_cost=="" ? $tot_rcpt_cost=0 : $tot_rcpt_cost;
$tot_urcpt_cost < 1 || $tot_urcpt_cost=="" ? $tot_urcpt_cost=0 : $tot_urcpt_cost;
update_hdr_charge_cost($tot_cash, $tot_cheque, $tot_rcpt_cost, $tot_urcpt_cost, $pcv_no);
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_entry_new.php?pcv_no=".$_POST['pcv_no']);
}
//for override
if(isset($_GET['pcvdtl_ctrlno']) && !isset($_POST['save'])){
$pcv_dtl=fill_pcv_dtl($_GET['pcvdtl_ctrlno']);
$pcv_no=$pcv_dtl['pcv_no'];
$job_order_no=$pcv_dtl['job_order_no'];
$chg_code=$pcv_dtl['chg_code'];
$chg_desc=$pcv_dtl['chg_desc'];
$grp_code=$pcv_dtl['grp_code'];
$grp_desc=$pcv_dtl['grp_desc'];
$php_cost=$pcv_dtl['php_cost'];
$usd_cost=$pcv_dtl['usd_cost'];
$receipted_exp=$pcv_dtl['receipted_exp'];
$cash=$pcv_dtl['cash'];
$check_bp=$pcv_dtl['check_bp'];
}
?>