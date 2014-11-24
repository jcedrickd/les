function check_transact_date(transact_date,error_msg_id){
	transact_date_str=document.getElementById(transact_date).value.trim();
		if(transact_date_str.length < 1 || transact_date_str == "01/01/1970"){
		document.getElementById(error_msg_id).innerHTML="<span id='"+error_msg_id+"'><b>Error: Transaction Date still empty!</b></span>";
		return false;
		}
	return true;
}
/*alert("Transaction Date still empty!");*/