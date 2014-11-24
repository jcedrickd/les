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
	
    <!--js validation-->
    <script src="http://wmsonline.aai.com.ph/usual_js/decimal_only.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_required.js"></script>
        		
    <!-- jQuery library -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>	
	
    <!--javascript datepicker -->
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/date_picker.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script>
    function validate(){
    var validate_curr_code=check_required('curr_code','Currency','inputError');
    var validate_curr_usd=check_required('curr_usd','Actual USD','inputError');
    var validate_effect_date=check_required('effect_date','Effect From','inputError');
    var validate_effect_date_to=check_required('effect_date_to','Date To','inputError');
    var validate_curr_apply=check_required('curr_apply','Curr Apply','inputError');
    return validate_curr_code && validate_curr_usd && validate_effect_date && validate_effect_date_to && validate_curr_apply;
    }
    
   function get_curr_desc(curr_code_value){
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState===4 && xmlhttp.status===200){
            document.getElementById("curr_desc").value = xmlhttp.responseText;
            }else{
            document.getElementById("curr_desc").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
            }
	}
   var s=encodeURIComponent(curr_code_value);
   xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/currency/desc.php?curr_code="+s,true);
   xmlhttp.send();
   }
    </script>
</head>

<body>
<div id="wrapper">
<b class="module">Conversion Rate Setup</b>
<span id="inputError"><?php include 'logic.php'; ?></span>
<form method="post" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="save" onClick="return validate();" value="Save" />
	</div><!--div class="form-group"-->
        <div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="back" value="Back" />
	</div><!--div class="form-group"-->
</div><!--div class="form-inline col-xs-12 inline_elements"-->
<fieldset style="float:left;">
<input type="text" name="ConversDate" value="<?php echo $_GET['ConversDate']; ?>" />
<div><label class="field">Currency:</label> <input type="text" name="curr_code" value="<?php echo @$curr_code; ?>" class="input" placeholder="Code" onKeyUp="get_curr_desc(this.value);" id="curr_code" autocomplete="off"  onInput="this.value=this.value.toUpperCase();" /> <input type="text" name="curr_desc" value="<?php echo @$curr_desc; ?>" class="input second_input bigtxt" readonly="readonly" id="curr_desc" /></div>
<div><label class="field">Actual USD:</label> <input type="text" name="curr_usd" value="<?php echo @$curr_usd; ?>" class="input" id="curr_usd" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">+5% USD:</label> <input type="text" name="curr_usdx" value="<?php echo @$curr_usdx; ?>" class="input" id="curr_usdx" onkeypress="return isDecimalKey(event);" /> </div>
<div><label class="field">USD-PHP:</label> <input type="text" name="usd_php" value="<?php echo @$usd_php; ?>" class="input" id="usd_php" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Effect From:</label> <input type="text" name="effect_date" value="<?php echo date("m/d/Y",strtotime($effect_date)); ?>" class="input datepicker" id="effect_date" /></div>
<div><label class="field">Date To:</label> <input type="text" name="effect_date_to" value="<?php echo date("m/d/Y",strtotime($effect_date_to)); ?>" class="input datepicker" id="effect_date_to" /></div>
<div><label class="field">Curr Apply:</label> 
    <select name="curr_apply" id="curr_apply" class="input">
        <option value="<?php echo @$curr_apply; ?>"><?php 
        if(isset($curr_apply)){
			switch($curr_apply){
			case "M":
			echo "M (*)";
			break;
			case  "D":
			echo  "D (/)";
			break;
			default : echo "";
			}
        }
        ?></option>
        <option value="M">M (*)</option>
        <option value="D">D (/)</option>
    </select>
</div>
<div><label class="field">Add/Edit By:</label> <input type="text" name="add_edit" value="<?php echo isset($_GET['convtable_ctrlno']) == false ? $add_edit=$_SESSION['username'] : $add_edit; ?>" class="input" id="add_edit" readonly="readonly" /></div>
<div><label class="field">Add / Edit Date:</label> <input type="text" name="add_date" value="<?php echo isset($_GET['convtable_ctrlno']) == false ? $add_date=date("m/d/Y") : $add_date; ?>" class="input" id="add_date" readonly="readonly" /></div>
<div><label class="field">Add / Edit Time:</label> <input type="text" name="add_time" value="<?php echo isset($_GET['convtable_ctrlno']) == false ? $add_time=date("H:i") : $add_time; ?>" class="input" id="add_time" readonly="readonly" /></div>
</fieldset>
</form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
</body>
</html>