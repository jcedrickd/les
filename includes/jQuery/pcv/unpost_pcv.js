function unpost_pcv(pcv_no_str){
    if (confirm("Are you sure do you want to unpost PCV No.: " +pcv_no_str+" ?") == true) {
        $(document).ready(function(){
            jQuery.ajax({
				type: "POST",
				url: "http://wmsonline.aai.com.ph/les/includes/ajax/pcv/unpost.php",
				data: {pcv_no: pcv_no_str},
				success: function(responseTxt) { // if no errors
                                    if(responseTxt=="Unposted"){
									alert(pcv_no_str + " has been unposted!");
                                    search_pcv(pcv_no_str);
                                    }else{
                                    $("#inputError").append(responseTxt);    
                                    }
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
    }
}