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
        <!--js convertion-->
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/currency/convert_php_usd.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/currency/convert_usd_php.js"></script>
        
        <script>
	function open_grp_code_list(id_name){
	window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/jo/chg_grp_list.php?id_name="+id_name,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
	document.getElementById('grp_code').focus();
	}
	
	function open_service_code_list(id_name,grp_code,trans_type){
	window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/jo/service_code_list.php?id_name="+id_name+"&chg_grp="+grp_code.toUpperCase().trim()+"&trans_type="+trans_type,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
	document.getElementById('service_code').focus();
	}
        
        function validate_pcv_dtl(){
        var check_chg_code=check_required('service_code','CHG','inputError');
        var check_grp_code=check_required('grp_code','GRP','inputError');
	var check_php_cost=check_required('php_cost','PHP Cost','inputError');
	var check_cash=check_required('cash','PCV Type','inputError');
	return check_chg_code && check_grp_code && check_php_cost && check_cash; 	   
        }
	
	   function showChg_Grp(str){
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState===4 && xmlhttp.status===200){
                document.getElementById("grp_desc").value = xmlhttp.responseText;
					if(document.getElementById("service_code").value.trim().length > 0){
					show_Service_Description(service_code.value);
					}
		}else{
		document.getElementById("grp_desc").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
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
                }else{
		document.getElementById("service_description").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                }
            }
        var s=encodeURIComponent(str);
        xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/booking_charges/setservice_description.php?service_code="+s,true);
        xmlhttp.send();
	}
	
	//shows service_description and grp_code
	function show_Service(str1,str2){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
            }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState===4 && xmlhttp.status===200 && str1.trim().length >= 2){
                document.getElementById("grp_code").value = xmlhttp.responseText;
					if(document.getElementById("grp_code").value.trim().length > 0){
					document.getElementById("grp_code").focus();	
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
<b class="module">PCV Entry New</b>
<span id="inputError"><?php include 'logic_pcvdtl_ctrlno.php'; ?></span>
<form method="post" id="form">
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="return validate_pcv_dtl();" />
    </div>
    <div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="back" value="Back" />
    </div>
</div>
<fieldset style="float:left;width:600px;">
<br />
<input type="hidden" name="pcv_no" value="<?php echo isset($_GET['pcv_no']) == true && isset($_POST['save']) == false ? $pcv_no=$_GET['pcv_no'] : @$pcv_no; ?>" />
<input type="hidden" name="pcvdtl_ctrlno" value="<?php echo @$_GET['pcvdtl_ctrlno']; ?>" />
<?php $hdr=fill_pcv_hdr($pcv_no); ?>
<input type="hidden" name="exrate" value="<?php echo $hdr['exrate']; ?>" id="exrate" />
<input type="hidden" name="cash" value="<?php echo $hdr['pcv_type']; ?>" />
<div><label class="field">Job Order No.:</label> 
    <select name="job_order_no" class="input" id="job_order_no">
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$result=  sybase_query("SELECT job_order_no FROM pcv_hdrx WHERE pcv_no='$pcv_no'");
    if(sybase_num_rows($result) == 1){
    $jo=  sybase_fetch_array($result);
?>
    <option><?php echo $jo['job_order_no']; ?></option>
<?php 
    }else{
?>
        <option></option>
<?php
        while ($jo=sybase_fetch_array($result)) {
?>
        <option><?php echo $jo['job_order_no']; ?></option>
<?php            
        }
    }
    sybase_free_result($result);
    sybase_close($link);
?>
    </select>
<!--input type="text" name="job_order_no" value="<?php //echo @$job_order_no; ?>" class="input" id="job_order_no" readonly="readonly" /-->

</div>
<div><label class="field">CHG:</label> <input type="text" name="chg_code" value="<?php echo @$chg_code; ?>" class="input" id="service_code" maxlength="7" onFocus="show_Service_Description(this.value);" onKeyUp="show_Service(this.value,'OS');" /> <input type="text" name="chg_desc" value="<?php echo @$chg_desc; ?>" class="input second_input bigtxt" id="service_description" readonly="readonly" /> <input type="button" class="btn btn-danger css_button btn-xs" value="Select" onClick="open_service_code_list('service_code',grp_code.value,'OS');" /></div>
<div><label class="field">GRP:</label> <input type="text" name="grp_code" value="<?php echo @$grp_code; ?>" class="input" id="grp_code" maxlength="7" onFocus="showChg_Grp(this.value);" onKeyUp="showChg_Grp(this.value);clear_service(this.value);" /> <input type="text" name="grp_desc" value="<?php echo @$grp_desc; ?>" class="input second_input bigtxt" id="grp_desc" readonly="readonly" /> <input type="button" class="btn btn-danger css_button btn-xs" value="Select" onClick="open_grp_code_list('grp_code');" /></div>
<div><label class="field">PHP Cost:</label> <input type="text" name="php_cost" value="<?php echo @$php_cost; ?>" class="input" id="php_cost" onkeypress="return isDecimalKey(event);" onKeyUp="convert_php_usd('exrate','php_cost','usd_cost');" autocomplete="off" /></div>
<div><label class="field">USD Cost:</label> <input type="text" name="usd_cost" value="<?php echo @$usd_cost; ?>" class="input" id="usd_cost" onkeypress="return isDecimalKey(event);" onKeyUp="convert_usd_php('exrate','php_cost','usd_cost');" autocomplete="off" /></div>
<div><label class="field">Receipted:</label> <input type="checkbox" name="receipted_exp" value="Y" class="input" id="receipted_exp" <?php echo show_receipted_exp(@$receipted_exp); ?> /></div>
<div>
<!--label class="field">PCV Type:</label> 
<select name="cash" class="input" id="cash">
    <option value="<?php //echo @$cash; ?>"><?php //echo show_pcv_type(@$cash); ?></option>
    <option value="Y">Cash</option>
    <option value="N">Company Cheque</option>
    <option value="M">Manager Cheque</option>
</select-->
</div>
<div><label class="field">FMS Code:</label> <input type="text" name="check_bp" value="<?php echo @$check_bp; ?>" class="input" id="check_bp" /></div>
</fieldset>
</form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>