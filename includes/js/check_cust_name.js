function check_cust_name(cust_name,error_msg_id){
	cust_name=document.getElementById(cust_name).value;
		if(cust_name.trim() == "VARIOUS" || cust_name.trim() == "Various"){
		document.getElementById(error_msg_id).innerHTML="<span id='"+error_msg_id+"'><b>Error: Client name Various not allowed! Please supply specific client!</b></span>";
		return false;
		}
	return true;
}
/*alert("Client name Various not allowed! Please supply specific client!");*/