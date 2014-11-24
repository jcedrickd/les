<?php 
//get the date three months before the current date
function get_one_month(){
$currentdate=date("m/d/Y");
$x = new DateTime($currentdate);
$x->modify('-30 day');
return $x->format('m/d/Y');
}

function show_status($status){
switch($status){
case 'X':
echo 'Posted';
break;
case 'C':
echo 'Cancel';
break;
case 'A': 
echo 'Active';
break;
default: echo 'No status';
	}
}

function show_validate($validate_stat){
switch($validate_stat){
case 'X':
echo 'Validated';
break;
case 'C':
echo 'Cancel';
break;
case 'A': 
echo 'No';
break;
default: echo '';
	}
}
//select the address and the company name of aaigoc_code
function select_address($bill_code){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$query=pg_query($con,"SELECT company_name,address,city,state_province,zipcode,public.country.country_desc FROM partners.customer 
LEFT OUTER JOIN public.country ON partners.customer.country_code = public.country.country_code WHERE aaigoc_code='$bill_code'");
$address=pg_fetch_array($query);
/*return array('address'=>$cust['address'],'city'=>$cust['city'],'state_province'=>$cust['state_province'],'zipcode'=>$cust['zipcode'],
'company_name'=>$cust['company_name'],'country_desc'=>$cust['country_desc']);*/
return @$address['address'].', '.@$address['city'].' '.@$address['state_province'].' '.@$address['country_desc'].' '.@$address['zipcode']; 
pg_free_result($query);
pg_close($con);
}
function fill_pcv_hdr($pcv){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query=  sybase_query("SELECT * FROM pcv_hdr WHERE pcv_no='$pcv'");
$result=  sybase_fetch_array($query);
return array('payee_code'=>$result['payee_code'],'payee_name'=>$result['payee_name']
,'cust_code'=>$result['cust_code'],'cust_name'=>$result['cust_name'],
'instruction'=>$result['instruction'],'release_type'=>$result['release_type'],'fd_bd'=>$result['fd_bd'],
'miscellaneous_pcv'=>$result['miscellaneous_pcv'],'pcv_no'=>$result['pcv_no'],'company_code'=>$result['company_code']
,'type_by'=>$result['type_by'],'validate_by'=>$result['validate_by'],'approved_by'=>$result['approved_by'],
'service_type'=>$result['service_type'],'transmit_no'=>$result['transmit_no'],
'fin_transmit_no'=>$result['fin_transmit_no'],'petty_cash_replenish'=>$result['petty_cash_replenish'],
'pcv_stat'=>$result['pcv_stat'],'pcv_date'=>$result['pcv_date'],'station_id'=>$result['station_id'],
'type_datetime'=>$result['type_datetime'],'validate_datetime'=>$result['validate_datetime'],
'tot_rcpt_cost'=>$result['tot_rcpt_cost'],'tot_urcpt_cost'=>$result['tot_urcpt_cost'],'tot_cash'=>$result['tot_cash'],
'tot_cheque'=>$result['tot_cheque'],'pcv_type'=>$result['pcv_type'],'job_order_no'=>$result['job_order_no'],
'mcarref'=>$result['mcarref'],'hcarref'=>$result['hcarref'],'dr_no'=>$result['dr_no'],
'shipper_code'=>$result['shipper_code'],'shipper_name'=>$result['shipper_name'],
'arrival_date'=>$result['arrival_date'],'commodity'=>$result['commodity'],'rcv_by'=>$result['rcv_by'],
'act_wt'=>$result['act_wt'],'chg_wt'=>$result['chg_wt'],'nopcs'=>$result['nopcs'],'exrate'=>$result['exrate'],
'other_ref'=>$result['other_ref'],'validate_stat'=>$result['validate_stat'],'verified_by'=>$result['verified_by']);
@sybase_free_result($query);
sybase_close($link);
}

function show_pcv_type($pcv_type){
    switch ($pcv_type){
        case 'Y':
            echo 'Cash';
            break;
        case 'N':
            echo 'Company Cheque';
            break;
        case 'M':
            echo 'Manager Check';
            break;
        default:
            echo '';
    }    
}

function show_cash_replenish($cash_replenish){
    switch($cash_replenish){
        case 'SD':
            echo 'SEAFRT';
            break;
        case 'FN':
            echo 'FINANCE';
            break;
        case 'EO':
            echo 'EXPORT AIR';
            break;
        default :
            echo '';
    }
}

function delete_pcv_dtl($checkbox){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	for($i=0;$i<count($checkbox);$i++){
	$id=$checkbox[$i];
	$delete=sybase_query("DELETE FROM pcv_dtl WHERE pcvdtl_ctrlno=$id");
	}
@sybase_free_result($delete);
sybase_close($link);
}

function show_receipted_exp($receipted_exp){
    switch ($receipted_exp){
        case 'Y':
            echo 'checked="checked"';
            break;
        case 'N':
            echo '';
            break;
        default:
            echo '';
    }    
}

function show_total_receipted($pcv_no){
//total of receipted cash
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT SUM(php_cost) AS receipt FROM pcv_dtl WHERE pcv_no='$pcv_no' AND cash='Y' AND receipted_exp='Y'");
$result1=  sybase_fetch_array($query1);
return $result1['receipt'];
@sybase_free_result($result1);
sybase_close($link);
}

function show_total_unreceipted($pcv_no){
//total unreceipted cash
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT SUM(php_cost) AS unreceipt FROM pcv_dtl WHERE pcv_no='$pcv_no' AND cash='Y' AND receipted_exp <> 'Y'");
$result1=  sybase_fetch_array($query1);
return $result1['unreceipt'];
@sybase_free_result($result1);
sybase_close($link);
}

function show_total_cheque($pcv_no){
//this is the total of cheque
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT SUM(php_cost) AS cheque FROM pcv_dtl WHERE pcv_no='$pcv_no' AND cash <> 'Y'");
$result1=  sybase_fetch_array($query1);
return $result1['cheque'];
@sybase_free_result($result1);
sybase_close($link);
}

function show_total_cash($pcv_no){
//this is the total of cheque
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT SUM(php_cost) AS cash FROM pcv_dtl WHERE pcv_no='$pcv_no' AND cash = 'Y'");
$result1=  sybase_fetch_array($query1);
return $result1['cash'];
@sybase_free_result($result1);
sybase_close($link);
}

function update_hdr_charge_cost($tot_cash,$tot_cheque,$tot_rcpt_cost,$tot_urcpt_cost,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$result=  sybase_query("UPDATE pcv_hdr SET tot_cash=$tot_cash,tot_cheque=$tot_cheque,
tot_rcpt_cost=$tot_rcpt_cost,tot_urcpt_cost=$tot_urcpt_cost WHERE pcv_no='$pcv_no'");
@sybase_free_result($result);
sybase_close($link);    
}

function wf_check($payee_code,$pcv_type,$petty_cash_replenish,$cust_name,$cust_code,$service_type,$miscellaneous_pcv,$job_order_no,$arrival_date,$station_id){
    if(strlen($payee_code) < 1){
        echo '<b>Error: Payee Code still empty!</b>';
        return 1;
    }
    if(strlen($pcv_type) < 1){
        echo '<b>Error: PCV Type still empty!</b>';
        return 1;
    }
    if($pcv_type=="Y"){
        if(strlen($petty_cash_replenish) < 1){
        echo '<b>Error: This is Cash liquidation! Cash replenishment is mandatory!</b>';    
        return 1;
        }
    }
    if($cust_name=="VARIOUS"){
        echo '<b>Error: Customer Name Various not allowed! Please Supply Specific Customer!</b>';
        return 1;
    }
    if(strlen($cust_code) < 1){
        echo '<b>Error: Customer Code still empty!</b>';
        return 1;
    }
    if($service_type=="OS"){
        if($miscellaneous_pcv=="Y"){
            if(strlen($job_order_no) > 0){
            echo '<b>Error: This is Miscellaneous PCV! Please remove JO!</b>';
            return 1;
            }
        }
        else{
            if(strlen($job_order_no) < 1){
            echo '<b>Error: Job Order No still empty!</b>';
            return 1;
            }
        }
    }
    else{
        if(strlen($job_order_no) < 1){
        echo '<b>Error: Job Order No still empty!</b>';
        return 1;
        }
    }
   if($service_type<>"OS"){
       if($arrival_date=="01/01/1900" || $arrival_date==NULL || $arrival_date==""){
       echo '<b>Error: Arrival Date still empty!</b>';
       return 1;
       }
   }
   if(strlen($station_id) < 1){
        echo '<b>Error: Station ID still empty!</b>';
        return 1;    
   }
}
//this is for charge cost information validation
function wf_check2($php_cost,$grp_code,$cash,$miscellaneous_pcv){
    if(strlen($php_cost) < 1){
        echo '<p style="color:red">Error: Please add Php Cost.</p>';
        return 1;    
   }
   if(strlen($grp_code) < 1){
        echo '<p style="color:red">Error: Group Code still empty!</p>';
        return 1;    
   }
   if(strlen($cash) < 1){
        echo '<p style="color:red">Error: PCV Type still empty!</p>';
        return 1;    
   }
   if($miscellaneous_pcv=="N" || $miscellaneous_pcv==NULL || $miscellaneous_pcv==""){
        echo '<p style="color:red">Error: Job Otder No. still empty!</p>';
        return 1;  
   }
}
//feb 6
//this function is for updating pcv_hdr
function update_pcv_hdr($instruction,$release_type,$fd_bd,$miscellaneous_pcv,$company_code,$type_by,$validate_by,
$approved_by,$service_type,$transmit_no,$fin_transmit_no,$petty_cash_replenish,$pcv_date,$station_id,
$type_datetime,$validate_datetime,$job_order_no,$mcarref,
$hcarref,$dr_no,$shipper_code,$shipper_name,$arrival_date,$commodity,$rcv_by,$act_wt,$chg_wt,$nopcs,$exrate,
$other_ref,$pcv_no,$payee_code,$payee_name,$cust_code,$cust_name,$pcv_type,$verified_by){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$update=sybase_query("UPDATE pcv_hdr SET instruction='$instruction',release_type='$release_type',fd_bd='$fd_bd',
miscellaneous_pcv='$miscellaneous_pcv',company_code='$company_code',type_by='$type_by',
validate_by='$validate_by',approved_by='$approved_by',service_type='$service_type',transmit_no='$transmit_no',
fin_transmit_no='$fin_transmit_no',petty_cash_replenish='$petty_cash_replenish',
pcv_date='$pcv_date',station_id='$station_id',type_datetime='$type_datetime',
validate_datetime='$validate_datetime',job_order_no='$job_order_no',mcarref='$mcarref',hcarref='$hcarref',
dr_no='$dr_no',shipper_code='$shipper_code',shipper_name='$shipper_name',arrival_date='$arrival_date',
commodity='$commodity',rcv_by='$rcv_by',act_wt=$act_wt,chg_wt=$chg_wt,nopcs=$nopcs,exrate=$exrate,
other_ref='$other_ref',payee_code='$payee_code',payee_name='$payee_name',cust_code='$cust_code',
cust_name='$cust_name',pcv_type='$pcv_type',verified_by='$verified_by' WHERE pcv_no='$pcv_no'");
//echo '<p style="color:green">Saved!</p>';
@sybase_free_result(@$update);
sybase_close($link);
}
//for new pcv series format(no dashes): two letters-year-number
function new_pcv_series($string_pcv){
$prefix_pcv=  trim($string_pcv);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$currentyear=date("Y");
$currentdate=date("m/d/Y");
$firstdate="01/01/".$currentyear;
$pcvyear=$string_pcv.$currentyear;
$pcv1=sybase_query("SELECT COUNT(pcv_no) AS total FROM pcv_hdr WHERE service_type='$prefix_pcv' AND pcv_date >= '$firstdate' AND pcv_date <= GETDATE() AND pcv_no LIKE '$pcvyear%'");
$tot=sybase_fetch_array($pcv1);
$pcv_no=$prefix_pcv.$currentyear.sprintf("%06d",$tot['total']);
//echo $tot['total'].'<br />';
$pcv2=sybase_query("SELECT pcv_no FROM pcv_hdr WHERE pcv_no='$pcv_no'");
    if(sybase_num_rows($pcv2) > 0){
    return $prefix_pcv.$currentyear.sprintf("%06d",$tot['total']+1);
    }
    else{
    return $prefix_pcv.$currentyear.sprintf("%06d",$tot['total']+1);
    }
@sybase_free_result($pcv1);
@sybase_free_result($pcv2);
sybase_close($link);
}
//NOTE: $ls_doc_ref is just a variable for setting values
//DM service type not yet tested!
function wf_insert_to_hdrx($service_type,$job_order_no,$hcarref,$dr_no,$pcv_no){
    if($service_type=="DM"){
    $doc_type=substr($job_order_no,0,2);
        if($doc_type=="L-" || $doc_type=="SI" || $doc_type=="AI"){
        $doc_type="DR";    
        }
        elseif($doc_type=="SO"){
        $doc_type="HBL";
        }
        elseif($doc_type=="AO"){
        $doc_type="HAWB";    
        }
        
        if($doc_type=="HAWB" || $doc_type=="HBL"){
        $ls_doc_ref=$hcarref;
        }
        elseif($doc_type=="DR"){
        $ls_doc_ref=$dr_no;
        }
    }
    else{
    $doc_type="HAWB";
    $ls_doc_ref=$hcarref;
    }
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$count_hdrx=sybase_query("SELECT COUNT(pcv_no) AS ll_count FROM pcv_hdrx WHERE pcv_no='$pcv_no'");
$pcv_hdrx=sybase_fetch_array($count_hdrx);
    if($pcv_hdrx['ll_count']==0){
    $insert_pcv_hdrx=sybase_query("INSERT INTO pcv_hdrx
	(pcv_no,job_order_no,doc_type,doc_ref)VALUES('$pcv_no','$job_order_no','$doc_type','$ls_doc_ref')");
    @sybase_free_result($insert_pcv_hdrx);
    //echo '<p style="color:green">Inserted pcv_hdrx!</p>';
    }
    else{
        if($service_type=="DM"){
        $select_pda=sybase_query("SELECT TOP 1 b.ctrlno AS is_job_order_no_sub FROM pda_hdr a,pda b
        WHERE a.dcs_ctrlno = '$job_order_no' AND b.status = 'X' AND a.dcs_ctrlno = b.jobno ORDER BY b.ctrlno");
            if(sybase_num_rows($select_pda) > 0){
            $pda=sybase_fetch_array($select_pda);
            $update_pcv_hdrx=sybase_query("UPDATE pcv_hdrx SET job_order_no='$pda[is_job_order_no_sub]' WHERE pcv_no='$pcv_no'");    
            @sybase_free_result($update_pcv_hdrx);
            //echo '<p style="color:green">Updated pcv_hdrx!  1</p>';
            }
        }
        else{
        $update_pcv_hdrx=sybase_query("UPDATE pcv_hdrx SET job_order_no='$job_order_no' WHERE pcv_no='$pcv_no'");
        //echo '<p style="color:green">Updated pcv_hdrx!  2</p>';
        @sybase_free_result($update_pcv_hdrx);
        }
    }
@sybase_free_result($count_hdrx);
sybase_close($link);
}

function insert_pcv_hdr($payee_code,$payee_name,$cust_code,$cust_name,$instruction,$release_type,$fd_bd,
$miscellaneous_pcv,$pcv_no,$company_code,$type_by,$validate_by,$approved_by,$service_type,$transmit_no,
$fin_transmit_no,$petty_cash_replenish,$pcv_stat,$pcv_date,$station_id,$type_datetime,$validate_datetime,
$pcv_type,$job_order_no,$mcarref,$hcarref,$dr_no,$shipper_code,
$shipper_name,$arrival_date,$commodity,$rcv_by,$act_wt,$chg_wt,$nopcs,$exrate,$other_ref,$validate_stat){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$insert_pcv_hdr=sybase_query("INSERT INTO pcv_hdr
(payee_code,payee_name,cust_code,cust_name,instruction,release_type,fd_bd,miscellaneous_pcv,pcv_no,company_code,
type_by,validate_by,approved_by,service_type,transmit_no,fin_transmit_no,petty_cash_replenish,pcv_stat,pcv_date,
station_id,type_datetime,validate_datetime,pcv_type,job_order_no,mcarref,hcarref,dr_no,shipper_code,shipper_name,
arrival_date,commodity,rcv_by,act_wt,chg_wt,nopcs,exrate,other_ref,validate_stat)
VALUES
('$payee_code','$payee_name','$cust_code','$cust_name','$instruction','$release_type','$fd_bd',
'$miscellaneous_pcv','$pcv_no','$company_code','$type_by','$validate_by','$approved_by','$service_type',
'$transmit_no','$fin_transmit_no','$petty_cash_replenish','$pcv_stat','$pcv_date','$station_id','$type_datetime',
'$validate_datetime','$pcv_type','$job_order_no','$mcarref',
'$hcarref','$dr_no','$shipper_code','$shipper_name','$arrival_date','$commodity','$rcv_by',$act_wt,$chg_wt,$nopcs,
$exrate,'$other_ref','$validate_stat')");
//echo '<p style="color:green">Inserted pcv_hdr!</p>';
@sybase_free_result($insert_pcv_hdr);
sybase_close($link);    
}
/*
function insert_pcv_hdr($payee_code,$payee_name,$pcv_type,$pcv_no,$type_by,$pcv_stat,$pcv_date,$type_datetime,$validate_stat){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$insert_pcv_hdr=sybase_query("INSERT INTO pcv_hdr
(payee_code,payee_name,pcv_type,pcv_no,type_by,pcv_stat,pcv_date,type_datetime,validate_stat)
VALUES
('$payee_code','$payee_name','$pcv_type','$pcv_no','$type_by','$pcv_stat','$pcv_date','$type_datetime','$validate_stat')");
echo '<p style="color:green">Inserted pcv_hdr!</p>';
@sybase_free_result($insert_pcv_hdr);
sybase_close($link);
}*/
/*
function insert_pcv_hdr($pcv_no,$type_by,$pcv_stat,$validate_stat,$service_type){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$insert_pcv_hdr=sybase_query("INSERT INTO pcv_hdr
(pcv_no,type_by,pcv_stat,pcv_date,type_datetime,validate_stat,service_type,tot_rcpt_cost,tot_urcpt_cost,tot_cash,tot_cheque,grand_total,act_wt,chg_wt)
VALUES
('$pcv_no','$type_by','$pcv_stat',GETDATE(),GETDATE(),'$validate_stat','$service_type',0,0,0,0,0,0,0)");
echo '<p style="color:green">Inserted pcv_hdr!</p>';
@sybase_free_result($insert_pcv_hdr);
sybase_close($link);
}*/

function update_cust($aaigoc_code,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$q1=pg_query($con,"SELECT partners.customer.company_name FROM partners.customer WHERE partners.customer.aaigoc_code='$aaigoc_code'");
$cust=pg_fetch_array($q1);
$cust_name=$cust['company_name'];
pg_free_result($q1);
pg_close($con);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$q2=sybase_query("UPDATE pcv_hdr SET cust_code='$aaigoc_code',cust_name='$cust_name' WHERE pcv_no='$pcv_no'");
@sybase_free_result($q2);
sybase_close($link);
}

function update_payee($aaigoc_code,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$q1=pg_query($con,"SELECT partners.customer.company_name FROM partners.customer WHERE partners.customer.aaigoc_code='$aaigoc_code'");
$cust=pg_fetch_array($q1);
$cust_name=$cust['company_name'];
pg_free_result($q1);
pg_close($con);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$q2=sybase_query("UPDATE pcv_hdr SET payee_code='$aaigoc_code',payee_name='$cust_name' WHERE pcv_no='$pcv_no'");
@sybase_free_result($q2);
sybase_close($link);
}

function update_payee1($payee_code,$payee_name,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$q2=sybase_query("UPDATE pcv_hdr SET payee_code='$payee_code',payee_name='$payee_name' WHERE pcv_no='$pcv_no'");
@sybase_free_result($q2);
sybase_close($link);
}

function update_pcv_dtl($job_order_no,$chg_code,$chg_desc,$grp_code,$grp_desc,$php_cost,$usd_cost,$receipted_exp,$cash,$check_bp,$pcvdtl_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("UPDATE pcv_dtl SET job_order_no='$job_order_no',
chg_code='$chg_code',chg_desc='$chg_desc',grp_code='$grp_code',grp_desc='$grp_desc',
php_cost=$php_cost,usd_cost=$usd_cost,receipted_exp='$receipted_exp',cash='$cash',check_bp='$check_bp' WHERE pcvdtl_ctrlno=$pcvdtl_ctrlno");
@sybase_free_result($query);
sybase_close($link);
}

function fill_pcv_dtl($pcvdtl_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$result=sybase_query("SELECT job_order_no,chg_code,chg_desc,grp_code,grp_desc,php_cost,usd_cost,receipted_exp,cash,
check_bp,pcv_no FROM pcv_dtl WHERE pcvdtl_ctrlno=$pcvdtl_ctrlno");
$pcv_dtl=  sybase_fetch_array($result);
return array('job_order_no'=>$pcv_dtl['job_order_no'],'chg_code'=>$pcv_dtl['chg_code'],
'chg_desc'=>$pcv_dtl['chg_desc'],'grp_code'=>$pcv_dtl['grp_code'],'grp_desc'=>$pcv_dtl['grp_desc'],
'php_cost'=>$pcv_dtl['php_cost'],'usd_cost'=>$pcv_dtl['usd_cost'],'receipted_exp'=>$pcv_dtl['receipted_exp'],
'cash'=>$pcv_dtl['cash'],'check_bp'=>$pcv_dtl['check_bp'],'pcv_no'=>$pcv_dtl['pcv_no']);
@sybase_free_result($result);
sybase_close($link);
}

function insert_pcv_dtl($pcv_no,$job_order_no,$chg_code,$chg_desc,$grp_code,$grp_desc,$php_cost,$usd_cost,$receipted_exp,$cash,$check_bp){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$result=sybase_query("INSERT INTO pcv_dtl(pcv_no,job_order_no,chg_code,chg_desc,grp_code,grp_desc,php_cost,usd_cost,receipted_exp,cash,check_bp)VALUES('$pcv_no','$job_order_no','$chg_code','$chg_desc','$grp_code','$grp_desc',$php_cost,$usd_cost,'$receipted_exp','$cash','$check_bp')");
@sybase_free_result($result);
sybase_close($link);
}

function update_pcv_dtl_chg($chg_code,$chg_desc,$pcvdtl_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("UPDATE pcv_dtl SET chg_code='$chg_code',chg_desc='$chg_desc' WHERE pcvdtl_ctrlno=$pcvdtl_ctrlno");
@sybase_free_result($query);
sybase_close($link);
}

function update_pcv_dtl_grp($grp_code,$grp_desc,$pcvdtl_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("UPDATE pcv_dtl SET grp_code='$grp_code',grp_desc='$grp_desc' WHERE pcvdtl_ctrlno=$pcvdtl_ctrlno");
@sybase_free_result($query);
sybase_close($link);
}

function select_grp($charge_group_code){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$query=pg_query("SELECT * FROM public.charge_group WHERE public.charge_group.charge_group_code='$charge_group_code'");
$charge_group=pg_fetch_array($query);
return array('charge_group_code'=>$charge_group['charge_group_code'],'charge_group_desc'=>$charge_group['charge_group_desc']);
pg_free_result($query);
pg_close($con);
}

function select_charge($charge_code){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$q1=pg_query($con,"SELECT public.charge.charge_code,public.charge.charge_desc FROM public.charge WHERE charge_code='$charge_code'");
$r1=pg_fetch_array($q1);
return array('charge_desc'=>$r1['charge_desc']);
pg_free_result($q1);
pg_close($con);
}

function validate_pcv_dtl($chg_code,$grp_code,$php_cost,$cash){
    if(strlen($chg_code) < 1){
    echo '<b>Error: Charge Code is required.</b>';  
    return 1;
    }
    if(strlen($grp_code) < 1){
    echo '<b>Error: Group Code is required.</b>';    
    return 1;
    }
    if(strlen($php_cost) < 1){
    echo '<b>Error: PHP Cost is required.</b>';        
    return 1;
    }
    if(strlen($cash) < 1){
    echo '<b>Error: PCV Type is required.</b>';        
    return 1;
    }
}

//feb 12
function wf_check_double_chg($miscellaneous_pcv,$job_order_no,$pcv_no){
    if($miscellaneous_pcv=="Y"){
    return 0;    
    }
    else{
    include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
    $q1=sybase_query("SELECT chg_code,grp_code FROM pcv_dtl WHERE job_order_no='$job_order_no' AND pcv_no='$pcv_no'");
    while ($row = sybase_fetch_array($q1)){
    $q2=sybase_query("SELECT chg_code,pcv_no FROM pcv_dtl a 
    WHERE pcv_no<>'$pcv_no' AND a.chg_code = '$row[chg_code]' AND a.grp_code =  '$row[grp_code]' AND
    a.job_order_no = '$job_order_no' AND
    exists(SELECT * FROM pcv_hdr b 
    WHERE a.pcv_no = b.pcv_no AND b.pcv_stat = 'X')");
    $chg=  sybase_fetch_array($q2);
        if($chg['chg_code']==$row['chg_code']){
        echo '<b>Error: Charge Code '.$chg['chg_code'].' alraeady exists in PCV No.: '.$chg['pcv_no'].'. Double Entry not allowed!</b>';       
        return 1;
            }
    @sybase_free_result($q2);
        }
    @sybase_free_result($q1);
    sybase_close($link);
    }
}
//note: service_type=="EA" not tested
function wf_check_if_billed($miscellaneous_pcv,$job_order_no,$service_type,$hawbno){
    if($miscellaneous_pcv=="Y"){
    return 0;    
    }
    else{
    include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
    $result1=  sybase_query("SELECT COUNT(distinct bill_no) AS ll_count FROM c_bill_sl 
    WHERE job_order_no='$job_order_no' AND exists (SELECT * FROM c_bill_hdr WHERE 
    c_bill_sl.bill_no = c_bill_hdr.bill_no AND status = 'X') and c_bill_sl.sl_lock = 'Y'");
    $r1=  sybase_fetch_array($result1);
        if($r1['ll_count'] > 0){
        //sybase_close($link);  
        echo '<b>Invoices already prepared for this Job Order No!. Pls coordinate with FN Team!~n Failed to post data</b>';
        return 1;
        }
        else{
        //Check if there is FMS SL already
        $result2=sybase_query("SELECT COUNT(c_bill_fms_sl.bill_no) AS tot_fms_sl  
        FROM c_bill_hdr 
        LEFT OUTER JOIN c_bill_hdrx ON c_bill_hdr.bill_no = c_bill_hdrx.bill_no,c_bill_fms_sl  
        WHERE (c_bill_hdr.bill_no = c_bill_fms_sl.bill_no) AND (( c_bill_hdr.status = 'X' ) AND  
        (c_bill_hdrx.job_order_no = '$job_order_no'))");
        $r2=  sybase_fetch_array($result2);
            if(is_null($r2['tot_fms_sl'])) $r2['tot_fms_sl']=0;
            if($r2['tot_fms_sl'] > 0){
            //sybase_close($link);  
            echo '<b>Invoices already prepared for this Job Order No!. Pls coordinate with FN Team!~n Failed to post data</b>';
            return 1;
            }
        @sybase_free_result($result2);
        }
    @sybase_free_result($result1);    
        if($service_type=="EA"){
        $result3=  sybase_query("SELECT COUNT(distinct a.bill_no) AS ll_count FROM c_bill_sl a 
        WHERE a.job_order_no ='$job_order_no' AND 
        exists(SELECT * FROM BOSS.dbo.manifest_hdr b where a.bill_no = b.mnf_invno and b.mnf_stat = 'X' ) AND
        a.sl_lock = 'Y'");    
        $r3=  sybase_fetch_array($result3);
            if(is_null($r3['ll_count'])) $r3['ll_count']=0;
            if($r3['ll_count']>0){
            echo '<b>Invoices already prepared for this Job Order No!. Pls coordinate with FN Team!~n Failed to post data</b>';
            return 1;
            }
            else{
            // Check if there is FMS SL already
            $result4=sybase_query("SELECT manifest_hdr.mnf_invno AS bill_no FROM manifest_hdr,manifest_detail  
            WHERE ( manifest_hdr.mnf_invno = manifest_detail.manifest_refno ) AND 
            ((manifest_hdr.mnf_stat = 'X' ) AND  ( manifest_detail.hawbno = '$hawbno'))
            GROUP BY manifest_hdr.mnf_invno");
            while($r4 = sybase_fetch_array($result4)){
            $result5=  sybase_query("SELECT COUNT(invno) AS tot_fms_sl FROM ea_sl_manifest 
            WHERE ea_sl_manifest.invno = '$r4[bill_no]'");
            $r5=  sybase_fetch_array($result5);
                if(is_null($r5['tot_fms_sl'])) $r5['tot_fms_sl']=0;
                if($r5['tot_fms_sl']>0){
                echo '<b>Invoices already prepared for this Job Order No!. Pls coordinate with FN Team!~n Failed to post data</b>';
                return 1;
                }
            @sybase_free_result($result5);
            }
            @sybase_free_result($result4);
            }
        @sybase_free_result($result3);
        }
    sybase_close($link);
    }
}

//note this is also needed in validate button
function wf_check_bp($pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$res=sybase_query("SELECT chg_code,check_bp,cash FROM pcv_dtl WHERE pcv_no='$pcv_no'");
while ($row = sybase_fetch_array($res)){
    if($row['cash']=="N" || $row['cash']=="M"){// check sya
        if(strlen($row['check_bp'])<1){
        echo '<b>Error: Check Payable BP for Charge Code: '.$row['chg_code'].'still empty!</b>';
        return 1;
        }
    }
}
@sybase_free_result($res);
sybase_close($link);    
}

//valentine's day
function post($pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$post=  sybase_query("UPDATE pcv_hdr SET pcv_stat = 'X' WHERE pcv_hdr.pcv_no = '$pcv_no'");
@sybase_free_result($post);
sybase_close($link);
}

//FEB 17
function unpost($pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$unpost=  sybase_query("UPDATE pcv_hdr SET pcv_stat = 'A' WHERE pcv_hdr.pcv_no = '$pcv_no'");
@sybase_free_result($unpost);
sybase_close($link);
}

function cancel($vc_reason,$username,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$cancel=  sybase_query("UPDATE pcv_hdr SET pcv_stat = 'C',vc_reason ='$vc_reason',vc_by ='$username',vc_datetime = GETDATE() WHERE pcv_hdr.pcv_no='$pcv_no'");
@sybase_free_result($cancel);
sybase_close($link);
}

function check_unpost($pcv_stat,$validate_stat,$pcv_no){
if(is_null($pcv_stat)) $pcv_stat="A";
if(is_null($validate_stat)) $validate_stat="A";
    if($pcv_stat=="A"){
    echo '<p style="color:red">Error: PCV No.: '.$pcv_no.' already active.</p>';    
    return 1;
    }
    elseif($pcv_stat=="C" || $pcv_stat=="V"){
    echo '<p style="color:red">Error: Failed to active PCV No.: '.$pcv_no.'. It was already cancelled/void!</p>';    
    return 1;    
    }
    elseif($pcv_stat=="X" && $validate_stat=="A"){
    return 0;    
    }
}

function validate($validate_by,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$validate=  sybase_query("UPDATE pcv_hdr SET validate_stat = 'X',validate_by='$validate_by',
validate_datetime=GETDATE() WHERE pcv_hdr.pcv_no ='$pcv_no'");
@sybase_free_result($validate);
sybase_close($link);
}

function wf_check_validate($job_order_no,$pcv_no){
if(is_null($job_order_no)) $job_order_no="";
    if(strlen($job_order_no) > 0){
    include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
    $query=sybase_query("SELECT pcv_hdrx.pcv_no FROM pcv_hdrx 
    WHERE ( pcv_hdrx.pcv_no = '$pcv_no') AND ( pcv_hdrx.job_order_no ='$job_order_no')"); 
        if(sybase_num_rows($query) > 0){
        $result1=sybase_query("SELECT job_order_no FROM pcv_dtl WHERE pcv_no='$pcv_no'");
        while ($row = sybase_fetch_array($result1)) {
            if($row['job_order_no']<>$job_order_no){
            echo '<b>Error: JO reference in charge cost information is not tally with main information!</b>';
            return 1;
            }
        }
        @sybase_free_result($result1);
        }
    @sybase_free_result($query);
    sybase_close($link);
    }
}

function wf_check_validate2($validate_by,$type_by){
    if(($validate_by <> $type_by) || $type_by=="DAVEOB" || $type_by=="CRIS"){
    return 0;
    }
    else{
    echo '<b>Error: Validate by cannot be of the same person who created the PCV. Failed to Validate PCV!</b>';    
    return 1;
    }    
}

//feb 18
function unvalidate($pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$unvalidate=  sybase_query("SELECT transmit_stat,fin_transmit_no FROM pcv_hdr WHERE pcv_no='$pcv_no'");
    while ($row = sybase_fetch_array($unvalidate)) {
    if(is_null($row['transmit_stat'])) $row['transmit_stat']="A";
        if(strlen(trim($row['fin_transmit_no'])) < 1 || is_null($row['fin_transmit_no'])){
        $unvalid=sybase_query("UPDATE pcv_hdr SET validate_stat='A',validate_by='',validate_datetime=NULL WHERE pcv_hdr.pcv_no='$pcv_no'");
        @sybase_free_result($unvalid);
        return 0;
        }
        else{
        echo '<b>Error: PCV Entry has already transmitted,Unvalidate not allowed!</b>';
        return 1;    
        }
    }
@sybase_free_result($unvalidate);
sybase_close($link);
}

//this is to update the jo in main information
function update_jo_main($job_order_no,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$jo_main=sybase_query("UPDATE pcv_hdr SET job_order_no='$job_order_no' WHERE pcv_no='$pcv_no'");
@sybase_free_result($jo_main);
sybase_close($link);
}

//this is to update the jo in charge cost information
function update_jo_chg($job_order_no,$pcv_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$jo_chg=sybase_query("UPDATE pcv_dtl SET job_order_no='$job_order_no' WHERE pcv_no='$pcv_no'");
@sybase_free_result($jo_chg);
sybase_close($link);
}

function update_pcv_hdrx($job_order_no,$doc_ref,$doc_type,$pcvhdrx_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$update_jo=sybase_query("UPDATE pcv_hdrx SET job_order_no='$job_order_no',doc_ref='$doc_ref',doc_type='$doc_type' 
WHERE pcvhdrx_ctrlno=$pcvhdrx_ctrlno");
@sybase_free_result($update_jo);
sybase_close($link);    
}

function delete_pcv_hdrx($pcvhdrx_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
    for($i=0;$i<count($pcvhdrx_ctrlno);$i++){
    $id=$pcvhdrx_ctrlno[$i];
    $delete_pcv_hdrx=sybase_query("DELETE FROM pcv_hdrx WHERE pcvhdrx_ctrlno=$id");
    }
@sybase_free_result($delete_pcv_hdrx);
sybase_close($link);        
}

function insert_pcv_hdrx($pcv_no,$doc_type,$doc_ref,$job_order_no){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$insert_pcv_hdrx=sybase_query("INSERT INTO pcv_hdrx(pcv_no,doc_type,doc_ref,job_order_no)VALUES('$pcv_no','$doc_type','$doc_ref','$job_order_no')");
@sybase_free_result($insert_pcv_hdrx);
sybase_close($link);
}

function fill_pcv_hdrx($pcvhdrx_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$fill_pcv_hdrx=sybase_query("SELECT job_order_no,doc_ref,doc_type,pcv_no FROM pcv_hdrx WHERE pcvhdrx_ctrlno=$pcvhdrx_ctrlno");
$row=sybase_fetch_array($fill_pcv_hdrx);
return array('job_order_no'=>$row['job_order_no'],'doc_ref'=>$row['doc_ref'],'doc_type'=>$row['doc_type'],'pcv_no'=>$row['pcv_no']);
@sybase_free_result($fill_pcv_hdrx);
sybase_close($link);
}

function show_release_type($release_type){
    switch($release_type){
    case 'OT':
    return 'Old Transhipment';
    break;
    case 'NT':
    return 'New Transhipment';
    break;
    case 'FC':
    return 'Formal Commercial';
    case 'IC':
    return 'Informal Commercial';
    break;
    case 'WH':
    return 'Warehousing';
    break;
    default : return '';
    }
}

function show_fullname($user1){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query_name=sybase_query("SELECT fullname FROM useracc WHERE user1='$user1'");
$name=  sybase_fetch_array($query_name);
return $name['fullname'];
@sybase_free_result($query_name);
sybase_close($link);
}

include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');

//declare the variables for pcv_hdr
@$payee_code=validate_input($_POST['payee_code']);
@$payee_name=validate_input($_POST['payee_name']);
@$cust_code=validate_input($_POST['cust_code']);
@$cust_name=validate_input($_POST['cust_name']);
@$cust_address=validate_input($_POST['cust_address']);
@$service_type=  validate_input($_POST['service_type']);
@$transmit_no=  validate_input($_POST['transmit_no']);
@$fin_transmit_no=  validate_input($_POST['fin_transmit_no']);
@$petty_cash_replenish=  validate_input($_POST['petty_cash_replenish']);//dropdown
@$tot_cash=  validate_input($_POST['tot_cash']);
@$tot_cheque=  validate_input($_POST['tot_cheque']);
@$grand_total=  validate_input($_POST['grand_total']);//not save
@$job_order_no=  validate_input($_POST['job_order_no']);
@$mcarref=  validate_input($_POST['mcarref']);
@$hcarref=  validate_input($_POST['hcarref']);
@$dr_no=  validate_input($_POST['dr_no']);
@$shipper_code=  validate_input($_POST['shipper_code']);
@$shipper_name=  validate_input($_POST['shipper_name']);
@$pcv_stat=  validate_input($_POST['pcv_stat']);
@$validate_stat=  validate_input($_POST['validate_stat']);
@$pcv_no=validate_input($_POST['pcv_no']);
@$pcv_type=  validate_input($_POST['pcv_type']);//dropdown
@$pcv_date=  validate_input($_POST['pcv_date']);
@$miscellaneous_pcv=validate_input($_POST['miscellaneous_pcv']);
@$type_by=  validate_input($_POST['type_by']);
@$type_datetime=  validate_input($_POST['type_datetime']);
@$validate_by=  validate_input($_POST['validate_by']);
@$validate_datetime=  validate_input($_POST['validate_datetime']);
@$verified_by=  validate_input($_POST['verified_by']);
@$approved_by=  validate_input($_POST['approved_by']);
@$station_id=  validate_input($_POST['station_id']);
@$tot_rcpt_cost=  validate_input($_POST['tot_rcpt_cost']);
@$tot_urcpt_cost=  validate_input($_POST['tot_urcpt_cost']);
@$arrival_date=  validate_input($_POST['arrival_date']);
@$commodity=  validate_input($_POST['commodity']);
@$rcv_by=  validate_input($_POST['rcv_by']);
@$act_wt=  validate_input($_POST['act_wt']);
@$chg_wt=  validate_input($_POST['chg_wt']);
@$nopcs=  validate_input($_POST['nopcs']);
@$exrate=  validate_input($_POST['exrate']);
@$other_ref=  validate_input($_POST['other_ref']);
@$instruction=validate_input($_POST['instruction']);
@$release_type=validate_input($_POST['release_type']);//dropdown
@$fd_bd=validate_input($_POST['fd_bd']);//dropdown
//declare the variable for pcv_dtl
@$pcvdtl_ctrlno=  validate_input($_POST['pcvdtl_ctrlno']);
@$job_order_no=  validate_input($_POST['job_order_no']);
@$chg_code=  validate_input($_POST['chg_code']);
@$chg_desc=  validate_input($_POST['chg_desc']);
@$grp_code=  validate_input($_POST['grp_code']);
@$grp_desc=  validate_input($_POST['grp_desc']);
@$php_cost=  validate_input(str_replace(',','',$_POST['php_cost']));
@$usd_cost=  validate_input(str_replace(',','',$_POST['usd_cost']));
@$receipted_exp=  validate_input($_POST['receipted_exp']);
@$cash=  validate_input($_POST['cash']);
@$check_bp=  validate_input($_POST['check_bp']);
//pcv_hdrx
@$doc_type=  validate_input($_POST['doc_type']);
@$doc_ref=  validate_input($_POST['doc_ref']);
?>