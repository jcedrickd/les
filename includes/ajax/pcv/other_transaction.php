<?php 
session_start(); 
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/access.php');
?>

<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$pcv_numb_search=validate_input(strtoupper($_GET['pcv_numb_search']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=  sybase_query("SELECT * FROM pcv_hdr WHERE pcv_no='$pcv_numb_search'");
$pcv=  sybase_fetch_array($query1);
?>
<div class="tab-pane active" id="main_info">
<fieldset style="float:left;">
<div><label class="field">Payee:</label> <input type="text" name="payee_code" value="<?php echo $pcv['payee_code']; ?>" maxlength="20" class="input" placeholder="Code" id="payee_code" onKeyUp="showPayeeName(this.value);" onFocus="showPayeeName(this.value);" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_user_list('payee_code');return false;" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('payee_code');return false;" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <input type="text" name="payee_name" value="<?php echo $pcv['payee_name']; ?>" maxlength="50" class="input bigtxt" readonly="readonly" id="payee_name" /></div>
<div id="jo_cust">
<div><label class="field">Customer:</label> <input type="text" name="cust_code" value="<?php echo @$pcv['cust_code']; ?>" maxlength="15" class="input" placeholder="Code" onFocus="showCust(this.value);" onKeyUp="showCust(this.value);" id="cust_code" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('cust_code');return false;" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <input type="text" name="cust_name" value="<?php echo $pcv['cust_name']; ?>" maxlength="50" class="input bigtxt" readonly="readonly" id="cust_name" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea rows="2" cols="38" class="input" id="cust_address" readonly="readonly" name="cust_address">
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$sql = "SELECT partners.customer.address,partners.customer.city,partners.customer.state_province,partners.customer.zipcode,public.country.country_desc 
FROM partners.customer LEFT OUTER JOIN public.country ON partners.customer.country_code = public.country.country_code 
WHERE partners.customer.aaigoc_code='$pcv[cust_code]'";
$result = pg_query($con,$sql) or die("Cannot execute query: $sql\n");
$address = pg_fetch_array($result);
echo @$address['address'].', '.@$address['city'].' '.@$address['state_province'].' '.@$address['country_desc'].' '.@$address['zipcode']; 
pg_free_result($result);
pg_close($con);
?>
</textarea>
</div>
</div>

<div><label class="field">Service Type:</label> <input type="text" name="service_type" value="<?php if($pcv['service_type']=="OS") echo 'Other Services'; ?>" class="input" id="service_type" readonly="readonly" /></div>

<div><label class="field">Transmit No.:</label> <input type="text" name="transmit_no" value="<?php echo $pcv['transmit_no']; ?>" maxlength="12" class="input" id="transmit_no" readonly="readonly" /></div>

<div><label class="field">FN Transmit No.:</label> <input type="text" name="fin_transmit_no" value="<?php echo $pcv['fin_transmit_no']; ?>" maxlength="12" class="input" id="fin_transmit_no" readonly="readonly" /></div>

<div><label class="field">Cash Replenish:</label> 
<select name="petty_cash_replenish" class="input" id="petty_cash_replenish">
    <option value="<?php echo $pcv['petty_cash_replenish']; ?>"><?php echo show_cash_replenish($pcv['petty_cash_replenish']); ?></option>
    <option value="SD">SEAFRT</option>
    <option value="FN">FINANCE</option>
    <option value="EO">EXPORT AIR</option>
</select>
</div>

<div><label class="field">Total Cash:</label> <input type="text" name="tot_cash" value="<?php echo number_format($pcv['tot_cash'],2); ?>" maxlength="14" class="input" id="tot_cash" readonly="readonly" /></div>

<div><label class="field">Total Check:</label> <input type="text" name="tot_cheque" value="<?php echo number_format($pcv['tot_cheque'],2); ?>" maxlength="14" class="input" id="tot_cheque" readonly="readonly" /></div>

<div><label class="field">Grand Total:</label> <input type="text" name="grand_total" value="<?php echo number_format($pcv['tot_cash']+$pcv['tot_cheque'],2); ?>" class="input" id="grand_total" readonly="readonly" /></div>

<fieldset style="float:left;">
<legend>Shipment Information</legend>
<div><label class="field">Job Order No.:</label> <input type="text" name="job_order_no" value="<?php echo trim($pcv['job_order_no']); ?>" class="input" id="job_order_no" onKeyUp="get_jo(this.value);" onInput="this.value=this.value.toUpperCase();" autocomplete="off" /></div>
<div id="jo_result">
<div><label class="field">MAWB/MBL:</label> <input type="text" name="mcarref" value="<?php echo $pcv['mcarref']; ?>" maxlength="20" class="input" id="mcarref" readonly="readonly" /> </div>
<div><label class="field">HAWB/HBL:</label> <input type="text" name="hcarref" value="<?php echo $pcv['hcarref']; ?>" maxlength="20" class="input" id="hcarref" readonly="readonly" /></div>
<div><label class="field">DR No.:</label> <input type="text" name="dr_no" value="<?php echo $pcv['dr_no']; ?>" maxlength="20" class="input" id="dr_no" readonly="readonly" /></div>
</div>
<div><label class="field">Shipper:</label> <input type="text" name="shipper_code" value="<?php echo $pcv['shipper_code']; ?>" maxlength="15" class="input" id="shipper_code" readonly="readonly" />  <input type="text" name="shipper_name" value="<?php echo $pcv['shipper_name']; ?>" maxlength="50" class="input second_input bigtxt" id="shipper_name" /></div>
</fieldset>

</fieldset>

<fieldset style="float:left;">
    <div><label class="field">Status</label> <input type="text" name="pcv_stat" value="<?php echo show_status($pcv['pcv_stat']); ?>" class="input" id="pcv_stat" readonly="readonly" /></div>
    <div><label class="field" style="visibility:hidden;">hdsufhdshfj</label> <input type="text" name="validate_stat" value="<?php echo show_validate($pcv['validate_stat']); ?>" class="input" id="validate_stat" readonly="readonly" /></div>
<div><label class="field">PCV No.:</label> <input type="text" name="pcv_no" value="<?php echo $pcv['pcv_no']; ?>" class="input" id="pcv_no" readonly="readonly"  /></div>

<div>
<label class="field">PCV Type:</label> 
<select name="pcv_type" class="input" id="pcv_type">
    <option value="<?php echo $pcv['pcv_type']; ?>"><?php echo show_pcv_type($pcv['pcv_type']); ?></option>
    <option value="Y">Cash</option>
    <option value="N">Company Cheque</option>
    <option value="M">Manager Cheque</option>
</select>
</div>

<div><label class="field">PCV Date:</label> <input type="text" name="pcv_date" value="<?php echo date("m/d/Y H:i",strtotime($pcv['pcv_date'])); ?>" class="input datepicker" id="pcv_date" readonly="readonly" /></div>

<div><label class="field">Miscellaneous:</label> <input type="checkbox" name="miscellaneous_pcv" id="miscellaneous_pcv" value="Y" <?php if($pcv['miscellaneous_pcv']=="Y") echo 'checked="checked"'; ?> class="input" id="doc_ref" /> </div>

<!--div><label class="field">Company:</label> <input type="text" name="hawbno" value="<?php echo @$hawbno; ?>" class="input" id="hawbno" /></div-->


<div><label class="field">Prepared By:</label> 
<input type="text" name="type_by" value="<?php echo $pcv['type_by']; ?>" maxlength="12" class="input" id="type_by" readonly="readonly" />
<input type="text" class="input" name="type_datetime" id="type_datetime" value="<?php echo date("m/d/Y H:i",strtotime($pcv['type_datetime'])); ?>" readonly="readonly" />
</div>

<div><label class="field">Validate By:</label> 
<select name="validate_by" class="input" id="validate_by">
<?php 
$query_validate=sybase_query("SELECT fullname FROM useracc WHERE user1='$pcv[verified_by]'");
$validate_name=  sybase_fetch_array($query_validate);
?>
<option value="<?php echo $pcv['validate_by']; ?>"><?php echo $validate_name['fullname']; ?></option>
<?php
sybase_free_result($query_validate);
$result1=sybase_query("SELECT pcv_validate FROM pcv_validate WHERE userid='$pcv[type_by]'");
while($validate=sybase_fetch_array($result1)){
$query_name=sybase_query("SELECT fullname FROM useracc WHERE user1='$validate[pcv_validate]'");
$name=  sybase_fetch_array($query_name);
?>
<option value="<?php echo $validate['pcv_validate']; ?>"><?php echo $name['fullname']; ?></option>
<?php
}
sybase_free_result($query_name);
sybase_free_result($result1);
?>
</select>
<input type="text" class="input" name="validate_datetime" id="validate_datetime" value="<?php echo date("m/d/Y H:i",strtotime($pcv['validate_datetime'])); ?>" readonly="readonly" /></div>

<div><label class="field">Verified By:</label> 
<select name="verified_by" class="input" id="verified_by">
<?php 
$query_verify=sybase_query("SELECT fullname FROM useracc WHERE user1='$pcv[verified_by]'");
$verify_name=  sybase_fetch_array($query_verify);
?>
<option value="<?php echo $pcv['verified_by']; ?>"><?php echo $verify_name['fullname']; ?></option>
<?php
sybase_free_result($query_verify);
$result2=sybase_query("SELECT pcv_verify FROM pcv_verified WHERE userid='$pcv[type_by]'");
while($verify=sybase_fetch_array($result2)){
$query_name=sybase_query("SELECT fullname FROM useracc WHERE user1='$verify[pcv_verify]'");
$name=  sybase_fetch_array($query_name);
?>
<option value="<?php echo $verify['pcv_verify']; ?>"><?php echo $name['fullname']; ?></option>
<?php
}
sybase_free_result($query_name);
sybase_free_result($result2);
?>
</select>
</div>

<div><label class="field">Approved By:</label> 
<select name="approved_by" class="input" id="approved_by">
<?php 
$query_apprv=sybase_query("SELECT fullname FROM useracc WHERE user1='$pcv[approved_by]'");
$apprv_name=  sybase_fetch_array($query_apprv);
?>
<option value="<?php echo $pcv['approved_by']; ?>"><?php echo $apprv_name['fullname']; ?></option>
<?php
sybase_free_result($query_apprv);
$result3=sybase_query("SELECT pcv_approver FROM pcv_apprv WHERE userid='$pcv[type_by]'");
while($apprv=sybase_fetch_array($result3)){
$query_name=sybase_query("SELECT fullname FROM useracc WHERE user1='$apprv[pcv_approver]'");
$name=  sybase_fetch_array($query_name);
?>
<option value="<?php echo $apprv['pcv_approver']; ?>"><?php echo $name['fullname']; ?></option>
<?php
}
sybase_free_result($query_name);
sybase_free_result($result3);
?>
</select>
</div>

<div><label class="field">Station:</label> <input type="text" name="station_id" value="<?php echo $pcv['station_id']; ?>" maxlength="3" class="input" id="station_id" /></div>

<div><label class="field">Receipted:</label> <input type="text" name="tot_rcpt_cost" value="<?php echo number_format($pcv['tot_rcpt_cost'],2); ?>" maxlength="14" class="input" id="tot_rcpt_cost" readonly="readonly" /></div>

<div><label class="field">Unreceipted:</label> <input type="text" name="tot_urcpt_cost" value="<?php echo number_format($pcv['tot_urcpt_cost'],2); ?>" maxlength="14" class="input" id="tot_urcpt_cost" readonly="readonly" /></div>

<div style="height:78px;"></div>
</fieldset>

<fieldset style="float:left;">
<div><label class="field">Arrival Date:</label> <input type="text" name="arrival_date" value="<?php echo date("m/d/Y",strtotime($pcv['arrival_date'])); ?>" class="input" id="arrival_date" /> </div>
<!--div><label class="field">Other Ref:</label> <input type="text" name="other_ref" value="<?php echo $pcv['other_ref']; ?>" maxlength="100" class="input" id="other_ref" /></div-->
<div><label class="field">Commodity:</label> <input type="text" name="commodity" value="<?php echo $pcv['commodity']; ?>" maxlength="50" class="input" id="commodity" /></div>
<div><label class="field">Rcv By:</label> <input type="text" name="rcv_by" value="<?php echo $pcv['rcv_by']; ?>" maxlength="12" class="input" id="rcv_by" /></div>

<div><label class="field">Act Wt:</label> <input type="text" name="act_wt" value="<?php echo $pcv['act_wt']; ?>" maxlength="14" class="input" id="act_wt" onkeypress="return isDecimalKey(event);" /> </div>
<div><label class="field">Chg Wt:</label> <input type="text" name="chg_wt" value="<?php echo $pcv['chg_wt']; ?>" maxlength="14" class="input" id="chg_wt" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Pcs:</label> <input type="text" name="nopcs" value="<?php echo $pcv['nopcs']; ?>" class="input" id="nopcs" onkeypress="return isNumberKey(event);" /></div>
<div><label class="field">Ex. Rate:</label> <input type="text" name="exrate" value="<?php echo $pcv['exrate']; ?>" maxlength="14" class="input" id="exrate" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Other Reference:</label> <textarea name="other_ref" rows="2" cols="38" class="input" id="other_ref" maxlength="100"><?php echo $pcv['other_ref']; ?></textarea></div>
</fieldset>

<fieldset style="float:left;">
<legend>Special Instructions</legend>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> 
<textarea name="instruction" rows="2" cols="30" maxlength="100" id="instruction" class="input">
<?php echo $pcv['instruction']; ?>
</textarea>
</div>
</fieldset>

<fieldset style="float:left;">
    <legend>Brokerage Info</legend>
    <div>
    <label class="field">Release Type:</label> 
    <select name="release_type" class="input" id="release_type">
        <option value="<?php echo $pcv['release_type']; ?>"><?php echo show_release_type($pcv['release_type']); ?></option>
        <option value="OT">Old Transhipment</option>
        <option value="NT">New Transhipment</option>
        <option value="FC">Formal Commercial</option>
        <option value="IC">Informal Commercial</option>
        <option value="WH">Warehousing</option>
    </select>
    </div>
    <div><label class="field">FD/BD:</label> 
    <select name="fd_bd" class="input" id="fd_bd">
        <option><?php echo $pcv['fd_bd']; ?></option>
        <option>FD</option>
        <option>BD</option>
    </select>
    </div>
</fieldset>
</div>

<div class="tab-pane" id="charge_cost_info">
<div style="float:left" id="table">
<div style="height:5px;width:inherit;"></div>
<div class="form-inline col-xs-12">
<div style="height:5px;width:inherit;"></div>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_insert; ?>" name="add" value="Add" <?php //echo @$post_disabled; ?> <?php //echo @$cancel_disabled; ?> id="add" <?php //echo @$disabled; ?> /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_delete; ?>" name="delete" value="Delete" <?php //echo @$post_disabled; ?> <?php //echo @$cancel_disabled; ?> id="delete" <?php //echo @$disabled; ?> /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs" name="view_tariff" value="View Tariff" <?php //echo @$post_disabled; ?> <?php //echo @$cancel_disabled; ?> id="view_tariff" <?php //echo @$disabled; ?> /></span>
</div>
<br />
<div style="height:25px;width:inherit;"> </div>
<?php 
$pcv['pcv_stat'] <> 'A' ? $hide='display:none;' : $hide='';
?>
<div style="float:left;"><table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
    <tr>
	<th style="<?php echo @$hide; ?>" class="hidable_column <?php echo @$access_update; ?>">Override</th>
	<th style="<?php echo @$hide; ?>" class="hidable_column <?php echo @$access_delete; ?>">Delete</th>
	<th>Job Order No</th>
	<th>Code</th>
	<th>Description</th>
	<th>Grp Code</th>
	<th>Grp Description</th>
	<th>PHP Cost</th>
	<th>USD Cost</th>
	<th>Receipted</th>
	<th>PCV Type</th>
	<th>FMS Code</th>
    </tr>
</thead>
<tbody>
<!--tr id="booking_charges_from_csr"></tr-->
<tr>
<?php
$query2=sybase_query("SELECT * FROM pcv_dtl WHERE pcv_no='$pcv_numb_search'");
$numrows=sybase_num_rows($query2);
	while($row=sybase_fetch_array($query2)){
?>
	<td style="<?php echo @$hide; ?>" class="hidable_column <?php echo @$access_update; ?>"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/other_transaction/billing/pcv_entry_new/pcvdtl_ctrlno.php?pcvdtl_ctrlno=<?php echo $row['pcvdtl_ctrlno']; ?>" class="hover_row">Override</a></td>
	<td style="<?php echo @$hide; ?>" class="hidable_column <?php echo @$access_delete; ?>"><input type="checkbox" value="<?php echo $row['pcvdtl_ctrlno']; ?>" name="checkbox[]" class="highlight_row" /></td>
	<td><?php echo $row['job_order_no']; ?></td>
        <td><?php echo $row['chg_code']; ?></td>
        <td><?php echo $row['chg_desc']; ?></td>
        <td><?php echo $row['grp_code']; ?></td>
        <td><?php echo $row['grp_desc']; ?></td>
        <td><?php echo number_format($row['php_cost'],2); ?></td>
        <td><?php echo number_format($row['usd_cost'],2); ?></td>
        <td><input type="checkbox" name="receipted_exp" value="<?php echo $row['receipted_exp']; ?>" <?php echo show_receipted_exp($row['receipted_exp']); ?> onclick="return false;" /></td>
        <td><?php echo show_pcv_type($row['cash']); ?></td>
        <td><?php echo $row['check_bp']; ?></td>            
</tr>
<?php
	}
sybase_free_result($query2);
?>
</tbody>
</table></div>
<?php 
$query_receipt=sybase_query("SELECT SUM(php_cost) AS receipt FROM pcv_dtl WHERE pcv_no='$pcv_numb_search' AND cash='Y' AND receipted_exp='Y'");
$result_receipt=  sybase_fetch_array($query_receipt);
$query_unreceipt=sybase_query("SELECT SUM(php_cost) AS unreceipt FROM pcv_dtl WHERE pcv_no='$pcv_numb_search' AND cash='Y' AND receipted_exp <> 'Y'");
$result_unreceipt=  sybase_fetch_array($query_unreceipt);
$query_cheque=sybase_query("SELECT SUM(php_cost) AS cheque FROM pcv_dtl WHERE pcv_no='$pcv_numb_search' AND cash <> 'Y'");
$result_cheque=  sybase_fetch_array($query_cheque);
?>
<p>Total No. of Records: <?php echo number_format($numrows,0); ?></p>
<p>Total Receipted: <?php echo number_format($result_receipt['receipt'],2); ?></p>
<p>Total Unreceipted: <?php echo number_format($result_unreceipt['unreceipt'],2); ?></p>
<p>Total Cheque: <?php echo number_format($result_cheque['cheque'],2); ?></p>
</div>
</div>
<?php 
sybase_free_result($query1);
sybase_free_result($query_receipt);
sybase_free_result($query_unreceipt);
sybase_free_result($query_cheque);
sybase_close($link);
?>

<?php
//functions
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
?>