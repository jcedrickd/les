<fieldset style="float:left;">
<div><label class="field">Payee:</label> <input type="text" name="payee_code" value="<?php echo @$payee_code; ?>" maxlength="20" class="input" placeholder="Code" id="payee_code" onKeyUp="showPayeeName(this.value);" onFocus="showPayeeName(this.value);" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_user_list('payee_code');return false;" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('payee_code');return false;" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <input type="text" name="payee_name" value="<?php echo @$payee_name; ?>" maxlength="50" class="input bigtxt" readonly="readonly" id="payee_name" /></div>
<div id="jo_cust">
<div><label class="field">Customer:</label> <input type="text" name="cust_code" value="<?php echo @$cust_code; ?>" maxlength="15" class="input" placeholder="Code" onFocus="showCust(this.value);" onKeyUp="showCust(this.value);" id="cust_code" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('cust_code');return false;" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <input type="text" name="cust_name" value="<?php echo @$cust_name; ?>" maxlength="50" class="input bigtxt" readonly="readonly" id="cust_name" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea rows="2" cols="38" class="input" id="cust_address" readonly="readonly" name="cust_address">
<?php 
echo @$cust_address; 
?>
</textarea>
</div>
</div>

<div><label class="field">Service Type:</label> <input type="text" name="service_type" value="<?php echo 'Other Services'; ?>" class="input" id="service_type" readonly="readonly" /></div>

<div><label class="field">Transmit No.:</label> <input type="text" name="transmit_no" value="<?php echo @$transmit_no; ?>" maxlength="12" class="input" id="transmit_no" readonly="readonly" /></div>

<div><label class="field">FN Transmit No.:</label> <input type="text" name="fin_transmit_no" value="<?php echo @$fin_transmit_no; ?>" maxlength="12" class="input" id="fin_transmit_no" readonly="readonly" /></div>

<div><label class="field">Cash Replenish:</label> 
<select name="petty_cash_replenish" class="input" id="petty_cash_replenish">
    <option value="<?php echo @$petty_cash_replenish; ?>"><?php echo show_cash_replenish(@$petty_cash_replenish); ?></option>
    <option value="SD">SEAFRT</option>
    <option value="FN">FINANCE</option>
    <option value="EO">EXPORT AIR</option>
</select>
</div>

<div><label class="field">Total Cash:</label> <input type="text" name="tot_cash" value="<?php echo @number_format($tot_cash,2); ?>" maxlength="14" class="input" id="tot_cash" readonly="readonly" /></div>

<div><label class="field">Total Check:</label> <input type="text" name="tot_cheque" value="<?php echo @number_format($tot_cheque,2); ?>" maxlength="14" class="input" id="tot_cheque" readonly="readonly" /></div>

<div><label class="field">Grand Total:</label> <input type="text" name="grand_total" value="<?php echo @number_format($tot_cash+$tot_cheque,2); ?>" class="input" id="grand_total" readonly="readonly" /></div>

<fieldset style="float:left;">
<legend>Shipment Information</legend>
<div><label class="field">Job Order No.:</label> <input type="text" name="job_order_no" value="<?php echo @$job_order_no; ?>" class="input" id="job_order_no" onKeyUp="get_jo(this.value);" onInput="this.value=this.value.toUpperCase();" autocomplete="off" /></div>
<div id="jo_result">
<div><label class="field">MAWB/MBL:</label> <input type="text" name="mcarref" value="<?php echo @$mcarref; ?>" maxlength="20" class="input" id="mcarref" readonly="readonly" /> </div>
<div><label class="field">HAWB/HBL:</label> <input type="text" name="hcarref" value="<?php echo @$hcarref; ?>" maxlength="20" class="input" id="hcarref" readonly="readonly" /></div>
<div><label class="field">DR No.:</label> <input type="text" name="dr_no" value="<?php echo @$dr_no; ?>" maxlength="20" class="input" id="dr_no" readonly="readonly" /></div>
</div>
<div><label class="field">Shipper:</label> <input type="text" name="shipper_code" value="<?php echo @$shipper_code; ?>" maxlength="15" class="input" id="shipper_code" readonly="readonly" />  <input type="text" name="shipper_name" value="<?php echo @$shipper_name; ?>" maxlength="50" class="input second_input bigtxt" id="shipper_name" /></div>
</fieldset>

</fieldset>

<fieldset style="float:left;">
    <div><label class="field">Status</label> <input type="text" name="pcv_stat" value="<?php echo show_status(@$pcv_stat); ?>" class="input" id="pcv_stat" readonly="readonly" /></div>
<div><label class="field" style="visibility:hidden;">hdsufhdshfj</label> <input type="text" name="validate_stat" value="<?php echo show_validate(@$validate_stat); ?>" class="input" id="validate_stat" readonly="readonly" /></div>
<div><label class="field">PCV No.:</label> <input type="text" name="pcv_no" value="<?php echo @$pcv_no; ?>" class="input" id="pcv_no" readonly="readonly" /></div>

<div>
<label class="field">PCV Type:</label> 
<select name="pcv_type" class="input" id="pcv_type">
    <option value="<?php echo @$pcv_type; ?>"><?php echo show_pcv_type(@$pcv_type); ?></option>
    <option value="Y">Cash</option>
    <option value="N">Company Cheque</option>
    <option value="M">Manager Cheque</option>
</select>
</div>

<div><label class="field">PCV Date:</label> <input type="text" name="pcv_date" value="<?php echo date("m/d/Y H:i",strtotime(@$pcv_date)); ?>" class="input" id="pcv_date" readonly="readonly" /></div>

<div><label class="field">Miscellaneous:</label> <input type="checkbox" name="miscellaneous_pcv" id="miscellaneous_pcv" value="Y" <?php if(@$miscellaneous_pcv=="Y") echo 'checked="checked"'; ?> class="input" id="doc_ref" /> </div>

<!--div><label class="field">Company:</label> <input type="text" name="hawbno" value="<?php echo @$hawbno; ?>" class="input" id="hawbno" /></div-->

<div><label class="field">Prepared By:</label> 
<input type="text" name="type_by" value="<?php echo @$type_by; ?>" maxlength="12" class="input" id="type_by" readonly="readonly" />
<input type="text" class="input" name="type_datetime" id="type_datetime" value="<?php echo date("m/d/Y H:i",strtotime(@$type_datetime)); ?>" readonly="readonly" />
</div>

<div><label class="field">Validate By:</label> 
<select name="validate_by" class="input" id="validate_by">
<option value="<?php echo @$validate_by; ?>"><?php echo show_fullname(@$validate_by); ?></option>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT pcv_validate FROM pcv_validate WHERE userid='$type_by'");
while($validate=sybase_fetch_array($query)){
$query_name=sybase_query("SELECT fullname FROM useracc WHERE user1='$validate[pcv_validate]'");
$name=  sybase_fetch_array($query_name);
?>
<option value="<?php echo $validate['pcv_validate']; ?>"><?php echo $name['fullname']; ?></option>
<?php
}
sybase_free_result($query_name);
sybase_free_result($query);
sybase_close($link);
?>
</select>
<input type="text" class="input" name="validate_datetime" id="validate_datetime" value="<?php echo date("m/d/Y H:i",strtotime(@$validate_datetime)); ?>" readonly="readonly" /></div>

<div><label class="field">Verified By:</label> 
<select name="verified_by" class="input" id="verified_by">
<option value="<?php echo @$verified_by; ?>"><?php echo show_fullname(@$verified_by); ?></option>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query2=sybase_query("SELECT pcv_verify FROM pcv_verified WHERE userid='$type_by'");
while($verify=sybase_fetch_array($query2)){
$query_name=sybase_query("SELECT fullname FROM useracc WHERE user1='$verify[pcv_verify]'");
$name=  sybase_fetch_array($query_name);
?>
<option value="<?php echo $verify['pcv_verify']; ?>"><?php echo $name['fullname']; ?></option>
<?php
}
sybase_free_result($query_name);
sybase_free_result($query2);
sybase_close($link);
?>
</select>
</div>

<div><label class="field">Approved By:</label> 
<select name="approved_by" class="input" id="approved_by">
<option value="<?php echo @$approved_by; ?>"><?php echo show_fullname(@$approved_by); ?></option>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query3=sybase_query("SELECT pcv_approver FROM pcv_apprv WHERE userid='$type_by'");
while($apprv=sybase_fetch_array($query3)){
$query_name=sybase_query("SELECT fullname FROM useracc WHERE user1='$apprv[pcv_approver]'");
$name=  sybase_fetch_array($query_name);
?>
<option value="<?php echo $apprv['pcv_approver']; ?>"><?php echo $name['fullname']; ?></option>
<?php
}
sybase_free_result($query_name);
sybase_free_result($query3);
sybase_close($link);
?>
</select>
</div>

<div><label class="field">Station:</label> <input type="text" name="station_id" value="<?php echo @$station_id; ?>" maxlength="3" class="input" id="station_id" /></div>

<div><label class="field">Receipted:</label> <input type="text" name="tot_rcpt_cost" value="<?php echo @number_format($tot_rcpt_cost,2); ?>" maxlength="14" class="input" id="tot_rcpt_cost" readonly="readonly" /></div>

<div><label class="field">Unreceipted:</label> <input type="text" name="tot_urcpt_cost" value="<?php echo @number_format($tot_urcpt_cost,2); ?>" maxlength="14" class="input" id="tot_urcpt_cost" readonly="readonly" /></div>

<div style="height:78px;"></div>
</fieldset>

<fieldset style="float:left;">
<div><label class="field">Arrival Date:</label> <input type="text" name="arrival_date" value="<?php echo date("m/d/Y",strtotime(@$arrival_date)); ?>" class="input datepicker" id="arrival_date" /> </div>
<!--div><label class="field">Other Ref:</label> <input type="text" name="other_ref" value="<?php echo @$other_ref; ?>" maxlength="100" class="input" id="other_ref" /></div-->
<div><label class="field">Commodity:</label> <input type="text" name="commodity" value="<?php echo @$commodity; ?>" maxlength="50" class="input" id="commodity" /></div>
<div><label class="field">Rcv By:</label> <input type="text" name="rcv_by" value="<?php echo @$rcv_by; ?>" maxlength="12" class="input" id="rcv_by" /></div>

<div><label class="field">Act Wt:</label> <input type="text" name="act_wt" value="<?php echo @$act_wt; ?>" maxlength="14" class="input" id="act_wt" onkeypress="return isDecimalKey(event);" /> </div>
<div><label class="field">Chg Wt:</label> <input type="text" name="chg_wt" value="<?php echo @$chg_wt; ?>" maxlength="14" class="input" id="chg_wt" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Pcs:</label> <input type="text" name="nopcs" value="<?php echo @$nopcs; ?>" class="input" id="nopcs" onkeypress="return isNumberKey(event);" /></div>
<div><label class="field">Ex. Rate:</label> <input type="text" name="exrate" value="<?php echo @$exrate; ?>" maxlength="14" class="input" id="exrate" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Other Reference:</label> <textarea name="other_ref" rows="2" cols="38" class="input" id="other_ref" maxlength="100"><?php echo @$other_ref; ?></textarea></div>
</fieldset>

<fieldset style="float:left;">
<legend>Special Instructions</legend>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> 
<textarea name="instruction" rows="2" cols="30" maxlength="100" id="instruction" class="input">
<?php echo @$instruction; ?>
</textarea>
</div>
</fieldset>

<fieldset style="float:left;">
    <legend>Brokerage Info</legend>
    <div>
    <label class="field">Release Type:</label> 
    <select name="release_type" class="input" id="release_type">
        <option value="<?php echo @$release_type; ?>"><?php echo show_release_type(@$release_type); ?></option>
        <option value="OT">Old Transhipment</option>
        <option value="NT">New Transhipment</option>
        <option value="FC">Formal Commercial</option>
        <option value="IC">Informal Commercial</option>
        <option value="WH">Warehousing</option>
    </select>
    </div>
    <div><label class="field">FD/BD:</label> 
    <select name="fd_bd" class="input" id="fd_bd">
        <option><?php echo @$fd_bd; ?></option>
        <option>FD</option>
        <option>BD</option>
    </select>
    </div>
</fieldset>