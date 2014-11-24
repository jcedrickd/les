$(document).ready(function(){
   $("#pcv_numb_search").focus(function(){
    var search_pcv = $("#pcv_numb_search").val();
    var dataString = 'pcv_numb_search='+ search_pcv;
    
        if(search_pcv.length == 12 && ($("#pcv_numb_search").val() != $("#pcv_no").val())){
            $.ajax({
            type: "GET",
            url: "http://wmsonline.aai.com.ph/les/includes/ajax/pcv/other_transaction.php",
            data: dataString,
            cache: false,
                beforeSend: function(html){
                document.getElementById("pcv_entry").innerHTML = '';
                $("#loader").html('<img src="http://wmsonline.aai.com.ph/les/includes/img/ajax-content-loader.gif" /> Loading Results...');
                },
                success: function(html){
                $("#pcv_entry").append(html);
                $("#loader").hide();
				disable_buttons('pcv_stat','validate_stat');
                },
                timeout: 15000, // timeout if 15 secs
		error: function(jqXHR, textStatus, errorThrown){ // connection error handler
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
            });
        }
    return false;
    });
    
    $("#pcv_numb_search").keyup(function(){
    var search_pcv = $("#pcv_numb_search").val();
    var dataString = 'pcv_numb_search='+ search_pcv;
    
        if(search_pcv.length == 12 && ($("#pcv_numb_search").val() != $("#pcv_no").val())){
        document.getElementById("pcv_entry").innerHTML = '';
        $("#loader").html('<img src="http://wmsonline.aai.com.ph/les/includes/img/ajax-content-loader.gif" /> Loading Results...');         
            $.ajax({
            type: "GET",
            url: "http://wmsonline.aai.com.ph/les/includes/ajax/pcv/other_transaction.php",
            data: dataString,
            cache: false,
                beforeSend: function(html){
                document.getElementById("pcv_entry").innerHTML = '';
                $("#loader").html('<img src="http://wmsonline.aai.com.ph/les/includes/img/ajax-content-loader.gif" /> Loading Results...');
                },
                success: function(html){
                $("#pcv_entry").append(html);
                $("#loader").hide();
				disable_buttons('pcv_stat','validate_stat');
                },
                timeout: 15000, // timeout if 15 secs
		error: function(jqXHR, textStatus, errorThrown){ // connection error handler
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
            });
        }
    return false;
    });  
});