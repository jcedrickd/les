function cancel_pcv(pcv_no_str){
var vc_reason_str=prompt("Enter Reason for cancellation:","");
    if (vc_reason_str.trim().length > 0) {
        $(document).ready(function(){
            jQuery.ajax({
				type: "POST",
				url: "http://wmsonline.aai.com.ph/les/includes/ajax/pcv/cancel.php",
				data: {pcv_no: pcv_no_str,vc_reason: vc_reason_str},
				success: function(responseTxt) { // if no errors
                                search_pcv(pcv_no_str);  
                                },
				timeout: 15000, // timeout if 15 secs
				error: function(jqXHR, textStatus, errorThrown) { // connection error handler
					switch(textStatus){
						case "timeout": // connection timeout handler
						alert('Connection Timeout, Please Try Later');
                                                $("#loader").html('<img src="http://wmsonline.aai.com.ph/les/includes/img/alarm-error-icon.png" /> Connection Timeout, Please Try Later.');
                                                break;
						case "error":
						alert('Connection Error'); // connection 404 handler
                                                $("#loader").html('<img src="http://wmsonline.aai.com.ph/les/includes/img/alarm-error-icon.png" /> Connection Error.');
                                                break;
						default:
						alert(textStatus);
                                                $("#loader").html('<img src="http://wmsonline.aai.com.ph/les/includes/img/alarm-error-icon.png" />'+ textStatus);
                                        }
				}
			}); // ajax end
        });
    }else{
	alert("Error: Reason is required!");
	}
}