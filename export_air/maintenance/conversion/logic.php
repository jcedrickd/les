<?php 
include_once('summon_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'les/includes/db_connect.php');//class file
if(isset($_POST['New'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/domestic/maintenance/conversion_rate_setup/convtable_ctrlno.php?ConversDate=".urlencode($_POST['ConversDate']));    
}
if(isset($_POST['back'])){
redirect("http://".$_SERVER['SERVER_NAME']."/les/domestic/maintenance/conversion_rate_setup/conversion_rate_setup.php?ConversDate=".urlencode($_POST['ConversDate']));
}

if(isset($_POST['save'])){
    $curr_usd == "" ? $curr_usd=0 : $curr_usd;
    $curr_usdx == "" ? $curr_usdx= 0 :$curr_usdx;
    $usd_php == "" ? $usd_php =0 : $usd_php;
    if(!isset($_GET['convtable_ctrlno'])){
    //insert data   
    insert_conversion($curr_code,$curr_desc,$curr_usd,$curr_usdx,$usd_php,$effect_date,$effect_date_to,$curr_apply,$add_edit);
    }else{
    //update data           
    update_conversion($curr_code,$curr_desc,$curr_usd,$curr_usdx,$usd_php,$effect_date,$effect_date_to,$curr_apply,$add_edit,$convtable_ctrlno);
    }
redirect("http://".$_SERVER['SERVER_NAME']."/les/domestic/maintenance/conversion_rate_setup/conversion_rate_setup.php?ConversDate=".urlencode($_POST['ConversDate']));
}
if(isset($_GET['convtable_ctrlno']) && !isset($_POST['save'])){
//select specific record    
$conv_list=$sybase->get_records('conversion_table',array('*'),"convtable_ctrlno=$convtable_ctrlno");
    foreach ($conv_list as $conv){
    $curr_code=$conv->curr_code;
    $curr_desc=$conv->curr_desc;
    $curr_usd=$conv->curr_usd;
    $curr_usdx=$conv->curr_usdx;
    $usd_php=$conv->usd_php;
    $effect_date=$conv->effect_date;
    $effect_date_to=$conv->effect_date_to;
    $curr_apply=$conv->curr_apply;
    $add_edit=$conv->add_edit;
    $add_date=$conv->add_date;
    $add_time=$conv->add_time;
    }
}
if(isset($_POST['Delete']) && isset($_POST['checkbox'])){
$checkbox=  $_POST['checkbox'];
    for($i=0;$i<count($checkbox);$i++){
    $id=$checkbox[$i];
    $sybase->delete_record('conversion_table',"convtable_ctrlno=$id");
    }
redirect("http://".$_SERVER['SERVER_NAME']."/les/domestic/maintenance/conversion_rate_setup/conversion_rate_setup.php?ConversDate=".urlencode($_POST['ConversDate']));
}
?>