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