<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
<?php 
session_start(); 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/verifylogin.php');
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <!-- css of bootstrap-->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

        <!-- css for forms-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />
	
        <!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	 
		<!--js validation-->
        <script src="http://wmsonline.aai.com.ph/usual_js/decimal_only.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_required.js"></script>
		
        <script>
		function validate_override_booking_charges(){
		var validate_chg_grp=check_required('chg_grp','GRP','inputError');
		var validate_service_code=check_required('service_code','CHG','inputError');
		var validate_selling_rate=check_required('selling_rate','Selling Rate','inputError');
		var validate_selling_currency=check_required('selling_currency','Selling Currency','inputError');
		var validate_collect_tag=check_required('collect_tag','Collect Tag','inputError');
		var validate_bill_to_code=check_required('bill_to_code','Bill To','inputError');
		return validate_chg_grp && validate_service_code && validate_selling_rate && validate_selling_currency && validate_collect_tag && validate_bill_to_code;
		}
		
        function open_cust_list(id_name){
	window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/cust_list.php?id_name="+id_name,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
	document.getElementById('bill_to_code').focus();
	}
	
	function open_chg_grp_list(id_name){
	window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/jo/chg_grp_list.php?id_name="+id_name,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
	document.getElementById('chg_grp').focus();
	}
	
	function open_service_code_list(id_name,chg_grp,trans_type){
	window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/jo/service_code_list.php?id_name="+id_name+"&chg_grp="+chg_grp.toUpperCase().trim()+"&trans_type="+trans_type,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
	document.getElementById('service_code').focus();
	}
        
        function showCust(str){
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState===4 && xmlhttp.status===200){
                document.getElementById("bill_to_name").value = xmlhttp.responseText;
                }
            }
        var s=encodeURIComponent(str);
        xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/customer/setcustname.php?q="+s,true);
        xmlhttp.send();
	}
	
	   function showChg_Grp(str){
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState===4 && xmlhttp.status===200){
                document.getElementById("chg_grp_desc").value = xmlhttp.responseText;
					if(document.getElementById("service_code").value.trim().length > 0){
					show_Service_Description(service_code.value);
					}
				}
            }
        var s=encodeURIComponent(str);
        xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/booking_charges/setchg_grp_desc.php?chg_grp="+s,true);
        xmlhttp.send();
	}
	
	function clear_service(str){
		if(str.trim().length < 1){
		document.getElementById('service_code').value="";
		document.getElementById('service_description').value="";
		}
	}
	
	function show_Service_Description(str){
		    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState===4 && xmlhttp.status===200){
                document.getElementById("service_description").value = xmlhttp.responseText;
                }
            }
        var s=encodeURIComponent(str);
        xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/booking_charges/setservice_description.php?service_code="+s,true);
        xmlhttp.send();
	}
	
	//shows service_description and chg_grp
	function show_Service(str1,str2){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState===4 && xmlhttp.status===200 && str1.trim().length >= 2){
                document.getElementById("chg_grp").value = xmlhttp.responseText;
					if(document.getElementById("chg_grp").value.trim().length > 0){
					document.getElementById("chg_grp").focus();	
					}
				}
            }
        var s=encodeURIComponent(str1);
		var t=encodeURIComponent(str2);
        xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/booking_charges/setchg_grp_code.php?chg_code="+s+"&trans_type="+t,true);
        xmlhttp.send();
	}
        </script>
        
        <title></title>
    </head>
    <body>
<div id="wrapper">
<b class="module">OS JO Entry</b>
<span id="inputError"><?php include 'logic_recno.php'; ?></span>
<form method="post" id="form">
<div class="form-inline col-xs-12 inline_elements">
    <!--div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="add" value="Add" onClick="return validate_override_booking_charges();" />
    </div-->
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="return validate_override_booking_charges();" />
    </div>
    <div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="back" value="Back" />
    </div>
</div>
<fieldset style="float:left;width:600px;">
<br />
<input type="hidden" name="foreign_recno_dbid" value="<?php echo isset($_GET['foreign_recno_dbid']) == true && isset($_POST['save']) == false ? $foreign_recno_dbid=$_GET['foreign_recno_dbid'] : @$foreign_recno_dbid; ?>" />
<input type="hidden" name="recno" value="<?php echo @$_GET['recno']; ?>" />

<div><label class="field">CHG:</label> <input type="text" name="service_code" value="<?php echo @$service_code; ?>" class="input" id="service_code" maxlength="7" onFocus="show_Service_Description(this.value);" onKeyUp="show_Service(this.value,'OS');" <?php echo isset($_GET['recno']) == true ? "readonly='readonly'" : ""; ?> /> <input type="text" name="service_description" value="<?php echo @$service_description; ?>" class="input second_input bigtxt" id="service_description" readonly="readonly" /> <input type="button" class="btn btn-danger css_button btn-xs" value="Select" onClick="open_service_code_list('service_code',chg_grp.value,'OS');" <?php echo isset($_GET['recno']) == true ? "disabled='disabled'" : ""; ?> /></div>
<div><label class="field">GRP:</label> <input type="text" name="chg_grp" value="<?php echo @$chg_grp; ?>" class="input" id="chg_grp" maxlength="7" onFocus="showChg_Grp(this.value);" onKeyUp="showChg_Grp(this.value);clear_service(this.value);" <?php echo isset($_GET['recno']) == true ? "readonly='readonly'" : ""; ?> /> <input type="text" name="chg_grp_desc" value="<?php echo @$chg_grp_desc; ?>" class="input second_input bigtxt" id="chg_grp_desc" readonly="readonly" /> <input type="button" class="btn btn-danger css_button btn-xs" value="Select" onClick="open_chg_grp_list('chg_grp');" <?php echo isset($_GET['recno']) == true ? "disabled='disabled'" : ""; ?> /></div>
<div><label class="field">Selling Rate:</label> <input type="text" name="selling_rate" value="<?php echo @$selling_rate; ?>" class="input" id="selling_rate" onkeypress="return isDecimalKey(event);" maxlength="24" /></div>
<div><label class="field">Currency:</label> 
    <select name="selling_currency" class="input" id="selling_currency">
        <option><?php echo @$selling_currency; ?></option>
		<option>PHP</option>    
        <option>USD</option>    
    </select> 
</div>
<div><label class="field">Collect Tag:</label> 
    <select name="collect_tag" class="input" id="collect_tag">
		<option value="<?php echo @$collect_tag; ?>"><?php show_collect_tag(@$collect_tag); ?></option>
		<option value="P">Prepaid</option>    
        <option value="C">Collect</option>    
    </select>
</div>
<div><label class="field">Bill To:</label> <input type="text" name="bill_to_code" value="<?php echo @$bill_to_code; ?>" class="input" id="bill_to_code" readonly="readonly" onFocus="showCust(this.value);" /> <input type="text" name="bill_to_name" value="<?php echo @$bill_to_name; ?>" class="input second_input bigtxt" id="bill_to_name" readonly="readonly" /> <input type="button" class="btn btn-danger css_button btn-xs" name="bill_to" value="Select" onClick="open_cust_list('bill_to_code');return false;" /></div>
<div><label class="field">Prepared By:</label> <input type="text" name="prepared_by" value="<?php echo @$prepared_by; ?>" class="input" id="prepared_by" readonly="readonly" /></div>
<div><label class="field">Date Prepared:</label> <input type="text" name="date_prepared" value="<?php echo date("m/d/Y H:i",strtotime(@$date_prepared)); ?>" class="input" id="date_prepared" readonly="readonly" /></div>
<div><label class="field">Override By:</label> <input type="text" name="override_by" value="<?php echo @$override_by; ?>" class="input" id="override_by" readonly="readonly" /></div>
<div><label class="field">Date Override:</label> <input type="text" name="date_override" value="<?php echo date("m/d/Y H:i",strtotime(@$date_override)); ?>" class="input" id="date_override" readonly="readonly" /></div>
</fieldset>
</form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>