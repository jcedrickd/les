<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <!-- css of bootstrap-->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

        <!-- css for forms-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />
		
	<!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	
    </head>
    <body>
<fieldset style="float:left;">
<legend>Transaction Information</legend>
<div><label class="field">CSR:</label> <input type="text" name="csr" value="<?php //echo @$csr; ?>" class="input bigtxt" placeholder="Reference" id="csr" onKeyUp="check_csr_level(this.value);" onFocus="check_csr_level(this.value);" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_csr_list('csr','OS');return false;" /> <input type="button" class="btn btn-danger css_button btn-xs" name="csr_searcher" value="..." onClick="check_csr('csr','inputError');return false;" /></div>
<div><label class="field">Customer:</label> <input type="text" name="c_code" value="<?php //echo @$c_code; ?>" class="input" placeholder="Code" onFocus="showCust(this.value);" onKeyUp="showCust(this.value);" id="c_code" autocomplete="off" /> <input type="text" name="client" value="<?php //echo @$client; ?>" class="input second_input bigtxt" readonly="readonly" id="client" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('c_code');return false;" /></div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea rows="2" cols="38" class="input" id="cust_address" readonly="readonly" name="cust_address"><?php //echo @$cust_address; ?></textarea></div>
<div><label class="field">Doc Type:</label> <input type="text" name="doc_type" value="<?php //echo @$doc_type; ?>" class="input" id="doc_type" /></div>
<div><label class="field">Doc Ref:</label> <input type="text" name="doc_ref" value="<?php //echo @$doc_ref; ?>" class="input" id="doc_ref" /> </div>
<div><label class="field">House Ref:</label> <input type="text" name="hawbno" value="<?php //echo @$hawbno; ?>" class="input" id="hawbno" /></div>
<div><label class="field">Master Ref:</label> <input type="text" name="mawbno" value="<?php //echo @$mawbno; ?>" class="input" id="mawbno" /></div>
<div><label class="field">Other Ref:</label> <input type="text" name="oth_reference" value="<?php //echo @$oth_reference; ?>" class="input" id="oth_reference" /></div>
<div><label class="field">Item Description:</label> <input type="text" name="item_description" value="<?php //echo @$item_description; ?>" class="input" id="item_description" /></div>
<div><label class="field">Agent:</label> <input type="text" name="agent_code" value="<?php //echo @$agent_code; ?>" class="input" placeholder="Code" onFocus="showAgentName(this.value);" onKeyUp="showCust(this.value);" id="agent_code" /> <input type="text" name="agent_name" value="<?php //echo @$agent_name; ?>" class="input second_input bigtxt" readonly="readonly" id="agent_name" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('agent_code');return false;" /></div>
<div><label class="field">Ex. Rate:</label> <input type="text" name="exrate" value="<?php //echo @number_format($exrate,2); ?>" class="input numeric" id="exrate" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Qnty:</label> <input type="text" name="qnty" value="<?php //echo @number_format($qnty,0); ?>" class="input numeric" onkeypress="return isNumberKey(event);" id="qnty" /></div>
<div><label class="field">Wt:</label> <input type="text" name="wt" value="<?php //echo @number_format($wt,0); ?>" class="input numeric" onkeypress="return isNumberKey(event);" id="wt" /></div>
<div><label class="field">CBM:</label> <input type="text" name="cbm" value="<?php //echo @number_format($cbm,4); ?>" class="input numeric" onkeypress="return isDecimalKey(event);" id="cbm" /></div>
</fieldset>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>
