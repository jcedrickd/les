<html>
<head>
<?php 
session_start(); 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/verifylogin.php');
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
		<!-- css of bootstrap-->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

        <!-- css for forms-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />
	
        <!-- css for table-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
		
		<!-- css for po_up-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/pop_up.css" />
		
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
		
		<!--pop-up-->
		<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/pop_up.js"></script>
                
		<!--recall pop-up-->
                <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/recall.js"></script>
		
		<!--set these values to the hidden fields of pop-up-->
		<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/get_jo_numb.js"></script>
		<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/get_doc_ref.js"></script>        
		<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/get_module_num.js"></script>        

		<!--js validation-->
		<script src="http://wmsonline.aai.com.ph/usual_js/decimal_only.js"></script>
		<script type="text/javascript" src="//wmsonline.aai.com.ph/usual_js/integer_only.js"></script>
		<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_csr.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_cust_name.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_transact_date.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_required.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_num_required.js"></script>
        <script src="disable_buttons.js"></script>       
        
		<!--delete_jo-->
		<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/delete_jo_numb.js"></script>
        		
		<script>
		function wf_check(){
		var validate_c_code=check_required('c_code','Customer','inputError');
		var validate_client=check_cust_name('client','inputError');
		var validate_service_type=check_required('service_type','Service Type','inputError');
		var validate_transact_date=check_transact_date('transaction_date','inputError');
		var validate_exrate=check_num_required('exrate','Ex. Rate','inputError');
		var validate_trans_type=check_required('trans_type','Transaction Type','inputError');
		var validate_access_save=access_save(access_insert.value,access_update.value);
		return validate_c_code && validate_client && validate_service_type && validate_transact_date && validate_exrate && validate_trans_type && validate_access_save;
		}
		//open lookup for jo list
		function open_jo_list(){
		window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/jo/jo_list.php","_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no");
		document.getElementById('jo_numb_search').focus();
		}
		//open lookup for cust list-->
		function open_cust_list(id_name){
		window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/cust_list.php?id_name="+id_name,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
		document.getElementById(id_name).focus();
		}
		//open lookup for csr list-->
		function open_csr_list(id_name,service_code){
		window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/jo/csr_list.php?id_name="+id_name+"&service_code="+service_code,"_blank","height=700,width=900, status=yes,toolbar=no,menubar=no,location=no"); 
		document.getElementById(id_name).focus();
		}
		//ajax show oth_services after focus-->
		function search_jo(jo_numb_search){
			if(jo_numb_search.length == 9){
				if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				}else{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState===4 && xmlhttp.status===200){
					document.getElementById("fieldsetform").innerHTML = xmlhttp.responseText;
					showBookingCharges(foreign_recno_dbid.value);
					showCustAddress(c_code.value);	
					}else if (xmlhttp.readyState===3){
					document.getElementById("fieldsetform").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-content-loader.gif" />';
                                        }
				}
			var s=encodeURIComponent(jo_numb_search);
			xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/oth_services/set_oth_services.php?jo_numb="+s,true);
			xmlhttp.send();
			}
		}
                //after selecting or typing csr-->
                function search_csr(csr){
                    if(csr.length > 12){
                        	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp1=new XMLHttpRequest();
                                xmlhttp2=new XMLHttpRequest();
				}else{// code for IE6, IE5
				xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
                                xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp1.onreadystatechange=function(){
					if (xmlhttp1.readyState===4 && xmlhttp1.status===200){
					document.getElementById("from_csr").innerHTML = xmlhttp1.responseText;
					showCustAddress(c_code.value);	
					}else if (xmlhttp.readyState===3){
					document.getElementById("from_csr").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-content-loader.gif" />';
                                        }
				}
				xmlhttp2.onreadystatechange=function(){
					if (xmlhttp2.readyState===4 && xmlhttp2.status===200){
                    document.getElementById("booking_charges_from_csr").innerHTML = xmlhttp2.responseText;
					}else if (xmlhttp.readyState===3){
					document.getElementById("booking_charges_from_csr").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-content-loader.gif" />';
                                        }
				}
			var s=encodeURIComponent(csr);
			xmlhttp1.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/oth_services/csr_oth_services.php?csr_oth_services="+s,true);
			xmlhttp1.send();
            xmlhttp2.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/booking_charges/csrbookingcharges.php?csr_booking_charges="+s,true);
			xmlhttp2.send();
                    }
                }
		//ajax show booking charges-->
		function showBookingCharges(foreign_recno_dbid){
			var jo_numb_search=document.getElementById('jo_numb_search').value;
			if(jo_numb_search.length == 9){
			//document.getElementById('jo_numb').focus();
				if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
				}else{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function(){
					if (xmlhttp.readyState===4 && xmlhttp.status===200){
					document.getElementById("table").innerHTML = xmlhttp.responseText;
					disable_buttons('status');
					}else if (xmlhttp.readyState===3){
					document.getElementById("table").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-content-loader.gif" />';
                                        }
				}
			var s=encodeURIComponent(foreign_recno_dbid);
			xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/booking_charges/setbookingcharges.php?foreign_recno_dbid="+s,true);
			xmlhttp.send();
			}
		}
		
		//ajax show customer address only-->
		function showCustAddress(str){
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp_address=new XMLHttpRequest();
			}else{// code for IE6, IE5
			xmlhttp_address=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_address.onreadystatechange=function(){
				if (xmlhttp_address.readyState===4 && xmlhttp_address.status===200){
				document.getElementById("cust_address").value = xmlhttp_address.responseText;
				}else if (xmlhttp.readyState===3){
				document.getElementById("cust_address").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
		var t=encodeURIComponent(str);
		xmlhttp_address.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/customer/setcustaddress.php?r="+t,true);
		xmlhttp_address.send();
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
				document.getElementById("client").value = xmlhttp.responseText;
				}else if (xmlhttp.readyState===3){
				document.getElementById("client").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
			xmlhttp_address.onreadystatechange=function(){
				if (xmlhttp_address.readyState===4 && xmlhttp_address.status===200){
				document.getElementById("cust_address").value = xmlhttp_address.responseText;
				}else if (xmlhttp.readyState===3){
				document.getElementById("cust_address").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
		var s=encodeURIComponent(str);
		xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/customer/setcustname.php?q="+s,true);
		xmlhttp.send();
		var t=encodeURIComponent(str);
		xmlhttp_address.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/customer/setcustaddress.php?r="+t,true);
		xmlhttp_address.send();
		}
		//ajax show agent name-->
		function showAgentName(str){
			if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState===4 && xmlhttp.status===200){
				document.getElementById("agent_name").value = xmlhttp.responseText;
				}else if (xmlhttp.readyState===3){
				document.getElementById("agent_name").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
		var s=encodeURIComponent(str);
		xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/customer/setcustname.php?q="+s,true);
		xmlhttp.send();
		}
		//validation for recall-->
		function wf_check_if_billed(doc_ref){
			if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState===4 && xmlhttp.status===200){
					if(xmlhttp.responseText > 0){
					alert("Error: Failed to Recall/Cancel. Job Order No. "+document.getElementById('jo_numb').value+" already billed.");
					document.getElementById('inputError').innerHTML="<span><b>Error: Failed to Recall/Cancel. Job Order No. "+document.getElementById('jo_numb').value+" already billed.</b></span>";
					}else{
					var status=document.getElementById('status').value.trim();
						if(status=="Posted" || status=="Cancel"){
						ShowDialog(true);
						e.preventDefault();
						}
					}
				}else if (xmlhttp.readyState===3){
				//document.getElementById("recall").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
		var s=encodeURIComponent(doc_ref);
		xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/validation/wf_check_if_billed.php?doc_ref="+s,true);
		xmlhttp.send();
		}
		
		function force_recall(){
		var status=document.getElementById('status').value.trim();
			if(status=="Posted" || status=="Cancel"){
			ShowDialog(true);
			e.preventDefault();
			}
		}
		
		function access_save(insert_id,update_id){
			if(insert_id.trim() == "hide"){
			alert("You have no insert access!");
			return false;
			}
			if(update_id.trim() == "hide"){
			alert("You have no update access!");
			return false;
			}
		}
		
		function check_csr_level(csr){
			if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState===4 && xmlhttp.status===200 && csr.trim().length >=20){
					if(xmlhttp.responseText == 0){
					document.getElementById("inputError").innerHTML="<span id='inputError'><b>Error: CSR "+csr+" not found</b></span>";
					}else if(xmlhttp.responseText == 1){
					search_csr(csr);
					}else if(xmlhttp.responseText == 2){
					check_attached_csr(csr);
					}
				}else if (xmlhttp.readyState===3){
				//document.getElementById("from_csr").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
		var s=encodeURIComponent(csr);
		xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/validation/check_csr_level.php?csr_value="+s,true);
		xmlhttp.send();
		}
		
		function check_attached_csr(csr){
			if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState===4 && xmlhttp.status===200 && csr.trim().length >=20){
					if(xmlhttp.responseText == 1){
					attach_csr_jo(csr);
					}else if(xmlhttp.responseText > 1){
					//alert("Error: CSR "+csr+" already attached in other Job Order");
					document.getElementById('inputError').innerHTML="<span><b>Error: CSR "+csr+" already attached in other Job Order.</b></span>";
					}else{
					document.getElementById("inputError").innerHTML="<span id='inputError'></span>";
					search_csr(csr);
					}
				}else if (xmlhttp.readyState===3){
				//document.getElementById("from_csr").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
		var s=encodeURIComponent(csr);
		xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/validation/attached_csr.php?csr_reference="+s,true);
		xmlhttp.send();
		}
		
		function attach_csr_jo(csr){
			if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
			}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState===4 && xmlhttp.status===200){
				jo_csr=xmlhttp.responseText;
				//alert("Error: CSR "+csr+" already attached in "+jo_csr);
				document.getElementById('inputError').innerHTML="<span><b>Error: CSR "+csr+" already attached in "+jo_csr+"</b></span>";	
				}else if (xmlhttp.readyState===3){
				//document.getElementById("from_csr").innerHTML='<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/img/ajax-text-loader.gif" />';
                                }
			}
		var s=encodeURIComponent(csr);
		xmlhttp.open("GET","//<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/ajax/oth_services/attach_csr_jo.php?csr_ref="+s,true);
		xmlhttp.send();
		}
	</script>
</head>
<body onLoad="jo_numb_search.focus();">
<div id="wrapper">
<b class="module">OS JO Entry</b>
<span id="inputError"><?php include 'logic.php'; ?></span>
<form method="post" id="form">
<input type="hidden" value="<?php echo @$access_insert; ?>" name="access_insert" id="access_insert" />
<input type="hidden" value="<?php echo @$access_update; ?>" name="access_update" id="access_update" />
<input type="hidden" value="73" name="module_no" id="module_no" />
<div class="form-inline col-xs-12 inline_elements">
    <div class="form-group">
<input type="text" name="jo_numb_search" value="" class="input-xs input" value="<?php echo @$jo_numb_search; ?>" placeholder="Job Order No." id="jo_numb_search" onFocus="search_jo(this.value);" onKeyup="search_jo(this.value);" autocomplete="off" onInput="this.value=this.value.toUpperCase();" />
<input type="button" class="btn btn-search btn-xs" onClick="open_jo_list();return false;" />
    </div>
    <div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" onClick="return wf_check();" value="Save" <?php echo @$insert_disabled; ?> <?php echo @$update_disabled; ?> <?php echo @$post_disabled; ?> <?php echo @$cancel_disabled; ?> id="save" />
<button type="button" class="btn btn-danger css_button btn-xs <?php echo @$access_unpost; ?>" name="recall" id="recall" onClick="wf_check_if_billed(doc_ref.value);" <?php echo @$cancel_disabled; ?> <?php echo @$disabled; ?>>Recall</button>
<input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_post; ?>" name="post" value="Post" <?php echo @$post_disabled; ?> <?php echo @$cancel_disabled; ?> id="post" <?php echo @$disabled; ?> />
<button type="button" class="btn btn-danger css_button btn-xs" name="print" <?php echo @$cancel_disabled; ?> id="print" <?php echo @$disabled; ?>>Print</button>
<input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_cancel; ?>" name="cancel" value="Cancel" <?php echo @$cancel_disabled; ?> id="cancel" <?php echo @$disabled; ?> />
<input type="submit" class="btn btn-danger css_button btn-xs" name="refresh" value="Refresh" />
<button type="button" class="btn btn-danger css_button btn-xs <?php echo @$access_force_recall; ?>" name="force_to_recall" id="force_to_recall" <?php echo @$cancel_disabled; ?> onClick="force_recall();" <?php echo @$disabled; ?>>Force to Recall</button>
<button type="button" class="btn btn-danger css_button btn-xs <?php echo @$access_delete; ?>" name="delete_jo_numb" <?php echo @$post_disabled; ?> <?php echo @$cancel_disabled; ?> id="delete_jo_numb" <?php echo @$disabled; ?> onClick="delete_jo_numb(jo_numb.value,foreign_recno_dbid.value,'http://<?php echo $_SERVER['SERVER_NAME'];?>/les/other_transaction/transaction/job_order_entry/jo_entry.php');">Delete JO</button> 
    </div>
</div>
<div id="fieldsetform">
<input type="hidden" name="foreign_recno_dbid" value="<?php echo @$foreign_recno_dbid; ?>" id="foreign_recno_dbid" />
<fieldset style="float:left;">
<legend>Transaction Information</legend>
<div><label class="field">CSR:</label> <input type="text" name="csr" value="<?php echo @$csr; ?>" class="input bigtxt" placeholder="Reference" id="csr" onKeyUp="check_csr_level(this.value);" onFocus="check_csr_level(this.value);" autocomplete="off" /> <input type="button" class="btn btn-search btn-xs" onClick="open_csr_list('csr','OS');return false;" /> <input type="button" class="btn btn-danger css_button btn-xs" name="csr_searcher" value="..." onClick="check_csr('csr','inputError');return false;" /></div>
<div id="from_csr">
<div><label class="field">Customer:</label> <input type="text" name="c_code" value="<?php echo @$c_code; ?>" class="input" placeholder="Code" onFocus="showCust(this.value);" onKeyUp="showCust(this.value);" id="c_code" autocomplete="off" /> <input type="text" name="client" value="<?php echo @$client; ?>" class="input second_input bigtxt" readonly="readonly" id="client" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('c_code');return false;" /></div>
</div>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea rows="2" cols="38" class="input" id="cust_address" readonly="readonly" name="cust_address"><?php echo @$cust_address; ?></textarea></div>
<div><label class="field">Doc Type:</label> <input type="text" name="doc_type" value="<?php echo @$doc_type; ?>" class="input" id="doc_type" /></div>
<div><label class="field">Doc Ref:</label> <input type="text" name="doc_ref" value="<?php echo @$doc_ref; ?>" class="input" id="doc_ref" /> </div>
<div><label class="field">House Ref:</label> <input type="text" name="hawbno" value="<?php echo @$hawbno; ?>" class="input" id="hawbno" /></div>
<div><label class="field">Master Ref:</label> <input type="text" name="mawbno" value="<?php echo @$mawbno; ?>" class="input" id="mawbno" /></div>
<div><label class="field">Other Ref:</label> <input type="text" name="oth_reference" value="<?php echo @$oth_reference; ?>" class="input" id="oth_reference" /></div>
<div><label class="field">Item Description:</label> <input type="text" name="item_description" value="<?php echo @$item_description; ?>" class="input" id="item_description" /></div>
<div><label class="field">Agent:</label> <input type="text" name="agent_code" value="<?php echo @$agent_code; ?>" class="input" placeholder="Code" onFocus="showAgentName(this.value);" onKeyUp="showCust(this.value);" id="agent_code" /> <input type="text" name="agent_name" value="<?php echo @$agent_name; ?>" class="input second_input bigtxt" readonly="readonly" id="agent_name" /> <input type="button" class="btn btn-search btn-xs" onClick="open_cust_list('agent_code');return false;" /></div>
<div><label class="field">Ex. Rate:</label> <input type="text" name="exrate" value="<?php echo @number_format($exrate,2); ?>" class="input numeric" id="exrate" onkeypress="return isDecimalKey(event);" /></div>
<div><label class="field">Qnty:</label> <input type="text" name="qnty" value="<?php echo @number_format($qnty,0); ?>" class="input numeric" onkeypress="return isNumberKey(event);" id="qnty" /></div>
<div><label class="field">Wt:</label> <input type="text" name="wt" value="<?php echo @number_format($wt,0); ?>" class="input numeric" onkeypress="return isNumberKey(event);" id="wt" /></div>
<div><label class="field">CBM:</label> <input type="text" name="cbm" value="<?php echo @number_format($cbm,4); ?>" class="input numeric" onkeypress="return isDecimalKey(event);" id="cbm" /></div>
</fieldset>
<fieldset style="float: left;">
<legend>Main Information</legend>
<div><label class="field">Job Order No.:</label> <input type="text" name="jo_numb" value="<?php echo @$jo_numb; ?>" class="input" readonly="readonly" id="jo_numb" /></div>
<div><label class="field">Status:</label> <input type="text" name="status" value="<?php echo show_status(@$status); ?>" class="input" readonly="readonly" id="status" /> </div>
<div><label class="field">Transaction Type:</label> 
<select name="trans_type" class="input" id="trans_type">
<option value="<?php echo @$trans_type; ?>"><?php echo show_trans_type(@$trans_type); ?></option>
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
<div><label class="field">Service Type:</label> <input type="text" name="service_type" id="service_type" value="<?php switch(@$service_type){
case 'OT':
echo 'Wrong Other Services';
break;
case 'OS':
echo 'Other Services';
break;
default: echo '';
} ?>" class="input" readonly="readonly" /></div>
<div><label class="field">Transaction Date:</label> <input type="text" name="transaction_date" value="<?php echo date("m/d/Y",strtotime(@$transaction_date)); ?>" class="input datepicker" id="transaction_date" /></div>
<div><label class="field">Billing-in-Charge:</label> <select name="bill_to_dept" class="input" id="bill_to_dept">
<option value="<?php echo @$bill_to_dept; ?>"><?php echo show_bill_to_dept(@$bill_to_dept); ?></option>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT dept_code,dept_desc FROM department");
while($dept=sybase_fetch_array($query)){
?>
<option value="<?php echo $dept['dept_code']; ?>"><?php echo $dept['dept_desc']; ?></option>
<?php
}
sybase_free_result($query);
sybase_close($link);
?>
</select> </div>
<div><label class="field">Total Charges:</label> <input type="text" name="total_charges" value="<?php echo @number_format($total_charges,2); ?>" class="input numeric" id="total_charges" readonly="readonly" /> </div>
<div><label class="field">Bill No.:</label> <input type="text" name="bill_no" value="<?php echo @$bill_no; ?>" class="input" id="bill_no" readonly="readonly" /></div>
<div><label class="field">Prepared By/Date:</label> <input type="text" name="prepared_by" value="<?php echo @$prepared_by; ?>" class="input" id="prepared_by" readonly="readonly" /> <input type="text" name="prepared_datetime" value="<?php echo date("m/d/Y H:i",strtotime(@$prepared_datetime)); ?>" class="input second_input" id="prepared_datetime" readonly="readonly" /></div>
<div><label class="field">Transmittal #:</label> <input type="text" name="transmit_no" value="<?php echo @$transmit_no; ?>" class="input" id="transmit_no" readonly="readonly" /></div>
<div><label class="field">Transmittal Date/Time:</label> <input type="text" name="transmit_date" value="<?php echo date("m/d/Y H:i",strtotime(@$transmit_date)); ?>" class="input" id="transmit_date" readonly="readonly" /> <!--input type="text" name="name" value="<?php //echo date("H:i",strtotime(@$jo['transmit_date'])); ?>" class="input second_input bigtxt" id="transmit_time" /--></div>
<div><label class="field">Transmittal By:</label> <input type="text" name="transmit_by" value="<?php echo @$transmit_by; ?>" class="input" id="transmit_by" readonly="readonly" /> </div>
</fieldset>
<fieldset style="float:left;">
<legend>Trucking (Delivery/Pick-Up)</legend>
<div><label class="field">From:</label> <input type="text" name="trucking_from" value="<?php echo @$trucking_from; ?>" class="input" id="trucking_from" /></div>
<div><label class="field">To:</label> <input type="text" name="trucking_to" value="<?php echo @$trucking_to; ?>" class="input" id="trucking_to" /> </div>
<div><label class="field">DR No.:</label> <input type="text" name="trucking_dr" value="<?php echo @$trucking_dr; ?>" class="input" id="trucking_dr" /> </div>
</fieldset>
<fieldset style="float:left;">
<legend>Special Instructions</legend>
<div><label class="field"><b style="visibility:hidden;">dsfdsf</b></label> <textarea name="instructions" rows="2" cols="38" class="input" id="instructions"><?php echo @$instructions; ?></textarea></div>
</fieldset>
</div>
<!--start booking charges-->
<div style="float:left" id="table">
<div style="height:5px;width:inherit;"></div>
<div class="form-inline col-xs-12 inline_elements">
<div style="height:5px;width:inherit;"></div>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_insert; ?>" name="add" value="Add" <?php echo @$post_disabled; ?> <?php echo @$cancel_disabled; ?> id="add" <?php echo @$disabled; ?> /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_delete; ?>" name="delete" value="Delete" <?php echo @$post_disabled; ?> <?php echo @$cancel_disabled; ?> id="delete" <?php echo @$disabled; ?> /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs" name="get_pcv_cost" value="Get PCV Cost" <?php echo @$post_disabled; ?> <?php echo @$cancel_disabled; ?> id="get_pcv_cost" <?php echo @$disabled; ?> /></span>
</div>
<br />
<div style="height:25px;width:inherit;"> </div>
<div style="float:left;"><table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead><tr>
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>">Override</th>
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_delete; ?>">Delete</th>
	<th>GRP</th>
	<th>Group Description</th>
	<th>CHG</th>
	<th>Charge Description</th>
	<th>Selling Rate</th>
	<th>Currency</th>
	<th>Collect Tag</th>
	<th>Bill To Code</th>
	<th>Bill To Name</th>
	<th>Prepared By</th>
	<th>Date Prepared</th>
	<th>Override By</th>
	<th>Date Override</th>
</tr></thead>
<tbody id="booking_charges_from_csr"></tbody>
<tbody>
<!--tr id="booking_charges_from_csr"></tr-->
<tr>
<?php
if((isset($_POST['save']) || isset($_POST['post']) || isset($_POST['cancel'])) && strlen($foreign_recno_dbid)>0){ 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT recno,chg_grp,chg_grp_desc,service_code,service_description,selling_rate,selling_currency,collect_tag,bill_to_code,bill_to_name,
prepared_by,date_prepared,override_by,date_override FROM booking_charges WHERE foreign_recno_dbid=$foreign_recno_dbid");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){
?>
	<td style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/other_transaction/transaction/job_order_entry/recno.php?recno=<?php echo $row['recno']; ?>&foreign_recno_dbid=<?php echo $foreign_recno_dbid; ?>" class="hover_row">Override</a></td>
	<td style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_delete; ?>"><input type="checkbox" value="<?php echo @$row['recno']; ?>" name="checkbox[]" class="highlight_row" /></td>
	<td><?php echo @$row['chg_grp']; ?></td>
	<td><?php echo @$row['chg_grp_desc']; ?></td>
	<td><?php echo @$row['service_code']; ?></td>
	<td><?php echo @$row['service_description']; ?></td>
	<td><?php echo number_format($row['selling_rate'],2); ?></td>
	<td><?php echo @$row['selling_currency']; ?></td>
	<td><?php echo show_collect_tag($row['collect_tag']); ?></td>
	<td><?php echo @$row['bill_to_code']; ?></td>
	<td><?php echo @$row['bill_to_name']; ?></td>
	<td><?php echo @$row['prepared_by']; ?></td>
	<td><?php echo date("m/d/Y H:i",strtotime($row['date_prepared'])); ?></td>
	<td><?php echo @$row['override_by']; ?></td>
	<td><?php echo date("m/d/Y H:i",strtotime($row['date_override'])); ?></td>
</tr>
<?php 
	}
sybase_free_result($query);
sybase_close($link);
}
include 'previous_booking_charge.php';
?>
</tbody>
<!--tfoot><tr><td colspan="13"><div id="paging"><ul>
	<li><a href="#"><span>Previous</span></a></li>
	<li><a href="#" class="active"><span>1</span></a></li>
	<li><a href="#"><span>2</span></a></li>
	<li><a href="#"><span>3</span></a></li>
	<li><a href="#"><span>4</span></a></li>
	<li><a href="#"><span>5</span></a></li>
	<li><a href="#"><span>Next</span></a></li>
</ul></div></tr></tfoot-->
</table></div>
<p>Total No. of Records: <?php echo @$numrows; ?></p>
</div>
</form>
</div>
<?php include("http://".$_SERVER['SERVER_NAME']."/les/recall_pop_up.html"); ?>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
</body>
</html>