<?php
$jo_numb=trim(pg_escape_string(strtoupper($_GET['jo_numb'])));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query1=sybase_query("SELECT * FROM oth_services WHERE jo_numb='$jo_numb'");
$jo=sybase_fetch_array($query1);
?>
<input type="text" name="foreign_recno_dbid" value="<?php echo @$jo['foreign_recno_dbid']; ?>" id="foreign_recno_dbid" />
<fieldset style="float:left;">
<legend>Transaction Information</legend>
<div><label class="field">CSR:</label> <input type="text" name="csr" value="<?php echo @$jo['csr']; ?>" class="input bigtxt" placeholder="Reference" id="csr" onKeyUp="check_csr_level(this.value);" onFocus="check_csr_level(this.value);" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_csr_list('csr','OS');return false;" /> <input type="button" class="btn btn-danger css_button btn-xs" name="csr_searcher" value="..." onClick="check_csr('csr','inputError');return false;" /></div>
<div id="from_csr">
<div><label class="field">Customer:</label> <input type="text" name="c_code" value="<?php echo @$jo['c_code']; ?>" class="input" placeholder="Code" onFocus="showCust(this.value);" onKeyUp="showCust(this.value);" id="c_code" /> <input type="text" name="client" value="<?php echo @$jo['client']; ?>" class="input second_input bigtxt" readonly="readonly" id="client" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('c_code');return false;" /></div>
</div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea rows="2" cols="38" class="input" id="cust_address" readonly="readonly" name="cust_address"></textarea></div>
<div><label class="field">Doc Type:</label> <input type="text" name="doc_type" value="<?php echo @$jo['doc_type']; ?>" class="input" id="doc_type" /></div>
<div><label class="field">Doc Ref:</label> <input type="text" name="doc_ref" value="<?php echo @$jo['doc_ref']; ?>" class="input" id="doc_ref" /> </div>
<div><label class="field">House Ref:</label> <input type="text" name="hawbno" value="<?php echo @$jo['hawbno']; ?>" class="input" id="hawbno" /></div>
<div><label class="field">Master Ref:</label> <input type="text" name="mawbno" value="<?php echo @$jo['mawbno']; ?>" class="input" id="mawbno" /></div>
<div><label class="field">Other Ref:</label> <input type="text" name="oth_reference" value="<?php echo @$jo['oth_reference']; ?>" class="input" id="oth_reference" /></div>
<div><label class="field">Item Description:</label> <input type="text" name="item_description" value="<?php echo @$jo['item_description']; ?>" class="input" id="item_description" /></div>
<div><label class="field">Agent:</label> <input type="text" name="agent_code" value="<?php echo @$jo['agent_code']; ?>" class="input" placeholder="Code" onFocus="showAgentName(this.value);" onKeyUp="showCust(this.value);" id="agent_code" /> <input type="text" name="agent_name" value="<?php echo @$jo['agent_name']; ?>" class="input second_input bigtxt" readonly="readonly" id="agent_name" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('agent_code');return false;" /></div>
<div><label class="field">Ex. Rate:</label> <input type="text" name="exrate" value="<?php echo @number_format($jo['exrate'],2); ?>" class="input numeric" id="exrate" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Qnty:</label> <input type="text" name="qnty" value="<?php echo @number_format($jo['qnty'],0); ?>" class="input numeric" onkeypress="return isNumberKey(event);" id="qnty" /></div>
<div><label class="field">Wt:</label> <input type="text" name="wt" value="<?php echo @number_format($jo['wt'],0); ?>" class="input numeric" onkeypress="return isNumberKey(event);" id="wt" /></div>
<div><label class="field">CBM:</label> <input type="text" name="cbm" value="<?php echo @number_format($jo['cbm'],4); ?>" class="input numeric" onkeypress="return isDecimalKey(event);" id="cbm" /></div>
</fieldset>
<fieldset style="float: left;">
<legend>Main Information</legend>
<div><label class="field">Job Order No.:</label> <input type="text" name="jo_numb" value="<?php echo @$jo['jo_numb']; ?>" class="input" readonly="readonly" id="jo_numb" /></div>
<div><label class="field">Status:</label> <input type="text" name="status" value="<?php echo show_status(@$jo['status']); ?>" class="input" readonly="readonly" id="status" /> </div>
<div><label class="field">Transaction Type:</label> 
<select name="trans_type" class="input" id="trans_type">
<option value="<?php echo @$jo['trans_type']; ?>"><?php echo show_trans_type(@$jo['trans_type']); ?></option>
<option value="EA">Air Export Forwarding</option>
<option value="IA">Air Import Forwarding</option>
<option value="BA">Brokerage Air</option>
<option value="BS">Brokerage Sea</option>
<option value="DA">Domestic Air</option>
<option value="DS">Domestic Sea</option>
<option value="DL">Domestic Land</option>
<option value="OT">Other Services</option>
<option value="ES">Sea Export Forwarding</option>
<option value="IS">Sea Import Forwarding</option>
<option value="WH">Warehousing</option>
</select> </div>
<div><label class="field">Service Type:</label> <input type="text" name="service_type" id="service_type" value="<?php switch(@$jo['service_type']){
case 'OT':
echo 'Wrong Other Services';
break;
case 'OS':
echo 'Other Services';
break;
default: echo '';
} ?>" class="input" readonly="readonly" /></div>
<div><label class="field">Transaction Date:</label> <input type="text" name="transaction_date" value="<?php echo date("m/d/Y",strtotime(@$jo['transaction_date'])); ?>" class="input datepicker" id="transaction_date" /></div>
<div><label class="field">Billing-in-Charge:</label> <select name="bill_to_dept" class="input" id="bill_to_dept">
<option value="<?php echo @$jo['bill_to_dept']; ?>">
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query_desc=sybase_query("SELECT dept_desc FROM department WHERE dept_code='$jo[bill_to_dept]'");
$desc=sybase_fetch_array($query_desc);
echo $desc['dept_desc'];
sybase_free_result($query_desc);
?></option>
<?php 
$query=sybase_query("SELECT dept_code,dept_desc FROM department");
while($dept=sybase_fetch_array($query)){
?>
<option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_desc']; ?></option>
<?php
}
sybase_free_result($query);
//sybase_close($link);
?>
</select> </div>
<div><label class="field">Total Charges:</label> <input type="text" name="total_charges" value="<?php echo @number_format($jo['total_charges'],2); ?>" class="input numeric" id="total_charges" readonly="readonly" /> </div>
<div><label class="field">Bill No.:</label> <input type="text" name="bill_no" value="<?php echo @$jo['bill_no']; ?>" class="input" id="bill_no" readonly="readonly" /></div>
<div><label class="field">Prepared By/Date:</label> <input type="text" name="prepared_by" value="<?php echo @$jo['prepared_by']; ?>" class="input" id="prepared_by" readonly="readonly" /> <input type="text" name="prepared_datetime" value="<?php echo date("m/d/Y H:i",strtotime(@$prepared_datetime)); ?>" class="input second_input" id="prepared_datetime" readonly="readonly" /></div>
<div><label class="field">Transmittal #:</label> <input type="text" name="transmit_no" value="<?php echo @$jo['transmit_no']; ?>" class="input" id="transmit_no" readonly="readonly" /></div>
<div><label class="field">Transmittal Date/Time:</label> <input type="text" name="transmit_date" value="<?php echo date("m/d/Y H:i",strtotime(@$jo['transmit_date'])); ?>" class="input" id="transmit_date" readonly="readonly" /> <!--input type="text" name="name" value="<?php //echo date("H:i",strtotime(@$jo['transmit_date'])); ?>" class="input second_input bigtxt" id="transmit_time" /--></div>
<div><label class="field">Transmittal By:</label> <input type="text" name="transmit_by" value="<?php echo @$jo['transmit_by']; ?>" class="input" id="transmit_by" readonly="readonly" /> </div>
</fieldset>
<fieldset style="float:left;">
<legend>Trucking (Delivery/Pick-Up)</legend>
<div><label class="field">From:</label> <input type="text" name="trucking_from" value="<?php echo @$jo['trucking_from']; ?>" class="input" id="trucking_from" /></div>
<div><label class="field">To:</label> <input type="text" name="trucking_to" value="<?php echo @$jo['trucking_to']; ?>" class="input" id="trucking_to" /> </div>
<div><label class="field">DR No.:</label> <input type="text" name="trucking_dr" value="<?php echo @$jo['trucking_dr']; ?>" class="input" id="trucking_dr" /> </div>
</fieldset>
<fieldset style="float:left;">
<legend>Special Instructions</legend>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea name="instructions" rows="2" cols="38" class="input" id="instructions"><?php echo @$jo['instructions']; ?></textarea></div>
</fieldset>
<?php 	
sybase_free_result($query1);
sybase_close($link);
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
?>