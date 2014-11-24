function check_num_required(id_name,field_name,error_msg_id){
		id_name_num=document.getElementById(id_name).value;
			if(id_name_num < 1){
			document.getElementById(error_msg_id).innerHTML="<span id='"+error_msg_id+"'><b>Error: "+field_name+" still empty!</b></span>";
			return false;
			}
		return true;
}
/*alert(field_name+" still empty!");*/