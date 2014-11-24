<?php 
//this is the next jo number
function new_jo_num(){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT oth_services_series FROM dbcentral_series");
$series=sybase_fetch_array($query1);
$new_str_series=$series['oth_services_series'] + 1;
return $new_str_series;
@sybase_free_result($query1);
sybase_close($link);
}
//update dbcentral_series table
function update_dbcentral_series($new_str_series){
$oth_services_series=sprintf('%06d',$new_str_series);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$update_dbcentral_series=sybase_query("UPDATE dbcentral_series SET oth_services_series='$oth_services_series'");
if($update_dbcentral_series){
echo '<p style="color:green">Success update</p>';
}
//@sybase_free_result($update_dbcentral_series);
sybase_close($link);
}
//for the header
function fill_jo_numb($jo_numb){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query1=sybase_query("SELECT * FROM oth_services WHERE jo_numb='$jo_numb'");
$jo=sybase_fetch_array($query1);
return array('jo_numb'=>$jo['jo_numb'],'c_code'=>$jo['c_code'],'client'=>$jo['client'],'doc_ref'=>$jo['doc_ref'],
'qnty'=>$jo['qnty'],'wt'=>$jo['wt'],'trucking_from'=>$jo['trucking_from'],'trucking_to'=>$jo['trucking_to'],
'trucking_dr'=>$jo['trucking_dr'],'payment_mode'=>$jo['payment_mode'],'total_charges'=>$jo['total_charges'],
'prepared_by'=>$jo['prepared_by'],'prepared_datetime'=>$jo['prepared_datetime'],'status'=>$jo['status'],
'foreign_recno_dbid'=>$jo['foreign_recno_dbid'],'csr'=>$jo['csr'],'service_type'=>$jo['service_type'],
'instructions'=>$jo['instructions'],'trans_type'=>$jo['trans_type'],'transaction_date'=>$jo['transaction_date'],
'doc_type'=>$jo['doc_type'],'bill_to_dept'=>$jo['bill_to_dept'],'hawbno'=>$jo['hawbno'],'mawbno'=>$jo['mawbno'],
'agent_code'=>$jo['agent_code'],'agent_name'=>$jo['agent_name'],'bill_no'=>$jo['bill_no'],'unpost_reason'=>$jo['unpost_reason'],
'transmit_by'=>$jo['transmit_by'],'transmit_no'=>$jo['transmit_no'],'transmit_date'=>$jo['transmit_date'],
'item_description'=>$jo['item_description'],'cbm'=>$jo['cbm'],'dest_code'=>$jo['dest_code'],'pick_datetime'=>$jo['pick_datetime'],
/**'station_id'=>$jo['station_id'],'plate_no'=>$jo['plate_no'],'scode'=>$jo['scode'],'sname'=>jo['sname'],'sadd1'=>$jo['sadd1'],**/
'sadd2'=>$jo['sadd2'],'sadd3'=>$jo['sadd3'],'peza'=>$jo['peza'],'cne_code'=>$jo['cne_code'],'cne_name'=>$jo['cne_name'],
'cne_add1'=>$jo['cne_add1'],'cne_add2'=>$jo['cne_add2'],'cne_add3'=>$jo['cne_add3'],'inv_value'=>$jo['inv_value'],
'ea_trans_cut_by'=>$jo['ea_trans_cut_by'],'act_wt'=>$jo['act_wt'],'est_pick_datetime'=>$jo['est_pick_datetime'],
'pick_email_sent'=>$jo['pick_email_sent'],'pick_email_datetime'=>$jo['pick_email_datetime'],'pick_email_by'=>$jo['pick_email_by'],
'oth_reference'=>$jo['oth_reference'],'transmit_remarks'=>$jo['transmit_remarks'],'exrate'=>$jo['exrate']);
@sybase_free_result($query1);
sybase_close($link); 
}
//get jo_numb using foreign_recno_dbid
function fill_foreign_recno_dbid($foreign_recno_dbid){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query1=sybase_query("SELECT * FROM oth_services WHERE foreign_recno_dbid=$foreign_recno_dbid");
$jo=sybase_fetch_array($query1);
return array('jo_numb'=>$jo['jo_numb'],'c_code'=>$jo['c_code'],'client'=>$jo['client'],'doc_ref'=>$jo['doc_ref'],
'qnty'=>$jo['qnty'],'wt'=>$jo['wt'],'trucking_from'=>$jo['trucking_from'],'trucking_to'=>$jo['trucking_to'],
'trucking_dr'=>$jo['trucking_dr'],'payment_mode'=>$jo['payment_mode'],'total_charges'=>$jo['total_charges'],
'prepared_by'=>$jo['prepared_by'],'prepared_datetime'=>$jo['prepared_datetime'],'status'=>$jo['status'],
'foreign_recno_dbid'=>$jo['foreign_recno_dbid'],'csr'=>$jo['csr'],'service_type'=>$jo['service_type'],
'instructions'=>$jo['instructions'],'trans_type'=>$jo['trans_type'],'transaction_date'=>$jo['transaction_date'],
'doc_type'=>$jo['doc_type'],'bill_to_dept'=>$jo['bill_to_dept'],'hawbno'=>$jo['hawbno'],'mawbno'=>$jo['mawbno'],
'agent_code'=>$jo['agent_code'],'agent_name'=>$jo['agent_name'],'bill_no'=>$jo['bill_no'],'unpost_reason'=>$jo['unpost_reason'],
'transmit_by'=>$jo['transmit_by'],'transmit_no'=>$jo['transmit_no'],'transmit_date'=>$jo['transmit_date'],
'item_description'=>$jo['item_description'],'cbm'=>$jo['cbm'],'dest_code'=>$jo['dest_code'],'pick_datetime'=>$jo['pick_datetime'],
/**'station_id'=>$jo['station_id'],'plate_no'=>$jo['plate_no'],'scode'=>$jo['scode'],'sname'=>jo['sname'],'sadd1'=>$jo['sadd1'],**/
'sadd2'=>$jo['sadd2'],'sadd3'=>$jo['sadd3'],'peza'=>$jo['peza'],'cne_code'=>$jo['cne_code'],'cne_name'=>$jo['cne_name'],
'cne_add1'=>$jo['cne_add1'],'cne_add2'=>$jo['cne_add2'],'cne_add3'=>$jo['cne_add3'],'inv_value'=>$jo['inv_value'],
'ea_trans_cut_by'=>$jo['ea_trans_cut_by'],'act_wt'=>$jo['act_wt'],'est_pick_datetime'=>$jo['est_pick_datetime'],
'pick_email_sent'=>$jo['pick_email_sent'],'pick_email_datetime'=>$jo['pick_email_datetime'],'pick_email_by'=>$jo['pick_email_by'],
'oth_reference'=>$jo['oth_reference'],'transmit_remarks'=>$jo['transmit_remarks'],'exrate'=>$jo['exrate']);
@sybase_free_result($query1);
sybase_close($link); 
}

function select_bill_to_dept($bill_to_dept){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT dept_desc FROM department WHERE dept_code='$bill_to_dept'");
$dept=sybase_fetch_array($query);
return $dept['dept_desc'];
@sybase_free_result($dept);
sybase_close($link);
}
//select the address and the company name of aaigoc_code
function select_address($bill_code){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$query=pg_query($con,"SELECT company_name,address,city,state_province,zipcode,public.country.country_desc FROM partners.customer 
LEFT OUTER JOIN public.country ON partners.customer.country_code = public.country.country_code WHERE aaigoc_code='$bill_code'");
$cust=pg_fetch_array($query);
return array('address'=>$cust['address'],'city'=>$cust['city'],'state_province'=>$cust['state_province'],'zipcode'=>$cust['zipcode'],
'company_name'=>$cust['company_name'],'country_desc'=>$cust['country_desc']);
pg_free_result($query);
pg_close($con);
}
//determine the level of csr
function csr_level_2_checker($csr){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$query1=pg_query($con,"SELECT b.aaigoc_code as c_code,b.company_name as c_name,isnull(prepaid, 'N'),a.csr_level
FROM csr.service_record a left join partners.customer b on
a.shipper_aaigoc_code = b.aaigoc_code left join csr.freight_header e on
a.csr_no = e.csr_no  
WHERE csr_reference = '$csr' AND service_code in ('OS','WH','CR') AND a.approved = true
AND (a.expired_csr = false or a.expired_csr is null) AND isnull(a.sp_service_no,0) not in (
select ss.service_no
from sp.services ss join sp.statuses sss on
ss.header_no = sss.header_no
where sss.status_code in('SC'))");
$csr_record=pg_fetch_array($query1);
$numrecord=pg_num_rows($query1);
if($numrecord < 1){
echo '<p style="color:red">Error: Record not found!</p>';
return 2;
}else{
//if it is level 1 then set the customer's code and name also the charges table
if($csr_record['csr_level'] == 1){
return 1;
	}
//if it is level 2 then connect to dbcentral. know if csr is already attached.
elseif($csr_record['csr_level'] == 2){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query2=sybase_query("SELECT COUNT(jo_numb) AS ll_count FROM oth_services WHERE csr='$csr' AND (status='A' OR status='X')");
$jo_rows=sybase_fetch_array($query2);
if($jo_rows['ll_count'] > 1){
echo '<p style="color:red">Error: CSR Reference already attached in other Job Order!</p>';
return 2;
}elseif($jo_rows['ll_count'] == 1){
$query3=sybase_query("SELECT jo_numb FROM oth_services WHERE csr='$csr'");
$jo=sybase_fetch_array($query3);
echo '<p style="color:red">Error: CSR Reference already attached in Job Order: '.$jo['jo_numb'].'</p>';
@sybase_free_result($query3);
return 2;
}else{
return 1;
}
@sybase_free_result($query2);
sybase_close($link);
	}

}
pg_free_result($query1);
pg_close($con);
}
//this is the insert in booking_charges
function wf_charges($csr,$jo_numb){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$query1=pg_query($con,"SELECT isnull(b.chg_grp,'') AS ls_chggrp,isnull(b.charge_code,'') as ls_chgdesc,
isnull(net_rate,0) AS ld_net_rate,isnull(net_currency,'') AS ls_net_currency,isnull(agent_rate,0) AS ld_agent_rate,
isnull(selling_currency,'') AS ls_selling_currency,isnull(selling_rate,0) AS ld_selling_rate,
isnull(c.aaigoc_code,'') AS ls_aaigoc_code,isnull(company_name,'') AS ls_bilto,
charge_group_desc AS ls_chgrp_desc,isnull(e.charge_desc,b.charge_code) AS ls_oc_desc,other_charges_no AS ld_other_charges_no,
isnull(agent_currency,'') AS ls_agent_currency,case prepaid when 'Y' then 'P' else 'C' end,
isnull(f.vat_code,'VAT') AS ls_vat_code,isnull(f.vat_rate,0.12) AS ld_vat_rate
FROM csr.service_record a join csr.other_charges b on
a.csr_no = b.csr_no join partners.customer c on
bill_to_aaigoc_code = c.aaigoc_code join charge_group d on
b.chg_grp = d.charge_group_code left join charge e on 
b.charge_code = e.charge_code left join vat_category f on
c.vat_code = f.vat_code WHERE a.csr_reference='$csr'");
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query2=sybase_query("SELECT foreign_recno_dbid FROM oth_services WHERE jo_numb='$jo_numb'");
$result=sybase_fetch_array($query2);
$foreign_recno_dbid=$result['foreign_recno_dbid'];
$query3=sybase_query("DELETE FROM booking_charges WHERE foreign_recno_dbid=$foreign_recno_dbid");
@sybase_free_result($query3);
while($csr=pg_fetch_array($query1)){
/**$ls_chgdesc=$csr['ls_chgdesc'];
$ls_oc_desc=$csr['ls_oc_desc'];
$ls_selling_currency=$csr['ls_selling_currency'];
$ld_selling_rate=$csr['ld_selling_rate'];
$ls_aaigoc_code=$csr['ls_aaigoc_code'];
$ls_bilto=$csr['ls_bilto'];
$ls_chgrp_desc=$csr['ls_chgrp_desc'];
$ls_chggrp=$csr['ls_chggrp'];
$is_trans_type=$csr['is_trans_type'];
$is_service_type=$csr['is_service_type'];
$ls_prepaid=$csr['prepaid'];**/
	if($csr['ls_chggrp']=="" || $csr['ls_chggrp']==NULL){
	$csr['ls_chggrp']="NONE";
	}
	if($csr['ls_aaigoc_code']=="" || $csr['ls_aaigoc_code']==NULL){
	$csr['ls_aaigoc_code']="NONE";
	}
	if($csr['ls_selling_currency']=="" || $csr['ls_selling_currency']==NULL){
	$csr['ls_selling_currency']="NONE";
	}
$query4=sybase_query("INSERT INTO booking_charges(service_code,service_description,selling_currency,selling_rate,bill_to_code,
bill_to_name,chg_grp_desc,chg_grp,trans_type,service_type,collect_tag,foreign_recno_dbid,prepared_by)VALUES
('$csr[ls_chgdesc]','$csr[ls_oc_desc]','$csr[ls_selling_currency]',$csr[ld_selling_rate],'$csr[ls_aaigoc_code]',
'$csr[ls_bilto]','$csr[ls_chgrp_desc]','$csr[ls_chggrp]','$csr[is_trans_type]','$csr[is_service_type]',
'$csr[prepaid]',$foreign_recno_dbid,'$_SESSION[username]')");
}
@sybase_free_result($query2);
@sybase_free_result($query4);
sybase_close($link);

pg_free_result($query1);
pg_close($con);
}
//for buttons and links
function check_post($status){
switch($status){
case 'X':
echo 'style="display:none"';
return 1;
break;
default: echo ' ';
	}//end switch
}

function show_bill_to_dept($bill_to_dept){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT dept_desc FROM department WHERE dept_code='$bill_to_dept'");
$dept=sybase_fetch_array($query);
return $dept['dept_desc'];
@sybase_free_result($dept);
sybase_close($link);
}

function show_trans_type($trans_type){
switch($trans_type){
case 'EA':
echo 'Air Export Forwarding';
break;
case 'IA':
echo 'Air Import Forwarding';
break;
case 'BA':
echo 'Brokerage Air';
break;
case 'DA':
echo 'Domestic Air';
break;
case 'DS':
echo 'Domestic Sea';
break;
case 'DL':
echo 'Domestic Land';
break;
case 'OT':
echo 'Other Services';
break;
case 'ES':
echo 'Sea Export Forwarding';
break;
case 'IS':
echo 'Sea Import Forwarding';
break;
case 'BS':
echo 'Brokerage Sea';
break;
case 'WH': 
echo 'Warehousing';
break;
default: echo '';
	}
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
default: echo '';
	}
}

function show_collect_tag($collect_tag){
switch(pg_escape_string(trim($collect_tag))){
case 'C':
echo 'Collect';
break;
case 'P':
echo 'Prepaid';
break;
default: echo '';
	}
}
//when inserting or updating a jo, this is the validation for the header
function wf_check($c_code,$client,$jo_numb,$service_type,$transaction_date,$exrate,$trans_type){
if(strlen($c_code) < 1){
echo '<b>Error: Client Code still empty.</b>';
return 1;
	}
if(pg_escape_string(trim($client))=="VARIOUS"){
echo '<b>Error: Client name Various not allowed! Please supply specific client!</b>';
return 1;
	}
/*if(strlen($doc_ref) < 1){
$doc_type="Job Order No";
$doc_ref=$jo_numb;
	}*/
if(strlen($service_type) < 1){
echo '<b>Error: Service Type still empty!</b>';
return 1;
	}
if(strlen($transaction_date) < 1 || $transaction_date=="01/01/1970"){
echo '<b>Error: Transaction Date still empty!</b>';
return 1;
	}
if($exrate < 1){
echo '<b>Error: Exchange Rate still empty!</b>';
return 1;
	}
if(strlen($trans_type) < 1){
echo '<b>Error: Transaction Type still empty!</b>';
return 1;
	}
}
//when adding a jo, this is the validation for booking_charges
function wf_check_2($foreign_recno_dbid){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT chg_grp,service_code,bill_to_code,selling_currency FROM booking_charges WHERE foreign_recno_dbid=$foreign_recno_dbid");
while($row=sybase_fetch_array($query)){
	if($row['chg_grp']=="NONE"){
	echo '<p style="color:red">Error: Grp Code still empty. Please supply Grp Code.</p>';
	return 1;
	}
	if($row['bill_to_code']=="NONE"){
	echo '<p style="color:red">Error: Bill to Code for Charge Code '.$row['service_code'].' still empty. Please supply Bill to Code.</p>';
	return 1;
		}
	if($row['selling_currency']=="NONE"){
	echo '<p style="color:red">Error: Selling Currency for '.$row['service_code'].' still empty. Please supply Selling Currency.</p>';
	return 1;
		}
	}
@sybase_free_result($query);
sybase_close($link);
}

function insert_oth_services($csr,$c_code,$client,$doc_type,$doc_ref,$hawbno,$mawbno,$oth_reference,$item_description,$agent_code,
$agent_name,$qnty,$wt,$cbm,$instructions,$jo_numb,$status,$trans_type,$service_type,$transaction_date,$bill_to_dept,$total_charges,$bill_no,
$prepared_by,$prepared_datetime,$transmit_no,$transmit_date,$transmit_by,$trucking_from,$trucking_to,$trucking_dr,$exrate){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$insert=sybase_query("INSERT INTO oth_services(csr,c_code,client,doc_type,doc_ref,hawbno,mawbno,oth_reference,item_description,agent_code,
agent_name,qnty,wt,cbm,instructions,jo_numb,status,trans_type,service_type,transaction_date,bill_to_dept,total_charges,bill_no,
prepared_by,prepared_datetime,transmit_no,transmit_date,transmit_by,trucking_from,trucking_to,trucking_dr,exrate)VALUES('$csr','$c_code','$client','$doc_type',
'$doc_ref','$hawbno','$mawbno','$oth_reference','$item_description','$agent_code','$agent_name',$qnty,$wt,$cbm,'$instructions','$jo_numb',
'$status','$trans_type','$service_type','$transaction_date','$bill_to_dept',$total_charges,'$bill_no','$prepared_by','$prepared_datetime',
'$transmit_no','$transmit_date','$transmit_by','$trucking_from','$trucking_to','$trucking_dr',$exrate)");
if($insert){
echo '<p style="color:green">Success insert</p>';
}
//@sybase_free_result($insert);
sybase_close($link);
}

function update_cust($aaigoc_code,$jo_numb){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$q1=pg_query($con,"SELECT partners.customer.company_name FROM partners.customer WHERE partners.customer.aaigoc_code='$aaigoc_code'");
$cust=pg_fetch_array($q1);
$cust_name=$cust['company_name'];
pg_free_result($q1);
pg_close($con);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$q2=sybase_query("UPDATE oth_services SET c_code='$aaigoc_code',client='$cust_name' WHERE jo_numb='$jo_numb'");
@sybase_free_result($q2);
sybase_close($link);
}
function update_agent($aaigoc_code,$jo_numb){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$q1=pg_query($con,"SELECT partners.customer.company_name FROM partners.customer WHERE partners.customer.aaigoc_code='$aaigoc_code'");
$cust=pg_fetch_array($q1);
$cust_name=$cust['company_name'];
pg_free_result($q1);
pg_close($con);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$q2=sybase_query("UPDATE oth_services SET agent_code='$aaigoc_code',agent_name='$cust_name' WHERE jo_numb='$jo_numb'");
@sybase_free_result($q2);
sybase_close($link);
}

function update_oth_services($foreign_recno_dbid,$doc_type,$doc_ref,$hawbno,$mawbno,$oth_reference,$item_description,$agent_code,$agent_name,$qnty,
$wt,$cbm,$instructions,$trans_type,$transaction_date,$bill_to_dept,$total_charges,$bill_no,$prepared_by,$prepared_datetime,$transmit_no,$transmit_date,
$transmit_by,$trucking_from,$trucking_to,$trucking_dr,$exrate){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("UPDATE oth_services SET doc_type='$doc_type',doc_ref='$doc_ref',hawbno='$hawbno',mawbno='$mawbno',oth_reference='$oth_reference',
item_description='$item_description',agent_code='$agent_code',agent_name='$agent_name',qnty=$qnty,wt=$wt,cbm=$cbm,instructions='$instructions',
trans_type='$trans_type',transaction_date='$transaction_date',bill_to_dept='$bill_to_dept',total_charges=$total_charges,bill_no='$bill_no',
prepared_by='$prepared_by',prepared_datetime='$prepared_datetime',transmit_no='$transmit_no',transmit_date='$transmit_date',transmit_by='$transmit_by',
trucking_from='$trucking_from',trucking_to='$trucking_to',trucking_dr='$trucking_dr',exrate=$exrate WHERE foreign_recno_dbid=$foreign_recno_dbid");
@sybase_free_result($query);
sybase_close($link);
}

function select_a_booking_charge($recno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT foreign_recno_dbid,chg_grp,chg_grp_desc,service_code,service_description,selling_rate,selling_currency,collect_tag,bill_to_code,bill_to_name,
prepared_by,date_prepared,override_by,date_override FROM booking_charges WHERE recno=$recno");
$result=sybase_fetch_array($query);
return array('foreign_recno_dbid'=>$result['foreign_recno_dbid'],'chg_grp'=>$result['chg_grp'],'chg_grp_desc'=>$result['chg_grp_desc'],
'service_code'=>$result['service_code'],'service_description'=>$result['service_description'],'selling_rate'=>$result['selling_rate'],
'selling_currency'=>$result['selling_currency'],'collect_tag'=>$result['collect_tag'],'bill_to_code'=>$result['bill_to_code'],
'bill_to_name'=>$result['bill_to_name'],'prepared_by'=>$result['prepared_by'],'date_prepared'=>$result['date_prepared'],
'override_by'=>$result['date_prepared'],'date_override'=>$result['date_override']);
@sybase_free_result($query);
sybase_close($link);
}

function override_booking_charges($selling_rate,$selling_currency,$collect_tag,$bill_to_code,$bill_to_name,$override_by,$date_override,$recno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("UPDATE booking_charges SET selling_rate=$selling_rate,selling_currency='$selling_currency',collect_tag='$collect_tag',
bill_to_code='$bill_to_code',bill_to_name='$bill_to_name',override_by='$override_by',date_override='$date_override' WHERE recno=$recno");
@sybase_free_result($query);
sybase_close($link);
}

function validate_override_booking_charges($chg_grp,$service_code,$selling_rate,$selling_currency,$collect_tag,$bill_to_code){
	if(strlen($chg_grp) < 1){
	echo '<b>Error: GRP must not be empty.</b>';
	return 1;
	}
	if(strlen($service_code) < 1){
	echo '<b>Error: CHG must not be empty.</b>';
	return 1;
	}
	if(strlen($selling_rate) < 1){
	echo '<b>Error: Selling Rate must not be empty.</b>';
	return 1;
	}
	if(strlen($selling_currency) < 1){
	echo '<b>Error: Selling Currency must not be empty.</b>';
	return 1;
	}
	if(strlen($collect_tag) < 1){
	echo '<b>Error: Collect Tag must not be empty.</b>';
	return 1;
	}
	if(strlen($bill_to_code) < 1){
	echo '<b>Error: Bill to code must not be empty.</b>';
	return 1;
	}
}

function select_grp($charge_group_code){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$query=pg_query("SELECT * FROM public.charge_group WHERE public.charge_group.charge_group_code='$charge_group_code'");
$charge_group=pg_fetch_array($query);
return array('charge_group_code'=>$charge_group['charge_group_code'],'charge_group_desc'=>$charge_group['charge_group_desc']);
pg_free_result($query);
pg_close($con);
}

function override_grp($recno,$chg_grp,$chg_grp_desc){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$q=sybase_query("UPDATE booking_charges SET chg_grp='$chg_grp',chg_grp_desc='$chg_grp_desc' WHERE recno=$recno");
@sybase_free_result($q);
sybase_close($link);
}

function get_jo_numb($foreign_recno_dbid){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$q1=sybase_query("SELECT jo_numb FROM oth_services WHERE foreign_recno_dbid=$foreign_recno_dbid");
$r=sybase_fetch_array($q1);
return array('jo_numb'=>$r['jo_numb']);
@sybase_free_result($q1);
sybase_close($link);
}

function override_service($recno,$service_code,$service_description){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$q=sybase_query("UPDATE booking_charges SET service_code='$service_code',service_description='$service_description' WHERE recno=$recno");
@sybase_free_result($q);
sybase_close($link);
}

function select_charge($charge_code){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
$q1=pg_query($con,"SELECT public.charge.charge_code,public.charge.charge_desc FROM public.charge WHERE charge_code='$charge_code'");
$r1=pg_fetch_array($q1);
return array('charge_desc'=>$r1['charge_desc']);
pg_free_result($q1);
pg_close($con);
}

function wf_check_post($foreign_recno_dbid,$trans_type){
	if($trans_type=="OT"){
	$trans_type="OS";
	}
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query_bill=sybase_query("SELECT service_code,bill_to_code,selling_rate,selling_currency,chg_grp FROM booking_charges WHERE foreign_recno_dbid=$foreign_recno_dbid");
	if(sybase_num_rows($query_bill) < 1){
	echo '<b>Error: No billing charges entered.</b>';
	return 1;
	}else{
	include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php');
	pg_prepare($con,"select_charge_list","SELECT b.charge_group_code FROM charge_list b WHERE b.charge_code=$1 AND b.service_code =$2 
	AND b.charge_group_code=$3");
	while($row=sybase_fetch_array($query_bill)){
	$query_charge=pg_execute($con,"select_charge_list",array(pg_escape_string(trim($row['service_code'])),$trans_type,pg_escape_string(trim($row['chg_grp']))));
	$charge_list=pg_fetch_array($query_charge);
		if(pg_escape_string(trim($row['bill_to_code']))=="" || pg_escape_string(trim($row['bill_to_code']))=="NULL"){
		echo '<b>Error: Bill To still empty for Charge Code '.$row['service_code'].'</b>';
		return 1;
		}
		if(pg_escape_string(trim($row['selling_rate']))=="" || pg_escape_string(trim($row['selling_rate']))=="NULL" || $row['selling_rate'] < 1){
		echo '<b>Error: Selling Rate still empty for Charge Code '.$row['service_code'].'</b>';
		return 1;
		}
		if(pg_escape_string(trim($row['selling_currency']))=="" || pg_escape_string(trim($row['selling_currency']))=="NULL"){
		echo '<b>Error: Currency still empty for Charge Code '.$row['service_code'].'</b>';
		return 1;
		}
		if(pg_escape_string(trim($charge_list['charge_group_code']))=="" || pg_escape_string(trim($charge_list['charge_group_code']))=="NULL"){
		echo '<b>Error: There is no '.$row['service_code'].' charges for Trans Type '.$trans_type.' with Grp Code '.$row['chg_grp'].'</b>';
		return 1;
		}
	}
pg_free_result($query_charge);
pg_close($con);
	}
@sybase_free_result($query_bill);
sybase_close($link);
}

function post($jo_numb){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query_post=sybase_query("UPDATE oth_services SET status = 'X' WHERE jo_numb ='$jo_numb'");
@sybase_free_result($query_post);
sybase_close($link);
}

function update_bill_to($recno,$bill_to_code){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$q1=pg_query($con,"SELECT partners.customer.company_name FROM partners.customer WHERE partners.customer.aaigoc_code='$bill_to_code'");
$cust=pg_fetch_array($q1);
$bill_to_name=$cust['company_name'];
	if($q1){
	echo '<p style="color:green">SELECT OK</p>';
	}
pg_free_result($q1);
pg_close($con);
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$q3=sybase_query("UPDATE booking_charges SET bill_to_code='$bill_to_code',bill_to_name='$bill_to_name' WHERE recno=$recno");
	if($q1){
	echo '<p style="color:green">UPDATE OK</p>';
	}
@sybase_free_result($q3);
sybase_close($link);
}

function unpost($jo_numb,$unpost_reason){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$unpost=sybase_query("UPDATE oth_services SET status = 'A',unpost_reason='$unpost_reason' WHERE jo_numb='$jo_numb'");
@sybase_free_result($unpost);
sybase_close($link);
}
//validation used in unpost. note: force to recall doesnt need this
function wf_check_if_billed($doc_ref,$jo_numb){
	if(strlen($doc_ref) > 0){
	include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	$check_billed=sybase_query("SELECT COUNT(bill_no) AS ll_tot_bill FROM c_bill_hdr WHERE (c_bill_hdr.doc_ref='$doc_ref') AND (c_bill_hdr.status='X')");
	$billed=sybase_fetch_array($check_billed);
		if($billed['ll_tot_bill'] > 0){
		echo '<p style="color:red">Error: Failed to Recall/Cancel. Job Order No. '.$jo_numb.' already billed.</p>';
		return 1;
		}
	@sybase_free_result($check_billed);
	sybase_close($link);
	}
}

function f_insert_logs($doc_ref,$button,$user,$action_reason,$mmain_ctrlno){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$log=sybase_query("INSERT INTO action_log(trans_ref,action_ref,exec_by,exec_datetime,action_reason,mmain_ctrlno)VALUES('$doc_ref','$button','$user',GETDATE(),'$action_reason',$mmain_ctrlno)");
@sybase_free_result($log);
sybase_close($link);
}

function cancel($jo_numb){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$cancel=sybase_query("UPDATE oth_services SET status = 'C' WHERE jo_numb='$jo_numb'");
@sybase_free_result($cancel);
sybase_close($link);
}

function delete_booking_charge($checkbox){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	for($i=0;$i<count($checkbox);$i++){
	$id=$checkbox[$i];
	$delete=sybase_query("DELETE FROM booking_charges WHERE recno=$id");
	}
@sybase_free_result($delete);
sybase_close($link);
}

function insert_booking_charges($foreign_recno_dbid,$selling_rate,$selling_currency,$collect_tag,$bill_to_code,$bill_to_name,$override_by,$date_override,$chg_grp,$chg_grp_desc,$service_code,$service_description,$prepared_by){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$insert_booking_charges=sybase_query("INSERT INTO booking_charges(foreign_recno_dbid,selling_rate,selling_currency,collect_tag,bill_to_code,bill_to_name,override_by,date_override,chg_grp,chg_grp_desc,service_code,service_description,prepared_by)VALUES($foreign_recno_dbid,$selling_rate,'$selling_currency','$collect_tag','$bill_to_code','$bill_to_name','$override_by','$date_override','$chg_grp','$chg_grp_desc','$service_code','$service_description','$prepared_by')");
@sybase_free_result($insert_booking_charges);
sybase_close($link);
}
//get the date three months before the current date
function get_three_month(){
$currentdate=date("m/d/Y");
$x = new DateTime($currentdate);
$x->modify('-90 day');
return $x->format('m/d/Y');
}

function select_tot_selling_rate($foreign_recno_dbid){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query_selling_rate=sybase_query("SELECT SUM(selling_rate) AS selling_rate FROM booking_charges WHERE foreign_recno_dbid=$foreign_recno_dbid");    
$selling_rate=sybase_fetch_array($query_selling_rate);
return $selling_rate['selling_rate'];
@sybase_free_result($query_selling_rate);
sybase_close($link);
}

function update_tot_chgs($tot_selling_rate,$foreign_recno_dbid){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$result=sybase_query("UPDATE oth_services SET total_charges=$tot_selling_rate WHERE foreign_recno_dbid=$foreign_recno_dbid");
@sybase_free_result($result);
sybase_close($link);    
}

//this is from selecting csr,select and insert into booking_charges
function insert_wf_charges($csr,$foreign_recno_dbid,$prepared_by){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$query_wf_charges=  pg_query($con,"select isnull(b.chg_grp,'') AS chg_grp,
isnull(b.charge_code,'') as oc_code,isnull(net_rate,0) AS net_rate,
isnull(net_currency,'') AS net_currency,
isnull(agent_rate,0) AS agent_rate,
isnull(selling_currency,'') AS selling_currency,
isnull(selling_rate,0) AS selling_rate,
isnull(c.aaigoc_code,'') AS aaigoc_code, 
isnull(company_name,'') AS company_name, charge_group_desc, 
isnull(e.charge_desc,b.charge_code) as oc_desc, other_charges_no, 
isnull(agent_currency,'') AS agent_currency, case prepaid when 'Y' then 'P' else 'C' end AS collect_tag,
isnull(f.vat_code,'VAT'), isnull(f.vat_rate,0.12)
from csr.service_record a join csr.other_charges b on
a.csr_no = b.csr_no join partners.customer c on
bill_to_aaigoc_code = c.aaigoc_code join charge_group d on
b.chg_grp = d.charge_group_code left join charge e on 
b.charge_code = e.charge_code left join vat_category f on
c.vat_code = f.vat_code
where a.csr_reference='$csr'");
    if(pg_num_rows($query_wf_charges) > 0){
    include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
        while ($row = pg_fetch_array($query_wf_charges)){
        $chg_grp=$row['chg_grp'];
        $chg_grp_desc=$row['charge_group_desc'];
        $service_code=$row['oc_code'];
        $service_description=$row['oc_desc'];
        $selling_rate=$row['selling_rate'];
        $selling_currency=$row['selling_currency'];
        $collect_tag=$row['collect_tag'];
        $bill_to_code=$row['aaigoc_code'];
        $bill_to_name=$row['company_name'];
        $insert_wf_charges=sybase_query("INSERT INTO booking_charges(foreign_recno_dbid,selling_rate,selling_currency,collect_tag,bill_to_code,bill_to_name,chg_grp,chg_grp_desc,service_code,service_description,prepared_by)VALUES($foreign_recno_dbid,$selling_rate,'$selling_currency','$collect_tag','$bill_to_code','$bill_to_name','$chg_grp','$chg_grp_desc','$service_code','$service_description','$prepared_by')");    
        }
    @sybase_free_result($insert_wf_charges);    
    sybase_close($link);
    }
@pg_free_result($query_wf_charges);
pg_close($con);
}

include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');

//this is for oth_services
@$jo_numb_search=validate_input($_POST['jo_numb_search']);

@$foreign_recno_dbid=validate_input($_POST['foreign_recno_dbid']);
@$csr=validate_input($_POST['csr']);
@$c_code=validate_input($_POST['c_code']);
@$client=validate_input($_POST['client']);
@$cust_address=validate_input($_POST['cust_address']);
@$doc_type=validate_input($_POST['doc_type']);
@$doc_ref=validate_input($_POST['doc_ref']);
@$hawbno=validate_input($_POST['hawbno']);
@$mawbno=validate_input($_POST['mawbno']);
@$oth_reference=validate_input($_POST['oth_reference']);
@$item_description=validate_input($_POST['item_description']);
@$agent_code=validate_input($_POST['agent_code']);
@$agent_name=validate_input($_POST['agent_name']);
@$qnty=validate_input($_POST['qnty']);
@$wt=validate_input($_POST['wt']);
@$cbm=validate_input($_POST['cbm']);
@$instructions=validate_input($_POST['instructions']);
@$exrate=validate_input($_POST['exrate']);
@$unpost_reason=validate_input($_POST['unpost_reason']);

@$jo_numb=validate_input($_POST['jo_numb']);
@$status=validate_input($_POST['status']);
@$trans_type=validate_input($_POST['trans_type']);
@$service_type=validate_input($_POST['service_type']);
@$transaction_date=validate_input($_POST['transaction_date']);
@$bill_to_dept=validate_input($_POST['bill_to_dept']);
@$total_charges=validate_input($_POST['total_charges']);
@$bill_no=validate_input($_POST['bill_no']);
@$prepared_by=validate_input($_POST['prepared_by']);
@$prepared_datetime=validate_input($_POST['prepared_datetime']);
@$transmit_no=validate_input($_POST['transmit_no']);
@$transmit_date=validate_input($_POST['transmit_date']);
@$transmit_by=validate_input($_POST['transmit_by']);
@$trucking_from=validate_input($_POST['trucking_from']);
@$trucking_to=validate_input($_POST['trucking_to']);
@$trucking_dr=validate_input($_POST['trucking_dr']);
//this is for booking_charges
@$chg_grp=validate_input(strtoupper($_POST['chg_grp']));
@$chg_grp_desc=validate_input($_POST['chg_grp_desc']);
@$service_code=validate_input(strtoupper($_POST['service_code']));
@$service_description=validate_input($_POST['service_description']);
@$selling_rate=validate_input($_POST['selling_rate']);
@$selling_currency=validate_input($_POST['selling_currency']);
@$collect_tag=validate_input($_POST['collect_tag']);
@$bill_to_code=validate_input($_POST['bill_to_code']);
@$bill_to_name=validate_input($_POST['bill_to_name']);
@$prepared_by=validate_input($_POST['prepared_by']);
@$date_prepared=validate_input($_POST['date_prepared']);
@$override_by=validate_input($_POST['override_by']);
@$date_override=validate_input($_POST['date_override']);
@$recno=validate_input($_POST['recno']);
?>