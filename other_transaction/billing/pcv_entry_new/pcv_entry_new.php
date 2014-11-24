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
	
        <!-- css for table-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
       
        <!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
                	 
        <!-- jQuery hover table row-->
        <script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
        
        <!-- jQuery highlight table row-->
        <script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script>
        
        <!--start jquery datepicker-->
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/date_picker.js"></script>
        
	<!--js validation-->	
        <script src="http://wmsonline.aai.com.ph/usual_js/decimal_only.js"></script>
	<script type="text/javascript" src="//wmsonline.aai.com.ph/usual_js/integer_only.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_cust_name.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_required.js"></script>
        <!--script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/pcv/check_service_type.js"></script-->
        <!--script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_num_required.js"></script-->
	<script src="disable_buttons.js"></script>
        <!--check access in insert or update-->
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/access_save.js"></script>
        
        <!--jquery unpost pcv-->
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/pcv/unpost_pcv.js"></script>
        <!--jquery cancel pcv-->
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/pcv/cancel_pcv.js"></script>
        
		<script>
		//open lookup for jo list
		function open_pcv_list(){
		window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/pcv/pcv_list.php","_blank","height=700,width=1900, status=yes,toolbar=no,menubar=no,location=no");
		document.getElementById('pcv_numb_search').focus();
		}
                //open lookup for cust list-->
		function open_cust_list(id_name){
		window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/cust_list.php?id_name="+id_name,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
		document.getElementById(id_name).focus();
		}
                
                function open_user_list(id_name){
                window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/user_list.php?id_name="+id_name,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
		document.getElementById(id_name).focus();    
                }
                
                function open_jo_list(){
                    if(pcv_stat.value == "Posted"){
                    window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/pcv/pcv_hdrx.php?pcv_no="+pcv_no.value,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
                    //document.getElementById(id_name).focus();
					return false;
                    }
                }
                //shows list of pcv in a job order #
                function search_jo(str){
                    if(str.trim().length == 9){
                    window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/pcv/pcv_of_jo.php?jo_numb="+str,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
                    document.getElementById('pcv_numb_search').focus(); 
                    }
                }
                
                //ajax show pcv after focus-->
		function search_pcv(pcv_numb_search){
			if(pcv_numb_search.length == 12 && (pcv_numb_search != document.getElementById("pcv_no").value)){
				if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				}else{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState===4 && xmlhttp.status===200){
					document.getElementById("pcv_entry").innerHTML = xmlhttp.responseText;
                                        disable_buttons('pcv_stat','validate_stat');
					}else if (xmlhttp.readyState != 4){
					document.getElementById("pcv_entry").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-content-loader.gif" />';
                                        }else if (xmlhttp.status===404){
					document.getElementById("pcv_entry").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/alarm-error-icon.png" /> Page Not Found';
                                        }
				}
			var s=encodeURIComponent(pcv_numb_search);
			xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/pcv/other_transaction.php?pcv_numb_search="+s,true);
			xmlhttp.send();
			}
		}
                //show mcarref,hcarref and dr no
                function get_jo(jo_numb_search){
                    if(jo_numb_search.length == 9){
				if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				}else{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState===4 && xmlhttp.status===200){
					document.getElementById("jo_result").innerHTML = xmlhttp.responseText;
                                        get_cust_in_jo(jo_numb_search);
					}else{
					document.getElementById("jo_result").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-content-loader.gif" />';
                                        }
				}
			var s=encodeURIComponent(jo_numb_search);
			xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/pcv/search_jo.php?jo_numb="+s,true);
			xmlhttp.send();
                    }else{
                    document.getElementById("mcarref").value="";
                    document.getElementById("hcarref").value="";
                    document.getElementById("dr_no").value="";
                    document.getElementById("cust_code").value="";
                    document.getElementById("cust_name").value="";
                    document.getElementById("cust_address").value="";
                    }
		}
                
                function get_cust_in_jo(jo_numb_search){
				if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				}else{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState===4 && xmlhttp.status===200){
					document.getElementById("jo_cust").innerHTML = xmlhttp.responseText;
					}else{
					document.getElementById("jo_cust").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-content-loader.gif" />';
                                        }
				}
			var s=encodeURIComponent(jo_numb_search);
			xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/pcv/search_cust_in_jo.php?jo_numb="+s,true);
			xmlhttp.send();
                }
                
                function showPayeeName(str){
                    if(str.trim().length > 2){
				if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				}else{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState===4 && xmlhttp.status===200){
					document.getElementById("payee_name").value = xmlhttp.responseText;
					}else if (xmlhttp.readyState != 4){
					document.getElementById("payee_name").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                        }else if (xmlhttp.status===404){
					document.getElementById("payee_name").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/alarm-error-icon.png" /> Page Not Found';
                                        }
				}
			var s=encodeURIComponent(str);
			xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/payee/set_payee_name.php?payee_code="+s,true);
			xmlhttp.send();
			}
                }
                
		//ajax show customer name and address-->
		function showCust(str){
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			xmlhttp_address=new XMLHttpRequest();
			}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp_address=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState===4 && xmlhttp.status===200){
				document.getElementById("cust_name").value = xmlhttp.responseText;
				}else if (xmlhttp.readyState != 4){
				document.getElementById("cust_name").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }else if (xmlhttp.status===404){
				document.getElementById("cust_name").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/alarm-error-icon.png" /> Page Not Found';
                                }
			}
			xmlhttp_address.onreadystatechange=function(){
				if (xmlhttp_address.readyState===4 && xmlhttp_address.status===200){
				document.getElementById("cust_address").value = xmlhttp_address.responseText;
				}else if (xmlhttp.readyState != 4){
				document.getElementById("cust_address").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }else if (xmlhttp.status===404){
				document.getElementById("cust_address").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/alarm-error-icon.png" /> Page Not Found';
                                }
			}
		var s=encodeURIComponent(str);
		xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/customer/setcustname.php?q="+s,true);
		xmlhttp.send();
		var t=encodeURIComponent(str);
		xmlhttp_address.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/customer/setcustaddress.php?r="+t,true);
		xmlhttp_address.send();
		}
		
		function check_pcv_type(pcv_type_id,petty_cash_replenish_id,error_message){
		var pcv_type=document.getElementById(pcv_type_id).value.trim();
		var petty_cash_replenish=document.getElementById(petty_cash_replenish_id).value.trim();
			if(petty_cash_replenish.length < 1 && pcv_type=="Y"){
			document.getElementById(error_message).innerHTML="<span id='inputError'><b>Error: This is Cash liquidation! Cash replenishment is mandatory!</b></span>";
			return false;
			}
		return true;
		}
		
		function check_service_type(service_type_id,miscellaneous_pcv_id,job_order_no_id,arrival_date_id,error_message){
    var service_type=document.getElementById(service_type_id).value.trim();
    var miscellaneous_pcv=document.getElementById(miscellaneous_pcv_id).checked;
    var job_order_no=document.getElementById(job_order_no_id).value.trim();
    var arrival_date=document.getElementById(arrival_date_id).value.trim();
    
    if(service_type=="Other Services"){
        if(miscellaneous_pcv){
            if(job_order_no.length > 0){
            document.getElementById(error_message).innerHTML="<span id='inputError'><b>Error: This is Miscellaneous PCV! Please remove JO!</b></span>";
            return false;    
            }
	}else{
            if(job_order_no.length < 1){
            document.getElementById(error_message).innerHTML="<span id='inputError'><b>Error: Job Order No still empty!</b></span>";
            return false;    
            }
        }  
    }else{
        if(job_order_no.length < 1){
            document.getElementById(error_message).innerHTML="<span id='inputError'><b>Error: Job Order No still empty!</b></span>";
            return false;    
        }
        if(arrival_date == NULL || arrival_date == ""){
            document.getElementById(error_message).innerHTML="<span id='inputError'><b>Error: Arrival Date still empty!</b></span>";
            return false;    
        }
    }
}
		
                function wf_check(){
                var validate_payee_code=check_required('payee_code','Payee Code','inputError');
                var validate_pcv_type=check_required('pcv_type','PCV Type','inputError');
		var check_pcv=check_pcv_type('pcv_type','petty_cash_replenish','inputError');
		var validate_client=check_cust_name('cust_name','inputError');
		var validate_cust_code=check_required('cust_code','Customer Code','inputError');
		var check_service=check_service_type('service_type','miscellaneous_pcv','job_order_no','arrival_date','inputError');
                var validate_station_id=check_required('station_id','Station ID','inputError');
                var validate_access_save=access_save(access_insert.value,access_update.value);
		return validate_payee_code && validate_pcv_type && check_pcv && validate_client && validate_cust_code && validate_station_id && check_service && validate_access_save;
                }
                
                function wf_check_validate2(validate_by_str,type_by_str,error_message){
                    if((validate_by_str.trim() != type_by_str.trim()) || type_by_str.trim()=="DAVEOB" || type_by_str.trim()=="CRIS"){
                    return true;
                    }
                    else{
                    //echo '<b>Error: Validate by cannot be of the same person who created the PCV. Failed to Validate PCV!</b>';    
                    document.getElementById(error_message).innerHTML="<span id='inputError'><b>Error: Validate by cannot be of the same person who created the PCV. Failed to Validate PCV!</b></span>";
                    return false;
                    }
                }
		</script>
    </head>
    <body>
<div id="wrapper">
<b class="module">PCV Entry New</b>
<span id="inputError"><?php include 'logic.php'; ?></span>
<form method="post" id="form">
<input type="hidden" value="134" name="module_no" id="module_no" />
<input type="hidden" value="<?php echo @$access_insert; ?>" name="access_insert" id="access_insert" />
<input type="hidden" value="<?php echo @$access_update; ?>" name="access_update" id="access_update" />
<div class="form-inline col-xs-12 inline_elements">
    <div class="form-group">
        <input type="submit" class="btn btn-danger css_button btn-xs" name="save" onClick="return wf_check();" value="Save" <?php echo @$save_disabled; ?> id="save" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="print_or_post" onClick="" value="Print/Post" <?php echo @$print_or_post_disabled; ?> id="print_or_post" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs  <?php echo @$access_post; ?>" name="post" onClick="return wf_check();" value="Post" <?php echo @$post_disabled; ?>  id="post" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs <?php echo @$access_unpost; ?>" name="unpost" value="Unpost" onClick="unpost_pcv(pcv_no.value);" <?php echo @$unpost_disabled; ?> id="unpost" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="re_print" onClick="" value="Re-print" <?php echo @$re_print_disabled; ?>  id="re_print" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs <?php echo @$access_cancel; ?>" name="cancel" value="Cancel" onClick="cancel_pcv(pcv_no.value);" <?php echo @$cancel_disabled; ?>  id="cancel" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="reset" onClick="" value="Reset" id="reset" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="remove_fn" onClick="" value="Remove FN" id="remove_fn" <?php echo @$remove_fn_disabled; ?>  />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_force_post; ?>" name="force_post" onClick="" value="Force Post" id="force_post" <?php echo @$force_post_disabled; ?> />
    </div>
</div>

<div class="form-inline col-xs-12">
    <div class="form-group">
<input type="text" name="pcv_numb_search" class="input-xs input" value="<?php echo @$pcv_numb_search; ?>" placeholder="PCV No." id="pcv_numb_search" autocomplete="off" onKeyUp="search_pcv(this.value);" onFocus="search_pcv(this.value);" onInput="this.value=this.value.toUpperCase();" />
<input type="button" class="btn btn-search btn-xs" onClick="open_pcv_list();return false;" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="print_jli_aai" onClick="" value="Print JLI-AAI" <?php echo @$print_jli_aai_disabled; ?> id="print_jli_aai" />
    </div>
	<div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="print_pcv_per_jo" onClick="printPCV()" value="Print PCV per JO" <?php echo @$print_pcv_per_jo_disabled; ?> id="print_pcv_per_jo" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_validate; ?>" name="validate" onClick="return wf_check_validate2(validate_by.value,type_by.value,'inputError');" value="Validate" <?php echo @$validate_disabled; ?>  id="validate" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_unvalidate; ?>" name="unvalidate" onClick="" value="Unvalidate" <?php echo @$unvalidate_disabled; ?>  id="unvalidate" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="force_validate" onClick="" value="Force Validate" <?php echo @$force_validate_disabled; ?> id="force_validate" />
    </div>
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_insert; ?>" name="add_jo" onClick="return open_jo_list();" value="Add Job Order" <?php echo @$add_jo_disabled; ?> id="add_jo" />

    </div>
	<div class="form-group">
<input type="text" name="jo_numb_search" value="" class="input-xs input" value="<?php echo @$jo_numb_search; ?>" placeholder="Search" id="jo_numb_search" onFocus="search_jo(this.value);return false;" onKeyup="search_jo(this.value);return false;" autocomplete="off" onInput="this.value=this.value.toUpperCase();" />
<!--input type="button" class="btn btn-search btn-xs" onClick="search_jo(this.value);return false;" /-->
    </div>
</div>

<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#main_info" role="tab" data-toggle="tab" style="color:#ff0000;background:#ffffff;">Main Information</a></li>
  <li><a href="#charge_cost_info" role="tab" data-toggle="tab" style="color:#ff0000;background:#ffffff;">Charge Cost Information</a></li>
</ul>

<!-- Tab panes -->
<div id="loader"></div>

<div class="tab-content" id="pcv_entry">
  <div class="tab-pane active" id="main_info"><?php include 'main_info.php'; ?></div>
  <div class="tab-pane" id="charge_cost_info"><?php include 'charge_cost.php'; ?></div>
</div>

</form>     
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
<script>
	function printPCV()
	{
		var pcvno	= document.getElementById("pcv_numb_search").value;
		window.open("http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/other_transaction/billing/pcv_entry_new/print.php","_blank","width=800, height=600");
	}
</script>
    </body>
</html>
