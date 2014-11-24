<?php
include 'summon_functions.php'; 
//back to main page
if(isset($_POST['back'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_entry_new.php?pcv_no=".$_GET['pcv_no']);
}
//delete pcv_hdrx
if(isset($_POST['delete_pcv_hdrx']) && isset($_POST['pcvhdrx_ctrlno'])){
delete_pcv_hdrx($_POST['pcvhdrx_ctrlno']);    
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_hdrx.php?pcv_no=".$_POST['pcv_no']);
}
//this is to attach jo in pcv
if(isset($_POST['attach_to_pcv']) && isset($_POST['pcvhdrx_ctrlno'])){
    if(count($_POST['pcvhdrx_ctrlno']) <> 1){
    echo '<b>Error: Please attach one JO only!</b>';
    }else{
    //echo '<b>Ok</b>';
    update_jo_main($job_order_no,$pcv_no);
    //update_jo_chg($job_order_no,$pcv_no);
    redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_entry_new.php?pcv_no=".$_POST['pcv_no']);    
    }   
}
//go to insert/update page of pcv_hdrx
if(isset($_POST['add'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/save_pcv_hdrx.php?pcv_no=".$_GET['pcv_no']."&pcvhdrx_ctrlno=add");
}
//back to pcv_hdrx page
if(isset($_POST['back_to_pcv_hdrx'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_hdrx.php?pcv_no=".$_GET['pcv_no']);
}
//insert or update pcv_hdrx
if(isset($_POST['save'])){
    switch($_POST['pcvhdrx_ctrlno']){
    case "add":    
    insert_pcv_hdrx($pcv_no,$doc_type,$doc_ref,$job_order_no);
    redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_hdrx.php?pcv_no=".$_GET['pcv_no']);    
    break;
    default ://update
    update_pcv_hdrx($job_order_no,$doc_ref,$doc_type,$pcvhdrx_ctrlno);
    redirect("http://".$_SERVER['SERVER_NAME']."/les/other_transaction/billing/pcv_entry_new/pcv_hdrx.php?pcv_no=".$_GET['pcv_no']);        
    }
}


if(isset($_GET['pcvhdrx_ctrlno']) && $_GET['pcvhdrx_ctrlno'] <> "add" && !isset($_POST['save'])){
$pcv_hdrx=  fill_pcv_hdrx($_GET['pcvhdrx_ctrlno']);
$doc_type=$pcv_hdrx['doc_type'];
$doc_ref=$pcv_hdrx['doc_ref'];
$job_order_no=$pcv_hdrx['job_order_no'];
}

?>
